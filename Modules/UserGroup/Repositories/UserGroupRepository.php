<?php

namespace Modules\UserGroup\Repositories;

use App\Implementations\QueryBuilderImplementation;
use DB;

class UserGroupRepository extends QueryBuilderImplementation
{

	public $fillable = ['group_name', 'group_id'];

    public function __construct()
    {
        $this->table = 'sys_user_groups';
        $this->pk = 'group_id';
    }

    //overide 
    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}