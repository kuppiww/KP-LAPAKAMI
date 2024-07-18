<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

use Modules\UserGroup\Repositories\UserGroupRepository;
use Modules\Users\Repositories\SysUsersRepository;
use Modules\User\Repositories\SubDistrictRepository;
use Modules\User\Repositories\DistrictRepository;


use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use DB;
use Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_usersRepository     = new SysUsersRepository;
        $this->_subDistrictRepository = new SubDistrictRepository;
        $this->_groupRepository     = new UserGroupRepository;
        $this->_districtRepository = new DistrictRepository;

        $this->module   = "Users";
        $this->_logHelper           = new LogHelper;

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // Authorize
        // if (Gate::denies(__FUNCTION__, $this->module)) {
        //     return redirect('unauthorize');
        // }

        $users      = $this->_usersRepository->getAll();
        $groups     = $this->_groupRepository->getAll();
        $sub_districts = $this->_subDistrictRepository->getAll();
        $districts = $this->_districtRepository->getAll();


        return view('users::index', compact('users', 'groups', 'sub_districts', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Authorize
        // if (Gate::denies(__FUNCTION__, $this->module)) {
        //     return redirect('unauthorize');
        // }

        $validator = Validator::make($request->all(), $this->_validationRules(''));

        if ($validator->fails()) {
            dd($validator);
            return redirect('sysusers')
                ->withErrors($validator)
                ->withInput();
        }

        $activation = md5(rand() . time());

        $request->request->set('activation_token', $activation);
        $request->request->set('user_username', $request->user_nip);

        DB::beginTransaction();
        $this->_usersRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store($this->module, $request->name, 'create');
        DB::commit();

        return redirect('sysusers')->with('message', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Authorize
        // if (Gate::denies(__FUNCTION__, $this->module)) {
        //     return redirect('unauthorize');
        // }

        $validator = Validator::make($request->all(), $this->_validationRules($id));

        if ($validator->fails()) {
            return redirect('sysusers')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        $this->_usersRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->name, 'update');
        DB::commit();

        return redirect('sysusers')->with('message', 'Pengguna berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        // Authorize
        // if (Gate::denies(__FUNCTION__, $this->module)) {
        //     return redirect('unauthorize');
        // }
        // Check detail to db
        $detail  = $this->_usersRepository->getById($id);

        if (!$detail) {
            return redirect('sysusers');
        }

        DB::beginTransaction();
        
        $this->_usersRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->user_name, 'delete');
        DB::commit();

        return redirect('sysusers')->with('message', 'Pengguna berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id){

        $response   = array('status' => 0, 'result' => array()); 
        $getDetail  = $this->_usersRepository->getById($id);

        if ($getDetail) {
            $response['status'] = 1;
            $response['result'] = $getDetail;
        }

        return $response;

    }

    private function _validationRules($id='')
    {
        if ($id == '') {
            return [
                'user_email' => 'required|unique:sys_users',
            ];  
           
        }else{
            return [
                'user_email' => 'required|unique:sys_users,user_email,' . $id . ',user_id',
            ];  
        }
        
    }  

}
