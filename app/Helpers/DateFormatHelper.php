<?php 
/**
 * Date Format Helper.
 *
 * Updated  2016, 18 Mei 08:55
 *
 * @author  Yudi Setiadi Permana <mail@yspermana.my.id>
 *
 */

namespace App\Helpers;

class DateFormatHelper{
	
	public function __construct(){
		
	}

	public static function dateEng($date){ 

		$day 	= substr($date,8,2); 
		$month 	= self::getMonth(substr($date,5,2)); 
		$year 	= substr($date,0,4); 
		
		return $day.' '.$month.' '.$year; 
	} 

	public static function dateEngFull($date){ 

		$day 	= substr($date,8,2); 
		$month 	= self::getMonth(substr($date,5,2)); 
		$year 	= substr($date,0,4); 
		$time 	= substr($date, 11,5);
		
		return $day.' '.$month.' '.$year.'  '. $time;
	} 

	public static function getMonth($month){ 
		switch ($month){ 
			case 1: 	return "January"; 	break; 
			case 2: 	return "February"; 	break; 
			case 3: 	return "March"; 	break; 
			case 4: 	return "April"; 	break; 
			case 5: 	return "May"; 		break;
			case 6: 	return "June"; 		break; 
			case 7: 	return "July"; 		break; 
			case 8: 	return "August"; 	break; 
			case 9: 	return "September"; break; 
			case 10:	return "October"; 	break; 
			case 11: 	return "November"; 	break; 
			case 12: 	return "December"; 	break; 
		}
	} 

	public static function dateEngShort($date){ 

		$day 	= substr($date,8,2); 
		$month 	= self::getMonthShort(substr($date,5,2)); 
		$year 	= substr($date,0,4); 
		
		return $day.' '.$month.' '.$year; 
	} 

	public static function getMonthShort($month){ 
		switch ($month){ 
			case 1: 	return "Jan"; 	break; 
			case 2: 	return "Feb"; 	break; 
			case 3: 	return "Mar"; 	break; 
			case 4: 	return "Apr"; 	break; 
			case 5: 	return "May"; 	break;
			case 6: 	return "Jun"; 	break; 
			case 7: 	return "Jul"; 	break; 
			case 8: 	return "Aug"; 	break; 
			case 9: 	return "Sep"; 	break; 
			case 10:	return "Oct"; 	break; 
			case 11: 	return "Nov"; 	break; 
			case 12: 	return "Dec"; 	break; 
		}
	}

	public static function getDay($day){ 
		switch ($day){ 
			case 1: 	return "Monday"; 	break; 
			case 2: 	return "Tuesday"; 	break; 
			case 3: 	return "Wednesday"; break; 
			case 4: 	return "Thursday"; 	break; 
			case 5: 	return "Friday"; 	break;
			case 6: 	return "Saturday"; 	break; 
			case 7: 	return "Sunday"; 	break; 
		}
	}

	public static function dateIn($tgl){ 

		$tanggal 	= substr($tgl,8,2); 
		$bulan 		= self::getBulan(substr($tgl,5,2)); 
		$tahun 		= substr($tgl,0,4); 
		
		return $tanggal.' '.$bulan.' '.$tahun; 
	} 

	public static function dateInFull($tgl){ 

		$tanggal 	= substr($tgl,8,2); 
		$bulan 		= self::getBulan(substr($tgl,5,2)); 
		$tahun 		= substr($tgl,0,4); 
		$waktu 		= substr($tgl, 11,5);
		
		return $tanggal.' '.$bulan.' '.$tahun.' '. $waktu; 
	} 

	public static function dateInShort($date){ 

		$day 	= substr($date,8,2); 
		$month 	= self::getBulanShort(substr($date,5,2)); 
		$year 	= substr($date,0,4); 
		
		return $day.' '.$month.' '.$year; 
	}

	public static function getBulan($bln){ 
		switch ($bln){ 
			case 1: 	return "Januari"; 	break; 
			case 2: 	return "Februari"; 	break; 
			case 3: 	return "Maret"; 	break; 
			case 4: 	return "April"; 	break; 
			case 5: 	return "Mei"; 		break;
			case 6: 	return "Juni"; 		break; 
			case 7: 	return "Juli"; 		break; 
			case 8: 	return "Agustus"; 	break; 
			case 9: 	return "September"; break; 
			case 10:	return "Oktober"; 	break; 
			case 11: 	return "November"; 	break; 
			case 12: 	return "Desember"; 	break; 
		}
	}

	public static function getBulanShort($bln){ 
		switch ($bln){ 
			case 1: 	return "Jan"; 	break; 
			case 2: 	return "Feb"; 	break; 
			case 3: 	return "Mar"; 	break; 
			case 4: 	return "Apr"; 	break; 
			case 5: 	return "Mei"; 	break;
			case 6: 	return "Jun"; 	break; 
			case 7: 	return "Jul"; 	break; 
			case 8: 	return "Agu"; 	break; 
			case 9: 	return "Sep"; 	break; 
			case 10:	return "Okt"; 	break; 
			case 11: 	return "Nov"; 	break; 
			case 12: 	return "Des"; 	break; 
		}
	}

	public static function dateNum($date){ 

		$day 	= substr($date,8,2); 
		$month 	= substr($date,5,2); 
		$year 	= substr($date,0,4); 
		
		return $day.'/'.$month.'/'.$year; 
	} 

	public static function dateNumFull($date){ 

		$day 	= substr($date,8,2); 
		$month 	= substr($date,5,2); 
		$year 	= substr($date,0,4); 
		$time 	= substr($date, 11,5);
		
		return $day.'/'.$month.'/'.$year.' '. $time;
	}

	public static function getHari($hari){ 
		switch ($hari){ 
			case 1: 	return "Senin"; 	break; 
			case 2: 	return "Selasa"; 	break; 
			case 3: 	return "Rabu"; 		break; 
			case 4: 	return "Kamis"; 	break; 
			case 5: 	return "Jumat"; 	break;
			case 6: 	return "Sabtu"; 	break; 
			case 7: 	return "Minggu"; 	break; 
		}
	}

	public static function hariIndo ($hariInggris) {
		switch ($hariInggris) {
		  case 'Sun':
			return 'Minggu';
		  case 'Mon':
			return 'Senin';
		  case 'Tue':
			return 'Selasa';
		  case 'Wed':
			return 'Rabu';
		  case 'Thu':
			return 'Kamis';
		  case 'Fri':
			return 'Jumat';
		  case 'Sat':
			return 'Sabtu';
		  default:
			return 'hari tidak valid';
		}
	}
}
 

?>