<?php

namespace Modules\ReqDomicileCompany\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class DomicileCompanyRepository extends QueryBuilderImplementation
{

    protected $fillable = ['kewarganegaraan', 'jam_kerja', 'alamat', 'jml_karyawan', 'masa_berlaku', 'tgl_surat_pernyataan', 'nama_perusahaan', 'notaris', 'tlp_perusahaan',
     'no_akta_notaris', 'tgl_akta_notaris', 'no_sk_kehakiman', 'status_bangunan', 'no_imb',
     'tlg_imb', 'penanggung_jawab', 'keperluan', 'request_id', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_ket_comp_domiciles';
        $this->pk = 'req_ket_comp_domicile_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['kewarganegaraan']    = $data['kewarganegaraan'];
        $data['requests_det']['nama_perusahaan']    = $data['nama_perusahaan'];
        $data['requests_det']['notaris']            = $data['notaris'];
        $data['requests_det']['masa_berlaku']            = $data['masa_berlaku'];
        $data['requests_det']['tgl_akta_notaris']            = $data['tgl_akta_notaris'];
        $data['requests_det']['no_akta_notaris']            = $data['no_akta_notaris'];
        $data['requests_det']['jml_karyawan']       = $data['jml_karyawan'];
        $data['requests_det']['jam_kerja']          = $data['jam_kerja'];
        $data['requests_det']['alamat']             = $data['alamat'];
        $data['requests_det']['jenis_usaha']        = $data['jenis_usaha'];
        $data['requests_det']['keperluan']  = $data['keperluan'];
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
        $data['requests_det']['kewarganegaraan']    = $data['kewarganegaraan'];
        $data['requests_det']['nama_perusahaan']    = $data['nama_perusahaan'];
        $data['requests_det']['notaris']            = $data['notaris'];
        $data['requests_det']['masa_berlaku']            = $data['masa_berlaku'];
        $data['requests_det']['tgl_akta_notaris']            = $data['tgl_akta_notaris'];
        $data['requests_det']['no_akta_notaris']            = $data['no_akta_notaris'];
        $data['requests_det']['jml_karyawan']       = $data['jml_karyawan'];
        $data['requests_det']['jam_kerja']          = $data['jam_kerja'];
        $data['requests_det']['alamat']             = $data['alamat'];
        $data['requests_det']['jenis_usaha']    = $data['jenis_usaha'];
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

}