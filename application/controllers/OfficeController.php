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

		$this->load->model('OfficeModel', 'oc');
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
	public function countsideoffice()
	{
		$expired = $this->db->get_where('bangunan_iuts',array('status'=>'3'))->num_rows();
        $pending = $this->db->get_where('bangunan_iuts',array('status'=>'0'))->num_rows();

        $this->db->select('*');
        $this->db->from('bangunan_iuts');
        $this->db->where('status','1');
        $this->db->or_where('status','2');
        $selesai = $this->db->get();
        $hasilselesai = $selesai->num_rows();
        echo json_encode(array('expired'=>$expired,'pending'=>$pending,'selesai'=>$hasilselesai));
	}
	function getDataSemua()
	{
		try {
            $data = $this->oc->getAll();
        } catch (Exception $e) {
            throw $e;
        }
        echo json_encode($data);
	}
	function getDataJalan()
	{
		try {
            $data = $this->oc->getAllJalan();
        } catch (Exception $e) {
            throw $e;
        }
        echo json_encode($data);
	}
}

/* End of file OfficeController.php */
/* Location: ./application/controllers/OfficeController.php */