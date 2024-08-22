<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class PegawaiRepository extends QueryBuilderImplementation
{

    protected $fillable = ['nip', 'nama', 'gol', 'jabatan', 'kode_jab', 'photo', 'unit_key', 'status', 'nama_singkat'];

    public function __construct()
    {
        $this->table = 'pegawai';
        $this->pk = 'nip';
    }

    public function getWherInByParam($params)
    {
        try {
            return DB::table($this->table)
                ->select($this->table.'.*', 'm_sub_districts.sub_district as unit_kel')
                ->leftjoin('m_sub_districts', 'm_sub_districts.unit_key', $this->table.'.unit_key')
                ->whereIn($this->table.'.nip', $params)
                ->get();

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}