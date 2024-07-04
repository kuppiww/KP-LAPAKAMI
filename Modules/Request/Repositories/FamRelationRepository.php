<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class FamRelationRepository extends QueryBuilderImplementation
{

    protected $fillable = ['nama_hub', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'm_fam_relation';
        $this->pk = 'id_hub';
    }

}