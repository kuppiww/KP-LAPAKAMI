<?php

namespace Modules\User\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class UserRepository extends QueryBuilderImplementation
{

    protected $fillable = [
        'user_username', 'user_password', 'user_phone', 'user_email', 'user_email_token', 'user_nik', 'user_is_comp_profile', 'user_kk', 'user_nama', 'user_id_agama', 'user_tmp_lahir', 'user_tgl_lahir', 'user_email_is_change', 'user_email_is_activate',
        'user_id_jenkel', 'user_pekerjaan', 'user_kewarganegaraan', 'id_merried_status', 'kd_kec', 'kd_kel', 'user_rw', 'user_rt', 'user_alamat', 'user_is_simkel', 'user_id_simkel', 'group_id', 'created_at', 'updated_at' 
    ];

    public function __construct()
    {
        $this->table = 'users';
        $this->pk = 'user_id';
    }

    public function getAllOnlyMasyarakat()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('user_id', 'user_username', 'user_nama', 'user_email', 'user_is_active')
                ->where('group_id', '=', null)
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // public function getAll()
    // {
    //     try {
    //         return DB::connection($this->db)
    //             ->table($this->table)
    //             ->select('*', 'sys_users.user_status')
    //             ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
    //             // ->where('sys_users.group_id', '!=', '1')
    //             ->get();
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function getAllByRole($role)
    // {
    //     try {
    //         return DB::connection($this->db)
    //             ->table($this->table)
    //             ->select('*', 'sys_users.user_status')
    //             ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
    //             ->whereRaw('sys_users.group_id IN ('. $role .')')
    //             ->get();
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    public function getById($id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where($this->pk, '=', $id)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // public function getByUsername($username)
    // {
    //     try {
    //         return DB::connection($this->db)
    //             ->table($this->table)
    //             ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
    //             ->where('user_username', '=', $username)
    //             ->first();
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function getByEmail($email)
    // {
    //     try {
    //         return DB::connection($this->db)
    //             ->table($this->table)
    //             ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
    //             ->where('user_email', '=', $email)
    //             ->first();
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

}