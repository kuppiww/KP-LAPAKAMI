<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class RequestSignLogRepository extends QueryBuilderImplementation
{

    protected $fillable = ['request_id', 'user_id', 'status', 'type_sign', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'requests_sign_logs';
        $this->pk = 'req_tte_log_id';
    }

    // overide
    public function getAllByParams(array $params)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('request_sign_logs.*')
                ->where($params)
                ->orderBy('req_tte_log_id', 'DESC')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}