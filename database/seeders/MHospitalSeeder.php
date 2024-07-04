<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MHospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_hospitals')->insert([
            [
                'id_hospital' => '1',
                'name'        => 'RSUD Cibabat Cimahi',
                'address'     => 'Cimahi',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '2',
                'name'        => 'Rumah Sakit Mitra Kasih Cimahi',
                'address'     => 'Cimahi',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '3',
                'name'        => 'Rumah Sakit Mitra Anugrah Lestari',
                'address'     => 'Cimahi',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '4',
                'name'        => 'Rumah Sakit Jiwa Provisi Jawabarat',
                'address'     => 'Cimahi',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '5',
                'name'        => 'Rumah Sakit Paru Rotinsulu Bandung ',
                'address'     => 'Bandung',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '6',
                'name'        => 'Rumah Sakit Khusus Ginjal Ny. R.A. Habibie',
                'address'     => 'Bandung',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '7',
                'name'        => 'Rumah Sakit Mata Cicendo',
                'address'     => 'Bandung',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '8',
                'name'        => 'RSUP Hasan Sadikin',
                'address'     => 'Bandung',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '19',
                'name'        => 'Rumah Sakit Dustira',
                'address'     => 'Cimahi',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '10',
                'name'        => 'Rumah Sakit',
                'address'     => '-',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '11',
                'name'        => 'Puskesmas',
                'address'     => '-',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_hospital' => '12',
                'name'        => 'Lainnya',
                'address'     => '-',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
           
        ]);
    }
}
