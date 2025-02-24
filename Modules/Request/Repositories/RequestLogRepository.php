<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class RequestLogRepository extends QueryBuilderImplementation
{

    protected $fillable = ['request_id', 'request_status_id', 'request_log_note', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'request_logs';
        $this->pk = 'request_log_id';
    }

    // overide
    public function getAllByParams(array $params)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('request_logs.*', 'request_status.request_status_name')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'request_logs.request_status_id')
                ->where($params)
                ->where('is_show', 'true')
                ->orderBy('request_log_id', 'DESC')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAllByParamsForAdmin(array $params)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('request_logs.*', 'request_status.request_status_name_backend')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'request_logs.request_status_id')
                ->where($params)
                ->orderBy('request_log_id', 'DESC')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getKonseptor($request_id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('request_logs.*', 'sys_users.user_name')
                ->leftJoin('sys_users', 'sys_users.user_id', '=', 'request_logs.created_by')
                ->where('request_status_id', 'PROCCESS')
                ->where('request_id', $request_id)
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}