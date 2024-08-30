<?php

namespace Modules\ReqSktm\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class SktmHealthRepository extends QueryBuilderImplementation
{

    protected $fillable = ['nama_pasien', 'tmp_lahir_pasien', 'tgl_lahir_pasien', 'id_hub_kel', 'peruntukan', 'id_rumkit', 'no_jamkesmas', 'no_kip', 'peruntukan', 'request_id', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_sktm_healths';
        $this->pk = 'req_sktm_health_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['nama_pasien'] = $data['nama_pasien'];
        $data['requests_det']['tmp_lahir_pasien'] = $data['tmp_lahir_pasien'];
        $data['requests_det']['tgl_lahir_pasien'] = $data['tgl_lahir_pasien'];
        $data['requests_det']['id_hub_kel'] = $data['id_hub_kel'];
        $data['requests_det']['id_rumkit'] = $data['id_rumkit'];
        $data['requests_det']['no_jamkesmas'] = !is_null($data['no_jamkesmas']) && $data['no_jamkesmas'] != '' ? $data['no_jamkesmas'] : null;
        if (isset($data['requests_det']['no_kip'])) {
            $data['requests_det']['no_kip'] = !is_null($data['no_kip']) && $data['no_kip'] != '' ? $data['no_kip'] : null;
        }
        $data['requests_det']['peruntukan'] = !empty($data['peruntukan']) ? true : false;
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
        $data['requests_det']['nama_pasien'] = $data['nama_pasien'];
        $data['requests_det']['tmp_lahir_pasien'] = $data['tmp_lahir_pasien'];
        $data['requests_det']['tgl_lahir_pasien'] = $data['tgl_lahir_pasien'];
        $data['requests_det']['id_rumkit'] = $data['id_rumkit'];
        $data['requests_det']['id_hub_kel'] = $data['id_hub_kel'];
        $data['requests_det']['no_jamkesmas'] = isset($data['no_jamkesmas']) ? $data['no_jamkesmas'] : null;
        if (isset($data['requests_det']['no_kip'])) {
            $data['requests_det']['no_kip'] = !is_null($data['no_kip']) && $data['no_kip'] != '' ? $data['no_kip'] : null;
        }
        $data['requests_det']['peruntukan'] = !empty($data['peruntukan']) ? true : false;
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

    public function updatePermohonan(array $data, $id)
    {
        $data['requests_det']['nama_pasien'] = $data['nama_pasien'];
        $data['requests_det']['tmp_lahir_pasien'] = $data['tmp_lahir_pasien'];
        $data['requests_det']['tgl_lahir_pasien'] = $data['tgl_lahir_pasien'];
        $data['requests_det']['id_rumkit'] = $data['id_rumkit'];
        $data['requests_det']['id_hub_kel'] = $data['id_hub_kel'];
        $data['requests_det']['no_jamkesmas'] = isset($data['no_jamkesmas']) ? $data['no_jamkesmas'] : null;
        if (isset($data['requests_det']['no_kip'])) {
            $data['requests_det']['no_kip'] = !is_null($data['no_kip']) && $data['no_kip'] != '' ? $data['no_kip'] : null;
        }
        $data['requests_det']['peruntukan'] = !empty($data['peruntukan']) ? true : false;
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
                ->select('req_sktm_healths.*', 'name', 'nama_hub')
                ->leftJoin('m_fam_relation', 'm_fam_relation.id_hub', '=', 'req_sktm_healths.id_hub_kel')
                ->join('m_hospitals', 'm_hospitals.id_hospital', '=', 'req_sktm_healths.id_rumkit')
                ->where($params)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateNoSurat(array $data, $id)
    {
        $data['requests']['no_surat'] = $data['no_surat'];
        $data['requests']['tgl_surat'] = $data['tgl_surat'];
        $data['requests']['masa_berlaku'] = $data['masa_berlaku'];
        $data['requests']['updated_at'] = $data['updated_at'];
        $data['requests']['updated_by'] = $data['updated_by'];

        try {
            DB::beginTransaction();
            DB::table($this->table)->where('request_id', '=', $id)->update($data['requests']);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function updateData(array $data, $id)
    {
        try {
            DB::beginTransaction();
            DB::table($this->table)->where('request_id', '=', $id)->update($data);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function getLastNoSurat($year, $kodeKelurahan)
    {
        $result = DB::connection($this->db)
            ->table($this->table)
            ->select($this->table.'.*', 'requests.kd_kel')
            ->join('requests', 'requests.request_id', $this->table.'.request_id')
            ->where('requests.kd_kel', $kodeKelurahan)
            ->whereYear($this->table.'.tgl_surat', $year)
            ->orderBy($this->pk, 'DESC')
            ->pluck($this->table.'.no_surat')
            ->first();
        return $result;
    }
}