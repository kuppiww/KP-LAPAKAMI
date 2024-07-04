<?php

namespace Modules\User\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class SubDistrictRepository extends QueryBuilderImplementation
{

    protected $fillable = ['kd_sub_district', 'sub_district', 'kd_district', 'unit_key', 'created_at', 'created_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'm_sub_districts';
        $this->pk = 'kd_sub_district';
    }

    //overide
    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select('m_sub_districts.*', 'm_districts.district')
                ->join('m_districts', 'm_districts.kd_district', '=', 'm_sub_districts.kd_district')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}