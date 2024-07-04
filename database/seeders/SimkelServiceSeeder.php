<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimkelServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'REQ_ANDON'         => ['slug_simkel' => 'andon-nikah', 'service_name_simkel' => 'Andon Nikah'],
            'REQ_BIRTH'         => ['slug_simkel' => 'kelahiran', 'service_name_simkel' => 'Kelahiran'],
            'REQ_BUSINESS'      => ['slug_simkel' => 'skmu', 'service_name_simkel' => 'Mempunyai Usaha'],
            'REQ_COMPANY'       => ['slug_simkel' => 'skdu', 'service_name_simkel' => 'Domisili Perusahaan'],
            'REQ_CROWD'         => ['slug_simkel' => 'keramaian', 'service_name_simkel' => 'Izin Keramaian'],
            'REQ_DEATH'         => ['slug_simkel' => 'kematian', 'service_name_simkel' => 'Kematian'],
            'REQ_DIVORCED'      => ['slug_simkel' => 'janda-duda', 'service_name_simkel' => 'Janda/Duda'],
            'REQ_DOMICILE'      => ['slug_simkel' => 'skd', 'service_name_simkel' => 'Domisili'],
            'REQ_HAJJ'          => ['slug_simkel' => 'ibadah-haji', 'service_name_simkel' => 'Ibadah Haji'],
            'REQ_HOUSE'         => ['slug_simkel' => 'belum-punya-rumah', 'service_name_simkel' => 'Belum Memiliki Rumah'],
            'REQ_MERRIED'       => ['slug_simkel' => 'belum-menikah', 'service_name_simkel' => 'Belum Menikah'],
            'REQ_MOVE'          => ['slug_simkel' => 'pindah', 'service_name_simkel' => 'Pindah'],
            'REQ_RESIDENT'      => ['slug_simkel' => 'skk', 'service_name_simkel' => 'Kependudukan'],
            'REQ_SKCK'          => ['slug_simkel' => 'skck', 'service_name_simkel' => 'SKCK'],
            'REQ_SKTM_EDUCATION'=> ['slug_simkel' => 'tidak-mampu-sekolah', 'service_name_simkel' => 'Tidak Mampu Pendidikan'],
            'REQ_SKTM_HEALTH'   => ['slug_simkel' => 'tidak-mampu-rs', 'service_name_simkel' => 'Tidak Mampu Rumah Sakit'],
            'REQ_SKTM_JUDICIARY'=> ['slug_simkel' => 'tidak-mampu-pengadilan', 'service_name_simkel' => 'Tidak Mampu Pengadilan'],
            'REQ_SKTM_PLN'      => ['slug_simkel' => 'tidak-mampu-listrik', 'service_name_simkel' => 'Tidak Mampu PLN']
        ];

        foreach ($services as $key => $s) {
            DB::table('services')
                ->where('service_id', $key)
                ->update($s);
        }
    }
}
