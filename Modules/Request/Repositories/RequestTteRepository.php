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
        // $field = 'user_id';
        // if ($is_kec) {
        //     $field = 'user_id_kec';
        // }
        try {

            return DB::table($this->table)
                ->select($this->table.'.*', 'sign_status.sign_status_name_tte', 'sign_status.sign_status_color', 'sys_users.is_kecamatan_employee', 'pegawai.nama', 'pegawai.jabatan', 'pegawai.nip', 'm_sub_districts.sub_district as unit_kel', 'm_districts.district as unit_kec')
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

    public function getRequest($params)
    {
        // $field = 'user_id';
        // if ($is_kec) {
        //     $field = 'user_id_kec';
        // }
        try {

            return DB::table($this->table)
                ->select($this->table.'.req_tte_id', 'requests.*', 'services.service_name',
                    'request_status.request_status_name as request_status_name',
                    'request_status.request_status_color as request_status_color'
                    // 'sign_status.sign_status_name_alias',
                    // 'sign_status.sign_status_color',
                    // 'sys_users.is_kecamatan_employee',
                    // 'pegawai.nama',
                    // 'pegawai.jabatan',
                    // 'pegawai.nip',
                    // 'm_sub_districts.sub_district as unit_kel',
                    // 'm_districts.district as unit_kec'
                )
                // ->leftjoin('sys_users', 'sys_users.user_id', $this->table.'.user_id')
                // ->leftjoin('m_sub_districts', 'm_sub_districts.kd_sub_district', 'sys_users.kd_kel')
                // ->leftjoin('m_districts', 'm_districts.kd_district', 'sys_users.kd_kec')
                // ->leftjoin('pegawai', 'pegawai.nip', 'sys_users.user_nip')
                // ->leftjoin('sign_status', 'sign_status.sign_status_id', $this->table.'.status')
                ->leftjoin('requests', 'requests.request_id', $this->table.'.request_id')
                ->leftJoin('services', 'services.service_id', '=', 'requests.service_id')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'requests.request_status_id')
                ->where($params)
                // ->whereIn('requests.request_status_id', ['VERIFICATION_KEL', 'TTE_KEL'])
                ->get();

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateStatus($data, $id)
    {
        $data['requests']['status'] = $data['status'];
        $data['requests']['updated_at'] = date('Y-m-d h:i:s');
        $data['requests']['updated_by'] = $data['updated_by'];

        try {
            DB::beginTransaction();
            DB::table($this->table)->where('req_tte_id', '=', $id)->update($data['requests']);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function updateStatusByUser($data, $req_id, $user_id)
    {
        $data['requests']['status'] = $data['status'];
        $data['requests']['updated_at'] = date('Y-m-d h:i:s');
        $data['requests']['updated_by'] = $data['updated_by'];

        try {
            DB::beginTransaction();
            DB::table($this->table)->where('request_id', '=', $req_id)->where('user_id', '=', $user_id)->update($data['requests']);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

}