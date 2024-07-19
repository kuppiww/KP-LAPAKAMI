<?php

namespace Modules\ReqDeath\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\RequestChangeStatusMail;

use Modules\User\Repositories\SubDistrictRepository;
use Modules\User\Repositories\DistrictRepository;
use Modules\User\Repositories\ReligionRepository;
use Modules\User\Repositories\GenderRepository;
use Modules\User\Repositories\MerriedStatusRepository;
use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Repositories\RequestLogRepository;
use Modules\Request\Repositories\RequestAttachmentRepository;
use Modules\Request\Repositories\ServiceRepository;
use Modules\ReqDeath\Repositories\ReqDeathRepository;

use App\Helpers\DataHelper;
use App\Helpers\DateTime;
use App\Helpers\HTMLHelper;
use App\Helpers\HttpStatusHelper;
use App\Helpers\LogHelper;
use App\Helpers\ReportHelper;
use DB;
use PDF;


class ReqDeathController extends Controller
{
    public function __construct()
    {

        // Require Login
        $this->middleware('auth');

        $this->_districtRepository = new DistrictRepository;
        $this->_subDistrictRepository = new SubDistrictRepository;
        $this->_religionRepository = new ReligionRepository;
        $this->_genderRepository = new GenderRepository;
        $this->_merriedStatusRepository = new MerriedStatusRepository;
        $this->_requestRepository = new RequestRepository;
        $this->_requestLogRepository = new RequestLogRepository;
        $this->_reqDeathRepository = new ReqDeathRepository;
        $this->_requestAttachmentRepository = new RequestAttachmentRepository;
        $this->_serviceRepository = new ServiceRepository;

        $this->module = "ReqBirth";
        $this->_logHelper = new LogHelper;

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('reqdeath::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $slug = $request->segment(3);

        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        $districts = $this->_districtRepository->getAll();
        $sub_districts = $this->_subDistrictRepository->getAll();
        $religions = $this->_religionRepository->getAll();
        $genders = $this->_genderRepository->getAll();
        $merried_stats = $this->_merriedStatusRepository->getAll();
        $attach_samples = $this->_serviceRepository->getRequirementSample(['service_id' => $getService->service_id]);

        return view('reqdeath::create', compact('user', 'sub_districts', 'districts', 'religions', 'genders', 'merried_stats', 'attach_samples'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request['nik'] = $user->user_nik;
        $request['no_kk'] = $user->user_kk;
        $request['nama_warga'] = $user->user_nama;
        $request['id_jenkel'] = $user->user_id_jenkel;
        $request['tmp_lahir'] = $user->user_tmp_lahir;
        $request['tgl_lahir'] = $user->user_tgl_lahir;
        $request['id_agama'] = $user->user_id_agama;
        $request['pekerjaan'] = $user->user_pekerjaan;
        $request['kd_kel'] = $user->kd_kel;

        //convertion date pengantar
        $tgl_surat_pengantar = str_replace('/', '-', $request->tgl_surat_pengantar);
        $request['tgl_surat_pengantar'] = date("Y-m-d", strtotime($tgl_surat_pengantar));
        $tgl_kematian = str_replace('/', '-', $request->tgl_kematian);
        $request['tgl_kematian'] = date("Y-m-d", strtotime($tgl_kematian));
        $tgl_lahir_warga_meninggal = str_replace('/', '-', $request->tgl_lahir_warga_meninggal);
        $request['tgl_lahir_warga_meninggal'] = date("Y-m-d", strtotime($tgl_lahir_warga_meninggal));
        // Upload image
        $data_upload = $this->_uploadFile($request);

        $request['req_attach_file'] = $data_upload['file'];
        $request['req_attach_note'] = $data_upload['note'];

        //new subdomain
        $request['service_id'] = 'REQ_DEATH';
        $request['request_status_id'] = 'SUBMITED';

        DB::beginTransaction();

        $req_id = $this->_requestRepository->insert(DataHelper::_normalizeParams($request->all(), true));

        $request['request_id'] = $req_id;

        $this->_reqDeathRepository->insert(DataHelper::_normalizeParams($request->all(), true));

        $this->_logRequest($req_id, $request['request_status_id'], 'Dibuat oleh ');
        $this->_logHelper->store($this->module, $request->service_id, 'create');

        if ($req_id != null) {
            $data_email = array(
                'name' => $user->user_nama,
                'email' => $request['user_email'],
                'url' => env('APP_URL') . '/user/layanan/penduduk/lihat/' . $req_id,
                'service_name' => 'Surat Keterangan Kematian',
                'time' => date('Y-m-d H:i:s'),
            );

            Mail::to($user->user_email)->send(new RequestChangeStatusMail($data_email));
        }

        DB::commit();


        return redirect('user/layanan')->with('message', 'Permohonan berhasil dikirim');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $user = Auth::user();
        $slug = $request->segment(3);

        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // Validation request data 
        $params = array(
            'request_id' => $id,
            'requests.created_by' => $user->user_id,
            'requests.service_id' => $getService->service_id
        );
        $request = $this->_requestRepository->getByParams($params);

        if (!$request) {
            return redirect(url('404'));
        }

        $filter['request_id'] = $id;

        $logs = $this->_requestLogRepository->getAllByParams($filter);
        $request_docs = $this->_requestAttachmentRepository->getAllByParams($filter);
        $request_detail = $this->_reqDeathRepository->getByParams($filter);

        return view('reqdeath::detail', compact('request', 'request_detail', 'logs', 'request_docs'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $slug = $request->segment(3);

        // Validation service
        $getService = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // Validation request data 
        $params = array(
            'request_id' => $id,
            'requests.created_by' => $user->user_id,
            'requests.service_id' => $getService->service_id
        );
        $request = $this->_requestRepository->getByParams($params);

        if (!$request) {
            return redirect(url('404'));
        }

        $filter['request_id'] = $id;

        $logs = $this->_requestLogRepository->getAllByParams($filter);
        $request_docs = $this->_requestAttachmentRepository->getAllByParams($filter);
        $districts = $this->_districtRepository->getAll();
        $sub_districts = $this->_subDistrictRepository->getAll();
        $religions = $this->_religionRepository->getAll();
        $genders = $this->_genderRepository->getAll();
        $merried_stats = $this->_merriedStatusRepository->getAll();
        $request_detail = $this->_reqDeathRepository->getByParams($filter);
        $attach_samples = $this->_serviceRepository->getRequirementSample(['service_id' => $getService->service_id]);

        return view('reqdeath::edit', compact('request', 'request_detail', 'logs', 'request_docs', 'sub_districts', 'districts', 'religions', 'genders', 'merried_stats', 'attach_samples'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $request['nik'] = $user->user_nik;
        $request['no_kk'] = $user->user_kk;
        $request['nama_warga'] = $user->user_nama;
        $request['id_jenkel'] = $user->user_id_jenkel;
        $request['tmp_lahir'] = $user->user_tmp_lahir;
        $request['tgl_lahir'] = $user->user_tgl_lahir;
        $request['id_agama'] = $user->user_id_agama;
        $request['pekerjaan'] = $user->user_pekerjaan;
        $request['kd_kel'] = $user->kd_kel;
        $request['kewarganegaraan'] = $user->user_kewarganegaraan;
        $request['id_status_kawin'] = $user->id_merried_status;

        //convertion date pengantar
        $tgl_surat_pengantar = str_replace('/', '-', $request->tgl_surat_pengantar);
        $request['tgl_surat_pengantar'] = date("Y-m-d", strtotime($tgl_surat_pengantar));
        $tgl_kematian = str_replace('/', '-', $request->tgl_kematian);
        $request['tgl_kematian'] = date("Y-m-d", strtotime($tgl_kematian));
        $tgl_lahir_warga_meninggal = str_replace('/', '-', $request->tgl_lahir_warga_meninggal);
        $request['tgl_lahir_warga_meninggal'] = date("Y-m-d", strtotime($tgl_lahir_warga_meninggal));

        // Upload image
        $data_upload = $this->_uploadFile($request);

        $request['req_attach_file'] = $data_upload['file'];
        $request['req_attach_note'] = $data_upload['note'];

        //new subdomain
        $request['request_status_id'] = 'EDITED';
        $request['request_id'] = $id;

        DB::beginTransaction();

        $this->_requestRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);

        $this->_reqDeathRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);

        // Send notification
        // $params = array(
        //             'title'     => $title,
        //             'body'      => $message,
        //             'type'      => 'subdomain',
        //             'content_id'=> $req_id
        //         );

        // $this->_notifHelper->save(1, 1, $params);

        $this->_logRequest($id, $request['request_status_id'], 'Diperbaharui oleh ');
        $this->_logHelper->store($this->module, $request->service_id, 'update');

        DB::commit();

        return redirect('user/layanan')->with('message', 'Permohonan berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        // Check detail to db
        $detail = $this->_requestRepository->getById($id);

        if (!$detail) {
            return redirect('/user/layanan');
        }

        $this->_requestRepository->delete($id);

        return redirect('user/layanan')->with('message', 'Permohonan berhasil dibatalkan');
    }

    public function pdf(Request $request, $id, $servicename)
    {
        $slug = $request->segment(3);
        
        $getService     = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);
        
        if (!$getService) {
            return redirect(url('404'));
        }
        
        $title = 'SURAT KETERANGAN KEMATIAN';

        $params     = array(
            'request_id'            => $id, 
            // 'requests.created_by'   => $user->user_id, 
            // 'requests.service_id'   => $getService->service_id
        );
        
        $datarequest = $this->_reqDeathRepository->getByParams($params); //$this->_setRepository($getService->slug);

        $data = [
            'meta' => [],//$this->meta,
            'data' => $datarequest,
            'pengajuan' => $this->_requestRepository->getByParams($params),
            'service' => $getService,
            'title' => $title,  
            'ReportHelper' => ReportHelper::class,
            'HtmlHelper' => HTMLHelper::class,
            'DateTime' => DateTime::class
        ];

        $pdf = PDF::loadView(
            'report/pdf/kematian', //ReportHelper::getReportTemplatePath($servicename),
            $data,
            [],
            config('mpdf')
        );

        return response()->stream(function () use ($pdf) {
            $pdf->stream('kematian-pdf-' . date('YmdHis') . '.pdf');
        }, HttpStatusHelper::OK, ['Content-Type' => 'application/pdf']);
    }

    private function _logRequest($req_id, $stat_id, $note_log)
    {
        $user_name = Auth::user()->user_id;
        $request['request_id'] = $req_id;
        $request['request_status_id'] = $stat_id;
        $request['request_log_note'] = $note_log . $user_name;

        $this->_requestLogRepository->insert(DataHelper::_normalizeParams($request, true));
    }

    private function _uploadFile($request)
    {
        $data['file'] = [];
        $data['note'] = [];

        if ($request->file('f_ktp') != '') {

            $imageName = md5(time() . rand()) . '.' . $request->f_ktp->extension();

            $request->file("f_ktp")->storeAs('files/request_death/ktp', $imageName, 'public');

            array_push($data['file'], $imageName);

            array_push($data['note'], 'FILE_KTP');

        }

        if ($request->file('f_ktp_meninggal') != '') {

            $imageName = md5(time() . rand()) . '.' . $request->f_ktp_meninggal->extension();

            $request->file("f_ktp_meninggal")->storeAs('files/request_death/ktp_meninggal', $imageName, 'public');

            array_push($data['file'], $imageName);

            array_push($data['note'], 'FILE_KTP_MENINGGAL');

        }

        if ($request->file('f_ktp_saksi_1') != '') {

            $imageName = md5(time() . rand()) . '.' . $request->f_ktp_saksi_1->extension();

            $request->file("f_ktp_saksi_1")->storeAs('files/request_death/ktp_saksi_1', $imageName, 'public');

            array_push($data['file'], $imageName);

            array_push($data['note'], 'FILE_KTP_SAKSI_1');

        }

        if ($request->file('f_ktp_saksi_2') != '') {

            $imageName = md5(time() . rand()) . '.' . $request->f_ktp_saksi_2->extension();

            $request->file("f_ktp_saksi_2")->storeAs('files/request_death/ktp_saksi_2', $imageName, 'public');

            array_push($data['file'], $imageName);

            array_push($data['note'], 'FILE_KTP_SAKSI_2');

        }

        if ($request->file('f_p_rt_rw') != '') {

            $imageName = md5(time() . rand()) . '.' . $request->f_p_rt_rw->extension();

            $request->file("f_p_rt_rw")->storeAs('files/request_death/pengantar_rt_rw', $imageName, 'public');

            array_push($data['file'], $imageName);

            array_push($data['note'], 'FILE_RT_RW');

        }

        if ($request->file('f_kk_meninggal') != '') {

            $imageName = md5(time() . rand()) . '.' . $request->f_kk_meninggal->extension();

            $request->file("f_kk_meninggal")->storeAs('files/request_death/kk_meninggal', $imageName, 'public');

            array_push($data['file'], $imageName);

            array_push($data['note'], 'FILE_KK_MENINGGAL');

        }

        if ($request->file('f_buku_nikah') != '') {

            $imageName = md5(time() . rand()) . '.' . $request->f_buku_nikah->extension();

            $request->file("f_buku_nikah")->storeAs('files/request_death/buku_nikah', $imageName, 'public');

            array_push($data['file'], $imageName);

            array_push($data['note'], 'FILE_BUKU_NIKAH');

        }

        if ($request->file('f_sptjm_kematian') != '') {

            $imageName = md5(time() . rand()) . '.' . $request->f_sptjm_kematian->extension();

            $request->file("f_sptjm_kematian")->storeAs('files/request_death/sptjm_kematian', $imageName, 'public');

            array_push($data['file'], $imageName);

            array_push($data['note'], 'FILE_SPTJM_KEMATIAN');

        }

        return $data;
    }

}