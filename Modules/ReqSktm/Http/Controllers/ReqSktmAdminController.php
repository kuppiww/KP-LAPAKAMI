<?php

namespace Modules\ReqSktm\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestChangeStatusMail;

use Modules\User\Repositories\SubDistrictRepository;
use Modules\User\Repositories\DistrictRepository;
use Modules\User\Repositories\ReligionRepository;
use Modules\User\Repositories\GenderRepository;
use Modules\User\Repositories\MerriedStatusRepository;
use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Repositories\RequestLogRepository;
use Modules\Request\Repositories\FamRelationRepository;
use Modules\Request\Repositories\KetIncapableRepository;
use Modules\Request\Repositories\HospitalRepository;
use Modules\Request\Repositories\RequestAttachmentRepository;
use Modules\Request\Repositories\ServiceRepository;
use Modules\ReqSktm\Repositories\SktmEducationRepository;
use Modules\ReqSktm\Repositories\SktmHealthRepository;
use Modules\ReqSktm\Repositories\SktmPengadilanRepository;
use Modules\ReqSktm\Repositories\SktmPlnRepository;

use App\Helpers\DataHelper;
use App\Helpers\HTMLHelper;
use App\Helpers\LogHelper;
use App\Helpers\DateTime;
use App\Helpers\HttpStatusHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\ReportHelper;
use App\Helpers\Surat;
use App\Helpers\TtdHelper;
use App\Mail\RequestNotifikasiMail;
use App\Mail\RequestRejectedFinalMail;
use DB;
use Modules\Request\Repositories\PegawaiRepository;
use Modules\Request\Repositories\ServiceSettingsRepository;
use PDF;

class ReqSktmAdminController extends Controller
{
    protected $_districtRepository;
    protected $_subDistrictRepository;
    protected $_religionRepository;
    protected $_genderRepository;
    protected $_merriedStatusRepository;
    protected $_requestRepository;
    protected $_famRelationRepository;
    protected $_ketIncapableRepository;
    protected $_hospitalRepository;
    protected $_requestLogRepository;
    protected $_sktmEducationRepository;
    protected $_sktmHealthRepository;
    protected $_sktmPengadilanRepository;
    protected $_sktmPlnRepository;
    protected $_requestAttachmentRepository;
    protected $_serviceRepository;
    protected $_serviceSettingsRepository;
    protected $_pegawaiRepository;
    protected $module;
    protected $_logHelper;
    protected $breadcrumbs;

    public function __construct()
    {

        // Require Login
        $this->middleware('auth:admin');

        $this->_districtRepository = new DistrictRepository;
        $this->_subDistrictRepository = new SubDistrictRepository;
        $this->_religionRepository = new ReligionRepository;
        $this->_genderRepository = new GenderRepository;
        $this->_merriedStatusRepository = new MerriedStatusRepository;
        $this->_requestRepository = new RequestRepository;
        $this->_famRelationRepository = new FamRelationRepository;
        $this->_ketIncapableRepository = new KetIncapableRepository;
        $this->_hospitalRepository = new HospitalRepository;
        $this->_requestLogRepository = new RequestLogRepository;
        $this->_sktmEducationRepository = new SktmEducationRepository;
        $this->_sktmHealthRepository = new SktmHealthRepository;
        $this->_sktmPengadilanRepository = new SktmPengadilanRepository;
        $this->_sktmPlnRepository = new SktmPlnRepository;
        $this->_requestAttachmentRepository = new RequestAttachmentRepository;
        $this->_serviceRepository = new ServiceRepository;
        $this->_serviceSettingsRepository = new ServiceSettingsRepository();
        $this->_pegawaiRepository = new PegawaiRepository();
        $this->breadcrumbs = ['Ekonomi, Pemberdayaan Masyarakat dan Kesejahteraan Sosial', 'Tidak Mampu', 'Sekolah'];

        $this->module = "ReqBirth";
        $this->_logHelper = new LogHelper;

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        //
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
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        //
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

    public function proses(Request $request, $id)
    {
        $slug = $request->segment(2);

        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // Validation request data 
        $params = array(
            'request_id' => $id,
            'requests.request_id' => $id,
        );
        $request = $this->_requestRepository->getByParams($params);

        if (!$request) {
            return redirect(url('404'));
        }

        if ($request->request_status_id == 'VERIFIED') {
            if ($request->service_is_kec) {
                $status['request_status_id'] = 'SUBMITED_KEC';
                DB::beginTransaction();
                $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $request->request_id);
                $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
                DB::commit();
            } else {
                $status['request_status_id'] = 'PROCCESS';
                DB::beginTransaction();
                $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $request->request_id);
                $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
                DB::commit();

                // set nomor surat
                $no_surat = Surat::getNoSurat($this->_sktmHealthRepository, date('Y'), $request->kd_kel, $this->breadcrumbs);
                $data['no_surat'] = $no_surat;
                $data['tgl_surat'] = date('Y-m-d');
                $data['masa_berlaku'] = date('Y-m-d',strtotime('+1 month',strtotime($data['tgl_surat'])));
                DB::beginTransaction();
                $this->_sktmHealthRepository->updateNoSurat(DataHelper::_normalizeParams($data, false, true), $request->request_id);
                DB::commit();

                // send notif
                if ($id != null) {
                    $text = NotificationHelper::redaksi($status['request_status_id'], null);
                    $data_email = array(
                        'name' => $request->nama_warga,
                        'email' => $request->user_email,
                        'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $id,
                        'service_name' => 'Surat Keterangan Tidak Mampu',
                        'time' => date('Y-m-d H:i:s'),
                        'status'        => $text['statusname'],
                        'redaksi'       => $text['redaksi'],
                        'catatan'       => $text['catatan']
                    );
        
                    Mail::to($request->user_email)->send(new RequestNotifikasiMail($data_email));
                }
            }
        }

