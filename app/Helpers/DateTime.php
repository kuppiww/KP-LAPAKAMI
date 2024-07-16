<?php

namespace App\Helpers;

class DateTime {

	public static function getDateName($date, $locale='id') {
		$date = date('l', strtotime($date));

		if ($locale != 'id') {
			return $date;
		} else {
			switch ($date) {
				case 'Monday' : return 'Senin';
				case 'Tuesday' : return 'Selasa';
				case 'Wednesday' : return 'Rabu';
				case 'Thursday' : return 'Kamis';
				case 'Friday' : return 'Jumat';
				case 'Saturday' : return 'Sabtu';
				case 'Sunday' : return 'Minggu';
			}
		}
	}

	public static function getMonthName($num, $locale='id') {
		if ($locale != 'id') {
			// assuming it's english language
			switch ($num) {
				case 1 : return 'January';
				case 2 : return 'February';
				case 3 : return 'March';
				case 4 : return 'April';
				case 5 : return 'May';
				case 6 : return 'June';
				case 7 : return 'July';
				case 8 : return 'August';
				case 9 : return 'September';
				case 10 : return 'October';
				case 11 : return 'November';
				case 12 : return 'December';
			}
		} else {
			// default is always in indonesian language
			switch ($num) {
				case 1 : return 'Januari';
				case 2 : return 'Februari';
				case 3 : return 'Maret';
				case 4 : return 'April';
				case 5 : return 'Mei';
				case 6 : return 'Juni';
				case 7 : return 'Juli';
				case 8 : return 'Agustus';
				case 9 : return 'September';
				case 10 : return 'Oktober';
				case 11 : return 'November';
				case 12 : return 'Desember';
			}
		}
	}

	public static function getLocaleToMssqlFormat($date, $delimiter='/', $formatType=1) {
		$d = explode($delimiter, $date);

		switch ($formatType) {
			// yyyy-mm-dd
			case 1: return $d[2] . '-' . $d[1] . '-' . $d[0];

			// mm/dd/yyyy
			case 2: return $d[1] . $delimiter . $d[0] . $delimiter . $d[2];
		}

	}

	public static function getMssqlToMysqlFormat($date, $delimiter='/') {
		$d = explode($delimiter, $date);

		return $d[2] . $delimiter . $d[1] . $delimiter . $d[0];
	}

	public static function getLocaleDateFromMssqlFormat($date, $delimiter='/') {
		$d = explode('-', date('Y-m-d', strtotime($date)));

		return $d[2] . $delimiter . $d[1] . $delimiter . $d[0];
	}

	public static function getSimpleDate($date, $delimiter=' ') {
		$d = explode('-', date('Y-m-d', strtotime($date)));
		//$day = self::getDateName($date);
		$month = self::getMonthName($d[1]);

		return $d[2] . $delimiter . $month . $delimiter . $d[0];
	}

    public static function locale($date, $showTime=false, $delimiter='/') {
        return ! $showTime ? date("d{$delimiter}m{$delimiter}Y", strtotime($date)) :
			date("d{$delimiter}m{$delimiter}Y H:i", strtotime($date));
    }

    public static function getExpireDatePerMonth($currentDate, $val = 1) {
        return date('Y-m-d', strtotime('+' . (int) $val . ' month', strtotime($currentDate)));
    }

    public static function setYear() {
        $year = date('Y');

        return $year?: date('Y');
    }

}
