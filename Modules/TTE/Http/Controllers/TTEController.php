<?php

namespace Modules\TTE\Http\Controllers;

use App\Helpers\DateFormatHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Request\Repositories\RequestAttachmentRepository;
use Modules\Request\Repositories\RequestLogRepository;
use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Repositories\RequestTteRepository;
use Modules\Request\Repositories\ServiceRepository;
use Yajra\DataTables\Facades\DataTables;

class TTEController extends Controller
{
    protected $_requestRepository;
    protected $_requestLogRepository;
    protected $_requestAttachmentRepository;
    protected $_serviceRepository;
    protected $module;
    protected $_logHelper;
    protected $_dateFormatHelper;
    protected $_requestTteRepository;

    public function __construct(){

        // Require Login
        $this->middleware('auth:admin');

        $this->_requestRepository               = new RequestRepository;
        $this->_requestLogRepository            = new RequestLogRepository;
        $this->_requestAttachmentRepository     = new RequestAttachmentRepository;
        $this->_serviceRepository               = new ServiceRepository;
        $this->_requestTteRepository = new RequestTteRepository;

        $this->module      = "Tte";
        $this->_logHelper  = new LogHelper;
        $this->_dateFormatHelper = new DateFormatHelper;

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tte::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tte::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id, $service_id)
    {
        $service = $this->_serviceRepository->getById($service_id);
        $service_slug = $service->slug;
        return redirect('/tte/'.$service_slug.'/lihat/'.$id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('tte::edit');
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

    public function listpermohonan(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $filter['requests.kd_kel'] = $user->kd_kel;
        $param['requests_ttes.user_id'] = $user->user_id;
        $data = $this->_requestTteRepository->getRequest($param);
        // $data = $this->_requestRepository->getAllByParamsAdmin($filter, $user->is_kecamatan_employee);
        if ($request->ajax()) {
            $datatable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('service_name', function($permohonan){
                $text = $permohonan->service_name;
                $tglPermohonan = $this->_dateFormatHelper->dateInFull($permohonan->created_at);
                return "$text<br><small class='text-muted'>$tglPermohonan</small>";
            })
            ->addColumn('nama_warga', function($permohonan){
                $text = $permohonan->nama_warga;
                return "$text<br><small class='text-muted'>$permohonan->nik</small>";
            })
            ->addColumn('request_status_name', function($permohonan){
                return '<span class="badge bg-'.$permohonan->request_status_color.'">'.$permohonan->request_status_name.'</span>';
            });
            $datatables = $datatable->addColumn('action', function($permohonan){
                $linkDetail= url('tte/detail');
                // if ($permohonan->request_status_id == 'SUBMITED' || $permohonan->request_status_id == 'EDITED') {
                //     $detailBtn = '<a href="'.$linkDetail.'/'. $permohonan->request_id.'/'.$permohonan->service_id.'" class="btn btn-info btn-light" data-toggle="tooltip" data-placement="top" title="Verifikasi">
                //         Verifkasi
                //     </a>';
                // } else {
                    $detailBtn = '
                    <a href="'.$linkDetail.'/'. $permohonan->request_id.'/'.$permohonan->service_id.'" class="btn btn-icon btn-light rounded-circle p-1" data-toggle="tooltip" data-placement="top" title="Detail">
                        <i class="ri-arrow-right-line fs-6"></i>
                    </a>';
                // }
                return $detailBtn;
            });
    
            $datatables = $datatable->rawColumns(['action', 'service_name', 'nama_warga', 'request_status_name']);
            $datatables = $datatable->make(true);
            return $datatables;
        }
    }
}
