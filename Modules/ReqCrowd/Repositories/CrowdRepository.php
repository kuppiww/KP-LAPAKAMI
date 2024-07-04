<?php

namespace Modules\ReqCrowd\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class CrowdRepository extends QueryBuilderImplementation
{

    protected $fillable = ['hari_kegiatan', 'tgl_kegiatan', 'tgl_kegiatan_akhir', 'waktu_akhir', 'waktu', 'kegiatan', 'masa_berlaku', 'tgl_surat_pernyataan', 'request_id', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_ket_crowds';
        $this->pk = 'req_ket_crowd_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['hari_kegiatan']        = '';
        $data['requests_det']['tgl_kegiatan']         = $data['tgl_kegiatan'];
        if (isset($data['waktu_akhir'])) {
            $data['requests_det']['waktu_akhir']       = !is_null ($data['waktu_akhir']) && $data['waktu_akhir'] != '' ? $data['waktu_akhir'] : null;
        }
        if (isset($data['tgl_kegiatan_akhir'])) {
            $data['requests_det']['tgl_kegiatan_akhir']       = !is_null ($data['tgl_kegiatan_akhir']) && $data['tgl_kegiatan_akhir'] != '' ? $data['tgl_kegiatan_akhir'] : null;
        }
        $data['requests_det']['waktu']                = $data['waktu'];
        $data['requests_det']['kegiatan']             = $data['kegiatan'];
        $data['requests_det']['request_id']           = $data['request_id'];
        $data['requests_det']['created_at']           = $data['created_at'];
        $data['requests_det']['created_by']           = $data['created_by'];

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
        $data['requests_det']['hari_kegiatan']        = '';
        $data['requests_det']['tgl_kegiatan']         = $data['tgl_kegiatan'];
        if (isset($data['waktu_akhir'])) {
            $data['requests_det']['waktu_akhir']       = !is_null ($data['waktu_akhir']) && $data['waktu_akhir'] != '' ? $data['waktu_akhir'] : null;
        }
        if (isset($data['tgl_kegiatan_akhir'])) {
            $data['requests_det']['tgl_kegiatan_akhir']       = !is_null ($data['tgl_kegiatan_akhir']) && $data['tgl_kegiatan_akhir'] != '' ? $data['tgl_kegiatan_akhir'] : null;
        }
        $data['requests_det']['waktu']                = $data['waktu'];
        $data['requests_det']['kegiatan']             = $data['kegiatan'];
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

    
}