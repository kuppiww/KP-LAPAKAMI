<?php

namespace App\Helpers;

class AutoNumber {

    public static function getLastNoSurat($repository, $year, $kodeKelurahan) {
        // set max as 4 digit number
        $noSurat = $repository->getLastNoSurat($year, $kodeKelurahan);
        if ($noSurat) {
            // increment by 1
            $firstSection = strpos($noSurat, '/', 0);
            $lastSection = strpos($noSurat, '/', strpos($noSurat, '/', 0) + 1);
            $lastNumber = substr($noSurat, $firstSection + 1, $lastSection - $firstSection - 1);
            
            $lastNumber++;

            $format = substr('0000' . $lastNumber, -4);
        } else {
            // start from 0001
            $format = '0001';
        }

        return $format;
    }

    public static function getLastIdSurat($repository, $year, $kodeKelurahan) {
        $idSurat = $repository->getLastIdSurat($year, $kodeKelurahan);

        if ($idSurat) {
            $lastNumber = substr($idSurat, -4);

			$lastNumber++;

			$format = substr('0000'. $lastNumber, -4);
        } else {
            $format = '0001';
        }

        return $format;
    }
}