<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class ServiceSettingsRepository extends QueryBuilderImplementation
{

    protected $fillable = ['service_setting_id', 'service_id', 'kd_kel', 'kd_kec', 'role_setting', 'created_at', 'created_by', 'updated_at', 'updated_by', 'role_setting_ttd', 'role_setting_ttd_kec', 'role_setting_is_complete'];

    public function __construct()
    {
        $this->table = 'service_settings';
        $this->pk = 'service_setting_id';
    }

    public function getByServiceId($params)
    {

        try {

            return DB::table($this->table)
                // ->select($this->table.'.*', 'ttd_kel.nama as nama_ttd_kel', 'ttd_kel.jabatan as jabatan_ttd_kel', 'ttd_kec.nama as nama_ttd_kec', 'ttd_kec.jabatan as jabatan_ttd_kec' )
                // ->leftjoin('pegawai as ttd_kel', 'ttd_kel.nip', $this->table.'.role_setting_ttd')
                // ->leftjoin('pegawai as ttd_kec', 'ttd_kec.nip', $this->table.'.role_setting_ttd_kec')
                ->where($params)
                ->first();

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}