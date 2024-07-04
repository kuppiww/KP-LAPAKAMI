<?php

namespace Modules\Request\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Illuminate\Support\Facades\DB;
use Modules\Request\Repositories\RequestAttachmentRepository;
use App\Helpers\DataHelper;
use App\Helpers\QBHelper;



class RequestSqlServerRepository extends QueryBuilderImplementation
{
    // overide
    public function getByParams(array $params)
    {
        $id = $params['id'];
        $table = $params['table_name'];
        $isKec = $params['is_kec'];
        $select = 'file_tte_kel';

        if ($isKec) {
            $select = 'file_tte_kec';
        }

        try {
            QBHelper::setQueryLog('sqlsrv');
            $result = DB::connection('sqlsrv')
                ->table($table)
                ->select('id_surat as request_simkel_id', 'created_at as request_file_date', 'tte_file_kel', 'tte_file_kec', 'm_kelurahan.kelurahan as sub_district', 'm_kecamatan.kecamatan as district')
                ->leftJoin('m_kelurahan', 'm_kelurahan.kd_kel', '=', $table . '.kd_kel')
                ->leftJoin('m_kecamatan', 'm_kecamatan.kd_kec', '=', 'm_kelurahan.kd_kec')
                ->where('id_surat', $id)
                ->first();
            QBHelper::showQueryLog('sqlsrv', false);

            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
