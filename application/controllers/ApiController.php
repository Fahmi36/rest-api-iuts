<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
class ApiController extends CI_Controller {
	function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin:*');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
	}
	function ApiPajakNPWP()
	{
		$id = $this->input->post('nik');
		$nopd = $this->input->post('nopd');
		$jns_pajak = $this->input->post('jenispajak');
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://soadki.jakarta.go.id/rest/com/gov/dki/ws/TAX?NIKNPWP=".$id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"authorization: Basic cHRzcHVzZXI6cHRzcHVzZXI=",
				"cache-control: no-cache",
				"postman-token: 3fb9f1ce-021d-9f3f-be58-df9fc595a90b"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo json_encode(array('success'=>false,'msg'=>'Server Sedang Bermasasalah'));
		} else {
			echo $response;
		}
	}
}

/* End of file ApiController.php */
/* Location: ./application/controllers/ApiController.php */