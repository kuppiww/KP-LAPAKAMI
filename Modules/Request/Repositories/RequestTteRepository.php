<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class RequestTteRepository extends QueryBuilderImplementation
{

    protected $fillable = ['req_tte_id', 'request_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'user_id_kec', 'user_id', 'tte_number'];

    public function __construct()
    {
        $this->table = 'requests_ttes';
        $this->pk = 'req_tte_id';
    }

    public function getByParams($params)
    {

        try {

            return DB::table($this->table)
                ->select($this->table.'.*', 'sign_status.sign_status_name', 'sign_status.sign_status_color', 'sys_users.is_kecamatan_employee', 'pegawai.nama', 'pegawai.jabatan', 'm_sub_districts.sub_district as unit_kel', 'm_districts.district as unit_kec')
                ->leftjoin('sys_users', 'sys_users.user_id', $this->table.'.user_id')
                ->leftjoin('m_sub_districts', 'm_sub_districts.kd_sub_district', 'sys_users.kd_kel')
                ->leftjoin('m_districts', 'm_districts.kd_district', 'sys_users.kd_kec')
                ->leftjoin('pegawai', 'pegawai.nip', 'sys_users.user_nip')
                ->leftjoin('sign_status', 'sign_status.sign_status_id', $this->table.'.status')
                ->where($params)
                ->get();

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}