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
        $this->pk = 'kd_sub_district';
    }
}