<?php

namespace Modules\ReqDomicile\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class DomicileRepository extends QueryBuilderImplementation
{

    protected $fillable = ['kewarganegaraan', 'tgl_permohonan_izin', 'jenis_usaha', 'alamat', 'nama_organisasi', 'jam_kerja', 'status_bangunan', 'peruntukan_bangunan', 'no_imb',
     'no_akta_pendirian', 'tgl_akta_pendirian', 'jumlah_anggota', 'penanggung_jawab', 'keperluan', 'tgl_imb', 'masa_berlaku', 'request_id', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_ket_domiciles';
        $this->pk = 'req_ket_domicile_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['kewarganegaraan']     = $data['kewarganegaraan'];
        $data['requests_det']['tgl_permohonan_izin'] = date('Y-m-d');
        $data['requests_det']['nama_organisasi']     = $data['nama_organisasi'];
        $data['requests_det']['jam_kerja']           = $data['jam_kerja'];
        $data['requests_det']['jumlah_anggota']      = $data['jumlah_anggota'];
        $data['requests_det']['keperluan']           = $data['keperluan'];
        $data['requests_det']['jenis_usaha']         = $data['jenis_usaha'];
        $data['requests_det']['alamat']              = $data['alamat'];
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
        $data['requests_det']['kewarganegaraan']= $data['kewarganegaraan'];
        $data['requests_det']['nama_organisasi']= $data['nama_organisasi'];
        $data['requests_det']['jam_kerja']      = $data['jam_kerja'];
        $data['requests_det']['jumlah_anggota'] = $data['jumlah_anggota'];
        $data['requests_det']['keperluan']      = $data['keperluan'];
        $data['requests_det']['jenis_usaha']    = $data['jenis_usaha'];
        $data['requests_det']['alamat']         = $data['alamat'];
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