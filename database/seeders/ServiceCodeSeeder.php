<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'REQ_ANDON'         => ['service_code' => 'EGP'],
            'REQ_BIRTH'         => ['service_code' => 'C6C'],
            'REQ_BUSINESS'      => ['service_code' => 'T4G'],
            'REQ_COMPANY'       => ['service_code' => 'F61'],
            'REQ_CROWD'         => ['service_code' => 'WIE'],
            'REQ_DEATH'         => ['service_code' => 'BDU'],
            'REQ_DIVORCED'      => ['service_code' => 'PD2'],
            'REQ_DOMICILE'      => ['service_code' => 'UFG'],
            'REQ_HAJJ'          => ['service_code' => 'H5Z'],
            'REQ_HOUSE'         => ['service_code' => 'AIU'],
            'REQ_MERRIED'       => ['service_code' => 'SJX'],
            'REQ_MOVE'          => ['service_code' => 'DNB'],
            'REQ_RESIDENT'      => ['service_code' => '0KP'],
            'REQ_SKCK'          => ['service_code' => '9R8'],
            'REQ_SKTM_EDUCATION'=> ['service_code' => 'SIU'],
            'REQ_SKTM_HEALTH'   => ['service_code' => 'HES'],
            'REQ_SKTM_JUDICIARY'=> ['service_code' => 'APQ'],
            'REQ_SKTM_PLN'      => ['service_code' => 'RFJ'],
            'REQ_SKTM'          => ['service_code' => 'TLM'],
            'ELEMENT'           => ['service_code' => 'UHO'],
            'FAMILY'            => ['service_code' => 'YND'],
            'REQ_CLEAN'         => ['service_code' => '3DG'],
            'RETIRED'           => ['service_code' => 'BZP'],
            'IDCARD'            => ['service_code' => 'S59'],
            'INHERITANCE'       => ['service_code' => '1AJ'],
            'RESPONSIBILITY'    => ['service_code' => 'LHG'],
            'KIPEM'             => ['service_code' => 'JKG'],
            'KITAS'             => ['service_code' => 'KV4'],
            'SOLDIER'           => ['service_code' => 'A0J'],
            'LEGAL'             => ['service_code' => 'WLM']
        ];

        foreach ($services as $key => $s) {

            $getService = DB::table('services')->where('service_id', $key)->first();

            if($getService){
                DB::table('services')->where('service_id', $key)->update($s);
            }

        }
    }
}
