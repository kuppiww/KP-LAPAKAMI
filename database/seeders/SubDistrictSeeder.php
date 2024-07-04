<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_sub_districts')->insert([
            [
                'kd_sub_district'   => '01',
                'sub_district'      => 'Melong',
                'unit_key'          => '126_',
                'kd_district'       => '01',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '02',
                'sub_district'      => 'Cibeureum',
                'unit_key'          => '127_',
                'kd_district'       => '01',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '03',
                'sub_district'      => 'Cibeber',
                'unit_key'          => '128_',
                'kd_district'       => '01',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '04',
                'sub_district'      => 'Leuwigajah',
                'unit_key'          => '129_',
                'kd_district'       => '01',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '05',
                'sub_district'      => 'Utama',
                'unit_key'          => '130_',
                'kd_district'       => '01',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '06',
                'sub_district'      => 'Baros',
                'unit_key'          => '124_',
                'kd_district'       => '02',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '07',
                'sub_district'      => 'Setiamanah',
                'unit_key'          => '122_',
                'kd_district'       => '02',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '08',
                'sub_district'      => 'Padasuka',
                'unit_key'          => '120_',
                'kd_district'       => '02',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '09',
                'sub_district'      => 'Karangmekar',
                'unit_key'          => '123_',
                'kd_district'       => '02',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '10',
                'sub_district'      => 'Cimahi',
                'kd_district'       => '02',
                'unit_key'          => '121_',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '11',
                'sub_district'      => 'Cigugur Tengah',
                'kd_district'       => '02',
                'unit_key'          => '125_',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '12',
                'sub_district'      => 'Cibabat',
                'kd_district'       => '03',
                'unit_key'          => '119_',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '13',
                'sub_district'      => 'Citeureup',
                'kd_district'       => '03',
                'unit_key'          => '117_',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '14',
                'sub_district'      => 'Cipageran',
                'kd_district'       => '03',
                'unit_key'          => '116_',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'kd_sub_district'   => '15',
                'sub_district'      => 'Pasirkaliki',
                'kd_district'       => '03',
                'unit_key'          => '118_',
                'created_by'        => '0',
	            'created_at'        => date('Y-m-d H:i:s')
            ],
           
        ]);
    }
}
