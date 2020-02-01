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
		$id_admin = $this->input->post('admin');
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

		$skor = ($skorlengkap + $skorlama + $skornpwp + $skorpbb)/4;

		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id_administrasi;
            $where = array(
                'id_administrasi' => $id,
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
			$q = $this->oc->InsertAdministrasi($bangunan,$id_admin,$kelengkapan,$lama,$npwp,$pbb,$skor,$keterangan);
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
		$id_bangunan = $this->input->post('id_bangunan');
		$admin = $this->input->post('admin');
		$lahansekitar = $this->input->post('lahansekitar');
		$rencanajalan = $this->input->post('rencanajalan');
		$eksitingjalan = $this->input->post('eksitingjalan');
		$tataruang = $this->input->post('tataruang');
		$statususaha = $this->input->post('statususaha');
		$statuspasar = $this->input->post('statuspasar');
		$keterangan = $this->input->post('keterangan');

		if ($lahansekitar == '1') {
			$skorlahan = 0;
		}elseif ($lahansekitar == '2') {
			$skorlahan = 1;
		}elseif($lahansekitar == '3'){
			$skorlahan = 2;
		}else if($lahansekitar == '4'){
			$skorlahan = 3;
		}else{
			$skorlahan = 0;
		}

		if ($rencanajalan == '1') {
			$skorrenjalan = 0;
		}elseif ($rencanajalan == '2') {
			$skorrenjalan = 1;
		}elseif($rencanajalan == '3'){
			$skorrenjalan = 2;
		}else if($rencanajalan == '4'){
			$skorrenjalan = 3;
		}else{
			$skorrenjalan = 0;
		}

		if ($eksitingjalan == '1') {
			$skoreksijalan = 0;
		}elseif ($eksitingjalan == '2') {
			$skoreksijalan = 1;
		}elseif($eksitingjalan == '3'){
			$skoreksijalan = 2;
		}else if($eksitingjalan == '4'){
			$skoreksijalan = 3;
		}else{
			$skoreksijalan = 0;
		}

		if ($tataruang == '1') {
			$skortata = 0;
		}elseif ($tataruang == '2') {
			$skortata = 1;
		}elseif($tataruang == '3'){
			$skortata = 2;
		}else if($tataruang == '4'){
			$skortata = 3;
		}else{
			$skortata = 0;
		}

		if ($statususaha == '1') {
			$skortusah = 0;
		}elseif ($statususaha == '2') {
			$skortusah = 1;
		}elseif($statususaha == '3'){
			$skortusah = 2;
		}else if($statususaha == '4'){
			$skortusah = 3;
		}else{
			$skortusah = 0;
		}

		if ($statuspasar == '1') {
			$skorpasar = 0;
		}elseif ($statuspasar == '2') {
			$skorpasar = 1;
		}elseif($statuspasar == '3'){
			$skorpasar = 2;
		}else if($statuspasar == '4'){
			$skorpasar = 3;
		}else{
			$skorpasar = 0;
		}

		$skor = ($skorpasar + $skorrenjalan + $skoreksijalan + $skortata + $skortusah + $skorlahan)/6;

		$cek = $this->oc->cekTeknis($id_bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id_teknis;
            $where = array(
                'id_teknis' => $id,
            );
            $array = array(
            'id_pasar' => $statuspasar,
            'id_rencana' => $rencanajalan,
            'id_rencana_eksisting' => $eksitingjalan,
            'id_tata_ruang' => $tataruang,
            'id_jarak' => $statususaha,
            'id_lahan' => $lahansekitar,
            'keterangan' => $keterangan,
            'total_skor' => $skor,
            'updated_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('admin_teknis',$array,$where);
		}else{
			$q = $this->oc->InsertAdminTeknis($id_bangunan,$admin,$lahansekitar,$rencanajalan,$eksitingjalan,$tataruang,$statususaha,$statuspasar,$keterangan,$skor);
		}
		if ($q == true) {
			$wherebangun = array(
                'id_bangunan' => $id_bangunan,
            );
			$data = array(
				'status_jalan'=>2,
			);
			$update = $this->db->update('bangunan_iuts', $data,$wherebangun);
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
		$id_admin = $this->input->post('admin');
		$keterangan = $this->input->post('keterangan');
		$skor = $this->input->post('skor');
		$status = $this->input->post('status');
		$cek = $this->oc->cekDinas($bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id_dinas;
            $where = array(
                'id_bangunan' => $bangunan,
            );
            $array = array(
            'keterangan' => $keterangan,
            'status' => $status,
            'skor_akhir' => $skor,
            'updated_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('admindinas',$array,$where);
		}else{
			$q = $this->oc->InsertAdminDinasBaru($bangunan,$id_admin,$keterangan,$status,$skor);
		}
        if ($q == true) {
        	if ($status == 1) {
        		$status_bangun = 4;
        		$statusweb = 1;
        	}else{
        		$status_bangun = 5;
        		$statusweb = 2;
        	}
        	$where = array(
                'id_bangunan' => $bangunan,
            );
			$data = array(
				'status_jalan'=>$status_bangun,
				'status'=>$statusweb,

			);
			$update = $this->db->update('bangunan_iuts', $data,$where);
			if ($update == true) {
        		$this->sendmail($bangunan);
				$json = $this->returnResultCustom(true,'Berhasil Simpan Data');
          	}else{
          		$json = $this->returnResultErrorDB();
          	}
		}else{
          	$json = $this->returnResultErrorDB();
		}
		echo json_encode($json);
	}
	function InsertSuratKuasa()
	{
		$bangunan = $this->input->post('id_bangunan');
		$id_admin = $this->input->post('admin');
		$tgl = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$cek = $this->oc->cekSurat($bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id_janji;
            $where = array(
                'id_bangunan' => $bangunan,
            );
            $array = array(
	            'id_bangunan' => $bangunan,
	            'tanggal' => $tgl,
	            'updated_at' => date('Y-m-d H:i:s'),
        	);
            $q = $this->db->update('janjian',$array,$where);
		}else{
			$q = $this->oc->InsertSurat($bangunan,$id_admin,$tgl);
		}
        if ($q == true) {
			$json = $this->returnResultCustom(true,'Berhasil Simpan Data');
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
	public function detailBangunanDinas()
	{
		try {
			$idbangun= $this->input->post('id');
			if ($idbangun != null) {
				$data = $this->oc->detailPermohonanAdminDinas($idbangun);
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
	function sendmail($idbangun)
	{
        $dPemohon = $this->oc->cekPemohon($idbangun);
        $result = $this->returnResult($dPemohon);
        $json = json_encode($result);
        $decoder = json_decode($json);
        if($decoder->rowCount>0){
            $decodeData = $decoder->row[0];
            $emailpemohon = $decodeData->email;
            $data = array();
            $data['data'] = $decodeData;
            $data['title'] = "Detail Permohonan Izin";
            $config = array(
             'protocol'  => 'mail',
             'smtp_host' => 'mail.perizinan.pkkmart.com',
             'smtp_port' => 587,
             'smtp_user' => 'cs@perizinan.pkkmart.com',
             'smtp_pass' => 'goodgame001',
             'mailtype'  => 'html',
             'wordwrap'  => TRUE,
             'charset'   => 'utf-8',
             'priority'  => 1
         );
            $this->email->initialize($config);

            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $mesg = $this->load->view('pages/mailselesai', $data, true);
            $this->email->to($emailpemohon);
            $this->email->from('cs@perizinan.pkkmart.com', 'Perizinan DKI');
            $this->email->reply_to('cs@perizinan.pkkmart.com', 'Perizinan DKI');

            $this->email->subject($data['title'] . ' - Perizinan DKI');
            $this->email->message($mesg);
            if ($this->email->send()) {
                    $result = $this->returnResultCustom(true,'Success send mail');
                } else {
                    $result = $this->returnResultCustom(false,'Failed to send mail '. $this->email->print_debugger());
                }
        }else{
            $result = $this->returnResultCustom(false,'Tidak ditemukan data dengan nomor token '.$token);
        }
    }
}

/* End of file OfficeController.php */
/* Location: ./application/controllers/OfficeController.php */