<?php

namespace Modules\ReqDivorced\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class DivorcedRepository extends QueryBuilderImplementation
{

    protected $fillable = ['perihal', 'id_status_janda', 'id_ket', 'request_id', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_ket_widow';
        $this->pk = 'req_ket_widow_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['id_status_janda'] = $data['id_status_janda'];
        $data['requests_det']['id_ket']          = $data['id_ket'];
        $data['requests_det']['perihal']         = $data['perihal'];
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
        $data['requests_det']['id_status_janda'] = $data['id_status_janda'];
        $data['requests_det']['id_ket']          = $data['id_ket'];
        $data['requests_det']['perihal']         = $data['perihal'];
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
                ->select('req_ket_widow.*', 'm_widow_status.widow_status', 'm_ket_widow.ket')
                ->join('m_widow_status', 'm_widow_status.id_widow_status', '=', 'req_ket_widow.id_status_janda')
                ->join('m_ket_widow', 'm_ket_widow.id_ket', '=', 'req_ket_widow.id_ket')
                ->where($params)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}