<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RequestStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('request_status')->insert([
            [
                'request_status_id'     => 'SUBMITED',
                'request_status_name'   => 'Di Ajukan',
                'request_status_color'  => 'blue',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'request_status_id'     => 'VERIFY ',
                'request_status_name'   => 'Verifikasi berkas',
                'request_status_color'  => 'blue',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'request_status_id'     => 'PROCCESS  ',
                'request_status_name'   => 'Proses Pembuatan',
                'request_status_color'  => 'blue',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'request_status_id'     => 'REJECT ',
                'request_status_name'   => 'Ditolak',
                'request_status_color'  => 'blue',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'req_status_id'     => 'APPROVED',
                'req_status_name'   => 'Selesai',
                'req_status_color'  => 'blue',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
           
        ]);
    }
}
