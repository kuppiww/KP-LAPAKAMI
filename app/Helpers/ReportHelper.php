<?php

namespace App\Helpers;

use App\Helpers\KelurahanHelper;
use App\Helpers\KecamatanHelper;
use App\Helpers\DateTime;
use App\Helpers\Url;
use App\Helpers\QrCodeHelper;
use Illuminate\Support\Facades\Auth;
use Mpdf\Css\Border;

class ReportHelper {

	public static function setHeader($year, $nama_kel, $nama_kec, $kd_kel, $iskec = false) {
		$user = Auth::user();
		if (date('Y', strtotime($year)) < 2018) {
			$logo = public_path() . '/assets/img/logo_report.jpg';
		} else {
			$logo = public_path() . '/assets/img/logo-color-baru.jpg';
		}

		if ($iskec) {
			$pemisah = '';
			$lineheight = '1.1';
			$namaheader = '<span style="font-weight: bold;font-size: 30px;">KECAMATAN ' . strtoupper($nama_kec) . '</span><br />';
			$alamatheader = '<span style="font-weight: normal;font-size: 16px;">' . KecamatanHelper::getAlamat($nama_kec, $kd_kel) .'</span>';
		} else {
			$pemisah = '<br>';
			$lineheight = '1.05';
			$namaheader = '<span style="font-weight: bold;font-size: 30px;">KECAMATAN ' . strtoupper($nama_kec) . '</span><br />
				<span style="font-weight: bold;font-size: 30px;">KELURAHAN ' . strtoupper($nama_kel) . '</span><br />';
			$alamatheader = '<span style="font-weight: normal;font-size: 16px;">' . KelurahanHelper::getAlamat($kd_kel) . '</span></p>';
		}

		return '<table style="font-weight: lighter;" border="0" autoresize="0" width="793px">' .
			'<tr>' .
				'<td valign="top" style="text-align: right;" width="150px">'.
					$pemisah.'
					<img class="padding-top:10px;" width="118px" height="123px" src="' . $logo . '" />
				</td>' .
				// $pemisah.
				'<td valign="top" width="643px" style="vertical-align: top;font-family: Arial;line-height: '.$lineheight.';text-align:center;">'.
						'<p style="font-size: 25px;font-weight: lighter;vertical-align: top;">PEMERINTAH DAERAH KOTA CIMAHI<br />' .
						$namaheader.
						$alamatheader.
				'</td>' .
			'</tr>' .
			'</table>';
	}

	public static function setFooter($idSurat = '#', $serviceCode = '', $ver = 1) {
		if ($ver) {
			return '<div style="border: 1px solid #fff; position: absolute; bottom: 30px; left: 0; width: 100%; line-height: 0">' .
					'<p style="font-size: 12px; text-align: center">Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan oleh<br /> Badan Sertifikasi Elektronik (BsrE) Badan Siber dan Sandi Negara (BSSN)</p>' .
					'</div>';
		} else {
			return '<div style="position: absolute; bottom: 30px; width: 90%; line-height: 0">' .
					'<p style="margin-left: 30px; font-size: 12px; text-align: center">Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan oleh<br /> Badan Sertifikasi Elektronik (BsrE) Badan Siber dan Sandi Negara (BSSN)<br />' .
					'<span style="font-size: 12px">(' . env('APP_URL_LAPAKAMI') . '/verifikasi-dokumen/hasil?key=' . $serviceCode . '-' . $idSurat . ')</span></p>' .
					'</div>';
		}

		return '<div style="position: absolute; bottom: 30px; width: 90%; line-height: 0">' .
				'<p style="margin-left: 30px; font-size: 12px; text-align: justify">Dokumen ini telah ditandatangani menggunakan sertifikat elektronik yang diterbitkan oleh Balai Sertifikasi Elektronik (BSrE), BSSN ' .
				'Untuk memastikan keaslian tanda tangan elektronik, silakan pindai QR Code atau melalui aplikasi BeSign atau Panter (https://bsre.bssn.go.id/repository).</p>' .
			'</div>';
	}

	public static function setQrCode($idSurat, $serviceCode = '', $status_request) {
		$color = 'red';
		if ($status_request == 'APPROVED' || $status_request == 'APPROVED_KEC') {
			$color = 'black';
		}
		return '<div style="position: absolute; left: 15px; bottom: 15px;">' .
			QrCodeHelper::generate(env('APP_URL_LAPAKAMI_VERIFIKASI') . '/hasil?key=' . $serviceCode . '-' . $idSurat, 110, $status_request) . '<br />' .
			// '<span style="font-size: 15px;color:'.$color.'">' . strtoupper($serviceCode) . '-' . $idSurat . '</span>' .
		'</div>';

		// $color = 'red';
		// if ($status_request == 'APPROVED' || $status_request == 'APPROVED_KEC') {
		// 	$color = 'black';
		// }

		// $qrCodeContent = QrCodeHelper::generate(env('APP_URL_LAPAKAMI_VERIFIKASI') . '/hasil?key=' . $serviceCode . '-' . $idSurat, 110, $status_request);

		// return '<div style="position: absolute; left: 15px; bottom: 15px;">' .
		// 	'<img src="data:image/png;base64,' . $qrCodeContent . '" alt="QR Code with Logo"><br />' .
		// 	'</div>';
	}

