<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class SignStatusRepository extends QueryBuilderImplementation
{

    protected $fillable = ['sign_status_id', 'sign_status_name', 'sign_status_color', 'sign_status_number', 'is_show', 'sign_status_name_alias', 'sign_status_color_alias', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'sign_status';
        $this->pk = 'sign_status_id';
    }


}