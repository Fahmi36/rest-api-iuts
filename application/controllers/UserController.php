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
				$login = $this->us->loginuser($email,$token);
				if ($login) {
					$res = $this->returnResult($login);
				}else{
					$res = $this->returnResultCustom(False,'Password anda salah');
				}
			}else{
				$res = $this->returnResultCustom(False,'Email dan Token Tidak Boleh Kosong');
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function loginemail()
	{
		try {
			$token = $this->input->get('token');
			if ($token != NULL) {
				$login = $this->us->loginemail($token);
				if ($login) {
					$res = $this->returnResult($login);
				}else{
					$res = $this->returnResultCustom(False,'Password anda salah');
				}
			}else{
				$res = $this->returnResultCustom(False,'Email dan Token Tidak Boleh Kosong');
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function listPermohonan()
	{
		try {
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			$start = $this->input->post('start');
			$offset = $this->input->post('offset');
			$data = $this->us->listPermohonan($id,$status,$start,$offset);
			if ($data->num_rows()>0) {
				$res = $this->returnResult($data);
			}else{
				$res = $this->returnResultCustom(false,'Tidak ada data');
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}

		echo json_encode($res);
	}
	function detailPermohonan()
	{
		try {
			$id = $this->input->post('id');
			$idbangunan = $this->input->post('idbangunan');
			$code = $this->input->post('code');
			$data = $this->us->detailPermohonan($id,$idbangunan,$code);
			$res = $this->returnResult($data);
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);

	}
}

/* End of file UserController.php */
/* Location: ./application/controllers/UserController.php */