<?php

namespace App\Helpers;

class TtdHelper {

    public static function getFttd($repository, $nip)
    {
        // dd($nip);
        $fttd = $repository->runQuery('SELECT fnfTtd(:nip_ttd) AS fttd', ['nip_ttd' => $nip]);

        return $fttd[0]->fttd;
    }

    public static function getLttd($repository, $nip)
    {
        $lttd = $repository->runQuery('SELECT fnlTtd(:nip_ttd) AS lttd', ['nip_ttd' => $nip]);

        return $lttd[0]->lttd;
    }

    public static function getFKecttd($repository, $nip)
    {
        $fttd = $repository->runQuery('SELECT fnfKecTtd(:nip_ttd) AS fttd', ['nip_ttd' => $nip]);

        return $fttd[0]->fttd;
    }

    public static function getLKecttd($repository, $nip)
    {
        $lttd = $repository->runQuery('SELECT fnlKecTtd(:nip_ttd) AS lttd', ['nip_ttd' => $nip]);

        return $lttd[0]->lttd;
    }
}