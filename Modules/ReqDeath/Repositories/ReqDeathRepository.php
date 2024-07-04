<?php

namespace Modules\ReqDeath\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class ReqDeathRepository extends QueryBuilderImplementation
{

    protected $fillable = ['keperluan', 'nik_warga_meninggal', 'tmp_lahir_warga_meninggal', 'tgl_lahir_warga_meninggal', 'jk_warga_meninggal', 'id_agama_warga_meninggal', 'pekerjaan_warga_meninggal', 'alamat_warga_meninggal', 'tgl_kematian', 'no_surat', 'tgl_surat', 'nama_warga_meninggal', 'id_status_kawin', 'jam_kematian', 'lokasi_kematian', 'penyebab_kematian', 'usia_kematian', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_ket_deaths';
        $this->pk = 'req_ket_death_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['keperluan'] = $data['keperluan'];
        $data['requests_det']['tgl_kematian'] = $data['tgl_kematian'];
        $data['requests_det']['id_status_kawin'] = $data['id_status_kawin'];
        $data['requests_det']['jam_kematian'] = $data['jam_kematian'];
        $data['requests_det']['lokasi_kematian'] = $data['lokasi_kematian'];
        $data['requests_det']['penyebab_kematian'] = $data['penyebab_kematian'];
        $data['requests_det']['usia_kematian'] = $data['usia_kematian'];
        $data['requests_det']['nama_warga_meninggal'] = $data['nama_warga_meninggal'];
        $data['requests_det']['nik_warga_meninggal'] = $data['nik_warga_meninggal'];
        $data['requests_det']['tmp_lahir_warga_meninggal'] = $data['tmp_lahir_warga_meninggal'];
        $data['requests_det']['tgl_lahir_warga_meninggal'] = $data['tgl_lahir_warga_meninggal'];
        $data['requests_det']['jk_warga_meninggal'] = $data['jk_warga_meninggal'];
        $data['requests_det']['id_agama_warga_meninggal'] = $data['id_agama_warga_meninggal'];
        $data['requests_det']['pekerjaan_warga_meninggal'] = $data['pekerjaan_warga_meninggal'];
        $data['requests_det']['alamat_warga_meninggal'] = $data['alamat_warga_meninggal'];
        $data['requests_det']['request_id'] = $data['request_id'];
        $data['requests_det']['created_at'] = $data['created_at'];
        $data['requests_det']['created_by'] = $data['created_by'];

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
        $data['requests_det']['keperluan'] = $data['keperluan'];
        $data['requests_det']['tgl_kematian'] = $data['tgl_kematian'];
        $data['requests_det']['jam_kematian'] = $data['jam_kematian'];
        $data['requests_det']['lokasi_kematian'] = $data['lokasi_kematian'];
        $data['requests_det']['penyebab_kematian'] = $data['penyebab_kematian'];
        $data['requests_det']['usia_kematian'] = $data['usia_kematian'];
        $data['requests_det']['nama_warga_meninggal'] = $data['nama_warga_meninggal'];
        $data['requests_det']['tmp_lahir_warga_meninggal'] = $data['tmp_lahir_warga_meninggal'];
        $data['requests_det']['tgl_lahir_warga_meninggal'] = $data['tgl_lahir_warga_meninggal'];
        $data['requests_det']['jk_warga_meninggal'] = $data['jk_warga_meninggal'];
        $data['requests_det']['id_agama_warga_meninggal'] = $data['id_agama_warga_meninggal'];
        $data['requests_det']['pekerjaan_warga_meninggal'] = $data['pekerjaan_warga_meninggal'];
        $data['requests_det']['alamat_warga_meninggal'] = $data['alamat_warga_meninggal'];
        $data['requests_det']['request_id'] = $data['request_id'];
        $data['requests_det']['updated_at'] = $data['updated_at'];
        $data['requests_det']['updated_by'] = $data['updated_by'];

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
                ->select('req_ket_deaths.*', 'merried_status', 'm_religion.religion', 'm_gender.gender')
                ->leftJoin('m_gender', 'm_gender.id_gender', '=', 'req_ket_deaths.jk_warga_meninggal')
                ->leftJoin('m_religion', 'm_religion.id_religion', '=', 'req_ket_deaths.id_agama_warga_meninggal')
                ->join('m_merried_status', 'm_merried_status.id_merried_status', '=', 'req_ket_deaths.id_status_kawin')
                ->where($params)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}