<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;
use Modules\Request\Repositories\RequestAttachmentRepository;
use App\Helpers\DataHelper;


class RequestRepository extends QueryBuilderImplementation
{

    protected $fillable = ['service_id', 'request_status', 'nik', 'no_kk', 'id_agama', 'tmp_lahir', 'tgl_lahir', 'id_jenkel', 'nama_warga', 'kd_kel', 'rt', 'rw', 'pekerjaan', 'no_surat_pengantar', 'tgl_surat_pengantar', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'requests';
        $this->pk = 'request_id';
        $this->_requestAttachmentRepository = new RequestAttachmentRepository;

    }

    public function getAllWithOutParams()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('requests.*', 'services.service_name', 'request_status.request_status_color_alias as request_status_color', 'request_status.request_status_name_alias as request_status_name', 'services.simkel_table', 'services.service_is_kec', 'm_sub_districts.sub_district')
                ->leftJoin('services', 'services.service_id', '=', 'requests.service_id')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'requests.request_status_id')
                ->leftJoin('m_sub_districts', 'm_sub_districts.kd_sub_district', '=', 'requests.kd_kel')
                ->orderBy('requests.created_at', 'desc')
                ->orderBy('requests.request_status_id', 'desc')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // overide
    public function getAllByParams(array $params)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('requests.*', 'services.service_name', 'request_status.request_status_name_alias as request_status_name', 'request_status.request_status_color_alias as request_status_color', )
                ->leftJoin('services', 'services.service_id', '=', 'requests.service_id')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'requests.request_status_id')
                ->where($params)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //overider
    public function getSomeByParams($row, array $params, $page = 1)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('requests.*', 'services.service_name', 'request_status.request_status_name_alias as request_status_name', 'request_status.request_status_color_alias as request_status_color')
                ->leftJoin('services', 'services.service_id', '=', 'requests.service_id')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'requests.request_status_id')
                ->offset(($page == 1 ? 0 : ($page - 1)) * $row)
                ->where($params)
                ->limit($row)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // overide
    public function getByParams(array $params)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('requests.*', 'services.service_name', 'request_status_color', 'request_status.request_status_name as request_status_name', 'm_gender.gender', 'm_religion.religion', 'm_sub_districts.sub_district', 'm_districts.district', 'm_districts.kd_district', 'users.user_alamat', 'services.slug', 'services.service_is_kec', 'services.slug_simkel')
                ->leftJoin('services', 'services.service_id', '=', 'requests.service_id')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'requests.request_status_id')
                ->leftJoin('m_gender', 'm_gender.id_gender', '=', 'requests.id_jenkel')
                ->leftJoin('m_religion', 'm_religion.id_religion', '=', 'requests.id_agama')
                ->leftJoin('m_sub_districts', 'm_sub_districts.kd_sub_district', '=', 'requests.kd_kel')
                ->leftJoin('m_districts', 'm_districts.kd_district', '=', 'm_sub_districts.kd_district')
                ->leftJoin('users', 'users.user_id', '=', 'requests.created_by')
                ->where($params)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // public function getByKeyParams(array $params)
    // {
    //     try {
    //         return DB::connection($this->db)
    //             ->table($this->table)
    //             ->select('requests.*', 'services.service_name', 'request_status_color', 'request_status.request_status_name as request_status_name', 'm_gender.gender', 'm_religion.religion', 'm_sub_districts.sub_district', 'm_districts.district', 'm_districts.kd_district', 'users.user_alamat', 'services.slug', 'services.service_is_kec', 'services.slug_simkel')
    //             ->leftJoin('services', 'services.service_id', '=', 'requests.service_id')
    //             ->leftJoin('request_status', 'request_status.request_status_id', '=', 'requests.request_status_id')
    //             ->leftJoin('m_gender', 'm_gender.id_gender', '=', 'requests.id_jenkel')
    //             ->leftJoin('m_religion', 'm_religion.id_religion', '=', 'requests.id_agama')
    //             ->leftJoin('m_sub_districts', 'm_sub_districts.kd_sub_district', '=', 'requests.kd_kel')
    //             ->leftJoin('m_districts', 'm_districts.kd_district', '=', 'm_sub_districts.kd_district')
    //             ->leftJoin('users', 'users.user_id', '=', 'requests.created_by')
    //             ->where('request_simkel_id', $params['request_simkel_id'])
    //             ->where('requests.service_id', $params['requests.service_id'])
    //             ->first();
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    //overide
    public function insert(array $data)
    {
        $data['requests']['nik'] = $data['nik'];
        $data['requests']['no_kk'] = $data['no_kk'];
        $data['requests']['nama_warga'] = $data['nama_warga'];
        $data['requests']['id_jenkel'] = isset($data['id_jenkel']) ? $data['id_jenkel'] : null;
        $data['requests']['tmp_lahir'] = isset($data['tmp_lahir']) ? $data['tmp_lahir'] : null;
        $data['requests']['tgl_lahir'] = isset($data['tgl_lahir']) ? $data['tgl_lahir'] : null;
        $data['requests']['id_agama'] = isset($data['id_agama']) ? $data['id_agama'] : null;
        $data['requests']['pekerjaan'] = isset($data['pekerjaan']) ? $data['pekerjaan'] : null;
        $data['requests']['no_surat_pengantar'] = isset($data['no_surat_pengantar']) ? $data['no_surat_pengantar'] : null;
        $data['requests']['tgl_surat_pengantar'] = isset($data['tgl_surat_pengantar']) ? $data['tgl_surat_pengantar'] : null;
        $data['requests']['rt'] = $data['rt'];
        $data['requests']['rw'] = $data['rw'];
        $data['requests']['kd_kel'] = $data['kd_kel'];
        $data['requests']['service_id'] = $data['service_id'];
        $data['requests']['request_status_id'] = $data['request_status_id'];
        $data['requests']['created_at'] = $data['created_at'];
        $data['requests']['created_by'] = $data['created_by'];

        try {
            DB::beginTransaction();
            $requestId = DB::table($this->table)->insertGetId($data['requests'], 'request_id');

            //insert into atachment table
            if (isset($data['req_attach_file'])) {

                $file = $data['req_attach_file'];
                foreach ($file as $key => $val) {
                    $data['request_attachments'][$key]['created_at'] = $data['created_at'];
                    $data['request_attachments'][$key]['created_by'] = $data['created_by'];
                    $data['request_attachments'][$key]['request_attachment_file'] = $data['req_attach_file'][$key];
                    $data['request_attachments'][$key]['request_attachment_note'] = $data['req_attach_note'][$key];
                    $data['request_attachments'][$key]['request_id'] = $requestId;

                    $req_attacment = DB::table('request_attachments')->insert($data['request_attachments'][$key]);
                }
            }

            DB::commit();
            return $requestId;
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    //overide
    public function update(array $data, $id)
    {
        $data['requests']['nik'] = $data['nik'];
        $data['requests']['no_kk'] = $data['no_kk'];
        $data['requests']['nama_warga'] = $data['nama_warga'];
        $data['requests']['id_jenkel'] = isset($data['id_jenkel']) ? $data['id_jenkel'] : null;
        $data['requests']['tmp_lahir'] = isset($data['tmp_lahir']) ? $data['tmp_lahir'] : null;
        $data['requests']['tgl_lahir'] = isset($data['tgl_lahir']) ? $data['tgl_lahir'] : null;
        $data['requests']['id_agama'] = isset($data['id_agama']) ? $data['id_agama'] : null;
        $data['requests']['pekerjaan'] = isset($data['pekerjaan']) ? $data['pekerjaan'] : null;
        $data['requests']['no_surat_pengantar'] = isset($data['no_surat_pengantar']) ? $data['no_surat_pengantar'] : null;
        $data['requests']['tgl_surat_pengantar'] = isset($data['tgl_surat_pengantar']) ? $data['tgl_surat_pengantar'] : null;
        $data['requests']['rt'] = $data['rt'];
        $data['requests']['rw'] = $data['rw'];
        // $data['requests']['kd_kel']              = $data['kd_kel'];
        $data['requests']['request_status_id'] = $data['request_status_id'];
        $data['requests']['updated_at'] = $data['updated_at'];
        $data['requests']['updated_by'] = $data['updated_by'];

        try {
            DB::beginTransaction();
            DB::table($this->table)->where('request_id', '=', $id)->update($data['requests']);

            //update or insert if not exist into atachment table
            if (isset($data['req_attach_file'])) {
                $file = $data['req_attach_file'];

                $file = $data['req_attach_file'];

                foreach ($file as $key => $val) {

                    $data['request_attachments'][$key]['request_attachment_file'] = $data['req_attach_file'][$key];
                    $data['request_attachments'][$key]['request_attachment_note'] = $data['req_attach_note'][$key];
                    $data['request_attachments'][$key]['request_id'] = $id;

                    if ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KTP') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KTP');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_RT_RW') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_RT_RW');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KTP_MENINGGAL') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KTP_MENINGGAL');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KK') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KK');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KK_MENINGGAL') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KK_MENINGGAL');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_PENDUKUNG') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_PENDUKUNG');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_PERNYATAAN') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_PERNYATAAN');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KTP_AYAH') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KTP_AYAH');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KTP_IBU') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KTP_IBU');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KTP_SAKSI_1') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KTP_SAKSI_1');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KTP_SAKSI_2') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KTP_SAKSI_2');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_BUKU_NIKAH') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_BUKU_NIKAH');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KET_RS') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KET_RS');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_USAHA') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_USAHA');
                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_PEMBERITAHUAN_TETANGGA') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_PEMBERITAHUAN_TETANGGA');
                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_PROPOSAL') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_PROPOSAL');
                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_PANITIA') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_PANITIA');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_SPTJM') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_SPTJM');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_AKTA_CERAI') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_AKTA_CERAI');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_PENDIRIAN') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_PENDIRIAN');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_SEWA_KEPEMILIKAN') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_SEWA_KEPEMILIKAN');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_DENAH') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_DENAH');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_KETERANGAN_RUMAH') {

                        //check to table 
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_KETERANGAN_RUMAH');

                    } elseif ($data['request_attachments'][$key]['request_attachment_note'] == 'FILE_RUJUKAN_RS') {
                        
                        $this->_checkAttachment($id, $data['request_attachments'][$key], 'FILE_RUJUKAN_RS');
                    }
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    private function _checkAttachment($id, $data, $note)
    {
        try {
            //check to table 
            $query = $this->_getAttachment($id, $note);

            if ($query == null) {
                //insert
                $this->_requestAttachmentRepository->insert(DataHelper::_normalizeParams($data, true));
            } else {
                //update
                $query_id = $query->request_attachment_id;

                $this->_requestAttachmentRepository->update(DataHelper::_normalizeParams($data, false, true), $query_id);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function _getAttachment($id, $note)
    {
        try {
            //check to table 
            $query = DB::table('request_attachments')
                ->where('request_id', '=', $id)
                ->where('request_attachment_note', '=', $note)
                ->first();

            return $query;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function _insertAttachment($data)
    {
        try {
            //check to table 
            $query = DB::table('request_attachments')
                ->insert($data);

            return $query;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
