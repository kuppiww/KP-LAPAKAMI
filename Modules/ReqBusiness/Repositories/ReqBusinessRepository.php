<?php

namespace Modules\ReqBusiness\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class ReqBusinessRepository extends QueryBuilderImplementation
{

    protected $fillable = ['kewarganegaraan', 'id_status_kawin', 'npwp', 'kredit_ke', 'tgl_surat_pernyataan', 'jenis_usaha', 'nama_usaha', 'alamat_usaha', 'tlp_tmp_usaha', 'status_bangunan', 'keperluan', 'masa_berlaku', 'request_id', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_ket_bussiness';
        $this->pk = 'req_ket_bussiness_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['kewarganegaraan'] = $data['kewarganegaraan'];
        $data['requests_det']['id_status_kawin'] = $data['id_status_kawin'];
        $data['requests_det']['npwp']            = $data['npwp'];
        $data['requests_det']['kredit_ke']            = $data['kredit_ke'];
        $data['requests_det']['jenis_usaha']     = $data['jenis_usaha'];
        $data['requests_det']['alamat_usaha']    = $data['alamat_usaha'];
        $data['requests_det']['tgl_surat_pernyataan'] = $data['tgl_surat_pernyataan'];
        // $data['requests_det']['keperluan']       = $data['keperluan'];
        $data['requests_det']['masa_berlaku']    = $data['masa_berlaku'];
        $data['requests_det']['request_id']      = $data['request_id'];
        $data['requests_det']['created_at']      = $data['created_at'];
        $data['requests_det']['created_by']      = $data['created_by'];

        try {
            DB::beginTransaction();
                DB::table($this->table)->insert($data['requests_det']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    //overide
    public function update(array $data, $id)
    {
        $data['requests_det']['npwp']            = $data['npwp'];
        $data['requests_det']['kredit_ke']       = $data['kredit_ke'];
        $data['requests_det']['jenis_usaha']     = $data['jenis_usaha'];
        $data['requests_det']['alamat_usaha']    = $data['alamat_usaha'];
        $data['requests_det']['tgl_surat_pernyataan'] = $data['tgl_surat_pernyataan'];
        // $data['requests_det']['keperluan']       = $data['keperluan'];
        $data['requests_det']['masa_berlaku']    = $data['masa_berlaku'];
        $data['requests_det']['request_id']      = $data['request_id'];
        $data['requests_det']['updated_at']      = $data['updated_at'];
        $data['requests_det']['updated_by']      = $data['updated_by'];

        try {
            DB::beginTransaction();
                DB::table($this->table)
                ->where('request_id', '=', $id)
                ->update($data['requests_det']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    // overide
    public function getByParams(array $params)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('req_ket_bussiness.*', 'merried_status')
                ->join('m_merried_status', 'm_merried_status.id_merried_status', '=', 'req_ket_bussiness.id_status_kawin')
                ->where($params)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}