<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;
use Modules\Request\Repositories\RequestAttachmentRepository;
use App\Helpers\DataHelper;


class HospitalRepository extends QueryBuilderImplementation
{

    protected $fillable = ['name', 'address', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'm_hospitals';
        $this->pk = 'id_hospital';
        $this->_requestAttachmentRepository     = new RequestAttachmentRepository;

    }
}