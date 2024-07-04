<?php

namespace Modules\ReqSktm\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class SktmEducationRepository extends QueryBuilderImplementation
{

    protected $fillable = ['nama_siswa', 'tmp_lahir_siswa', 'tgl_lahir_siswa', 'id_ket', 'id_hub_kel', 'peruntukan', 'nama_sekolah', 'no_kip', 'request_id', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_sktm_educations';
        $this->pk = 'req_sktm_education_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['nama_siswa']      = $data['nama_siswa'];
        $data['requests_det']['tmp_lahir_siswa'] = $data['tmp_lahir_siswa'];
        $data['requests_det']['tgl_lahir_siswa'] = $data['tgl_lahir_siswa'];
        $data['requests_det']['id_hub_kel']      = $data['id_hub_kel'];
        $data['requests_det']['id_ket']          = $data['id_ket'];
        $data['requests_det']['nama_sekolah']    = $data['nama_sekolah'];
        $data['requests_det']['no_kip']          = isset ($data['no_kip']) ? $data['no_kip'] : null;
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
        $data['requests_det']['nama_siswa']      = $data['nama_siswa'];
        $data['requests_det']['tmp_lahir_siswa'] = $data['tmp_lahir_siswa'];
        $data['requests_det']['tgl_lahir_siswa'] = $data['tgl_lahir_siswa'];
        $data['requests_det']['id_hub_kel']      = $data['id_hub_kel'];
        $data['requests_det']['id_ket']          = $data['id_ket'];
        $data['requests_det']['nama_sekolah']    = $data['nama_sekolah'];
        $data['requests_det']['no_kip']          = isset ($data['no_kip']) ? $data['no_kip'] : null;
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
                ->select('req_sktm_educations.*', 'ket', 'nama_hub')
                ->join('m_fam_relation', 'm_fam_relation.id_hub', '=', 'req_sktm_educations.id_hub_kel')
                ->join('m_ket_incapable', 'm_ket_incapable.id_ket', '=', 'req_sktm_educations.id_ket')
                ->where($params)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}