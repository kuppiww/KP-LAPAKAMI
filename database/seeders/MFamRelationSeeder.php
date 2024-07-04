<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MFamRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_fam_relation')->insert([
            [
                'id_hub'      => '1',
                'nama_hub'    => 'Kepala Keluarga',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '2',
                'nama_hub'         => 'Suami',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '3',
                'nama_hub'         => 'Istri',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '4',
                'nama_hub'         => 'Anak',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '5',
                'nama_hub'         => 'Menantu',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '6',
                'nama_hub'         => 'CUcu',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '7',
                'nama_hub'         => 'Orang Tua',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '8',
                'nama_hub'         => 'Mertua',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '9',
                'nama_hub'         => 'Famili Lain',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '10',
                'nama_hub'         => 'Pembantu',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '11',
                'nama_hub'         => 'Lainnya',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '12',
                'nama_hub'         => 'Kakak',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '13',
                'nama_hub'         => 'Adik',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
            [
                'id_hub'      => '14',
                'nama_hub'         => 'Keponakan',
                'created_by'  => '0',
	            'created_at'  => date('Y-m-d H:i:s')
            ],         
        ]);
    }
}
