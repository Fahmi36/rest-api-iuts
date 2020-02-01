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
		$kelengkapan = $this->input->post('kelengkapan_admin');
		$lama = $this->input->post('lama_mengajukan');
		$npwp = $this->input->post('statusNPWP');
		$pbb = $this->input->post('statusPBB');
		$keterangan = $this->input->post('keterangan');
		$cek = $this->oc->cekAdministrasi($bangunan);

		if ($kelengkapan == '1') {
			$skorlengkap = 0;
		}elseif ($kelengkapan == '2') {
			$skorlengkap = 1;
		}elseif($kelengkapan == '3'){
			$skorlengkap = 2;
		}else if($kelengkapan == '4'){
			$skorlengkap = 3;
		}else{
			$skorlengkap = 0;
		}

		if ($lama == '1') {
			$skorlama = 0;
		}elseif ($lama == '2') {
			$skorlama = 1;
		}elseif($lama == '3'){
			$skorlama = 2;
		}else if($lama == '4'){
			$skorlama = 3;
		}else{
			$skorlama = 0;
		}

		if ($npwp == '1') {
			$skornpwp = 0;
		}elseif ($npwp == '2') {
			$skornpwp = 1;
		}elseif($npwp == '3'){
			$skornpwp = 2;
		}else if($npwp == '4'){
			$skornpwp = 3;
		}else{
			$skornpwp = 0;
		}
		if ($pbb == '1') {
			$skorpbb = 0;
		}elseif ($pbb == '2') {
			$skorpbb = 1;
		}elseif($pbb == '3'){
			$skorpbb = 2;
		}else if($pbb == '4'){
			$skorpbb = 3;
		}else{
			$skorpbb = 0;
		}

		$skor = ($skorlengkap + $skorlama + $skornpwp + $skorpbb / 4);

		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id;
            $where = array(
                'id_bangunan' => $bangunan,
            );
            $array = array(
            'kelengkapan' => $kelengkapan,
            'lama_waktu' => $lama,
            'status_pbb' => $pbb,
            'status_npwp' => $npwp,
            'total_skor' => $skor,
            'keterangan' => $keterangan,
            'updated_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('administrasi',$array,$where);
		}else{
			$q = $this->oc->InsertAdministrasi($bangunan,$kelengkapan,$lama,$npwp,$pbb,$skor,$keterangan);
		}
        if ($q == true) {
			$data = array(
				'status_jalan'=>1,
			);
			$where = array(
                'id_bangunan' => $bangunan,
            );
			$update = $this->db->update('bangunan_iuts', $data,$where);
			if ($update == true) {
				$json = $this->returnResultCustom(true,'Berhasil Simpan Data');
          	}else{
          		$json = $this->returnResultErrorDB();
          	}
		}else{
          	$json = $this->returnResultErrorDB();
		}
		echo json_encode($json);
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
		if ($q == true) {
			$data = array(
				'status_jalan'=>2,
			);
			$update = $this->db->update('bangunan_iuts', $data,$where);
			if ($update == true) {
				$json = $this->returnResultCustom(true,'Berhasil Simpan Data');
          	}else{
          		$json = $this->returnResultErrorDB();
          	}
		}else{
          	$json = $this->returnResultErrorDB();
		}
		echo json_encode($json);

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
        if ($q == true) {
			$data = array(
				'status_jalan'=>3,
			);
			$update = $this->db->update('bangunan_iuts', $data,$where);
			if ($update == true) {
				$json = $this->returnResultCustom(true,'Berhasil Simpan Data');
          	}else{
          		$json = $this->returnResultErrorDB();
          	}
		}else{
          	$json = $this->returnResultErrorDB();
		}
		echo json_encode($json);
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
			if ($code != null) {
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