<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Helpers\ResponseHelper;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use App\Helpers\FCMHelper;
use App\Repositories\UserForgotRepository;
use App\Mail\UserForgotPasswordMail;
use App\Mail\UserVerificationMail;
// Use App\User;
use App\Helpers\LogHelper;
use App\Helpers\CheckSiak;

use App\Models\User;
use App\Models\UserTemp;
use Session;
use DB;
use AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use Modules\Users\Repositories\UsersRepository;

class UserController extends Controller
{
    protected $_SSOController;

    public function __construct()
    {

        $this->_userRepository      = new User;
        $this->_userTemp = new UserTemp;
        $this->_forgotRepository    = new UserForgotRepository;
        $this->_logHelper           = new LogHelper;
        $this->_fcmHelper           = new FCMHelper;
        $this->_SSOController = new SSOController;
    }

    public function login(Request $request)
    {
        $data['client_id'] = null;
        $data['token'] = null;
        $data['client_secret'] = null;

        if (!empty($request->client_id) && !empty($request->token) && !empty($request->client_secret)) {
            $data['client_id'] = $request->client_id;
            $data['token'] = $request->token;
            $data['client_secret'] = $request->client_secret;
            $data['nama'] = $request->nama ?? null;
            $data['email'] = $request->email ?? null;
            $data['nik'] = $request->username ?? null;
            return view('auth.loginwithsso', compact('data'));
        } else {
            if (Auth::check()) {
                return redirect('/user/beranda');
            }
            return view('auth.login', compact('data'));
        }
    }

    public function register(Request $request)
    {
        $data['client_id'] = null;
        $data['token'] = null;
        $data['client_secret'] = null;

        if (!empty($request->client_id) && !empty($request->token) && !empty($request->client_secret)) {
            $data['client_id'] = $request->client_id;
            $data['token'] = $request->token;
            $data['client_secret'] = $request->client_secret;
            $data['nama'] = $request->nama ?? null;
            $data['email'] = $request->email ?? null;
            $data['nik'] = $request->username ?? null;
            return view('auth.registerwithsso', compact('data'));
        } else {
            if (Auth::check()) {
                return redirect('/user/beranda');
            }
            return view('auth.register', compact('data'));
        }
    }

    public function username()
    {
        return 'usuario';
    }

    public function forgot()
    {
        if (Auth::check()) {
            return redirect('/user/beranda');
        }

        return view('auth.forgotpassword');
    }

