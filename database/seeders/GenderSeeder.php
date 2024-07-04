<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_gender')->insert([
            [
                'id_gender'   => '0',
                'gender'      => 'Perempuan',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_gender'   => '1',
                'gender'      => 'Laki-laki',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
