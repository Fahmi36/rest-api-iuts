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
	function loginAdmin()
	{
		try {
			$email = $this->input->post('email');
			$token = $this->input->post('token');
			if ($email != null AND $token != NULL) {
				$login = $this->us->loginadmin($email,$token);
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
	function getTimelinePemohon()
	{
		try {
			$id = $this->input->post('code');
			$data = $this->us->cekCodeBangunan($id);
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
	function countside()
	{
		$id = $this->input->post('id');

		$expired = $this->db->get_where('cek_izin',array('status'=>'3','id_pemohon'=>$id))->num_rows();
		$pending = $this->db->get_where('cek_izin',array('status'=>'0','id_pemohon'=>$id))->num_rows();

		$this->db->select('*');
		$this->db->from('cek_izin');
		$this->db->where('cek_izin.id_pemohon', $id);
		$this->db->where_in('status',[1,2]);
		$selesai = $this->db->get();
		$hasilselesai = $selesai->num_rows();
		echo json_encode(array('expired'=>$expired,'pending'=>$pending,'selesai'=>$hasilselesai));
	}
	function SendMessage()
	{
		try {
			$id = $this->input->post('id');
			$pesan = htmlspecialchars($this->input->post('pesan'));
			if ($id != null AND $pesan != null) {
				$res = $this->us->SendMessage($id,$pesan);
			}else{
				$res = $this->returnResultCustom(false,'Pesan tidak boleh kosong');
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function detailPesan()
	{
		try {
			$id = $this->input->post('id');
			$detail = $this->us->detailMessage($id);
			if ($detail) {
				$res = $this->returnResult($detail);
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function ambilPesan()
	{
		try {
			$id = $this->input->post('id');
			$detail = $this->us->AmbilMessage($id);
			if ($detail) {
				$res = $this->returnResult($detail);
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function PemohonSelesai()
	{
		$id = $this->input->post('idbangunan');
		try { 
			$data = array(
				'status_jalan'=>6,
			);
			$where = array(
				'id_slf'=>$id
			);
			$update = $this->db->update('data_slf', $data,$where);
			if ($skor == true) {
				$json = $this->returnResultCustom(true,'Berhasil Simpan Data');
			}else{
				$json = $this->returnResultErrorDB();
			}
		} catch (Exception $e) {
			$json = $this->returnResultErrorDB();
		}
		echo json_encode($json);
	}
	function detailPemohonAdministrasi()
	{
		try {
			$idbangunan = $this->input->post('idizin');
			$detail = $this->us->detailPemohonAdministrasi($idbangunan);
			if ($detail) {
				$res = $this->returnResult($detail);
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function detailPemohonteknis()
	{
		try {
			$id = $this->input->post('id');
			$idbangunan = $this->input->post('idbangunan');
			$detail = $this->us->detailPemohonteknis($idbangunan,$id);
			if ($detail) {
				$res = $this->returnResult($detail);
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function detailPemohonDinas()
	{
		try {
			$id = $this->input->post('id');
			$idbangunan = $this->input->post('idbangunan');
			$detail = $this->us->detailPemohonDinas($idbangunan,$id);
			if ($detail) {
				$res = $this->returnResult($detail);
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function detailPemohonAmbil()
	{
		try {
			$idbangunan = $this->input->post('idbangunan');
			$detail = $this->us->detailPemohonAmbil($idbangunan);
			if ($detail) {
				$res = $this->returnResult($detail);
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
	function KonfirmasiIzin()
	{
		try {
			$idbangunan = $this->input->post('idbangunan');
			$file = $this->input->post('file');
			$detail = $this->us->KonfirmasiPemohon($idbangunan,$file);
			if ($detail) {
				$res = $this->returnResult($detail);
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,$e);
		}
		echo json_encode($res);
	}
}

/* End of file UserController.php */
/* Location: ./application/controllers/UserController.php */