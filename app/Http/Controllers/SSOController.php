<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SSOController extends Controller
{
    protected $_usersRepository;

    public function __construct()
    {
        $this->_usersRepository      = new User;    
    }

    public function getUrlSSO() {
        $query = http_build_query([
            "response_type" => "code",
            "client_id" => config("auth.client_id"),
        ]);

        $url = config("auth.sso_host") . "/realms" . "/" . config("auth.sso_realm") . "/protocol/openid-connect/auth?" . $query;
        try {
            return Redirect::away($url);
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function ssoCallback(Request $request)
    {
        $server_output = $this->_getToken($request);
        $data = ['data' => $server_output];
        $request->session()->put($data);
        return redirect(route('sso.connect'));
    }

    public function connectUser(Request $request)
    {
        $data = json_decode($request->session()->get('data'));
        if (empty($data->access_token)) {
            return redirect('masuk')->with('error', 'Anda tidak memiliki akses! Access Token not found');
        }
        $datauser = $this->_getUserData($data);
        $params = [
            'id_sso' => $datauser->sub,
            'refresh_token' => $data->refresh_token,
            'token_sso' => $data->access_token,
        ];
        $data = ['data_user' => $datauser];
        $request->session()->put($data);
        $credentials = $this->_usersRepository->getByNIK($datauser->preferred_username ?? 'nonik');
        // User Validation
        if (!$credentials) {
            $this->_deleteSessionSSO($params);
            return redirect('/masuk')->with('error', 'Pengguna tidak terdaftar'); 
        }

        if (!$credentials->user_is_active) {
            $this->_deleteSessionSSO($params);
            return redirect('/masuk')->with('error', 'Pengguna belum melakukan aktivasi melalui email yang sudah di daftarkan '); 
        }

        if ($credentials) {
            if (Auth::loginUsingId($credentials->user_id)) {
                $request->session()->put(['id_sso' => $datauser->sub]);
                $this->_setLogSSO($datauser->preferred_username, 'LOGIN');
                return redirect()->intended('user/beranda');
            } else {
                return redirect('masuk')->with('error', 'Anda tidak memiliki akses!');
            }
        } else {
            return redirect('masuk')->with('error', 'Anda tidak memiliki akses!');
        }
    }

    public function _getToken($request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,config("auth.sso_host"). "/realms/".config('auth.sso_realm')."/protocol/openid-connect/token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"grant_type=authorization_code&client_id=".config("auth.client_id")."&client_secret=".config("auth.client_secret")."&code=".$request->code);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }

    public static function _setLogSSO($email, $type_notification)
    {
        $icon = "ti ti-bolt";
        if ($type_notification == 'LOGOUT') {
            $icon = "ti ti-key";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,config("auth.sso_api_host"). "/user/logs");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"type_notification=".$type_notification."&app_id=".config("auth.client_id")."&icon=".$icon."&user_name=".$email);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec ($ch);
        curl_close ($ch);
        return $result;
    }

    public static function _deleteSessionSSO($params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config("auth.sso_host") . "/admin/realms/" . config('auth.sso_realm') . "/users/" . $params['id_sso'] . "/logout");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=" . config("auth.client_id") . "&refresh_token=" . $params['refresh_token']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $params['token_sso']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function _getUserData($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,config("auth.sso_host"). "/"."realms"."/".config('auth.sso_realm')."/protocol/openid-connect/userinfo");
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Authorization: Bearer ' . $data->access_token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec ($ch);
        curl_close ($ch);
        return json_decode($result);
    }
}
