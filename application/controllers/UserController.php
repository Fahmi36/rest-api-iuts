<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

class UserController extends CI_Controller {

	function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin:*');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

		$this->load->model('UserModel', 'us');
	}
	function returnResult($data)
	{
		$result = array(
			'success'=>true,
			'rowCount'=>$data->num_rows(),
			'row'=>$data->result()
		);
		return $result;
	}

	function returnResultErrorDB()
	{
		return array(
			'success'=>false,
			'msg'=>'Failed fetch data from database'
		);
	}
	function returnResultCustom($t,$msg)
	{
		return array(
			'success'=>$t,
			'msg'=>$msg
		);
	}
	function loginPemohon()
	{
		try {
			$email = $this->input->post('email');
			$token = $this->input->post('token');
			if ($email != null AND $token != NULL) {
				$login = $this->us->loginuser();
				if ($login) {
					$res = $this->returnResult($login);
				}else{
					$res = $this->returnResultCustom(False,'Password anda salah');
				}
			}else{
				$res = $this->returnResultCustom(False,'Email dan Token Tidak Boleh Kosong');
			}
			echo json_encode($res);
		} catch (Exception $e) {
			
		}
	}

}

/* End of file UserController.php */
/* Location: ./application/controllers/UserController.php */