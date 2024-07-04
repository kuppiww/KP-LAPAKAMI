<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_districts')->insert([
            [
                'kd_district'   => '01',
                'district'      => 'Cimahi Selatan',
                'kode_district' => '20080023',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'kd_district'   => '02',
                'district'      => 'Cimahi Tengah',
                'kode_district' => '20080022',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'kd_district'   => '03',
                'district'      => 'Cimahi Utara',
                'kode_district' => '20080021',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            
        ]);
    }
}
