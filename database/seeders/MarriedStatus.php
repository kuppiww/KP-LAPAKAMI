<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MarriedStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_merried_status')->insert([
            [
                'id_merried_status' => '1',
                'merried_status'    => 'Belum Kawin',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'id_merried_status' => '2',
                'merried_status'    => 'Kawin',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'id_merried_status' => '3',
                'merried_status'    => 'Cerai Hidup',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'id_merried_status' => '4',
                'merried_status'    => 'Cerai Mati',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
