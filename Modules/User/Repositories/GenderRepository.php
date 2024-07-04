<?php

namespace Modules\User\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class GenderRepository extends QueryBuilderImplementation
{

    protected $fillable = ['id_gender', 'gender', 'created_at', 'created_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'm_gender';
        $this->pk = 'id_gender';
    }
}