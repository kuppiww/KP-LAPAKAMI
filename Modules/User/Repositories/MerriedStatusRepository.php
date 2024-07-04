<?php

namespace Modules\User\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class MerriedStatusRepository extends QueryBuilderImplementation
{

    protected $fillable = ['id_merried_status', 'merried_status', 'created_at', 'created_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'm_merried_status';
        $this->pk = 'id_merried_status';
    }
}