<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Modules\User\Repositories\UserRepository;
use Modules\User\Repositories\DistrictRepository;
use Modules\User\Repositories\SubDistrictRepository;
use Modules\User\Repositories\ReligionRepository;
use Modules\User\Repositories\GenderRepository;
use Modules\User\Repositories\MerriedStatusRepository;

use Illuminate\Support\Facades\Crypt;

use App\Mail\UserVerificationChangeMail;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use DB;
use Yajra\DataTables\Facades\DataTables;

class UserAdminController extends Controller
{
    protected $_userRepository;
    protected $_logHelper;
    protected $_districtRepository;
    protected $_subDistrictRepository;
    protected $_religionRepository;
    protected $_genderRepository;
    protected $_merriedStatusRepository;
    protected $module;

    public function __construct()
    {

        // Require Login
        $this->middleware('auth:admin');

        $this->_userRepository = new UserRepository;
        $this->_districtRepository = new DistrictRepository;
        $this->_subDistrictRepository = new SubDistrictRepository;
        $this->_religionRepository = new ReligionRepository;
        $this->_genderRepository = new GenderRepository;
        $this->_merriedStatusRepository = new MerriedStatusRepository;
        // $this->_forgotRepository    = new UserForgotRepository;

        $this->module = "User";
        $this->_logHelper = new LogHelper;

    }

    public function showSetting()
    {
        $user = $this->_userRepository->getAllOnlyMasyarakat();
        return view('user::listuser', compact('user'));
    }

    public function showSettingPassword($id)
    {
        $param = array('user_id' => $id);
        $user = $this->_userRepository->getByParams($param);
        return view('user::formsettingpassword', compact('user'));
    }

    public function settingPassword(Request $request)
    {
        $password = Hash::make($request->user_password);
        $this->_userRepository->update(DataHelper::_normalizeParams(['user_password' => $password], false, true), $request->user_id);
        $this->_logHelper->store('Password User', $request->user_id, 'update');
        return redirect('user/setting')->with('message', 'Kata sandi berhasil diubah');
    }

    public function showSettingEmail($id)
    {
        $param = array('user_id' => $id);
        $user = $this->_userRepository->getByParams($param);
        return view('user::formsettingemail', compact('user'));
    }
    
    public function settingEmail(Request $request)
    {
        $email = $request->user_email;
        $payload = ['user_email_is_activate' => true, 'user_email' => $email, 'user_email_is_change' => false];
        $this->_userRepository->update(DataHelper::_normalizeParams($payload, false, true), $request->user_id);
        $this->_logHelper->store('Email User', $request->user_id, 'update');
        return redirect('user/setting')->with('message', 'Email berhasil diubah');
    }

    public function listuser(Request $request)
    {
        $data = $this->_userRepository->getAllOnlyMasyarakat();
        if ($request->ajax()) {
            $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('user_nama', function($users){
                $text = $users->user_username;
                return "$text<br><small class='text-muted'>$users->user_nama</small>";
            })
            ->addColumn('user_email', function($users){
                $text = $users->user_email;
                return $text;
            })
            ->addColumn('user_is_active', function($users){
                if($users->user_is_active) {
                    return '<span class="badge bg-success">Aktif</span>';
                } else {
                    return '<span class="badge bg-danger">Tidak Aktif</span>';
                }
            });
            $datatables = $datatable->addColumn('action', function($users){
                $linkSettingPassword = url('user/setting/password');
                $linkSettingEmail= url('user/setting/email');
                $actionBtn = '
                <a href="'.$linkSettingEmail.'/'. $users->user_id.'" class="btn btn-icon btn-light rounded-circle p-1" data-toggle="tooltip" data-placement="top" title="Ubah Email">
                    <i class="ri-mail-line fs-6"></i>
                </a>
                <a href="'.$linkSettingPassword.'/'. $users->user_id.'" class="btn btn-icon btn-light rounded-circle p-1" data-toggle="tooltip" data-placement="top" title="Ubah Password">
                    <i class="ri-lock-line fs-6"></i>
                </a>
                ';
                return $actionBtn;
            });

            $datatables = $datatable->rawColumns(['action', 'user_nama', 'user_email', 'user_is_active']);
            $datatables = $datatable->make(true);
            return $datatables;
        }   
    }

    public function changepassword(Request $request)
    {

        $currpass = $request->input('current_password');
        $password = $request->input('user_password');

        if (!Hash::check($currpass, Auth::user()->user_password)) {
            return redirect('user/pengaturan')->with('error', 'Kata sandi sekarang salah');
        }

        $this->_userRepository->update(DataHelper::_normalizeParams(['user_password' => $password], false, true), Auth::user()->user_id);

        return redirect('user/pengaturan')->with('message', 'Kata sandi berhasil diubah');

    }
}
