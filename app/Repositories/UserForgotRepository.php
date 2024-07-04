<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Implementations\QueryBuilderImplementation;

class UserForgotRepository extends QueryBuilderImplementation
{

    public $fillable = ['forgot_id', 'user_id', 'forgot_status', 'forgot_expired', 'created_at', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'user_forgots';
        $this->pk = 'forgot_id';
    }

    public function updateData(array $data, $id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where($this->pk, '=', $id)
                ->update($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}