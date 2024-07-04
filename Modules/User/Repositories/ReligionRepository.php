<?php

namespace Modules\User\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class ReligionRepository extends QueryBuilderImplementation
{

    protected $fillable = ['id_religion', 'religion', 'created_at', 'created_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'm_religion';
        $this->pk = 'id_religion';
    }
}