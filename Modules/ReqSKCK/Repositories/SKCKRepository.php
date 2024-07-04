<?php

namespace Modules\ReqSKCK\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class SKCKRepository extends QueryBuilderImplementation
{

    protected $fillable = ['keperluan', 'request_id', 'created_at', 'created_by', 'updated_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'req_ket_skck';
        $this->pk = 'req_ket_skck_id';
    }

    //overide
    public function insert(array $data)
    {
        $data['requests_det']['keperluan'] = $data['keperluan'];
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
        $data['requests_det']['keperluan']  = $data['keperluan'];
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

}