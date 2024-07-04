<?php

namespace Modules\ReqBusiness\Http\Controllers;

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
use Modules\Request\Repositories\RequestAttachmentRepository;
use Modules\Request\Repositories\ServiceRepository;
use Modules\ReqBusiness\Repositories\ReqBusinessRepository;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use DB;

class ReqBusinessController extends Controller
{
    public function __construct(){

        // Require Login
        $this->middleware('auth');

        $this->_districtRepository          = new DistrictRepository;
        $this->_subDistrictRepository       = new SubDistrictRepository;
        $this->_religionRepository          = new ReligionRepository;
        $this->_genderRepository            = new GenderRepository;
        $this->_merriedStatusRepository     = new MerriedStatusRepository;
        $this->_requestRepository           = new RequestRepository;
        $this->_requestLogRepository        = new RequestLogRepository;
        $this->_reqBusinessRepository       = new ReqBusinessRepository;
        $this->_requestAttachmentRepository = new RequestAttachmentRepository;
        $this->_serviceRepository           = new ServiceRepository;

        $this->module      = "ReqBusiness";
        $this->_logHelper  = new LogHelper;

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('reqbusiness::index');
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
        $getService     = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        $districts      = $this->_districtRepository->getAll();
        $sub_districts  = $this->_subDistrictRepository->getAll();
        $religions      = $this->_religionRepository->getAll();
        $genders        = $this->_genderRepository->getAll();
        $merried_stats  = $this->_merriedStatusRepository->getAll();
        $attach_samples = $this->_serviceRepository->getRequirementSample(['service_id' => $getService->service_id]);

        return view('reqbusiness::create',  compact('user', 'sub_districts', 'districts', 'religions', 'genders', 'merried_stats', 'attach_samples'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request['nik']         = $user->user_nik;
        $request['no_kk']       = $user->user_kk;
        $request['nama_warga']  = $user->user_nama;
        $request['id_jenkel']   = $user->user_id_jenkel;
        $request['tmp_lahir']   = $user->user_tmp_lahir;
        $request['tgl_lahir']   = $user->user_tgl_lahir;
        $request['id_agama']    = $user->user_id_agama;
        $request['pekerjaan']   = $user->user_pekerjaan;
        $request['kd_kel']      = $user->kd_kel;
        $request['kewarganegaraan']    = $user->user_kewarganegaraan;
        $request['id_status_kawin']    = $user->id_merried_status;

        //convertion date pengantar
        $tgl_surat_pengantar = str_replace('/', '-', $request->tgl_surat_pengantar);
        $request['tgl_surat_pengantar'] = date("Y-m-d", strtotime($tgl_surat_pengantar));

        //convertion date pernyataan
        $tgl_surat_pernyataan = str_replace('/', '-', $request->tgl_surat_pernyataan);
        $request['tgl_surat_pernyataan'] = date("Y-m-d", strtotime($tgl_surat_pernyataan));

        //convertion date masa berlaku
        $masa_berlaku = str_replace('/', '-', $request->masa_berlaku);
        $request['masa_berlaku'] = date("Y-m-d", strtotime($masa_berlaku));

        // Upload image
        $data_upload = $this->_uploadFile($request);

        $request['req_attach_file'] = $data_upload['file'];
        $request['req_attach_note'] = $data_upload['note'];

        //new subdomain
        $request['service_id']         = 'REQ_BUSINESS';
        $request['request_status_id']  = 'SUBMITED';

        DB::beginTransaction();

        $req_id = $this->_requestRepository->insert(DataHelper::_normalizeParams($request->all(), true));

        $request['request_id']  = $req_id;

        $this->_reqBusinessRepository->insert(DataHelper::_normalizeParams($request->all(), true));

        $this->_logRequest($req_id, $request['request_status_id'], 'Dibuat oleh ');
        $this->_logHelper->store($this->module, $request->service_id, 'create');

        if($req_id != null){
            $data_email   = array(
                'name'          => $user->user_nama,
                'email'         => $request['user_email'],
                'url'           => env('APP_URL').'/user/layanan/memiliki-usaha/lihat/'.$req_id,
                'service_name'  => 'Surat Keterangan Memiliki Usaha',
                'time'          => date('Y-m-d H:i:s'),
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
        $getService     = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // Validation request data 
        $params     = array(
                        'request_id'            => $id, 
                        'requests.created_by'   => $user->user_id, 
                        'requests.service_id'   => $getService->service_id
                    );        
        $request    = $this->_requestRepository->getByParams($params);

        if (!$request) {
            return redirect(url('404'));
        } 

        $filter['request_id'] = $id;

        $logs            = $this->_requestLogRepository->getAllByParams($filter); 
        $request_docs    = $this->_requestAttachmentRepository->getAllByParams($filter); 
        $request_detail  = $this->_reqBusinessRepository->getByParams($filter); 

        return view('reqbusiness::detail', compact ('request', 'request_detail', 'logs', 'request_docs'));
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
        $getService     = $this->_serviceRepository->getByParams(['slug' => $slug, 'is_active' => 'true']);

        if (!$getService) {
            return redirect(url('404'));
        }

        // Validation request data 
        $params     = array(
                        'request_id'            => $id, 
                        'requests.created_by'   => $user->user_id, 
                        'requests.service_id'   => $getService->service_id
                    );        
        $request    = $this->_requestRepository->getByParams($params);

        if (!$request) {
            return redirect(url('404'));
        } 

        $filter['request_id'] = $id;

        $logs           = $this->_requestLogRepository->getAllByParams($filter); 
        $request_docs   = $this->_requestAttachmentRepository->getAllByParams($filter); 
        $districts      = $this->_districtRepository->getAll();
        $sub_districts  = $this->_subDistrictRepository->getAll();
        $religions      = $this->_religionRepository->getAll();
        $genders        = $this->_genderRepository->getAll();
        $merried_stats  = $this->_merriedStatusRepository->getAll();
        $request_detail  = $this->_reqBusinessRepository->getByParams($filter); 
        $attach_samples = $this->_serviceRepository->getRequirementSample(['service_id' => $getService->service_id]);

        return view('reqbusiness::edit', compact ('request', 'request_detail', 'logs', 'request_docs', 'sub_districts', 'districts', 'religions', 'genders', 'merried_stats', 'attach_samples'));
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
        $request['nik']         = $user->user_nik;
        $request['no_kk']       = $user->user_kk;
        $request['nama_warga']  = $user->user_nama;
        $request['id_jenkel']   = $user->user_id_jenkel;
        $request['tmp_lahir']   = $user->user_tmp_lahir;
        $request['tgl_lahir']   = $user->user_tgl_lahir;
        $request['id_agama']    = $user->user_id_agama;
        $request['pekerjaan']   = $user->user_pekerjaan;
        $request['kd_kel']      = $user->kd_kel;
        $request['kewarganegaraan']    = $user->user_kewarganegaraan;
        $request['id_status_kawin']    = $user->id_merried_status;
        
        //convertion date pengantar
        $tgl_surat_pengantar = str_replace('/', '-', $request->tgl_surat_pengantar);
        $request['tgl_surat_pengantar'] = date("Y-m-d", strtotime($tgl_surat_pengantar));

        //convertion date birth
        $tgl_lahir = str_replace('/', '-', $request->tgl_lahir);
        $request['tgl_lahir'] = date("Y-m-d", strtotime($tgl_lahir));

        //convertion date pernyataan
        $tgl_surat_pernyataan = str_replace('/', '-', $request->tgl_surat_pernyataan);
        $request['tgl_surat_pernyataan'] = date("Y-m-d", strtotime($tgl_surat_pernyataan));

        //convertion date masa berlaku
        $masa_berlaku = str_replace('/', '-', $request->masa_berlaku);
        $request['masa_berlaku'] = date("Y-m-d", strtotime($masa_berlaku));

        // Upload image
        $data_upload = $this->_uploadFile($request);

        $request['req_attach_file'] = $data_upload['file'];
        $request['req_attach_note'] = $data_upload['note'];

        //new subdomain
        $request['request_status_id']  = 'EDITED';
        $request['request_id']         = $id;

        DB::beginTransaction();

        $this->_requestRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);

        $this->_reqBusinessRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);

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
          $detail  = $this->_requestRepository->getById($id);

          if (!$detail) {
              return redirect('/user/layanan');
          }
  
          $this->_requestRepository->delete($id);
          
          return redirect('user/layanan')->with('message', 'Permohonan berhasil dibatalkan');
    }

    private function _logRequest($req_id, $stat_id, $note_log)
    {
        $user_name = Auth::user()->user_id;
        $request['request_id']        = $req_id;
        $request['request_status_id'] = $stat_id;
        $request['request_log_note']  = $note_log.$user_name;
        
        $this->_requestLogRepository->insert(DataHelper::_normalizeParams($request, true));        
    }

    private function _uploadFile($request)
    {
        $data['file']  = [];
        $data['note']  = [];

        if ($request->file('f_ktp') != '') {

            $imageName = md5(time() . rand()) .'.'. $request->f_ktp->extension(); 

            $request->file("f_ktp")->storeAs('files/request_business/ktp', $imageName, 'public');

            array_push($data['file'], $imageName );

            array_push($data['note'], 'FILE_KTP' );

        }

        if ($request->file('f_p_rt_rw') != '') {

            $imageName = md5(time() . rand()) .'.'. $request->f_p_rt_rw->extension(); 

            $request->file("f_p_rt_rw")->storeAs('files/request_business/pengantar_rt_rw', $imageName, 'public');

            array_push($data['file'], $imageName );

            array_push($data['note'], 'FILE_RT_RW');

        } 

        if ($request->file('f_kk') != '') {

            $imageName = md5(time() . rand()) .'.'. $request->f_kk->extension(); 

            $request->file("f_kk")->storeAs('files/request_business/kk', $imageName, 'public');

            array_push($data['file'], $imageName );

            array_push($data['note'], 'FILE_KK');

        } 

        if ($request->file('f_pernyataan') != '') {

            $imageName = md5(time() . rand()) .'.'. $request->f_pernyataan->extension(); 

            $request->file("f_pernyataan")->storeAs('files/request_business/surat_pernyataan', $imageName, 'public');

            array_push($data['file'], $imageName );

            array_push($data['note'], 'FILE_PERNYATAAN');

        } 

        if ($request->file('f_usaha') != '') {

            $imageName = md5(time() . rand()) .'.'. $request->f_usaha->extension(); 

            $request->file("f_usaha")->storeAs('files/request_business/usaha', $imageName, 'public');

            array_push($data['file'], $imageName );

            array_push($data['note'], 'FILE_USAHA');

        } 
        
        return $data;
    }
}
