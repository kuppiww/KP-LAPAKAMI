<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class RequestAttachmentRepository extends QueryBuilderImplementation
{

    protected $fillable = ['request_attachment_id', 'request_id', 'request_attachment_file', 'request_attachment_note', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'request_attachments';
        $this->pk = 'request_attachment_id';
    }

}