    public function authenticate(Request $request)
    {

        // if ($request->input('g-recaptcha-response') !== null) {
        //     $captcha = $request->input('g-recaptcha-response');
        // } else {
        //     $captcha = false;
        // }

        // if (!$captcha) {
        //     //Do something with error
        //     return redirect('login')->with('error', 'Captcha tidak ditemukan! coba masuk kembali');
        // } 
        // else {
        //     $secret   = '6Lca1VEeAAAAAPLIfIkOXh1qQHyiH7K2dZfI4tkv';
        //     $response = file_get_contents(
        //         "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
        //     );

        //     // use json_decode to extract json response
        //     $response = json_decode($response);

        //     if ($response->success === false) {
        //         //Do something with error
        //         return redirect('login')->with('error', 'Verifikasi captcha gagal! coba masuk kembali');
        //     }
        // }

        $credentials = $request->only('user_username', 'user_password');
        $param = '';
        if (!empty($request->client_id) && !empty($request->token) && !empty($request->client_secret)) {
            $param = "?client_id=" . $request->client_id . "&client_secret=" . $request->client_secret . "&token=" . $request->token . "&user_id=" . $credentials['user_username'] . "&id=" . env('APPLICATION_ID');
        }

        $validator = Validator::make($request->all(), $this->_rules(''));

        if ($validator->fails()) {
            return redirect('/masuk' . $param)->with('error', 'NIK dan kata sandi tidak boleh kosong');
        }

        $getUser = $this->_userRepository->getByNIK($request->user_username);

        // dd($getUser->user_is_active);

        // User Validation
        if (!$getUser) {
            return redirect('/masuk' . $param)->with('error', 'Pengguna tidak terdaftar');
        }

        if (!$getUser->user_is_active) {
            return redirect('/masuk' . $param)->with('error', 'Pengguna belum melakukan aktivasi melalui email yang sudah di daftarkan ');
        }

        if (Auth::guard('web')->attempt(['user_username' => $credentials['user_username'], 'user_password' => $credentials['user_password'], 'user_is_active' => 1])) {
            if (!empty($request->client_id) && !empty($request->token) && !empty($request->client_secret)) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, config("auth.sso_api_host") . "/" . "service" . "/create");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=" . $request->client_id . "&client_secret=" . $request->client_secret . "&token=" . $request->token . "&user_id=" . $credentials['user_username'] . "&id=" . env('APPLICATION_ID'));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
                return redirect()->intended('user/beranda');
            } else {
                return redirect()->intended('user/beranda');
            }
        } else {
            if (!empty($request->client_id) && !empty($request->token) && !empty($request->client_secret)) {
                return redirect('/masuk' . $param)->with('error', 'NIK atau kata sandi salah');
            } else {
                return redirect('/masuk')->with('error', 'NIK atau kata sandi salah');
            }
        }
    }

    public function setting()
    {

        return view('user.setting');
    }

    public function changepassword(Request $request)
    {

        $currpass = $request->input('current_password');
        $password = $request->input('user_password');

        if (!Hash::check($currpass, Auth::user()->user_password)) {
            return redirect('setting')->with('error', 'Kata sandi sekarang salah');
        }

        $this->_userRepository->update(DataHelper::_normalizeParams(['user_password' => $password], false, true), Auth::user()->user_id);

        return redirect('setting')->with('message', 'Kata sandi berhasil diubah');
    }

    public function sendforgot(Request $request)
    {

        $username = $request->input('user_username');
        $getUser = $this->_userRepository->getByNIK($username);

        // User Validation
        if (!$getUser) {
            return redirect('/lupa-sandi')->with('error', 'Email tidak terdaftar!');
        }

        try {

            $token = md5(sha1($getUser->user_email . time() . uniqid()));
            $idEnc = Crypt::encryptString($getUser->user_id);

            $data = array(
                'email' => $getUser->user_email,
                'token' => $token,
                'name' => $getUser->user_nama,
                'id' => $idEnc,
                'url' => env('APP_URL'),
            );

            Mail::to($getUser->user_email)->send(new UserForgotPasswordMail($data));

            $value = array(
                'forgot_id' => $token,
                'forgot_expired' => date('Y-m-d H:i:s', time() + 600),
                'user_id' => $getUser->user_id,
                'created_by' => $getUser->user_id,
                'created_at' => date('Y-m-d H:i:s')
            );

            $this->_forgotRepository->insert(DataHelper::_normalizeParams($value, false));

            return redirect('/lupa-sandi')->with('message', 'Lupa kata sandi berhasil dikirim melalui email!');
        } catch (Exception $e) {
            return redirect('/lupa-sandi')->with('error', 'Terjadi kesalahan!');
        }
    }

    public function reset($id, $token)
    {
        if (Auth::check()) {
            return redirect('/user/beranda');
        }

        $user_id = Crypt::decryptString($id);

        // User Validation
        $getUser = $this->_userRepository->getById($user_id);

        if (!$getUser) {
            return redirect('/lupa-sandi')->with('error', 'Penggunga tidak terdaftar!');
        }

        // Token Validation
        $getToken = $this->_forgotRepository->getByParams(['forgot_id' => $token, 'user_id' => $user_id, 'forgot_status' => true]);

        if (!$getToken) {
            return redirect('/lupa-sandi')->with('error', 'Token tidak valid!');
        }

        if ($getToken->forgot_expired < date('Y-m-d H:i:s')) {
            return redirect('/lupa-sandi')->with('error', 'Token sudah kadaluarsa!');
        }

        return view('auth.resetpassword', compact('id', 'token'));
    }

    public function do_reset(Request $request)
    {

        $user_id = Crypt::decryptString($request->input('id'));
        $token = $request->input('token');
        // $password = $request->input('user_password');
        $password = Hash::make($request['user_password']);


        // User Validation
        $getUser = $this->_userRepository->getById($user_id);

        if (!$getUser) {
            return redirect('/reset-sandi' . '/' . $request->input('id') . '/' . $token)->with('error', 'Terjadi kesalahan penggunga tidak terdaftar!');
        }

        // Token Validation
        $getToken = $this->_forgotRepository->getByParams(['forgot_id' => $token, 'user_id' => $getUser->user_id, 'forgot_status' => '1']);

        if (!$getToken) {
            return redirect('/reset-sandi' . '/' . $request->input('id') . '/' . $token)->with('error', 'Token tidak valid');
        }

        if ($getToken->forgot_expired < date('Y-m-d H:i:s')) {
            return redirect('/reset-sandi' . '/' . $request->input('id') . '/' . $token)->with('error', 'Token sudah kadaluarsa');
        }

        DB::beginTransaction();
        $requests['user_password'] = $password;
        $forgots['forgot_status'] = false;
        // $this->_userRepository->update(DataHelper::_normalizeParams(['user_password' => $password], false, false), $user_id);
        $this->_userRepository->updateData(DataHelper::_normalizeParams($requests, false, false), $user_id);

        $this->_forgotRepository->updateData(DataHelper::_normalizeParams($forgots, false, false), $token);

        DB::commit();

        return redirect('/masuk')->with('message', 'Kata sandi berhasil diubah, silahkan masuk menggunakan kata sandi baru');
    }

    public function fcm_token(Request $request)
    {

        if (!Auth::check()) {
            return false;
        }

        $this->_fcmHelper->saveToken($request->input('token'), Auth::user()->user_id, $request->header('User-Agent'));

        return true;
    }

    public function logout(Request $request)
    {
        $data = json_decode($request->session()->get('data'));
        $data_user = $request->session()->get('data_user');
        Auth::logout();
        if ($data != null) {
            // $this->_SSOController->_setLogSSO($data_user->preferred_username, 'LOGOUT');
            // config("auth.sso_host")
            return redirect()->to('https://polakami.cimahikota.go.id/logout');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Register User.
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->_registerRules()['rules'], $this->_registerRules()['messages']);
        $token = md5(sha1($request->user_nik . time() . uniqid()));
        $param = "?client_id=" . $request->client_id . "&client_secret=" . $request->client_secret . "&token=" . $request->token . "&user_id=" . $request['user_nik'] . "&id=" . env('APPLICATION_ID');
        // dd($validator->messages());
        unset($request['repassword']);
        $password = Hash::make($request['user_password']);
        if ($request->is_sso) {
            $password = Hash::make('Is*SSO*Secret*2024');
        }

        if ($validator->fails()) {
            //if user is activation false 
            $getUser = $this->_userRepository->getByNIK($request['user_nik']);
            $id_enc = Crypt::encryptString($getUser->user_id);
            $email = $request['user_email'];
            $nama = $request['user_nama'];


            //email yan dimasukan sebelum nya salah tp belum aktif
            // if (!$getUser->user_is_active) {
            //     $this->_userRepository->updateData(DataHelper::_normalizeParams(['user_password' => $password], false, false), $getUser->user_id);
            //     $this->_userRepository->updateData(DataHelper::_normalizeParams(['user_email' => $email], false, false), $getUser->user_id);
            //     return $this->resendEmail($id_enc, true, $email);
            // }

            if (!empty($request->client_id) && !empty($request->token) && !empty($request->client_secret)) {
                return redirect('/daftar' . $param)->withErrors($validator)->withInput();
            } else {
                return redirect('/daftar')->withErrors($validator)->withInput();
            }
        }

        /* for testing only
            $request['user_is_active']        = true;
        */

        // $request['user_is_active'] = false;
        // $request['user_is_comp_profile'] = false;
        $data['user_username'] = $request['user_nik'];
        $data['user_nik'] = $request['user_nik'];
        $data['user_kk'] = $request['user_kk'];
        $data['user_nama'] = $request['user_nama'];
        $data['user_email'] = $request['user_email'];
        $data['user_password'] = $password;
        // $request['user_email_is_activate'] = false;
        // $request['user_email_is_change'] = false;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['user_email_token'] = $token;
        $data['user_email_expired'] = date('Y-m-d H:i:s', time() + 24 * 60 * 60);

        //check to siak
        if (empty($request->client_id) && empty($request->token) && empty($request->client_secret)) {
            // mantra cek kependudukan
            $checkRes = CheckSiak::exec($request);

            dd($checkRes);

            //do scoring
            $score = $checkRes['score'];

            if ($score < 100) {
                $message = 'Data yang anda masukan tidak sesuai dengan data kependudukan. Tolong cek kembali kesuaian ' . $checkRes['message_score'];

                return redirect('/masuk')->with('error', $message);
            }
        }


        $nikEnc = Crypt::encryptString($request['user_nik']);
        $data_email = [];
        $param = "?client_id=" . $request->client_id . "&client_secret=" . $request->client_secret . "&token=" . $request->token . "&user_id=" . $data['user_username'] . "&id=" . env('APPLICATION_ID');

        DB::beginTransaction();
        // dd($data, $request->all());

        // $store = $this->_userRepository->insertGetId(DataHelper::_normalizeParams($request->all()), 'user_id');

        $store = $this->_userTemp->insertGetId(DataHelper::_normalizeParams($data), 'user_id');

        $id_enc = Crypt::encryptString($store);
        $is_SSO = false;

        if ($store) {
            if (!empty($request->client_id) && !empty($request->token) && !empty($request->client_secret)) {
                $is_SSO = true;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, config("auth.sso_api_host") . "/" . "service" . "/create");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=" . $request->client_id . "&client_secret=" . $request->client_secret . "&token=" . $request->token . "&user_id=" . $request['user_nik'] . "&id=" . env('APPLICATION_ID'));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
            }
            $data_email = array(
                'name' => $request['user_nama'],
                'nik' => $nikEnc,
                'email' => $request['user_email'],
                'token' => $token,
                'url' => env('APP_URL'),
                'user_id' => $id_enc,
            );
        }

        DB::commit();

        return $this->_sendMailActivation($data_email, '', $is_SSO, $param);
    }

    /**
     * Resend Email User.
     * @param id;
     * @return Response
     */
    public function resendEmail($id, $is_validate = false)
    {
        $user_id = Crypt::decryptString($id);
        $getUser = $this->_userTemp->getById($user_id);

        if (!$getUser) {
            $message = "Akun sudah pernah melakukan aktivasi";
            return redirect('/masuk')->with('error', $message);
        }

        $nikEnc = Crypt::encryptString($getUser->user_nik);

        // $email = $getUser->user_email;

        $data_email = array(
            'name' => $getUser->user_nama,
            'nik' => $nikEnc,
            'email' => $getUser->user_email,
            'token' => $getUser->user_email_token,
            'url' => env('APP_URL'),
            'user_id' => $id,
        );

        $message = '';

        if ($is_validate) {
            $message = "Anda sudah pernah mendaftar, silahkan cek email untuk melakukan aktivasi";
        };

        return $this->_sendMailActivation($data_email, $message, false);
    }

    private function _sendMailActivation($data, $message, $is_sso, $param = null)
    {
        if ($is_sso) {
            return $this->activationSso($data['nik'], $data['token'], $data, $message, $param);
        } else {
            Mail::to($data['email'])->send(new UserVerificationMail($data));
            return redirect('/daftar/selesai/' . $data['user_id'])->with('message', $message);
        }
    }

    public function activationSso($nik, $token, $data, $messages, $param)
    {
        $nikDec = Crypt::decryptString($nik);
        $getUserByToken = $this->_userTemp->getByParams(['user_email_token' => $token, 'user_nik' => $nikDec]);
        $getUser = $this->_userRepository->getByNIK($nikDec);

        if ($getUser) {
            $message = "Akun sudah pernah berhasil diaktifasi";
            return redirect('/masuk' . $param)->with('error', $message);
        }

        // Token Validation
        if (!$getUserByToken) {
            $message = "Izin akses gagal, Token tidak valid!";
            return redirect('/masuk' . $param)->with('error', $message);
        }

        $id = $getUserByToken->user_id;
        $request['user_username'] = $getUserByToken->user_nik;
        $request['user_kk'] = $getUserByToken->user_kk;
        $request['user_nik'] = $getUserByToken->user_nik;
        $request['user_nama'] = $getUserByToken->user_nama;
        $request['user_password'] = $getUserByToken->user_password;
        $request['created_at'] = date('Y-m-d H:i:s');
        $request['user_email'] = $getUserByToken->user_email;
        $request['user_email_token'] = $getUserByToken->user_email_token;
        $request['user_email_expired'] = $getUserByToken->user_email_expired;
        $request['user_is_comp_profile'] = false;
        $request['user_is_active'] = true;
        $request['user_email_is_activate'] = true;
        $request['user_email_is_change'] = false;

        DB::beginTransaction();
        $this->_userRepository->insertGetId(DataHelper::_normalizeParams($request), 'user_id');
        UserTemp::where('user_id', $id)->delete();
        DB::commit();

        return redirect('/izinsso/selesai/' . $data['user_id'])->with('message', $messages);
    }

    /**
     * Update the activation status user in storage.
     * @param string token
     * @param string nik
     * @return Renderable
     */
    public function activation($nik, $token)
    {
        $nikDec = Crypt::decryptString($nik);

        $getUserByToken = $this->_userTemp->getByParams(['user_email_token' => $token, 'user_nik' => $nikDec]);

        $getUser = $this->_userRepository->getByNIK($nikDec);

        // get User 
        // $getUser = $this->_userTemp->getByNIK($nikDec);

        // if (!$getUserByToken) {
        //     $message = "Penggunga tidak terdaftar!";
        //     return redirect('/masuk')->with('error', $message);
        // }

        // if user exist but activation looping by user
        if ($getUser) {
            // if ($getUser->user_is_active) {

            $message = "Akun sudah pernah berhasil diaktifasi";
            return redirect('/masuk')->with('error', $message);
            // }

        }

        // Token Validation
        if (!$getUserByToken) {
            $message = "Validasi Email Gagal, Token tidak valid!";
            if (!Auth::check()) {
                return redirect('/masuk')->with('error', $message);
            }
            return redirect('/user/profil')->with('error', $message);
        }

        // if($getToken->user_email_expired < date('Y-m-d H:i:s')){
        //     $message = "Token kadaluarsa !";
        //     return redirect('/user/login')->with('error', $message);
        // }
        // $request['user_is_active'] = false;
        // $request['user_is_comp_profile'] = false;
        $id = $getUserByToken->user_id;
        $request['user_username'] = $getUserByToken->user_nik;
        $request['user_kk'] = $getUserByToken->user_kk;
        $request['user_nik'] = $getUserByToken->user_nik;
        $request['user_nama'] = $getUserByToken->user_nama;
        $request['user_password'] = $getUserByToken->user_password;
        $request['created_at'] = date('Y-m-d H:i:s');
        $request['user_email'] = $getUserByToken->user_email;
        $request['user_email_token'] = $getUserByToken->user_email_token;
        $request['user_email_expired'] = $getUserByToken->user_email_expired;
        $request['user_is_comp_profile'] = false;
        $request['user_is_active'] = true;
        $request['user_email_is_activate'] = true;
        $request['user_email_is_change'] = false;
        // dd($request);

        DB::beginTransaction();
        $this->_userRepository->insertGetId(DataHelper::_normalizeParams($request), 'user_id');
        UserTemp::where('user_id', $id)->delete();
        // $this->_userRepository->updateData(DataHelper::_normalizeParams($request, false, false), $getUser->user_id);
        DB::commit();

        if (Auth::check()) {
            return redirect('/user/profil')->with('message', 'Akun email berhasil diaktivasi');
        }

        return redirect('/masuk')->with('message', 'Akun berhasil diaktivasi, silahkan login');
    }

    private function _rules()
    {

        $rules = array(
            'user_username' => 'required',
            'user_password' => 'required',
            'g-recaptcha-response' => 'recaptcha'
        );

        return $rules;
    }

    private function _registerRules()
    {

        $rules = array(
            'g-recaptcha-response' => 'recaptcha',
            'user_nik' => [
                Rule::unique('users')->where(function ($query) {
                    $query->where('user_is_active', true);
                })
            ],
        );


        $messages = array(
            'user_nik.unique' => 'NIK sudah ada yang menggunakan'
        );

        return array('rules' => $rules, 'messages' => $messages);
    }

    /**
     * check user by NIK.
     * 
     * Get checking access NIK.
     * 
     * 
     * @bodyParam  nik required NIK user masyarakat
     * 
     * @response  {
     *  "code": 200,
     *  "status": "OK",
     *  "message": "Sukses",
     *  "result": 
     *           {
     *               "status": true,
     *           }
     *       ,
     *  "time": "2022-12-05 11:13:18"
     * }
     *
     */

    public function checkniksso(Request $request)
    {

        $getUser = $this->_userRepository->getByNIK($request->nik);

        $result = array(
            'status' => false,
        );

        // if user exist
        if ($getUser) {
            $result['status'] = true;
        }

        return ResponseHelper::setResponse(200, 'Sukses', $result);
    }

    public function showForm()
    {

        // dd('here');
        return view('users.services.form-detail');
    }
    public function submitForm(Request $request)
    {
        // Validasi dan simpan data
        $validatedData = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'nama_kelurahan' => 'required|string|max:255',
            'nama_kecamatan' => 'required|string|max:255',
            'paraf_kelurahan' => 'required|string',
            'tanda_tangan_kelurahan' => 'required|string',
            'paraf_kecamatan' => 'required|string',
            'tanda_tangan_kecamatan' => 'required|string',
        ]);

        // Simpan data ke database atau proses lainnya

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function showVerification()
    {
        $data = [
            'nomor_surat' => '123/ABC/2024',  // Contoh nomor surat
            'layanan' => 'Nama Layanan',      // Contoh layanan
            'tanggal_surat' => date('Y-m-d'), // Contoh tanggal surat
            'pdf_filename' => 'test.pdf' // Nama file PDF
        ];

        return view('users.services.verification-permohonan', $data);
    }
}
