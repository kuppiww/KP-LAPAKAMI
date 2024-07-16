<?php

namespace App\Helpers;

class KecamatanHelper {

	public static function getAlamat($id, $id_kel) {
		switch ($id) {
			case 'Cimahi Utara': return '<p>Jl. Jati Serut No.12 Cibabat Telp. (022) 6654591 Fax. (022) 6654591<br>
				<span style="font-style:oblique">Website</span> : https://cimut.cimahikota.go.id <span style="font-style:oblique">e-mail</span> : cimut@cimahikota.go.id  <br>
				Cimahi 40513 Jawa Barat</p>';break;//cimut
            case 'Cimahi Tengah': return '<p>Jl. Terusan No.44 Telp. (022) 6654592 Fax. (022) 6654592<br>
				<span style="font-style:oblique">Website</span> : https://cimteng.cimahikota.go.id <span style="font-style:oblique">e-mail</span>: cimteng@cimahikota.go.id <br>
				Cimahi 40525 Jawa Barat</p>';break;//cimteng
			case 'Cimahi Selatan': return '<p>Jl. Baros No.14 Telp. (022) 6629676 Fax. (022) 6631950<br>
				<span style="font-style:oblique">Website</span> : https://cimsel.cimahikota.go.id <span style="font-style:oblique">e-mail</span>: cimsel@cimahikota.go.id <br>
				Cimahi 40533 Jawa Barat</p>';break; //cimsel
		}
	}

	public static function getKel($kd_kec)
	{
		if ($kd_kec == '01') {
			return ['01', '02', '03', '04', '05'];
		} else if ($kd_kec == '02') {
			return ['06', '07', '08', '09', '10'];
		} else if ($kd_kec == '03') {
			return ['11', '12', '13', '14', '15'];
		} else {
			return ['999999'];
		}
	}
}