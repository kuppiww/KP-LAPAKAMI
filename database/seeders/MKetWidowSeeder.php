<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MKetWidowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_ket_widow')->insert([
            [
                'id_ket'      => '1',
                'ket'         => 'Bercerai',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],[
                'id_ket'      => '2',
                'ket'         => 'Suami Meninggal',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],[
                'id_ket'      => '3',
                'ket'         => 'Istri Meninggal',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            
            
        ]);
    }
}
