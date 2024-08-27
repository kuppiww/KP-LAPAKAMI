<?php 
/** 
 * Auth Helpers
 * 
 * Updated 11 Mei 2021, 09:40
 *
 * @author Yudi Setiadi Permana 
 *
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

use App\Models\Notification;
use App\Models\User;
use App\Helpers\FCMHelper;

use Modules\Users\Repositories\UsersRepository;

use Sentinel;

class NotificationHelper{

	public function __construct(){

		$this->_fcmHelper 		= new FCMHelper;
		$this->_userRepository  = new UsersRepository;

	}

	/**
	 * Save notification
	 *
	 * @param
	 * - title 		: judul dari pesan yang dikirim
	 * - body 		: isi pesan yang dikirim
	 * - user_id 	: akun pemilik
	 * 
	 * @return boolean
	 *
	 */
	public function save($type = 1, $category, $params){

		// Admin
		if ($type == 1) {
			return $this->_admin($category, $params);
		}
		// User
		else{
			return $this->_user($params);
		}

	}

	public static function redaksi($status, $request_note)
	{
		$dalamproses = 'Selamat permohonan layanan yang anda ajukan melalui aplikasi Lapakami dalam proses';
        $prosespermohonan = 'proses permohonan dapat anda lihat melalui Lapakami menggunakan akun anda dengan detail permohonan sebagai berikut.';
        $catatan = null;
        if ($status == 'APPROVED' || $status == 'APPROVED_KEC') {
            $redaksi = 'Selamat permohonan layanan yang anda ajukan melalui aplikasi Lapakami telah selesai, dokumen hasil permohonan dapat anda unduh melalui Lapakami menggunakan akun anda dengan detail permohonan sebagai berikut.';
            $statusname = 'Selesai';
        } else if ($status == 'VERIFIED') {
            $redaksi = $dalamproses.' verfikasi, '. $prosespermohonan;
            $statusname = 'Proses Verifikasi';
        } else if ($status == 'REJECTED') {
            $redaksi = 'Mohon maaf permohonan layanan yang anda ajukan melalui aplikasi Lapakami tidak dapat kami lanjutkan ke tahapan berikutnya, silahkan lengkapi atau perbaiki persyaratan dengan detail sebagai berikut.';
            $statusname = 'Permohonan Ditolak';
            $catatan = $request_note;
        } else if ($status == 'PROCCESS') {
            $redaksi = $dalamproses.' pembuatan dokumen, '. $prosespermohonan;
            $statusname = 'Proses Pembuatan Dokumen';
        } else if ($status == 'PROCCESS_KEC') {
            $redaksi = $dalamproses.' pembuatan, '. $prosespermohonan;
            $statusname = 'Proses Pembuatan Dokumen di Kecamatan';
        } else if ($status = 'VERIFIED_KEC') {
            $redaksi = $dalamproses.' verfikasi di Kecamatan, '. $prosespermohonan;
            $statusname = 'Proses Verifikasi di Kecamatan';
        } else {
            $redaksi = '-';
            $statusname = '-';
        }

		$data['redaksi'] = $redaksi;
		$data['statusname'] = $statusname;
		$data['catatan'] = $catatan;

		return $data;
	}

	public static function render(){

		$userid 	= Auth::user()->user_id;

		$getNotif 	= Notification::where('user_id', '=', $userid)->where('notif_status', '=', '0')->orderby('created_at', 'DESC')->limit(5)->get();
		$res 		= array(
						'count' => 0, 
						'list' 	=> "<div class='text-center text-muted'><small>Tidak ada pemberitahuan</small></div>", 
						'badge' => ""
					);

		if (sizeof($getNotif) > 0) {

			$list 	= "";
			$count 	= sizeof($getNotif);
			
			foreach ($getNotif as $notif) {
				
				$list .= "
						<div class='div-link' data-link='". url($notif->notif_type .'/show/'. $notif->notif_content_id) ."'>
							<p class='m-0'>
								<small class='text-muted'>". date('d/m/Y H:i:s', strtotime($notif->created_at)) ."</small><br>
								<strong>". $notif->notif_title ."</strong> ". $notif->notif_content ."
							</p>
						</div>";

			}

			$list .= "
						<div class='div-link' data-link='". url('notification') ."'>
							<p class='m-0 text-center'>
								<small>Lihat semua pemberitahuan</small>
							</p>
						</div>
					";

			$res = array('count' => $count, 'list' => $list, 'badge' => "<span class='badge bg-red'></span>");

		}

		return $res;

	} 

	private function _admin($category, $params){

		$res = false;

		try {

			$value 	= array(
					'notif_title'		=> $params['title'],
					'notif_content'		=> $params['body'],
					'notif_status'		=> '0',
					'notif_type'		=> $params['type'],
					'notif_content_id'	=> $params['content_id'],
					'created_by'		=> Auth::user()->user_id,
					'updated_by'		=> Auth::user()->user_id,
					'created_at'		=> date('Y-m-d H:i:s'),
					'updated_at'		=> date('Y-m-d H:i:s')
				);

			// Admin Aplikasi 
			if($category == 1){
				$role = '1,2,3';
			}
			// Admin Infrastruktur
			elseif ($category == 2) {
				$role = '1,2,4';
			}
			// Admin Persandian
			elseif ($category == 3) {
				$role = '1,2,5';
			}
			
			// Get User
            $getUser = $this->_userRepository->getAllByRole($role);

            if (sizeof($getUser) > 0) {

                foreach ($getUser as $user) {
                   	
                	$value['user_id'] 	= $user->user_id;
                	$params['user_id'] 	= $user->user_id;

                	// Insert new log
					$params['notif_id'] = Notification::create($value);

					$request = $this->_fcmHelper->request($params);

					if ($request['status'] == 1) {
						$res = true;
					}

                }

            }

		} catch (Exception $e) {
			die('[Notification] Internal server error');
		}

		return $res;

	}

	private function _user($params){

		$res = false;

		try {

			$value 	= array(
					'notif_title'		=> $params['title'],
					'notif_content'		=> $params['body'],
					'user_id'			=> $params['user_id'],
					'notif_status'		=> '0',
					'notif_type'		=> $params['type'],
					'notif_content_id'	=> $params['content_id'],
					'created_by'		=> Auth::user()->user_id,
					'updated_by'		=> Auth::user()->user_id,
					'created_at'		=> date('Y-m-d H:i:s'),
					'updated_at'		=> date('Y-m-d H:i:s')
				);

			// Insert new log
			$params['notif_id'] = Notification::create($value);

			$request = $this->_fcmHelper->request($params);

			if ($request['status'] == 1) {
				$res = true;
			}

		} catch (Exception $e) {
			die('[Notification] Internal server error');
		}

		return $res;

	}

}