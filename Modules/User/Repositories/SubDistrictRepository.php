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


    public function getAllByParams($params)
    {
        $query = DB::table('m_sub_districts');

        if (!empty($params['kd_district'])) {
            $query->where('kd_district', $params['kd_district']);
        }

        return $query->get();
    }
}
