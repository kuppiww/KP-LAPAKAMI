<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id'           => '0',
            'user_username'		=> '0000000000000000',
            'user_password'     => Hash::make('000000'),
            'user_phone' 		=> '082116660230',
            'user_email' 	    => 'dev@email.com',
            'user_nik'			=> '0000000000000000',
            'user_kk'    		=> '0000000000000000',
            'user_nama'         => '1',
            'user_tmp_lahir'    => 'Cimahi',
            'user_tgl_lahir'    =>  date('Y-m-d H:i:s'),
            'user_alamat'       => 'alamat test',
            'user_is_simkel'    => false,
            'created_at'   => date('Y-m-d H:i:s'),
            'user_is_active'    => true,
            'user_is_comp_profile'   => true,
            'user_email_is_activate' => true,
            'user_email_is_change'   => true
        ]);
    }
}
