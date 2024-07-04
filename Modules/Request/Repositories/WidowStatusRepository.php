<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;
use Modules\Request\Repositories\RequestAttachmentRepository;
use App\Helpers\DataHelper;


class WidowStatusRepository extends QueryBuilderImplementation
{

    protected $fillable = ['id_widow_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'm_widow_status';
        $this->pk = 'id_widow_status';

    }
}