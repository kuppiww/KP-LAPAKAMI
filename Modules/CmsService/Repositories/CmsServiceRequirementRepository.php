<?php

namespace Modules\CmsService\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class CmsServiceRequirementRepository extends QueryBuilderImplementation
{

    public $fillable = ['service_requirement_id', 'service_requirement_name', 'example_file', 'is_required', 'service_id', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'service_requirements';
        $this->pk = 'service_requirement_id';
    }

}