<?php

namespace App\Helpers;

class KelurahanHelper {

	public static function getAlamat($id) {
		switch ($id) {
			case '01': return '<p>Jl. Melong Raya Blok Sakola No.72 Telp. (022) 6026961 <br><span style="font-style:oblique">Website</span> : https://melong.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  melong@cimahikota.go.id<br>Cimahi 40534 Jawa Barat</p>';break; //melong
			case '02': return '<p>Jl. Raya Jend. H. Amir Machmud No.125 Telp. (022) 6002605 <br><span style="font-style:oblique">Website</span> : https://cibeureum.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  cibeureum@cimahikota.go.id<br>Cimahi 40535 Jawa Barat</p>';break;//cibeureum
			case '03': return '<p>Jl. Ibu Ganirah No.41 Cibeber Telp. (022) 6672994<br><span style="font-style:oblique">Website</span> : https://cibeber.cimahikota.go.id <span style="font-style:oblique">e-mail</span> : cibeber@cimahikota.go.id<br>Cimahi 40531 Jawa Barat</p>';break;//cibeber
			case '04': return '<p>Jl. Sadarmanah No.11 RT.01 RW.05 Telp./Fax. (022) 6672995 <br><span style="font-style:oblique">Website</span> : https://leuwigajah.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  leuwigajah@cimahikota.go.id<br>Cimahi 40532 Jawa Barat</p>';break;//lewigajah
			case '05': return '<p>Jl. Nanjung No.58 Telp. (022) 6676995 <br><span style="font-style:oblique">Website</span> : https://utama.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  utama@cimahikota.go.id<br>Cimahi 40533 Jawa Barat</p>';break;//Utama
			//case '06': return '<p>Jl. Haji Haris No.8B Telp. (022) 70775106 <br><span style="font-style:oblique">Website</span> : https://baros.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  baros@cimahikota.go.id<br>Cimahi 40521 Jawa Barat</p>';break;//Baros
			case '06': return '<p>Jl. Haji Haris No.8B Telp. (022) 20660151 <br><span style="font-style:oblique">Website</span> : https://baros.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  baros@cimahikota.go.id<br>Cimahi 40521 Jawa Barat</p>';break;//Baros
			case '07': return '<p>Jl. Ubed No.1 Telp. (022) 6654087 <br><span style="font-style:oblique">Website</span> : https://setiamanah.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  setiamanah@cimahikota.go.id<br>Cimahi 40524 Jawa Barat</p>';break;//Setiamanah
			case '08': return '<p>Jl. Kebon Manggu No.6 Telp. (022) 6621678 <br><span style="font-style:oblique">Website</span> : https://padasuka.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  padasuka@cimahikota.go.id<br>Cimahi 40526 Jawa Barat</p>';break;//Padasuka
			case '09': return '<p>Jl. Lurah No.26 Telp. (022) 6652090 <br><span style="font-style:oblique">Website</span> : https://karangmekar.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  karangmekar@cimahikota.go.id<br>Cimahi 40523 Jawa Barat</p>';break;//Karangmekar
			case '10': return '<p>Jl. Terusan No.41 Telp. (022) 6641829 <br><span style="font-style:oblique">Website</span> : https://cimahi.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  cimahi@cimahikota.go.id<br>Cimahi 40525 Jawa Barat</p>';break;//Cimahi
			case '11': return '<p>Jl. RH. Abdul Halim No.24 Telp./Fax. (022) 6634746 <br><span style="font-style:oblique">Website</span> : https://cigugurtengah.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  cigugurtengah@cimahikota.go.id<br>Cimahi 40522 Jawa Barat</p>';break;//Cigugur Tengah
			case '12': return '<p>Jl. Sirnarasa No.18 Telp. (022) 6654095 <br><span style="font-style:oblique">Website</span> : https://cibabat.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  cibabat@cimahikota.go.id<br>Cimahi 40513 Jawa Barat</p>';break;//Cibabat
			case '13': return '<p>Jl. Encep Kartawiria No.29 Telp. (022) 6654063 <br><span style="font-style:oblique">Website</span> : https://citeureup.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  citeureup@cimahikota.go.id<br>Cimahi Jawa Barat</p>';break;//Citeureup
			case '14': return '<p>Jl. Cipageran No.77 Telp. (022) 6654063 <br><span style="font-style:oblique">Website</span> : https://cipageran.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  cipageran@cimahikota.go.id<br>Cimahi Jawa Barat</p>';break;//Cipageran
			case '15': return '<p>Jl. Gunung Batu Cidamar Telp. (022) 2001731 <br><span style="font-style:oblique">Website</span> : https://pasirkaliki.cimahikota.go.id <span style="font-style:oblique">e-mail</span> :  pasirkaliki@cimahikota.go.id<br>Cimahi Jawa Barat</p>';break;//Pasirkaliki
		}
	}

	public static function getEmail($id)
	{
		switch ($id) {
			case '01': return 'email kelurahan :  melong@cimahikota.go.id';break; //melong
			case '02': return 'email kelurahan :  cibeureum@cimahikota.go.id';break;//cibeureum
			case '03': return 'email kelurahan : cibeber@cimahikota.go.id';break;//cibeber
			case '04': return 'email kelurahan :  leuwigajah@cimahikota.go.id';break;//lewigajah
			case '05': return 'email kelurahan :  utama@cimahikota.go.id';break;//Utama
			case '06': return 'email kelurahan :  baros@cimahikota.go.id';break;//Baros
			case '07': return 'email kelurahan :  setiamanah@cimahikota.go.id';break;//Setiamanah
			case '08': return 'email kelurahan :  padasuka@cimahikota.go.id';break;//Padasuka
			case '09': return 'email kelurahan :  karangmekar@cimahikota.go.id';break;//Karangmekar
			case '10': return 'email kelurahan :  cimahi@cimahikota.go.id';break;//Cimahi
			case '11': return 'email kelurahan :  cigugurtengah@cimahikota.go.id';break;//Cigugur Tengah
			case '12': return 'email kelurahan :  cibabat@cimahikota.go.id';break;//Cibabat
			case '13': return 'email kelurahan :  citeureup@cimahikota.go.id';break;//Citeureup
			case '14': return 'email kelurahan :  cipageran@cimahikota.go.id';break;//Cipageran
			case '15': return 'email kelurahan :  pasirkaliki@cimahikota.go.id';break;//Pasirkaliki
		}
	}
}