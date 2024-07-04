<?php

namespace Modules\CmsService\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class CmsServiceRepository extends QueryBuilderImplementation
{

    public $fillable = ['service_id', 'service_name', 'service_icon', 'service_link', 'slug', 'service_description', 'position', 'service_is_kec', 'is_select', 'is_online', 'service_code', 'is_active', 'is_show_front', 'slug_simkel', 'service_name_simkel', 'simkel_table', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'services';
        $this->pk = 'service_id';
    }

}