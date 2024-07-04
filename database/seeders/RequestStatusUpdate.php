<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RequestStatusUpdate extends Seeder
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
                'request_status_id'     => 'REJECTED_KEC',
                'request_status_name'   => 'Ditolak di Kecamatan’',
                'request_status_color'  => 'danger',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'request_status_id'     => 'APPROVED_KEC',
                'request_status_name'   => 'Permohonan Selesai',
                'request_status_color'  => 'success',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'request_status_id'     => 'EDITED_KEC',
                'request_status_name'   => 'Diperbaharui Kecamatan ',
                'request_status_color'  => 'primary',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'request_status_id'     => 'PROCCESS_KEC',
                'request_status_name'   => 'Pembuatan Dokumen di Kecamatan',
                'request_status_color'  => 'primary',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'req_status_id'     => 'SUBMITED_KEC',
                'req_status_name'   => 'Diajukan ke Kecamatan',
                'req_status_color'  => 'warning',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [   
                'req_status_id'     => 'VERIFIED_KEC',
                'req_status_name'   => 'Verifikasi Berkas di Kecamatan',
                'req_status_color'  => 'primary',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
           
        ]);
    }
}
