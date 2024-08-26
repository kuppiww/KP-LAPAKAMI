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
use App\Models\User;
use App\Models\UserTemp;
use Session;
// use DB;
use Illuminate\Support\Facades\DB;
use AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use Modules\Request\Repositories\RequestVerificationRepository;
use Modules\Request\Repositories\ServiceRepository;
use Modules\Users\Repositories\SysUsersRepository;
use Modules\Users\Repositories\UsersRepository;

class VerifikatorController extends Controller
{
    protected $_SSOController;
    protected $_userRepository;
    protected $_userTemp;
    protected $_forgotRepository;
    protected $_logHelper;
    protected $_fcmHelper;
    protected $_sysUsersRepository;
    protected $_requestVerificationRepository;
    protected $_serviceRepository;

    public function __construct()
    {

        $this->_userRepository      = new User;
        $this->_userTemp = new UserTemp;
        $this->_forgotRepository    = new UserForgotRepository;
        $this->_logHelper           = new LogHelper;
        $this->_fcmHelper           = new FCMHelper;
        $this->_SSOController = new SSOController;
        $this->_sysUsersRepository = new SysUsersRepository;
        $this->_requestVerificationRepository = new RequestVerificationRepository;
        $this->_serviceRepository = new ServiceRepository;
    }

    public function storeverification(Request $request, $id, $jenis, $service)
    {
        $user = Auth::guard('admin')->user();

        $getService = $this->_serviceRepository->getByParams(['slug' => $service, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        $lastId = $this->_requestVerificationRepository->getLastID($jenis, $id);

        $data = [
            'request_id' => $id,
            'status' => 'NEEDS_CLARIFICATION',
            'user_id' => $request->pegawai,
            'verification_number' => $lastId,
            'created_at' => date('Y-m-d h:i:s'),
            'created_by' => $user->user_id
        ];

        DB::beginTransaction();
        $this->_requestVerificationRepository->insert($data);
        DB::commit();

        return redirect('/operator/'.$service.'/lihat/'.$id)->with('success', 'Berhasil menambah verifikator');
    }

    public function deleteverification($id, $request_id, $service)
    {
        $user = Auth::guard('admin')->user();
        $getService = $this->_serviceRepository->getByParams(['slug' => $service, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }
        $params['request_id'] = $request_id;
        if ($user->is_kecamatan_employee) {
            $params['kd_kec'] = $user->kd_kec;
            $params['group_id'] = 'pkecamatan';
        } else {
            $params['kd_kel'] = $user->kd_kel;
            $params['group_id'] = 'pkelurahan';
        }

        $getVerification = $this->_requestVerificationRepository->getById($id);

        if (!$getVerification) {
            return redirect(url('404'));
        }
        
        DB::beginTransaction();
        $this->_requestVerificationRepository->delete($id);
        DB::commit();

        $dataBeforeDel = $this->_requestVerificationRepository->getByParams($params);

        foreach ($dataBeforeDel as $key => $value) {
            $dataVer['verification_number'] = $key;
            $data['req_verification_id'] = $value->req_verification_id;
            DB::beginTransaction();
            $this->_requestVerificationRepository->update($dataVer, $data['req_verification_id']);
            DB::commit();
        }

        // $data = array_values($data);
        // foreach ($data as $index => &$item) {
        //     $item[0] = (string)$index;
        // }

        // foreach ($data as $key => $value) {
        //     $dataVer['verification_number'] = $value[0];
        //     DB::beginTransaction();
        //     $this->_requestVerificationRepository->update($dataVer, $value[1]);
        //     DB::commit();
        // }

        return redirect('/operator/'.$service.'/lihat/'.$request_id)->with('success', 'Berhasil menghapus verifikator');
    }
}