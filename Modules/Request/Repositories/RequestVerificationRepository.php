<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestVerificationRepository extends QueryBuilderImplementation
{

    protected $fillable = ['req_verification_id', 'request_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'user_id_kec', 'user_id', 'verification_number'];

    public function __construct()
    {
        $this->table = 'requests_verifications';
        $this->pk = 'req_verification_id';
    }

    public function updateStatus(array $data, $id)
    {
        $data['requests']['status'] = $data['status'];
        $data['requests']['updated_at'] = date('Y-m-d h:i:s');
        $data['requests']['updated_by'] = $data['updated_by'];

        try {
            DB::beginTransaction();
            DB::table($this->table)->where('req_verification_id', '=', $id)->update($data['requests']);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function getByParams($params)
    {

        try {

            return DB::table($this->table)
                ->select($this->table.'.*', 'sign_status.sign_status_name', 'sign_status.sign_status_color', 'sys_users.is_kecamatan_employee', 'pegawai.nama', 'pegawai.jabatan', 'pegawai.nip', 'm_sub_districts.sub_district as unit_kel', 'm_districts.district as unit_kec')
                ->leftjoin('sys_users', 'sys_users.user_id', $this->table.'.user_id')
                ->leftjoin('sign_status', 'sign_status.sign_status_id', $this->table.'.status')
                ->leftjoin('m_sub_districts', 'm_sub_districts.kd_sub_district', 'sys_users.kd_kel')
                ->leftjoin('m_districts', 'm_districts.kd_district', 'sys_users.kd_kec')
                ->leftjoin('pegawai', 'pegawai.nip', 'sys_users.user_nip')
                ->where($params)
                ->orderBy($this->table.'.verification_number', 'ASC')
                ->get();

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getIsVerifikator($params)
    {
        try {
            $data = DB::table($this->table)
                ->select($this->table.'.*', 'sign_status.sign_status_name', 'sign_status.sign_status_color', 'sys_users.is_kecamatan_employee', 'pegawai.nama', 'pegawai.jabatan', 'pegawai.nip', 'm_sub_districts.sub_district as unit_kel', 'm_districts.district as unit_kec')
                ->leftjoin('sys_users', 'sys_users.user_id', $this->table.'.user_id')
                ->leftjoin('sign_status', 'sign_status.sign_status_id', $this->table.'.status')
                ->leftjoin('m_sub_districts', 'm_sub_districts.kd_sub_district', 'sys_users.kd_kel')
                ->leftjoin('m_districts', 'm_districts.kd_district', 'sys_users.kd_kec')
                ->leftjoin('pegawai', 'pegawai.nip', 'sys_users.user_nip')
                ->where($params)
                ->orderBy($this->table.'.verification_number', 'ASC')
                ->first();

            if ($data->status == 'ACCEPTED') {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getLastID($jenis, $request_id)
    {
        $user = Auth::guard('admin')->user();
        if ($jenis == 'kel') {
            $where[] = ['kd_kel', $user->kd_kel];
            $where[] = ['group_id', 'pkelurahan'];
        } else {
            $where[] = ['kd_kec', $user->kd_kec];
            $where[] = ['group_id', 'pkecamatan'];
        }

        // cek kandidat verifikator siapa aja ambil user_id
        $existing = DB::table('sys_users')
            ->where($where)
            ->get();
        
        foreach ($existing as $key => $exis) {
            $dataVerifikatorExis[] = $exis->user_id;
        }
        
        // get data berdasarkan user_id, ambil verification_number, order verification_number DESC first()
        $getLastNumberId = DB::table($this->table)
            ->select('verification_number')
            ->whereIn('user_id', $dataVerifikatorExis)
            ->where('request_id', $request_id)
            ->orderBy('verification_number', 'DESC')
            ->first();
        return $getLastNumberId->verification_number+1;
        // dd($jenis, $request_id, $existing, $dataVerifikatorExis, $getLastNumberId->verification_number);
    }

    public function getAllByParamsAdmin(array $params, $group, $is_peg_kec, $datakel)
    {
        try {
            $sql = DB::connection($this->db)
                ->table($this->table)
                ->select(
                    'requests.*',
                    'services.service_name',
                    'request_status.request_status_name_backend as request_status_name',
                    'request_status.request_status_color as request_status_color'
                )
                ->leftJoin('requests', 'requests.request_id', $this->table.'.request_id')
                ->leftJoin('services', 'services.service_id', '=', 'requests.service_id')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'requests.request_status_id');
            if ($params != array()) {
                $sql->where($params);
            }
            // if ($is_peg_kec) {
            //     $sql->whereIn('requests.request_status_id', ['SUBMITED_KEC', 'VERIFIED_KEC', 'PROCCESS_KEC', 'VERIFICATION_KEC']);
            //     $sql->whereIn('requests.kd_kel', $datakel);
            // }
            // if ($group == 'pkelurahan') {
            //     $sql->whereNotIn('requests.request_status_id', ['SUBMITED']);
            // }
            $result = $sql->orderBy('created_at', 'desc')->get();

            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}