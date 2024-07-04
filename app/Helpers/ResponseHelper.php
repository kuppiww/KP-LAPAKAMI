<?php
/** 
 * Response Helpers
 * 
 * 
 */
namespace App\Helpers;

class ResponseHelper
{

	/**
	 * Set response to client
	 *
	 * @param number $code : http response code
	 * @param string $msg : message for response api
	 * @param array $result : data resutl for response api
	 * @param array $paging : data resutl for response api
	 * 
	 * @return json
	 *
	 */
	public static function setResponse($code = 200, $msg = '', $result = null, $paging = null)
	{

		$response = array(
			'code' => (int) $code,
			'status' => self::_getStatus($code),
			'message' => 'Success',
			'result' => null,
			'time' => date('Y-m-d H:i:s')
		);

		if ($msg != '') {
			$response['message'] = $msg;
		}

		if (!empty($result)) {
			$response['result'] = $result;
		}

		if (!empty($paging)) {
			$response['paging'] = $paging;
		}

		http_response_code($code);

		self::_returnJson($response);

	}

	/**
	 * Show json response
	 *
	 * @param array $data : array of data will be encode
	 * 
	 * @return json
	 *
	 */
	private static function _returnJson($data)
	{

		header('Content-Type: application/json');
		echo json_encode($data, JSON_PRETTY_PRINT);
		exit;

	}

	/**
	 * Get status description
	 *
	 * @param number $code : http status code
	 * 
	 * @return json
	 *
	 */
	private static function _getStatus($code)
	{

		switch ($code) {
			case 200:
				$status = "OK";
				break;

			case 201:
				$status = "CREATED";
				break;

			case 204:
				$status = "EMPTY";
				break;

			case 400:
				$status = "BAD_REQUEST";
				break;

			case 401:
				$status = "UNAUTHORIZED";
				break;

			case 403:
				$status = "FORBIDDEN";
				break;

			case 404:
				$status = "NOT_FOUND";
				break;

			case 406:
				$status = "INVALID_CLIENT";
				break;

			case 500:
				$status = "INTERNAL_SERVER_ERROR";
				break;

			default:
				$status = "INTERNAL_SERVER_ERROR";
				break;
		}

		return $status;

	}

}

?>