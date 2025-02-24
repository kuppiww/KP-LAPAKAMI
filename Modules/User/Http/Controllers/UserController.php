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

class UserController extends Controller
{
    protected $_userRepository;
    protected $_logHelper;

    public function __construct()
    {

        // Require Login
        $this->middleware('auth');

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

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // str_pad($value, 8, '0', STR_PAD_LEFT);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showProfile()
    {
        $districts = $this->_districtRepository->getAll();
        $sub_districts = $this->_subDistrictRepository->getAll();
        $religions = $this->_religionRepository->getAll();
        $genders = $this->_genderRepository->getAll();
        $merried_stats = $this->_merriedStatusRepository->getAll();
        $user = Auth::user();

        // dd($user);

        return view('user::profile', compact('user', 'districts', 'sub_districts', 'religions', 'genders', 'merried_stats'));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Show the form for editing setting resource.
     * @return Renderable
     */
    public function setting()
    {
        return view('user::setting');
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


    public function updateProfile(Request $request)
    {

        $user = Auth::user();
        $data_email = [];

        //checking email change
        if ($user->user_email != $request->user_email) {
            $token = md5(sha1($request->user_nik . time() . uniqid()));

            $request['user_email_is_change'] = true;
            $request['user_email_is_activate'] = false;
            $request['user_email_token'] = $token;
            $nikEnc = Crypt::encryptString($request['user_nik']);

            $data_email = array(
                'name' => $request['user_nama'],
                'nik' => $nikEnc,
                'email' => $request['user_email'],
                'token' => $token,
                'url' => env('APP_URL'),
            );

        }

        //convertion date
        $birthdate = str_replace('/', '-', $request->birthdate);
        $request['user_tgl_lahir'] = date("Y-m-d", strtotime($birthdate));

        $request['user_rt'] = str_pad($request->rt, 3, '0', STR_PAD_LEFT);
        $request['user_rw'] = str_pad($request->rw, 3, '0', STR_PAD_LEFT);
        $request['user_is_comp_profile'] = true;

        DB::beginTransaction();

        $store = $this->_userRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $user->user_id);
        $this->_logHelper->store($this->module, $request->user_nama, 'update');

        if ($request['user_email_is_change']) {
            Mail::to($request['user_email'])->send(new UserVerificationChangeMail($data_email));
        }

        DB::commit();

        return redirect('user/profil')->with('message', 'Profil pengguna berhasil diubah');

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // Authorize
        //  if (Gate::denies(__FUNCTION__, $this->module)) {
        //     return redirect('unauthorize');
        // }
        dd($request->all());

        $user = Auth::user();

        DB::beginTransaction();

        $this->_usersRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $user->user_id);
        $this->_logHelper->store($this->module, $request->user_nama, 'update');

        DB::commit();

        return redirect('user/pengaturan')->with('message', 'Kata Sandi pengguna berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