	public static function setFormatTanggal($tanggal)
	{
		$bulan = array (
			1 =>   'Januari', 'Februari','Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		);

		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		
	}

	public static function ttehead($nama_kel, $tgl_surat, $ttd_f, $ttd_l, $withcamat = false, $ttd_l_kec= '', $f_kec_ttd = '')
	{
		$tablewidth = '800px';
		$fontsize = '25px';
		$tdwidthone = '512px';
		$tdwidthan  = '48px';
		$tdwidthtwo = '510px';
		$backgroundColor = '';
		$color = 'black';
		$align = 'left';
		$tglSurat = self::setFormatTanggal($tgl_surat);
		$alignkec = 'left';
		$textCamat = '';
		// DateTime::getSimpleDate($tgl_surat)
		if ($ttd_f == null) {
			$align = 'left';
			$backgroundColor = 'red';
			$color = 'white';
		}

		if ($f_kec_ttd == '') {
			$alignkec = 'center';
		}

		if ($withcamat) {
			$tablewidth = '800px';
			$textCamat = $ttd_l_kec;
			$tdwidthone = '512px';
			$tdwidthan  = '48px';
			$tdwidthtwo = '510px';
		}
		// <b style="font-family: Arial;font-size: '.$fontsize.';">'.substr("$textCamat",0,20)."<br/>".substr("$textCamat",20,20).'</b>
		$tglsurat = '<table align="'.$align.'" width="'.$tablewidth.'" border="0" autoresize="0">'.
						'<tr>'.
							'<td width="'.$tdwidthone.'" style="text-align:'.$align.';">
								<b style="font-family: Arial;font-size: '.$fontsize.';"></b>
							</td>'.
							'<td width="'.$tdwidthan.'" style="text-align:justify;vertical-align: top;">
								<b style="font-family: Arial;font-size: '.$fontsize.';"></b>
							</td>'.
							'<td width="'.$tdwidthtwo.'" style="text-align:left;">
								<p style="font-family: Arial;color:'.$color.';background-color: '.$backgroundColor.';font-size: '.$fontsize.';">'.$nama_kel.', '.$tglSurat.'</p>
							</td>
						</tr>
					</table><table><tr><td></td><td></td><td></td></tr></table>';
		if ($withcamat) {
			return $tglsurat.'<table align="'.$align.'" width="'.$tablewidth.'" border="0" autoresize="0">'.
				'<tr>'.
					'<td width="'.$tdwidthone.'" style="text-align:'.$align.';">
						<b style="font-family: Arial;font-size: '.$fontsize.';"></b>
					</td>'.
					'<td width="'.$tdwidthan.'" style="text-align:justify;vertical-align: top;">
						<b style="font-family: Arial;font-size: '.$fontsize.';">'.$ttd_f.'</b>
					</td>'.
					'<td width="'.$tdwidthtwo.'" style="text-align:'.$align.';">
						<b style="font-family: Arial;font-size: '.$fontsize.';">'.str_replace(chr(13), '<br />', $ttd_l). ',</b>
					</td>'.
				'</tr>'.
			'</table>';
		} else {
			return $tglsurat.'<table align="'.$align.'" width="'.$tablewidth.'" border="0" autoresize="0">'.
				'<tr>'.
					'<td width="'.$tdwidthone.'" style="text-align:'.$align.';">
						<b style="font-family: Arial;font-size: '.$fontsize.';"></b>
					</td>'.
					'<td width="'.$tdwidthan.'" style="text-align:justify;vertical-align: top;">
						<b style="font-family: Arial;font-size: '.$fontsize.';">'.$ttd_f.'</b>
					</td>'.
					'<td width="'.$tdwidthtwo.'" style="text-align:'.$align.';">
						<b style="font-family: Arial;font-size: '.$fontsize.';">'.str_replace(chr(13), '<br />', $ttd_l). ',</b>
					</td>'.
				'</tr>'.
			'</table>';
		}
	}

	public static function tte($id_surat, $service_code, $request_status, $nama_singkat_ttd, $jabatan, $nip_ttd, $pangkat)
	{
		return
			'<table align="center" width="500px" border="0" autoresize="0">'.
				'<tr>'.
					'<td width="110px" align="center" style="padding-top:13px;padding-bottom:15px;">'.
						'<img height="42%" src="' . public_path() . '/assets/img/logo_report_color.png" />'.
					'</td>'.
					'<td width="310px">'.
						'Ditandatangani secara elektronik oleh : <br>'.
						'<b>'.$jabatan.'</b><br><br>'.
						'<b>'.$nama_singkat_ttd.'</b><br>'.$pangkat.'<br>'.
						'<p>NIP. '.substr("$nip_ttd",0,8) . " " . substr("$nip_ttd",8,6) . " " . substr("$nip_ttd",14,1) . " " . substr("$nip_ttd",15,3).'</p>'.
					'</td>'.
				'</tr>'.
			'</table>';
	}

	public static function tte_v2_old($nama_kel, $tgl_surat, $ttd_f, $ttd_l, $service_code, $request_status, $nama_singkat_ttd)
	{
		$fontsize = '25px';
		$color = 'black';
		$backgroundColor = '';
		$align = 'left';
		if ($ttd_f == null) {
			$align = 'left';
			$backgroundColor = 'red';
			$color = 'white';
		}
		$tablewidth = '500px';
		$tdwidthone = '512px';
		$tdwidthan  = '48px';
		$tdwidthtwo = '510px';
		return
			// '<table align="'.$align.'" width="'.$tablewidth.'" border="1" autoresize="0">'.
			// 	'<tr>'.
			// 		'<td width="'.$tdwidthone.'" style="text-align:'.$align.';">
			// 			<b style="font-family: Arial;font-size: '.$fontsize.';"></b>
			// 		</td>'.
			// 		'<td width="'.$tdwidthan.'" style="text-align:justify;vertical-align: top;">
			// 			<b style="font-family: Arial;font-size: '.$fontsize.';">'.$ttd_f.'</b>
			// 		</td>'.
			// 		'<td width="'.$tdwidthtwo.'" style="text-align:'.$align.';">
			// 			<b style="font-family: Arial;font-size: '.$fontsize.';">'.str_replace(chr(13), '<br />', $ttd_l). ',</b>
			// 		</td>'.
			// 	'</tr>'.
			// '</table>
			'<table width="500px" border="1" autoresize="0">'.
				'<tr>'.
					'<td>'.
						'<b style="font-family: Arial;color:white;font-size: '.$fontsize.';">a.n.</b><br>'.
					'</td>'.
					'<td>
						<p style="font-family: Arial;color:'.$color.';background-color: '.$backgroundColor.';font-size: '.$fontsize.';">'.$nama_kel.', '.self::setFormatTanggal($tgl_surat).'</p>
					</td>'.
				'</tr>'.
			'</table>'.
			'<table width="500px" border="1" autoresize="0">'.
				'<tr>'.
					'<td>'.
						'<b style="font-family: Arial;font-size: '.$fontsize.';">'.$ttd_f.'</b><br>'.
						'<b style="font-family: Arial;font-size: '.$fontsize.';">'.$ttd_f.'</b><br>'.
						'<b style="font-family: Arial;font-size: '.$fontsize.';">'.$ttd_f.'</b><br>'.
						'<b style="font-family: Arial;font-size: '.$fontsize.';">'.$ttd_f.'</b><br>'.
						// '<b style="font-family: Arial;font-size: '.$fontsize.';">'.$ttd_f.'</b><br>'.
					'</td>'.
					'<td>'.
						'<b style="font-family: Arial;font-size: '.$fontsize.';">'.strtoupper(str_replace(chr(13), '<br />', $ttd_l)).'</b></br>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td >'.
						
					'</td>'.
					'<td width="420px" align="left" style="padding-top:13px;padding-bottom:15px;">'.
						''.self::setQrCode('id_surat', $service_code, $request_status).'</br>'.
					'</td>'.
				'</tr>'.
					'<tr>'.
						'<td >'.
						
						'</td>'.
						'<td width="420px" align="left" style="padding-top:13px;padding-bottom:15px;">'.
							'<b style="font-family: Arial;color:'.$color.';font-size: '.$fontsize.';background-color: '.$backgroundColor.';">'.strtoupper($nama_singkat_ttd).'</b><br>'.
						'</td>'.
				'</tr>'.
			'</table>';
	}

	public static function tte_v2($nama_kel, $tgl_surat, $ttd_f, $ttd_l, $service_code, $request_status, $nama_singkat_ttd)
	{
		$tablewidth = '800px';
		$fontsize = '25px';
		$tdwidthone = '512px';
		$tdwidthan  = '48px';
		$tdwidthtwo = '510px';
		$backgroundColor = 'red';
		$color = 'white';
		$align = 'left';
		$tglSurat = self::setFormatTanggal($tgl_surat);

		if ($request_status == 'APPROVED' || $request_status == 'APPROVED_KEC' || $request_status == 'TTE' || $request_status == 'TTE_KEC' ) {
			$align = 'left';
			$backgroundColor = 'white';
			$color = 'black';
		}

		$tglsurat = '<table align="'.$align.'" width="'.$tablewidth.'" border="0" autoresize="0">'.
						'<tr>'.
							'<td width="'.$tdwidthone.'" style="text-align:'.$align.';">
								<b style="font-family: Arial;font-size: '.$fontsize.';"></b>
							</td>'.
							'<td width="'.$tdwidthan.'" style="text-align:justify;vertical-align: top;">
								<b style="font-family: Arial;font-size: '.$fontsize.';"></b>
							</td>'.
							'<td width="'.$tdwidthtwo.'" style="text-align:left;">
								<p style="font-family: Arial;color:'.$color.';background-color: '.$backgroundColor.';font-size: '.$fontsize.';">'.$nama_kel.', '.$tglSurat.'</p>
							</td>
						</tr>
					</table><table><tr><td></td><td></td><td></td></tr></table>';

			return $tglsurat.'<table align="'.$align.'" width="'.$tablewidth.'" border="0" autoresize="0">'.
				'<tr>'.
					'<td width="'.$tdwidthone.'" style="text-align:'.$align.';">
						<b style="font-family: Arial;font-size: '.$fontsize.';"></b>
					</td>'.
					'<td width="'.$tdwidthan.'" style="text-align:justify;vertical-align: top;">
						<b style="font-family: Arial;color:'.$color.';background-color: '.$backgroundColor.';font-size: '.$fontsize.';">'.$ttd_f.'</b>
					</td>'.
					'<td width="'.$tdwidthtwo.'" style="text-align:'.$align.';">
						<b style="font-family: Arial;color:'.$color.';background-color: '.$backgroundColor.';font-size: '.$fontsize.';">'.str_replace(chr(13), '<br />', $ttd_l). ',</b><br>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<table align="'.$align.'" width="'.$tablewidth.'" border="0" autoresize="0">'.
				'<tr>'.
					'<td width="'.$tdwidthone.'" style="text-align:'.$align.';">
					
					</td>'.
					'<td width="'.$tdwidthan.'" style="text-align:justify;vertical-align: top;">
						<b style="font-family: Arial;color:white;font-size: '.$fontsize.';">a.n.</b>
					</td>'.
					'<td width="'.$tdwidthtwo.'" style="text-align:'.$align.';">'.
						''.self::setQrCode('id_surat', $service_code, $request_status).'</br>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<table align="'.$align.'" width="'.$tablewidth.'" border="0" autoresize="0">'.
				'<tr>'.
					'<td width="'.$tdwidthone.'" style="text-align:'.$align.';">
					
					</td>'.
					'<td width="'.$tdwidthan.'" style="text-align:justify;vertical-align: top;">
						<b style="font-family: Arial;color:white;font-size: '.$fontsize.';">a.n.</b>
					</td>'.
					'<td width="'.$tdwidthtwo.'" style="text-align:'.$align.';">'.
						'<b style="font-family: Arial;font-size: '.$fontsize.';color:'.$color.';background-color: '.$backgroundColor.';">'.$nama_singkat_ttd.'</b>'.
					'</td>'.
				'</tr>'.
			'</table>';
	}

	public static function ttecamat($ttd_l_kec, $nama_singkat_ttd, $nip_ttd, $pangkat)
	{
		$textCamat = $ttd_l_kec;
			$border = 'double';

		return '<table align="right" width="500px" border="0" autoresize="0">'.
		'<tr>'.
			'<td width="110px" align="center" style="padding-top:13px;padding-bottom:15px;">'.
				'<img height="42%" src="' . public_path() . '/assets/img/logo_report_color.png" />'.
			'</td>'.
			'<td width="310px">'.
				'Ditandatangani secara elektronik oleh : <br>'.
				'<b>'.$textCamat.'</b><br><br>'.
				'<b>'.$nama_singkat_ttd.'</b><br>'.$pangkat.'<br>'.
				'<p>NIP. '.substr("$nip_ttd",0,8) . " " . substr("$nip_ttd",8,6) . " " . substr("$nip_ttd",14,1) . " " . substr("$nip_ttd",15,3).'</p>'.
			'</td>'.
		'</tr>'.
		'</table>';
	}

	public static function getReportTemplatePath($routeName, $file='ver-1', $date=null) {
		$url = new Url($routeName);

        return $url->generateReportUrl() . '/' . $routeName;
    }

}
