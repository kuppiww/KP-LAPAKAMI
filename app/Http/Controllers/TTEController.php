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
use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Repositories\RequestTteRepository;
use Modules\Request\Repositories\RequestVerificationRepository;
use Modules\Request\Repositories\ServiceRepository;
use Modules\Users\Repositories\SysUsersRepository;
use Modules\Users\Repositories\UsersRepository;

class TTEController extends Controller
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
    protected $_requestTTERepository;
    protected $_requestRepository;

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
        $this->_requestTTERepository = new RequestTteRepository;
        $this->_requestRepository = new RequestRepository;
    }

    public function ubah(Request $request, $id, $req, $service)
    {
        $user = Auth::guard('admin')->user();

        $getService = $this->_serviceRepository->getByParams(['slug' => $service, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        $params = array(
            'request_id' => $req,
            'requests.request_id' => $req,
        );

        $dataRequest = $this->_requestRepository->getByParams($params);

        if (!$dataRequest) {
            return redirect(url('404'));
        }

        $data = [
            'user_id' => $request->pegawaiTTE,
            'updated_at' => date('Y-m-d h:i:s'),
            'updated_by' => $user->user_id
        ];

        DB::beginTransaction();
        $this->_requestTTERepository->update($data, $id);
        DB::commit();

        return redirect('/operator/'.$service.'/lihat/'.$req)->with('success', 'Berhasil merubah penandatangan');
    }
}