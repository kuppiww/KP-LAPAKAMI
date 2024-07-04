<?php

namespace Modules\ReqClean\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class ReqCleanRepository extends QueryBuilderImplementation
{

    protected $fillable = ['nik_ayah', 'nama_ayah', 'id_agama_ayah', 'alamat_ayah', 'pekerjaan_ayah', 'nik_ibu', 'nama_ibu', 'id_agama_ibu', 'alamat_ibu', 'pekerjaan_ibu', 'keperluan', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_ket_cleans';
        $this->pk = 'req_ket_clean_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['nik_ayah']       = $data['nik_ayah'];
        $data['requests_det']['nama_ayah']      = $data['nama_ayah'];
        $data['requests_det']['id_agama_ayah']  = $data['id_agama_ayah'];
        $data['requests_det']['alamat_ayah']    = $data['alamat_ayah'];
        $data['requests_det']['pekerjaan_ayah'] = $data['pekerjaan_ayah'];
        $data['requests_det']['nik_ibu']        = $data['nik_ibu'];
        $data['requests_det']['nama_ibu']       = $data['nama_ibu'];
        $data['requests_det']['id_agama_ibu']   = $data['id_agama_ibu'];
        $data['requests_det']['alamat_ibu']     = $data['alamat_ibu'];
        $data['requests_det']['pekerjaan_ibu']  = $data['pekerjaan_ibu'];
        $data['requests_det']['keperluan']      = $data['keperluan'];
        $data['requests_det']['request_id']     = $data['request_id'];
        $data['requests_det']['created_at']     = $data['created_at'];
        $data['requests_det']['created_by']     = $data['created_by'];

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
        $data['requests_det']['nik_ayah']       = $data['nik_ayah'];
        $data['requests_det']['nama_ayah']      = $data['nama_ayah'];
        $data['requests_det']['id_agama_ayah']  = $data['id_agama_ayah'];
        $data['requests_det']['alamat_ayah']    = $data['alamat_ayah'];
        $data['requests_det']['pekerjaan_ayah'] = $data['pekerjaan_ayah'];
        $data['requests_det']['nik_ibu']        = $data['nik_ibu'];
        $data['requests_det']['nama_ibu']       = $data['nama_ibu'];
        $data['requests_det']['id_agama_ibu']   = $data['id_agama_ibu'];
        $data['requests_det']['alamat_ibu']     = $data['alamat_ibu'];
        $data['requests_det']['pekerjaan_ibu']  = $data['pekerjaan_ibu'];
        $data['requests_det']['keperluan']      = $data['keperluan'];
        $data['requests_det']['request_id']     = $data['request_id'];
        $data['requests_det']['updated_at']     = $data['updated_at'];
        $data['requests_det']['updated_by']     = $data['updated_by'];

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
                ->select('req_ket_cleans.*', 'ibu.religion AS agama_ibu', 'ayah.religion AS agama_ayah')
                ->leftJoin('m_religion AS ibu', 'ibu.id_religion', '=', 'req_ket_cleans.id_agama_ibu')
                ->leftJoin('m_religion AS ayah', 'ayah.id_religion', '=', 'req_ket_cleans.id_agama_ayah')
                ->where($params)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}