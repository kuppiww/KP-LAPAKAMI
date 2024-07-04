<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MWidowStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_widow_status')->insert([
            [
                'id_widow_status'      => '1',
                'widow_status'         => 'Janda',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            [
                'id_widow_status'      => '2',
                'widow_status'         => 'Duda',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],
            
            
        ]);
    }
}
