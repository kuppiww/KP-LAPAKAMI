<?php

namespace Modules\Users\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class SysUsersRepository extends QueryBuilderImplementation
{

    public $fillable = ['user_username', 'user_name', 'user_email', 'user_phone', 'user_nip', 'kd_kel', 'user_password', 'user_phone', 'group_id', 'is_active', 'created_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'sys_users';
        $this->pk = 'user_id';
    }

    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getById($id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
                ->where($this->pk, '=', $id)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getByNIP($nip)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
                ->where('user_username', '=', $nip)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    } 

}