<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class ServiceRepository extends QueryBuilderImplementation
{

    protected $fillable = ['service_id', 'service_name', 'simkel_table', 'service_description', 'service_icon', 'service_is_kec', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'services';
        $this->pk = 'service_id';
    }

    public function getRequirementSample($params)
    {

        try {

            return DB::table('service_requirements')
                ->where($params)
                ->whereNotNull('example_file')
                ->get();

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}