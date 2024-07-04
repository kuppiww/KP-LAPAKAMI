<?php 
/** 
 * Auth Helpers
 * 
 * Updated 11 Juni 2021, 09:40
 *
 * @author Yudi Setiadi Permana 
 *
 */
namespace App\Helpers;

use App\Models\FCMLog;
use App\Models\FCMRegistration;

use Ixudra\Curl\Facades\Curl;

class FCMHelper{

	public function __construct(){

		$this->config 		= config('fcm.http');
		$this->_clientId 	= "WEB";

	}

	/**
	 * Save Token
	 *
	 * @param
	 * - token 		: token fcm
	 * - user 		: user id
	 * - user_type 	: 1: student, 2: lecture
	 * - client_id 	: client id for auth verification
	 * 
	 * @return string
	 *
	 */
	public function saveToken($token, $user, $agent){

		$data 	= array(
					'fcm_reg_token'		=> $token,
					'fcm_reg_device'	=> $agent,
					'auth_client_id'	=> $this->_clientId,
					'user_id'			=> $user
				);

		$existToken = FCMRegistration::where('auth_client_id', $this->_clientId)->where('user_id', $user)->first();

		if ($existToken) {
			// Update token
			$data['updated_at'] = date('Y-m-d H:i:s');
			$existToken->update($data);
		}
		else{
			// Insert new token
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user;
			FCMRegistration::create($data);
		}

		return $token;

	}

	/**
	 * Send Request To FCM
	 *
	 * @param
	 * - token 		: token fcm
	 * - notif_id 	: id dari notifikasi yang disimpan
	 * - title 		: judul dari pesan yang dikirim
	 * - body 		: isi pesan yang dikirim
	 * - sound 		: nada dering notifikasi
	 * 
	 * @return array
	 *
	 */
	public function request($params){

		$return = array('status' => 0, 'msg' => 'Failed to request FCM');

		$token  = $this->_getToken($params['user_id']);
		$regId 	= is_array($token ) ? $token  : array($token);

		$data 	= array(
					'registration_ids'	=> $regId,
					'notification' 		=> array(
												'title'			=> $params['title'],
												'body'			=> $params['body'],
												'content_id'	=> $params['content_id'],
												'type'			=> $params['type'],
												// 'icon'			=> 'ic_launcher'
											)
				);

		$request =  Curl::to($this->config['server_send_url'])
						->withData(json_encode($data))
						->withHeader('Authorization: key='. $this->config['server_key'])
						->withHeader('Content-type: application/json')
        				->post();

		try {

			$value 	= array(
					'fcm_reg_token'		=> json_encode($regId),
					'fcm_log_url'		=> $this->config['server_send_url'],
					'fcm_log_data'		=> json_encode($data),
					'fcm_log_status'	=> '1',
					'fcm_log_response'	=> $request,
					'created_at'		=> date('Y-m-d H:i:s'),
					'updated_at'		=> date('Y-m-d H:i:s')
				);

			// Insert new log
			FCMLog::create($value);

		} catch (Exception $e) {
			die('[FCM] Internal server error');
		}

		if (!empty($request)) {

			$response = json_decode($request);

			// if(array_key_exists('multicast_id', $response) && array_key_exists('failure', $response)){
			if(isset($response->multicast_id) && isset($response->failure)){

				if ($response->failure == 0) {
					$return['status'] 		= 1;
					$return['msg']			= "Success";
					$return['multicast_id'] = $response->multicast_id;
				}
				else{
					$return['msg'] 			= "Error FCM";
					
					if (!empty($response->results[0]->error)) {
						$return['msg']	 	= $response->results[0]->error;
					}
				}
				
			}

		}

		return $return;

	}

	/**
	 * Get Token Registered
	 *
	 * @param
	 * - user_id 		: ID dari user yang akan di cek
	 * 
	 * @return array
	 *
	 */
	private function _getToken($user_id){

		$res = "";

		$getToken = FCMRegistration::where('user_id', '=', $user_id)->get();

		if ($getToken) {

			$tokens = array();

			foreach ($getToken as $token) {
				$tokens[] = $token->fcm_reg_token;
			}

			$res = $tokens;

		}

		return $res;

	}
	
}