        if ($request->request_status_id == 'VERIFIED_KEC') {
            $status['request_status_id'] = 'PROCCESS_KEC';
            DB::beginTransaction();
            $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $request->request_id);
            $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
            DB::commit();

            if ($id != null) {
                $text = NotificationHelper::redaksi($status['request_status_id'], null);
                $data_email = array(
                    'name' => $request->nama_warga,
                    'email' => $request->user_email,
                    'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $id,
                    'service_name' => 'Surat Keterangan Tidak Mampu',
                    'time' => date('Y-m-d H:i:s'),
                    'status'        => $text['statusname'],
                    'redaksi'       => $text['redaksi'],
                    'catatan'       => $text['catatan']
                );
    
                Mail::to($request->user_email)->send(new RequestNotifikasiMail($data_email));
            }

            // set nomor surat
            $no_surat = Surat::getNoSurat($this->_sktmHealthRepository, date('Y'), $request->kd_kel, $this->breadcrumbs);
            $data['no_surat'] = $no_surat;
            $data['tgl_surat'] = date('Y-m-d');
            $data['masa_berlaku'] = date('Y-m-d',strtotime('+1 month',strtotime($data['tgl_surat'])));
            DB::beginTransaction();
            $this->_sktmHealthRepository->updateNoSurat(DataHelper::_normalizeParams($data, false, true), $request->request_id);
            DB::commit();
        }

        // return view('reqsktm::detailPermohonan', compact('request', 'request_detail', 'logs', 'request_docs'));
        return redirect('/verification');
    }

    public function showPermohoanan(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::user();


        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // Validation request data 
        $params = array(
            'request_id' => $id,
            'requests.request_id' => $id,
            // 'requests_ttes.request_id'   => $id
        );
        $request = $this->_requestRepository->getByParams($params);

        if (!$request) {
            return redirect(url('404'));
        }

        // if ($request->request_status_id == 'EDITED' || $request->request_status_id == 'SUBMITED') {
        //     $status['request_status_id'] = 'VERIFIED';
        //     DB::beginTransaction();
        //     $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $request->request_id);
        //     $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
        //     DB::commit();

        //     if ($id != null) {
        //         $text = NotificationHelper::redaksi($status['request_status_id'], null);
        //         $data_email = array(
        //             'name' => $request->nama_warga,
        //             'email' => $request->user_email,
        //             'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $id,
        //             'service_name' => 'Surat Keterangan Tidak Mampu',
        //             'time' => date('Y-m-d H:i:s'),
        //             'status'        => $text['statusname'],
        //             'redaksi'       => $text['redaksi'],
        //             'catatan'       => $text['catatan']
        //         );
    
        //         Mail::to($user->user_email)->send(new RequestNotifikasiMail($data_email));
        //     }
        // }

        // if ($request->request_status_id == 'EDITED_KEC' || $request->request_status_id == 'SUBMITED_KEC') {
        //     $status['request_status_id'] = 'VERIFIED_KEC';
        //     DB::beginTransaction();
        //     $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $request->request_id);
        //     $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
        //     DB::commit();

        //     if ($id != null) {
        //         $text = NotificationHelper::redaksi($status['request_status_id'], null);
        //         $data_email = array(
        //             'name' => $request->nama_warga,
        //             'email' => $request->user_email,
        //             'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $id,
        //             'service_name' => 'Surat Keterangan Tidak Mampu',
        //             'time' => date('Y-m-d H:i:s'),
        //             'status'        => $text['statusname'],
        //             'redaksi'       => $text['redaksi'],
        //             'catatan'       => $text['catatan']
        //         );
    
        //         Mail::to($request->user_email)->send(new RequestNotifikasiMail($data_email));
        //     }
        // }

        $filter['request_id'] = $id;

        $logs = $this->_requestLogRepository->getAllByParamsForAdmin($filter);
        $request_docs = $this->_requestAttachmentRepository->getAllByParams($filter);

        if ($request->service_id == 'REQ_SKTM_EDUCATION') {
            $request_detail = $this->_sktmEducationRepository->getByParams($filter);
        } elseif ($request->service_id == 'REQ_SKTM_HEALTH') {
            $request_detail = $this->_sktmHealthRepository->getByParams($filter);
        } elseif ($request->service_id == 'REQ_SKTM_JUDICIARY') {
            $request_detail = $this->_sktmPengadilanRepository->getByParams($filter);
        } else {
            $request_detail = $this->_sktmPlnRepository->getByParams($filter);
        }

        $paramVerifikator['service_id'] = $request->service_id;
        
        $listJK = $this->_genderRepository->getAll();
        $listReligion = $this->_religionRepository->getAll();
        $listHospitals = $this->_hospitalRepository->getAll();
        $listHubKel = $this->_famRelationRepository->getAll();
        $listService = $this->_serviceSettingsRepository->getByServiceId($paramVerifikator);
        $listVerifikator = null;
        $listTTE = null;
        if ($listService) {
            $listTTE = $this->_pegawaiRepository->getWherInByParam([$listService->role_setting_ttd, $listService->role_setting_ttd_kec]);
            if ($listService->role_setting) {
                $listVerifikator = $this->_pegawaiRepository->getWherInByParam(explode(",", $listService->role_setting));
            }
        }

        return view('reqsktm::detailPermohonan', compact('request', 'listTTE', 'listVerifikator', 'listHubKel', 'listHospitals', 'request_detail', 'logs', 'request_docs', 'listJK', 'listReligion'));
    }

    public function pdf(Request $request, $id, $servicename)
    {
        $slug = $request->segment(2);
        
        $getService     = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);
        
        if (!$getService) {
            return redirect(url('404'));
        }
        
        $title = 'SURAT KETERANGAN TIDAK MAMPU';

        $params     = array(
            'request_id'            => $id, 
            // 'requests.created_by'   => $user->user_id, 
            // 'requests.service_id'   => $getService->service_id
        );
        
        $datarequest = $this->_sktmHealthRepository->getByParams($params); //$this->_setRepository($getService->slug);
        $ttd = $this->_requestRepository->getTTD($id);
        $f_ttd = null;
        $l_ttd = null;

        if ($ttd != null) {
            $f_ttd = TtdHelper::getFttd($this->_sktmHealthRepository, $ttd->ttd_nip);
            $l_ttd = TtdHelper::getLttd($this->_sktmHealthRepository, $ttd->ttd_nip);
        }

        $data = [
            'meta' => [],//$this->meta,
            'data' => $datarequest,
            'pengajuan' => $this->_requestRepository->getByParams($params),
            'service' => $getService,
            'f_ttd' => $f_ttd,
            'l_ttd' => $l_ttd,
            'title' => $title,
            'ttdRequest' => $ttd,
            'ReportHelper' => ReportHelper::class,
            'HtmlHelper' => HTMLHelper::class,
            'DateTime' => DateTime::class
        ];

        $pdf = PDF::loadView(
            'report/pdf/sktm-rs', //ReportHelper::getReportTemplatePath($servicename),
            $data,
            [],
            config('mpdf')
        );

        return response()->stream(function () use ($pdf) {
            $pdf->stream('skd-pdf-' . date('YmdHis') . '.pdf');
        }, HttpStatusHelper::OK, ['Content-Type' => 'application/pdf']);
    }

    public function tangguhkan(Request $request, $id)
    {
        $slug = $request->segment(3);
        $user = Auth::user();

        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // validate request
        $params = array(
            'request_id' => $id,
            'requests.request_id' => $id
        );
        $requestService = $this->_requestRepository->getByParams($params);

        if (!$requestService) {
            return redirect(url('404'));
        }

        // update status
        $status['request_status_id'] = 'REJECTED';
        DB::beginTransaction();
        $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $id);
        $this->_logRequest($id, $status['request_status_id'], 'Ditolak oleh ');
        DB::commit();

        if ($id != null) {
            $data_email = array(
                'name' => $requestService->user_nama,
                'email' => $requestService->user_email,
                'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $id,
                'service_name' => 'Surat Keterangan Tidak Mampu',
                'redaksi' => $request->keterangan,
                'time' => date('Y-m-d H:i:s'),
            );

            Mail::to($user->user_email)->send(new RequestRejectedFinalMail($data_email));
        }

        return redirect('/verification');
    }

    public function tolak(Request $request, $id)
    {
        $slug = $request->segment(3);
        $user = Auth::user();

        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // validate request
        $params = array(
            'request_id' => $id,
            'requests.request_id' => $id
        );
        $requestService = $this->_requestRepository->getByParams($params);

        if (!$requestService) {
            return redirect(url('404'));
        }

        // update status
        $status['request_status_id'] = 'REJECTED_FINAL';
        DB::beginTransaction();
        $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $id);
        $this->_logRequest($id, $status['request_status_id'], $request->keterangan);

        if ($id != null) {
            $data_email = array(
                'name' => $requestService->user_nama,
                'email' => $requestService->user_email,
                'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $id,
                'service_name' => 'Surat Keterangan Tidak Mampu',
                'redaksi' => $request->keterangan,
                'time' => date('Y-m-d H:i:s'),
            );

            Mail::to($user->user_email)->send(new RequestRejectedFinalMail($data_email));
        }

        DB::commit();


        return redirect('/verification');
    }

    public function updatepermohonan(Request $request, $id)
    {
        $slug = $request->segment(3);

        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        $filter['request_id'] = $id;
        $req = $this->_requestRepository->getByParams($filter);

        if (!$req) {
            return redirect(url('404'));
        }

        $datarequest['_token'] = $request->_token;
        $datarequest['id_jenkel'] = $request->gender;
        $datarequest['tmp_lahir'] = $request->tmp_lahir;
        $datarequest['id_agama'] = $request->religion;
        $datarequest['pekerjaan'] = $request->pekerjaan;
        $datarequest['rt'] = $request->rt;
        $datarequest['rw'] = $request->rw;

        //convertion date pengantar
        $tgl_surat_pengantar = str_replace('/', '-', $request->tgl_surat_pengantar);
        $datarequest['tgl_surat_pengantar'] = date("Y-m-d", strtotime($tgl_surat_pengantar));
        $datarequest['no_surat_pengantar'] = $request->no_surat_pengantar;
        $datarequest['_token'] = $request->_token;

        //convertion date birth
        $tgl_lahir = str_replace('/', '-', $request->tgl_lahir);
        $datarequest['tgl_lahir'] = date("Y-m-d", strtotime($tgl_lahir));

        DB::beginTransaction();

        $this->_requestRepository->updatePermohonan(DataHelper::_normalizeParams($datarequest, false, true), $id);
        $this->_logHelper->store($this->module, $request->service_id, 'update');

        DB::commit();

        return redirect('operator/sktm/lihat/'.$id)->with('message', 'Permohonan berhasil diperbaharui');
    }

    private function _logRequest($req_id, $stat_id, $note_log)
    {
        $user_name = Auth::user()->user_id;
        $request['request_id'] = $req_id;
        $request['request_status_id'] = $stat_id;
        if ($stat_id == 'REJECTED_FINAL' || $stat_id == 'REJECTED') {
            $request['request_log_note'] = $note_log;
        } else {
            $request['request_log_note'] = $note_log . $user_name;
        }

        $this->_requestLogRepository->insert(DataHelper::_normalizeParams($request, true));
    }
}