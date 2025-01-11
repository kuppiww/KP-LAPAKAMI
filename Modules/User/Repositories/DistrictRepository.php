<?php

namespace Modules\User\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class DistrictRepository extends QueryBuilderImplementation
{

    protected $fillable = ['kd_district', 'district', 'kode_district', 'created_at', 'created_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'm_districts';
        $this->pk = 'kd_district';
    }

    public function getAllByParams($params)
    {
        try {

            $query = DB::table($this->table);


            foreach ($params as $key => $value) {
                $query->where($key, $value);
            }


            return $query->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
