<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MIncapableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_ket_incapable')->insert([
            [
                'id_ket'      => '3',
                'ket'         => 'Keringanan Biaya Pendidikan',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_ket'      => '4',
                'ket'         => 'Beasiswa Sekolah',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_ket'      => '5',
                'ket'         => 'Pengambilan Izajah Sekolah',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_ket'      => '6',
                'ket'         => 'Bantuan Walikota',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            
        ]);
    }
}
