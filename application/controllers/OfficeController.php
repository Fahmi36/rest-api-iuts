<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

class OfficeController extends CI_Controller {

	function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin:*');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

		$this->load->model('MatriksModel', 'mm');
		$this->load->model('UsersModel', 'um');
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
	function detailBangunan()
	{
		try {
			$this->detailPermohonanAdmin($id_bangunan,$code);
		} catch (Exception $e) {
			
		}
	}

}

/* End of file OfficeController.php */
/* Location: ./application/controllers/OfficeController.php */