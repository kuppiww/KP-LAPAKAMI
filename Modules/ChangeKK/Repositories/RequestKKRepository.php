<?php

namespace Modules\ChangeKK\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class RequestKKRepository extends QueryBuilderImplementation
{

    protected $fillable = ['user_id', 'kk_baru', 'kk_file', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'req_change_kks';
        $this->pk = 'user_id';
    }

    //overide
    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->select($this->table.'.*', 'users.user_nik', 'users.user_nama')
                ->leftjoin('users', 'users.user_id', '=', 'req_change_kks.user_id')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}