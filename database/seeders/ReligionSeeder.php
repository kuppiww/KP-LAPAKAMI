<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_religion')->insert([
            [
                'id_religion'   => '1',
                'religion'      => 'Islam',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_religion'   => '2',
                'religion'      => 'Protestan',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_religion'   => '3',
                'religion'      => 'Katolik',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_religion'   => '4',
                'religion'      => 'Budha',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_religion'   => '5',
                'religion'      => 'Hindu',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_religion'   => '6',
                'religion'      => 'Konghuchu',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
