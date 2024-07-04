<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class KetIncapableRepository extends QueryBuilderImplementation
{

    protected $fillable = ['ket', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'm_ket_incapable';
        $this->pk = 'id_ket';
    }

}