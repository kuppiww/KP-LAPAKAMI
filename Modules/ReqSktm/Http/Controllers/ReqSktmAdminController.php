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
use App\Helpers\DataRequestHelper;
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
use App\Models\SysUsers;
// use DB;
use Illuminate\Support\Facades\DB;
use Modules\Request\Repositories\PegawaiRepository;
use Modules\Request\Repositories\RequestSignLogRepository;
use Modules\Request\Repositories\RequestTteRepository;
use Modules\Request\Repositories\RequestVerificationRepository;
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
    protected $_sysUserRepository;
    protected $_requestTteRepository;
    protected $_requestVerificationRepository;
    protected $_dataReqHelper;
    protected $_requestSignLogRepository;

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
        $this->_sysUserRepository = new SysUsers();
        $this->_requestTteRepository = new RequestTteRepository();
        $this->_requestVerificationRepository = new RequestVerificationRepository();
        $this->_requestSignLogRepository = new RequestSignLogRepository();
        $this->breadcrumbs = ['Ekonomi, Pemberdayaan Masyarakat dan Kesejahteraan Sosial', 'Tidak Mampu', 'Sekolah'];

        $this->module = "ReqBirth";
        $this->_logHelper = new LogHelper;
        $this->_dataReqHelper = new DataRequestHelper;

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

    public function verifikasi(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

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

        $param['requests_verifications.request_id'] = $request->request_id;
        $param['is_kecamatan_employee'] = $user->is_kecamatan_employee;
        $allVerifikator = $this->_requestVerificationRepository->getByParams($param);
        $param['requests_verifications.user_id'] = $user->user_id;
        $dataverifikator = $this->_requestVerificationRepository->getByParams($param);

        if (!$dataverifikator) {
            return redirect(url('404'));
        }

        $status['status'] = 'ACCEPTED';
        $status['updated_by'] = $user->user_id;
        if ($dataverifikator[0]->verification_number == count($allVerifikator)-1 ) {
            //update status
            if ($request->request_status_id == 'PROCCESS') {
                $status['request_status_id'] = 'VERIFICATION_KEL';
            } else {
                $status['request_status_id'] = 'VERIFICATION_KEC';
            }
            DB::beginTransaction();
            $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $request->request_id);
            $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
            $this->_requestVerificationRepository->updateStatus($status, $dataverifikator[0]->req_verification_id);
            $this->_signLogRequest($request->request_id, $status['status'], 'VERIFICATION', $user->user_id);
            DB::commit();
        } else {
            DB::beginTransaction();
            $this->_requestVerificationRepository->updateStatus($status, $dataverifikator[0]->req_verification_id);
            $this->_signLogRequest($request->request_id, $status['status'], 'VERIFICATION', $user->user_id);
            DB::commit();
        }
        return redirect('/operator')->with('success', 'Berhasil mengupdate status');
    }

    public function proses(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

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

        $status['status'] = 'AWAITING_RESPONSE';
        $status['updated_by'] = $user->user_id;

        $param['request_id'] = $request->request_id;
        $param['is_kecamatan_employee'] = $user->is_kecamatan_employee;
        $listTTE = $this->_requestTteRepository->getByParams($param);
        $listVerifikator = $this->_requestVerificationRepository->getByParams($param);

        DB::beginTransaction();
        foreach ($listTTE as $key => $val_tte) {
            $this->_requestTteRepository->updateStatus($status, $val_tte->req_tte_id);
            $this->_signLogRequest($request->request_id, $status['status'], 'TTE', $val_tte->user_id);
        }
        foreach ($listVerifikator as $key => $val_ver) {
            $this->_requestVerificationRepository->updateStatus($status, $val_ver->req_verification_id);
            $this->_signLogRequest($request->request_id, $status['status'], 'VERIFICATION', $val_ver->user_id);
        }
        DB::commit();

        if ($request->request_status_id == 'VERIFIED_KEC') {
            $status['request_status_id'] = 'PROCCESS_KEC';
            DB::beginTransaction();
            $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $request->request_id);
            $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
            DB::commit();
        }

        if ($request->request_status_id == 'VERIFIED') {
            if ($request->service_is_kec) {
                $status['request_status_id'] = 'PROCCESS';
                DB::beginTransaction();
                // $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $request->request_id);
                $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $request->request_id);
                $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
                DB::commit();
            } else {
                $status['request_status_id'] = 'PROCCESS';
                DB::beginTransaction();
                $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $request->request_id);
                $this->_logRequest($request->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
                DB::commit();

                // set nomor surat
                // $no_surat = Surat::getNoSurat($this->_sktmHealthRepository, date('Y'), $request->kd_kel, $this->breadcrumbs);
                // $data['no_surat'] = $no_surat;
                // $data['tgl_surat'] = date('Y-m-d');
                // $data['masa_berlaku'] = date('Y-m-d',strtotime('+1 month',strtotime($data['tgl_surat'])));
                // DB::beginTransaction();
                // $this->_sktmHealthRepository->updateNoSurat(DataHelper::_normalizeParams($data, false, true), $request->request_id);
                // DB::commit();

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

        // if ($request->request_status_id == 'VERIFIED_KEC') {
        //     $status['request_status_id'] = 'PROCCESS_KEC';
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

        //     // set nomor surat
        //     $no_surat = Surat::getNoSurat($this->_sktmHealthRepository, date('Y'), $request->kd_kel, $this->breadcrumbs);
        //     $data['no_surat'] = $no_surat;
        //     $data['tgl_surat'] = date('Y-m-d');
        //     $data['masa_berlaku'] = date('Y-m-d',strtotime('+1 month',strtotime($data['tgl_surat'])));
        //     DB::beginTransaction();
        //     $this->_sktmHealthRepository->updateNoSurat(DataHelper::_normalizeParams($data, false, true), $request->request_id);
        //     DB::commit();
        // }

        // return view('reqsktm::detailPermohonan', compact('request', 'request_detail', 'logs', 'request_docs'));
        return redirect('/operator');
    }

    public function showPermohoanan(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

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

        if ($request->request_status_id == 'EDITED' || $request->request_status_id == 'SUBMITED') {
            $status['request_status_id'] = 'VERIFIED';
            DB::beginTransaction();
            $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $request->request_id);
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
    
                Mail::to($user->user_email)->send(new RequestNotifikasiMail($data_email));
            }
        }

        if ($request->request_status_id == 'SUBMITED_KEC') {
            $status['request_status_id'] = 'VERIFIED_KEC';
            DB::beginTransaction();
            $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $request->request_id);
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
    
                Mail::to($user->user_email)->send(new RequestNotifikasiMail($data_email));
            }
        }

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
        $param['request_id'] = $request->request_id;
        
        $listJK = $this->_genderRepository->getAll();
        $listReligion = $this->_religionRepository->getAll();
        $listHospitals = $this->_hospitalRepository->getAll();
        $listHubKel = $this->_famRelationRepository->getAll();
        $listVerifikator = $this->_requestVerificationRepository->getByParams($param);
        $listTTE = $this->_requestTteRepository->getByParams($param);
        $listService = $this->_serviceSettingsRepository->getByServiceId($paramVerifikator);

        if ($listTTE->isEmpty()) {
            // insert req tte
            $users = $this->_sysUserRepository->getByNIP($listService->role_setting_ttd);
            $data = [
                'request_id' => $request->request_id,
                'status' => 'NEEDS_CLARIFICATION',
                'user_id' => $users->user_id,
                'tte_number' => 0,
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $user->user_id
            ];
            DB::beginTransaction();
            $this->_requestTteRepository->insert($data);
            DB::commit();
            if ($request->service_is_kec) {
                $users = $this->_sysUserRepository->getByNIP($listService->role_setting_ttd_kec);
                $data = [
                    'request_id' => $request->request_id,
                    'status' => 'NEEDS_CLARIFICATION',
                    'user_id' => $users->user_id,
                    'tte_number' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'created_by' => $user->user_id
                ];
                DB::beginTransaction();
                $this->_requestTteRepository->insert($data);
                DB::commit();
            }
            $listTTE = $this->_requestTteRepository->getByParams($param);
        }

        if ($listVerifikator->isEmpty()) {
            // insert verifikator
            $datas = explode(",", $listService->role_setting);
            foreach ($datas as $key => $value) {
                //getid user 
                $users = $this->_sysUserRepository->getByNIP($value);
                
                $data = [
                    'request_id' => $request->request_id,
                    'status' => 'NEEDS_CLARIFICATION',
                    'user_id' => $users->user_id,
                    'verification_number' => $key,
                    'created_at' => date('Y-m-d h:i:s'),
                    'created_by' => $user->user_id
                ];
                DB::beginTransaction();
                $this->_requestVerificationRepository->insert($data);
                DB::commit();
            }

            if ($request->service_is_kec) {
                // $urutan = sizeof($datas);
                $datas = explode(",", $listService->role_setting_kec);
                foreach ($datas as $key => $value) {
                    //getid user 
                    $users = $this->_sysUserRepository->getByNIP($value);
                    
                    $data = [
                        'request_id' => $request->request_id,
                        'status' => 'NEEDS_CLARIFICATION',
                        'user_id' => $users->user_id,
                        'verification_number' => $key,
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => $user->user_id
                    ];
                    // $urutan++;
                    DB::beginTransaction();
                    $this->_requestVerificationRepository->insert($data);
                    DB::commit();
                }
            }
        }

        $listVerifikator = $this->_requestVerificationRepository->getByParams($param);

        foreach ($listVerifikator as $key => $ver) {
            $dataNotPegKel[] = $ver->nip;
        }

        foreach ($listTTE as $key => $val_tte) {
            $dataNotTTE[] = $val_tte->nip;
        }

        $param_peg_kel['kd_kel'] = $user->kd_kel;
        $param_peg_kel['group_id'] = 'pkelurahan';

        $param_peg_kec['kd_kec'] = $user->kd_kec;
        $param_peg_kec['group_id'] = 'pkecamatan';
        $listPegawaiKel = $this->_sysUserRepository->getByPegawai($param_peg_kel, $dataNotPegKel);
        $listPegawaiKec = $this->_sysUserRepository->getByPegawai($param_peg_kec, $dataNotPegKel);
        $listTTEKel = $this->_sysUserRepository->getByTTE($param_peg_kel, $dataNotTTE);
        $listTTEKec = $this->_sysUserRepository->getByTTE($param_peg_kec, $dataNotTTE);
        $isPegKec = $user->is_kecamatan_employee;
        $group = $user->group_id;
        $isVerifikator['isVerified'] = false;
        $isVerifikator['pesan'] = null;
        $list['listKonseptor'] = $this->_requestLogRepository->getKonseptor($request->request_id);

        return view('reqsktm::detailPermohonan', compact('request', 'isVerifikator', 'list', 'listTTEKec', 'listTTEKel', 'group', 'isPegKec', 'listPegawaiKec', 'listPegawaiKel', 'listTTE', 'listVerifikator', 'listHubKel', 'listHospitals', 'request_detail', 'logs', 'request_docs', 'listJK', 'listReligion'));
    }

    public function showTTE(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

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
        $param['request_id'] = $request->request_id;
        
        $listJK = $this->_genderRepository->getAll();
        $listReligion = $this->_religionRepository->getAll();
        $listHospitals = $this->_hospitalRepository->getAll();
        $listHubKel = $this->_famRelationRepository->getAll();
        $listVerifikator = $this->_requestVerificationRepository->getByParams($param);
        $listTTE = $this->_requestTteRepository->getByParams($param);
        $listService = $this->_serviceSettingsRepository->getByServiceId($paramVerifikator);

        foreach ($listVerifikator as $key => $ver) {
            $dataNotPegKel[] = $ver->nip;
        }

        foreach ($listTTE as $key => $val_tte) {
            $dataNotTTE[] = $val_tte->nip;
        }

        $param_peg_kel['kd_kel'] = $user->kd_kel;
        $param_peg_kel['group_id'] = 'pkelurahan';

        $param_peg_kec['kd_kec'] = $user->kd_kec;
        $param_peg_kec['group_id'] = 'pkecamatan';
        $listPegawaiKel = $this->_sysUserRepository->getByPegawai($param_peg_kel, $dataNotPegKel);
        $listPegawaiKec = $this->_sysUserRepository->getByPegawai($param_peg_kec, $dataNotPegKel);
        $listTTEKel = $this->_sysUserRepository->getByTTE($param_peg_kel, $dataNotTTE);
        $listTTEKec = $this->_sysUserRepository->getByTTE($param_peg_kec, $dataNotTTE);
        $isPegKec = $user->is_kecamatan_employee;
        $group = $user->group_id;
        $list['listKonseptor'] = $this->_requestLogRepository->getKonseptor($request->request_id);

        return view('reqsktm::detailTTE', compact('request', 'list', 'listTTEKec', 'listTTEKel', 'group', 'isPegKec', 'listPegawaiKec', 'listPegawaiKel', 'listTTE', 'listVerifikator', 'listHubKel', 'listHospitals', 'request_detail', 'logs', 'request_docs', 'listJK', 'listReligion'));
    }

    public function showVerifikator(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

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
        $param['request_id'] = $request->request_id;
        
        $listJK = $this->_genderRepository->getAll();
        $listReligion = $this->_religionRepository->getAll();
        $listHospitals = $this->_hospitalRepository->getAll();
        $listHubKel = $this->_famRelationRepository->getAll();
        $listVerifikator = $this->_requestVerificationRepository->getByParams($param);
        $listTTE = $this->_requestTteRepository->getByParams($param);
        $listService = $this->_serviceSettingsRepository->getByServiceId($paramVerifikator);

        foreach ($listVerifikator as $key => $ver) {
            $dataNotPegKel[] = $ver->nip;
        }

        foreach ($listTTE as $key => $val_tte) {
            $dataNotTTE[] = $val_tte->nip;
        }

        $param_peg_kel['kd_kel'] = $user->kd_kel;
        $param_peg_kel['group_id'] = 'pkelurahan';

        $param_peg_kec['kd_kec'] = $user->kd_kec;
        $param_peg_kec['group_id'] = 'pkecamatan';
        $listPegawaiKel = $this->_sysUserRepository->getByPegawai($param_peg_kel, $dataNotPegKel);
        $listPegawaiKec = $this->_sysUserRepository->getByPegawai($param_peg_kec, $dataNotPegKel);
        $listTTEKel = $this->_sysUserRepository->getByTTE($param_peg_kel, $dataNotTTE);
        $listTTEKec = $this->_sysUserRepository->getByTTE($param_peg_kec, $dataNotTTE);
        $isPegKec = $user->is_kecamatan_employee;
        $group = $user->group_id;
        $isVerifikator['isVerified'] = 'false';
        $isVerifikator['pesan'] = null;
        if ($group == 'pkelurahan' || $group == 'pkecamatan') {
            $param_cek['requests_verifications.user_id'] = $user->user_id;
            $param_cek['requests_verifications.request_id'] = $id;
            $isVerifikator = $this->_requestVerificationRepository->getIsVerifikator($param_cek, $group, $request->request_id);
        }
        $list['listKonseptor'] = $this->_requestLogRepository->getKonseptor($request->request_id);

        return view('reqsktm::detailVerification', compact('request', 'isVerifikator', 'list', 'listTTEKec', 'listTTEKel', 'group', 'isPegKec', 'listPegawaiKec', 'listPegawaiKel', 'listTTE', 'listVerifikator', 'listHubKel', 'listHospitals', 'request_detail', 'logs', 'request_docs', 'listJK', 'listReligion'));
    }

    public function addTTE(Request $request, $request_id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // Validation request data 
        $params = array(
            'request_id' => $request_id,
            'requests.request_id' => $request_id,
        );
        $datarequest = $this->_requestRepository->getByParams($params);

        if (!$datarequest) {
            return redirect(url('404'));
        }

        if ($datarequest->request_status_id == 'VERIFICATION_KEL') {
            $status['request_status_id'] = 'TTE_KEL';
        } else {
            $status['request_status_id'] = 'TTE_KEC';
        }
        $statusTTE['status'] = 'ACCEPTED'; 
        $statusTTE['updated_by'] = $user->user_id;

        if ($datarequest->service_id == 'REQ_SKTM_HEALTH') {
            $param['request_id'] = $datarequest->request_id;
            $repo = $this->_sktmHealthRepository;
            $detailrequest = $this->_sktmHealthRepository->getByParams($param);
        }

        if ($detailrequest->no_surat == null) {
            $no_surat = Surat::getNoSurat($repo, date('Y'), $datarequest->kd_kel, $this->breadcrumbs);
            $data['tgl_surat'] = date('Y-m-d');
            $data['no_surat'] = $no_surat;
            $data['masa_berlaku'] = date('Y-m-d',strtotime('+1 month',strtotime($data['tgl_surat'])));
        }

        DB::beginTransaction();
        if ($detailrequest->no_surat == null) {
            $repo->updateData($data, $datarequest->request_id);
        }
        $this->_requestTteRepository->updateStatusByUser($statusTTE, $datarequest->request_id, $user->user_id);
        $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $datarequest->request_id);
        $this->_logRequest($datarequest->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
        $this->_signLogRequest($detailrequest->request_id, $statusTTE['status'], $status['request_status_id'], $user->user_id);
        DB::commit();

        return redirect('/tte/'.$slug.'/lihat/'.$datarequest->request_id)->with('successs', 'Berhasil melakukan tte');
    }

    public function finish(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();
        
        $getService     = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);
        
        if (!$getService) {
            return redirect(url('404'));
        }

        $params     = array(
            'request_id'            => $id
        );
        
        $pengajuan = $this->_requestRepository->getByParams($params);
        $ttd = $this->_requestRepository->getTTD($id, $pengajuan->service_is_kec);
        $f_ttd = null;
        $l_ttd = null;

        if ($pengajuan->service_id == 'REQ_SKTM_HEALTH') {
            $repo = $this->_sktmHealthRepository;
            $datarequest = $this->_sktmHealthRepository->getByParams($params);
        }

        if ($ttd != null) {
            $f_ttd = TtdHelper::getFttd($repo, $ttd->ttd_nip);
            $l_ttd = TtdHelper::getLttd($repo, $ttd->ttd_nip);
            // update data
            $data['f_ttd'] = $f_ttd;
            $data['l_ttd'] = $l_ttd;
            $data['nip_ttd'] = $ttd->ttd_nip;

            if ($pengajuan->service_is_kec) {
                $status['request_status_id'] = 'APPROVED_KEC';
            } else {
                $status['request_status_id'] = 'APPROVED';
            }

            DB::beginTransaction();
            $repo->updateData($data, $datarequest->request_id);
            $this->_signLogRequest($pengajuan->request_id, $status['request_status_id'], 'TTE', $user->user_id);
            $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $pengajuan->request_id);
            $this->_logRequest($pengajuan->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
            if ($id != null) {
                $text = NotificationHelper::redaksi($status['request_status_id'], null);
                $data_email = array(
                    'name' => $pengajuan->nama_warga,
                    'email' => $pengajuan->user_email,
                    'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $pengajuan->request_id,
                    'service_name' => 'Surat Keterangan Tidak Mampu',
                    'time' => date('Y-m-d H:i:s'),
                    'status'        => $text['statusname'],
                    'redaksi'       => $text['redaksi'],
                    'catatan'       => $text['catatan']
                );
    
                Mail::to($pengajuan->user_email)->send(new RequestNotifikasiMail($data_email));
            }
            DB::commit();
        }

        return redirect('/tte')->with('successs', 'Berhasil mengupdate data');        
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
        
        $pengajuan = $this->_requestRepository->getByParams($params);
        if ($pengajuan->service_id == 'REQ_SKTM_HEALTH') {
            $pathPdf = 'report/pdf/sktm-rs';
            $repo = $this->_sktmHealthRepository;
            $datarequest = $this->_sktmHealthRepository->getByParams($params); //$this->_setRepository($getService->slug);
        }
        $ttd = $this->_requestRepository->getTTD($id, $pengajuan->service_is_kec);
        $f_ttd = null;
        $l_ttd = null;

        if ($ttd != null) {
            $f_ttd = TtdHelper::getFttd($repo, $ttd->ttd_nip);
            $l_ttd = TtdHelper::getLttd($repo, $ttd->ttd_nip);
        }

        $data = [
            'meta' => [],//$this->meta,
            'data' => $datarequest,
            'pengajuan' => $pengajuan,
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
            $pathPdf, //ReportHelper::getReportTemplatePath($servicename),
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
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

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
        $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $id);
        // $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $id);
        $this->_logRequest($id, $status['request_status_id'], 'Ditolak oleh ');
        $this->_signLogRequest($request->request_id, 'DENIED', 'VERIFICATION/TTE', $user->user_id);
        DB::commit();

        if ($id != null) {
            $data_email = array(
                'name' => $requestService->nama_warga,
                'email' => $requestService->user_email,
                'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $id,
                'service_name' => 'Surat Keterangan Tidak Mampu',
                'redaksi' => $request->keterangan,
                'time' => date('Y-m-d H:i:s'),
            );

            Mail::to($data_email['email'])->send(new RequestRejectedFinalMail($data_email));
        }

        return redirect('/operator');
    }

    public function tolak(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

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
        // $this->_requestRepository->updateStatus(DataHelper::_normalizeParams($status, false, true), $id);
        $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $id);
        $this->_logRequest($id, $status['request_status_id'], $request->keterangan);
        $this->_signLogRequest($request->request_id, 'DENIED', 'VERIFICATION/TTE', $user->user_id);

        if ($id != null) {
            $data_email = array(
                'name' => $requestService->nama_warga,
                'email' => $requestService->user_email,
                'url' => env('APP_URL') . '/user/layanan/sktm/lihat/' . $id,
                'service_name' => 'Surat Keterangan Tidak Mampu',
                'redaksi' => $request->keterangan,
                'time' => date('Y-m-d H:i:s'),
            );

            Mail::to($data_email['email'])->send(new RequestRejectedFinalMail($data_email));
        }

        DB::commit();


        return redirect('/operator');
    }

    public function updatepermohonan(Request $request, $id)
    {
        $slug = $request->segment(2);

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

    public function movetokec(Request $request, $id)
    {
        $slug = $request->segment(2);
        $user = Auth::guard('admin')->user();

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
        $datarequest = $this->_requestRepository->getByParams($params);

        if (!$datarequest) {
            return redirect(url('404'));
        }

        if ($datarequest->service_is_kec && $datarequest->request_status_id == 'TTE_KEL' ) {
            $status['request_status_id'] = 'SUBMITED_KEC';
            $this->_dataReqHelper->updateStatus($this->_requestRepository, $status, $datarequest->request_id);
            $this->_logRequest($datarequest->request_id, $status['request_status_id'], 'Diperbaharui oleh ');
        }

        return redirect('/tte')->with('successs', 'Berhasil mengirim ke kecamatan');
    }

    private function _logRequest($req_id, $stat_id, $note_log)
    {
        $user_name = Auth::guard('admin')->user()->user_id;
        $request['request_id'] = $req_id;
        $request['request_status_id'] = $stat_id;
        if ($stat_id == 'REJECTED_FINAL' || $stat_id == 'REJECTED') {
            $request['request_log_note'] = $note_log;
        } else {
            $request['request_log_note'] = $note_log . $user_name;
        }

        $this->_requestLogRepository->insert(DataHelper::_normalizeParams($request, true));
    }

    private function _signLogRequest($req_id, $stat_id, $type_sign, $user_id)
    {
        $request['request_id'] = $req_id;
        $request['user_id'] = $user_id;
        $request['status'] = $stat_id;
        $request['type_sign'] = $type_sign;

        $this->_requestSignLogRepository->insert(DataHelper::_normalizeParams($request, true));
    }
}