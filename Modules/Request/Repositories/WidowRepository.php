<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;
use Modules\Request\Repositories\RequestAttachmentRepository;
use App\Helpers\DataHelper;


class WidowRepository extends QueryBuilderImplementation
{

    protected $fillable = ['ket', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'm_ket_widow';
        $this->pk = 'id_ket';
        $this->_requestAttachmentRepository     = new RequestAttachmentRepository;

    }
}