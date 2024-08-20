<?php

namespace Modules\ChangeKK\Http\Controllers;

use App\Helpers\DataHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Request\Repositories\RequestLogRepository;

use App\Helpers\DateFormatHelper;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\DB;
use Modules\ChangeKK\Repositories\RequestKKRepository;
use Modules\User\Repositories\UserRepository;
use Yajra\DataTables\Facades\DataTables;

class ChangeKKController extends Controller
{
    protected $_requestLogRepository;
    protected $_changeKKRepository;
    protected $_userRepository;
    protected $module;
    protected $_logHelper;
    protected $_dateFormatHelper;

    public function __construct(){

        // Require Login
        $this->middleware('auth:admin');

        $this->_requestLogRepository            = new RequestLogRepository;
        $this->_changeKKRepository               = new RequestKKRepository;
        $this->_userRepository = new UserRepository;

        $this->module      = "ChangeKK";
        $this->_logHelper  = new LogHelper;
        $this->_dateFormatHelper = new DateFormatHelper;

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $listkk= $this->_changeKKRepository->getAll();
        return view('changeKK::index', compact('listkk'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request['user_id']         = $user->user_id;

        //upload
        $data_upload = $this->_uploadFile($request);
        $request['kk_file'] = $data_upload['file'][0];

        DB::beginTransaction();
        $this->_changeKKRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store('Permohonan ubah nomor kartu keluarga', $request->user_id, 'create');
        DB::commit();

        return redirect('user/profil')->with('message', 'Permohonan ubah nomor kartu keluarga berhasil dikirim');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('request::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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

    public function selesai($id, $kk)
    {
        DB::beginTransaction();
        $this->_userRepository->update(DataHelper::_normalizeParams(['user_kk' => $kk], false, true), $id);
        $this->_changeKKRepository->delete($id);
        $this->_logHelper->store('nomor kartu keluarga dengan id : '.$id, Auth::user()->user_id, 'update');
        DB::commit();

        return redirect('/ubah-kk')->with('message', 'Nomor kartu keluarga berhasil diperbaharui');
    }

    public function tolak($id, $kk)
    {
        DB::beginTransaction();
        $this->_changeKKRepository->delete($id);
        $this->_logHelper->store('perubahan nomor kartu keluarga dengan id : '.$id, Auth::user()->user_id, 'delete');
        DB::commit();

        return redirect('/ubah-kk')->with('message', 'Perubahan nomor kartu keluarga berhasil ditolak');
    }

    
    public function listkk(Request $request)
    {
        $data = $this->_changeKKRepository->getAll();
        if ($request->ajax()) {
            $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('user_nik', function($list){
                $text = $list->user_nik;
                return "$text<br><small class='text-muted'>$list->user_nama</small>";
            })
            ->addColumn('kk_baru', function($list){
                $text = $list->kk_baru;
                return $text;
            })
            ->addColumn('kk_file', function($list){
                $linkFile = '/storage/files/request_change_kks/kk';
                $text = '<a target="blank" href="'.$linkFile.'/'. $list->kk_file.'" class="btn btn-link p-0">'.
                                'Lihat file'.
                            '</a>';
                return $text;
            });
            $datatables = $datatable->addColumn('action', function($list){
                $linkSelesai= url('ubah-kk/selesai');
                $linkTolak= url('ubah-kk/tolak');
                $detailBtn = '
                <a href="'.$linkSelesai.'/'. $list->user_id.'/'.$list->kk_baru.'" class="btn btn-icon btn-primary rounded-circle p-1" data-toggle="tooltip" data-placement="top" title="Setuju">
                    <i class="ri-check-line fs-6"></i>
                </a>
                <a href="'.$linkTolak.'/'. $list->user_id.'/'.$list->kk_baru.'" class="btn btn-icon btn-danger rounded-circle p-1" data-toggle="tooltip" data-placement="top" title="Tolak">
                    <i class="ri-close-line fs-6"></i>
                </a>';
                return $detailBtn;
            });
    
            $datatables = $datatable->rawColumns(['action', 'user_nik', 'kk_baru', 'kk_file']);
            $datatables = $datatable->make(true);
            return $datatables;
        }
    }

    private function _uploadFile($request)
    {
        $data['file']  = [];
        $data['note']  = [];

        if ($request->file('f_change_kk') != '') {

            $imageName = md5(time() . rand()) .'.'. $request->f_change_kk->extension(); 

            $request->file("f_change_kk")->storeAs('files/request_change_kks/kk', $imageName, 'public');

            array_push($data['file'], $imageName );

            array_push($data['note'], 'FILE_CHANGE_KK' );

        }
        
        return $data;
    }
}
