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
	function getWilayah(){

		$search = $this->input->post('wilayah');
		$this->db->select('p.id as idprovinsi,r.id as idkota,d.id as idkecamatan , v.id as idkelurahan,concat(p.name,",",r.name,",",d.name,",",v.name) as address ');
		$this->db->from('provinces p');
		$this->db->join('regencies r', 'r.province_id = p.id', 'INNER');
		$this->db->join('districts d', 'd.regency_id = r.id', 'INNER');
		$this->db->join('villages v', 'v.district_id = d.id', 'INNER');
		$this->db->like('r.name', $search, 'after');
		$this->db->or_like('d.name', $search, 'after');
		$this->db->or_like('v.name', $search, 'after');
		$this->db->where('p.id', 31);
		$q = $this->db->get();
		echo json_encode(array('data'=>$q->result()));
	}
	function pilihWilayah(){

		$search = $this->input->post('idkelurahan');
		$this->db->select('p.id as idprovinsi,r.id as idkota,d.id as idkecamatan , v.id as idkelurahan,concat(p.name,",",r.name,",",d.name,",",v.name) as address ');
		$this->db->from('provinces p');
		$this->db->join('regencies r', 'r.province_id = p.id', 'INNER');
		$this->db->join('districts d', 'd.regency_id = r.id', 'INNER');
		$this->db->join('villages v', 'v.district_id = d.id', 'INNER');
		$this->db->where('v.id', $search);
		$q = $this->db->get();
		echo json_encode($q->result());
	}
	function cektoken()
	{
		$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://jakevo.jakarta.go.id/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: 446c0170-6b58-16ba-202e-a0963e2160a8"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            
        $pecah = explode('<input type="hidden" name="_token" value="',$response);
        $pecah2 = explode('">',$pecah[1]);
        $result = $pecah2[0];
        echo $result;
        }
	}
	function loginname()
	{

		$namatoken  = $this->input->post('token');
	    $token = $this->cektoken();
	    $email = $this->input->post('email');
	    $password = $this->input->post('password');
	   // return $token;
		$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://jakevo.jakarta.go.id/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "email=".$email."&_token=".$token."&password=".$password."",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "postman-token: 7dcf2a49-5854-acc9-5b84-b1a1ddf0498e"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
	}
	function getAddresses($domain) {
		$records = dns_get_record($domain);
		$res = array();
		foreach ($records as $r) {
            if ($r['host'] != $domain) continue; // glue entry
            if (!isset($r['type'])) continue; // DNSSec

            if ($r['type'] == 'A') $res[] = $r['ip'];
            if ($r['type'] == 'AAAA') $res[] = $r['ipv6'];
        }
        return $res;
    }
    function getAddresses_www($domain) {
    	$res = getAddresses($domain);
    	if (count($res) == 0) {
    		$res = getAddresses('www.' . $domain);
    	}
    	for ($i=0; $i < count($res) ; $i++) { 
    		$hasil = $res[$i];
    	}
    	return $hasil;
    }
    function ApiPajakNPWP()
    {
    	$alamat = $_SERVER['HTTP_REFERER'];
    	$hasil = $this->getAddresses_www($alamat);
    	if ($hasil == '45.13.133.94' OR $hasil == '127.0.0.1') {
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
    	}else{
    		$json = $this->returnResultCustom(false,'Tidak Boleh Akses');
    		echo json_encode($json);
    	}
    }
}

/* End of file ApiController.php */
/* Location: ./application/controllers/ApiController.php */