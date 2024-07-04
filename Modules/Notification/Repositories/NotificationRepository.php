<?php

namespace Modules\Notification\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;

class NotificationRepository extends QueryBuilderImplementation
{

    protected $fillable = ['request_id', 'request_status_id', 'notification_note', 'notification_is_read', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'notifications';
        $this->pk = 'notification_id';
    }

    // overide
    public function getAllByParamsPage(array $params, $page ='')
    {
        try {
            $query = DB::connection($this->db)
                ->table($this->table)
                ->select('notifications.*', 'request_status.request_status_name', 'request_status.request_status_color', 'services.service_name')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'notifications.request_status_id')
                ->leftJoin('requests', 'requests.request_id', '=', 'notifications.request_id')
                ->rightJoin('services', 'services.service_id' , '=', 'requests.service_id')
                ->where($params)
                ->orderBy('notifications.created_at', 'DESC');
                
            if (!empty($page['start'])) {
                $query->offset($page['start']);
            }

            if (!empty($page['limit'])) {
                $query->limit($page['limit']);
            }

            return $query->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // overide
    public function getById($id)
    {
        try {
            $query = DB::connection($this->db)
                ->table($this->table)
                ->select('notifications.*', 'request_status.request_status_name', 'request_status.request_status_color', 'services.service_name', 'services.service_id')
                ->leftJoin('request_status', 'request_status.request_status_id', '=', 'notifications.request_status_id')
                ->leftJoin('requests', 'requests.request_id', '=', 'notifications.request_id')
                ->rightJoin('services', 'services.service_id' , '=', 'requests.service_id')
                ->where('notifications.notification_id', $id);

            return $query->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}