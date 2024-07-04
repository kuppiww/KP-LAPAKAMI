<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Services extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'service_id'            => 'REQ_RESIDENT',
                'service_name'          => 'Permintaan Keterangan Penduduk',
                'service_description'   => 'blue',
                'service_description'   => 'service deskripsi',
                'service_icon'          => 'test',
                'created_by'            => '0',
	            'created_at'            => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
