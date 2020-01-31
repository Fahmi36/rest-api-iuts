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
	function InsertAdministrasi()
	{
		$bangunan = $this->input->post('id_bangunan');
		$kelengkapan = $this->input->post('id_bangunan');
		$lama = $this->input->post('id_bangunan');
		$kondisi = $this->input->post('id_bangunan');
		$pbb = $this->input->post('id_bangunan');
		$npwp = $this->input->post('id_bangunan');
		$skor = $this->input->post('id_bangunan');
		$keterangan = $this->input->post('id_bangunan');
		$cek = $this->oc->cekAdministrasi($bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id;
            $where = array(
                'id_bangunan' => $bangunan,
            );
            $array = array(
            'kelengkapan' => $kelengkapan,
            'lama_waktu' => $lama,
            'kondisi_eksisting' => $kondisi,
            'status_pbb' => $pbb,
            'status_npwp' => $npwp,
            'total_skor' => $skor,
            'keterangan' => $keterangan,
            'updated_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('administrasi',$array,$where);
		}else{
			$q = $this->oc->InsertAdministrasi($bangunan,$kelengkapan,$lama,$kondisi,$pbb,$npwp,$skor,$keterangan);
		}
        return $q;
	}
	function InsertAdminTeknis()
	{
		$bangunan = $this->input->post('id_bangunan');
		$pasar = $this->input->post('id_bangunan');
		$rencana = $this->input->post('id_bangunan');
		$rencana_eksis = $this->input->post('id_bangunan');
		$tata_ruang = $this->input->post('id_bangunan');
		$jarak = $this->input->post('id_bangunan');
		$lahan = $this->input->post('id_bangunan');
		$keterangan = $this->input->post('id_bangunan');
		$skor = $this->input->post('id_bangunan');
		$cek = $this->oc->cekTeknis($bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id;
            $where = array(
                'id_bangunan' => $bangunan,
            );
            $array = array(
            'id_pasar' => $pasar,
            'id_rencana' => $rencana,
            'id_rencana_eksisting' => $rencana_eksis,
            'id_tata_ruang' => $tata_ruang,
            'id_jarak' => $jarak,
            'id_lahan' => $lahan,
            'keterangan' => $keterangan,
            'total_skor' => $skor,
            'updated_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('admin_teknis',$array,$where);
		}else{
			$q = $this->oc->InsertAdminTeknis($bangunan,$pasar,$rencana,$rencana_eksi,$tata_ruang,$jarak,$lahan,$keteranga,$skor,$cek);
		}
        return $q;
	}
	function InsertAdminDinas()
	{
		$bangunan = $this->input->post('id_bangunan');
		$keterangan = $this->input->post('id_bangunan');
		$status = $this->input->post('id_bangunan');
		$cek = $this->oc->cekDinas($bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id;
            $where = array(
                'id_bangunan' => $bangunan,
            );
            $array = array(
            'keterangan' => $keterangan,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('admindinas',$array,$where);
		}else{
			$q = $this->oc->InsertAdminDinas($bangunan,$keterangan,$status);
		}
        return $q;
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
	function getAllChat()
	{
		try {
			$iduser= $this->input->post('id');
			if ($iduser == null) {
				$data = $this->oc->CekPesan($iduser);
				if ($data) {
					$res = $this->returnResult($data);
				}else{
					$res = $this->returnResultErrorDB();
				}
			}else{
				$res = $this->returnResultCustom(false,'Tidak ada data');
			}

		} catch (Exception $e) {
			throw $e;
		}
		echo json_encode($res);
	}
	function getDetailChat()
	{
		try {
			$idpesan= $this->input->post('id');
			if ($idpesan == null) {
				$data = $this->oc->DetailPesan($idpesan);
				if ($data) {
					$res = $this->returnResult($data);
				}else{
					$res = $this->returnResultErrorDB();
				}
			}else{
				$res = $this->returnResultCustom(false,'Tidak ada data');
			}

		} catch (Exception $e) {
			throw $e;
		}
		echo json_encode($res);
	}
	function getBangunan()
	{
		try {
			$code= $this->input->post('code');
			if ($code == null) {
				$data = $this->oc->DetailBangunan($code);
				if ($data) {
					$res = $this->returnResult($data);
				}else{
					$res = $this->returnResultErrorDB();
				}
			}else{
				$res = $this->returnResultCustom(false,'Tidak ada data');
			}

		} catch (Exception $e) {
			throw $e;
		}
		echo json_encode($res);
	}
}

/* End of file OfficeController.php */
/* Location: ./application/controllers/OfficeController.php */