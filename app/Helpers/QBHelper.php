<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class QBHelper {

	public static function setQueryLog($conn) {
		return DB::connection($conn)->enableQueryLog();
	}

	public static function showQueryLog($conn, $execute=true) {
		if ($execute)
			dd(DB::connection($conn)->getQueryLog());
	}
}