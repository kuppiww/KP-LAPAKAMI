<?php

namespace App\Helpers;

use App\Helpers\AutoNumber;

class Surat {

    public static function setKodeBidang($bidang) {
        if (strtolower($bidang) == 'ekonomi, pemberdayaan masyarakat dan kesejahteraan sosial') {
            return 'EPMKS';
        } else if (strtolower($bidang) == 'pemerintahan, ketentraman dan ketertiban umum') {
            return 'PEMTRA';
        } else if (strtolower($bidang) == 'sarana dan prasarana lingkungan') {
            return 'SARPRAS';
        } else if (strtolower($bidang) == 'pemberdayaan') {
            return 'Pembd.';
        } else if (strtolower($bidang) == 'pemerintahan') {
            return 'Pem.';
        } else if (strtolower($bidang) == 'ekbang') {
            return 'Ekbang';
        } else if (strtolower($bidang) == 'trantib') {
            return 'Trantib';
        }
    }

    public static function setKodeKlasifikasi($klasifikasi) {
        switch (strtolower($klasifikasi)) {
            case 'pengadilan' :
            case 'listrik' :
            case 'rumah sakit' :
            case 'sekolah' : return '460';
            case 'andon nikah' :
            case 'belum menikah' : return '474.2';
            case 'janda/duda' :
            case 'belum punya rumah' : return '474';
            case 'ibadah haji' : return '450';
            case 'kelahiran' : return '474.1';
            case 'kematian' : return '474.3';
            case 'pindah rumah' : return '475';
            case 'kependudukan' : return '148';
            case 'mempunyai usaha (pengajuan kredit)' :
            case 'domisili (yayasan/lembaga/organisasi)' : return '517';
            case 'domisili perusahaan' : return '500';
            case 'izin keramaian' : return '300';
            case 'pengantar skck' :
            case 'bersih diri' : return '331';
            default: return 'unidentified';
        }
    }

    public static function getNoSurat($repository, $year, $kodeKelurahan, $breadcrumbs) {
        $bidang = self::setKodeBidang($breadcrumbs[0]);

		if (count($breadcrumbs) > 2) {
        	$jenisSk = self::setKodeKlasifikasi($breadcrumbs[2]);
		} else {
			$jenisSk = self::setKodeKlasifikasi($breadcrumbs[1]);
		}

        return $jenisSk . '/' . AutoNumber::getLastNoSurat($repository, $year, $kodeKelurahan) . '/' . $bidang . '/' . $year;
    }

    public static function getIdSurat($repository, $year, $kodeKelurahan) {
        return $kodeKelurahan . $year . AutoNumber::getLastIdSurat($repository, $year, $kodeKelurahan);
    }
}