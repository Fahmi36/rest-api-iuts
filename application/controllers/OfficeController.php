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
	function CountSideAdmin()
	{
		$expired = $this->db->get_where('data_slf',array('status'=>3,'id_pemohon'=>$id))->num_rows();
		$pending = $this->db->get_where('data_slf',array('status'=>0,'id_pemohon'=>$id))->num_rows();

		$this->db->select('*');
		$this->db->from('data_slf');
		$this->db->where('data_slf.id_pemohon', $id);
		$this->db->where_in('status',[1,2]);
		$selesai = $this->db->get();
		$hasilselesai = $selesai->num_rows();
		echo json_encode(array('expired'=>$expired,'pending'=>$pending,'selesai'=>$hasilselesai));
	}
	function CountTugasAdmin()
	{
		$id = $this->input->post('id');
		if ($id == '1') {
			$status = 1;// Dinas
		}else if ($id == '2') {
			$status = 0;// Teknis
		}else if ($id == '3'){
			$status = 2;// Admin
		}
		$expired = $this->db->get_where('data_slf',array('status_jalan'=>$status,'id_pemohon'=>$id))->num_rows();
		$pending = $this->db->get_where('data_slf',array('status_jalan'=>$status,'id_pemohon'=>$id))->num_rows();
		$this->db->select('*');
		$this->db->from('data_slf');
		$this->db->where('data_slf.id_pemohon', $id);
		$this->db->where_in('status_jalan',4);
		$selesai = $this->db->get();
		$hasilselesai = $selesai->num_rows();
		echo json_encode(array('expired'=>$expired,'pending'=>$pending,'selesai'=>$hasilselesai));
	}
	function InsertAdminTeknis()
	{
		$id_bangunan = $this->input->post('id_bangunan');
		$admin = $this->input->post('admin');
		$lahansekitar = $this->input->post('lahansekitar');
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

		$skor = ($skorpasar + $skortusah + $skorlahan)/3;

		$cek = $this->oc->cekTeknis($id_bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id_teknis;
            $where = array(
                'id_teknis' => $id,
            );
            $array = array(
            'id_pasar' => $statuspasar,
            'id_jarak' => $statususaha,
            'id_lahan' => $lahansekitar,
            'keterangan' => $keterangan,
            'total_skor' => $skor,
            'updated_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('admin_teknis',$array,$where);
		}else{
			$q = $this->oc->InsertAdminTeknis($id_bangunan,$admin,$lahansekitar,$statususaha,$statuspasar,$keterangan,$skor);
		}
		if ($q == true) {
			$wherebangun = array(
                'id_izin' => $id_bangunan,
            );
			$data = array(
				'status_jalan'=>2,
			);
			$update = $this->db->update('cek_izin', $data,$wherebangun);
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
		$skoriuts = $this->input->post('skoriuts');
		$skorslf = $this->input->post('skorslf');
		$status = $this->input->post('status');
		$cek = $this->oc->cekDinas($bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id_dinas;
            $where = array(
                'id_izin' => $bangunan,
            );
            $array = array(
            'keterangan' => $keterangan,
            'status' => $status,
            'skorakhirslf' => $skorslf,
            'skorakhiriuts' => $skoriuts,
            'updated_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('admindinas',$array,$where);
		}else{
			$q = $this->oc->InsertAdminDinasBaru($bangunan,$id_admin,$keterangan,$status,$skorslf,$skoriuts);
		}
        if ($q == true) {
        	if ($status == 5) {
        		$statusweb = 2;
        	}elseif ($status == 6) {
        		$statusweb = 2;
        	}elseif ($status == 3) {
        		$statusweb = 1;
        	}else{
        		$statusweb = 2;
        	}
        	$where = array(
                'id_izin' => $bangunan,
            );
			$data = array(
				'status_jalan'=>$status,
				'status'=>$statusweb,

			);
			$update = $this->db->update('cek_izin', $data,$where);
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
		$jam = $this->input->post('jam');
		$cek = $this->oc->cekSurat($bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id_janji;
            $where = array(
                'id_bangunan' => $bangunan,
            );
            $array = array(
	            'tanggal' => $tgl,
	            'tgl_ambil' => $tgl,
	            'jam' => $jam,
	            'updated_at' => date('Y-m-d H:i:s'),
        	);
            $q = $this->db->update('janjian',$array,$where);
		}else{
			$q = $this->oc->InsertSurat($bangunan,$id_admin,$tgl,$jam);
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
		$expired = $this->db->get_where('cek_izin',array('status'=>'3'))->num_rows();
		$pending = $this->db->get_where('cek_izin',array('status'=>'0'))->num_rows();
		$tolak = $this->db->get_where('cek_izin',array('status_jalan'=>'5'))->num_rows();
		$all = $this->db->get('cek_izin')->num_rows();

		$this->db->select('*');
		$this->db->from('cek_izin');
		$this->db->where('status',1);
		$selesai = $this->db->get();
		$hasilselesai = $selesai->num_rows();
		echo json_encode(array('expired'=>$expired,'pending'=>$pending,'selesai'=>$hasilselesai,'tolak'=>$tolak,'all'=>$all));
	}
	public function countsidelevel()
	{
		if ($this->input->post('level') == '1') {
			$hitung = $this->db->get_where('cek_izin',array('status'=>'3'))->num_rows();
		}elseif ($this->input->post('level') == '2') {
			$hitung = $this->db->get_where('cek_izin',array('status'=>'3'))->num_rows();
		}else{
			$hitung = $this->db->get_where('cek_izin',array('status'=>'3'))->num_rows();
		}
		echo json_encode(array('hitung'=>$hitung));
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
	function downloadpdf($id)
	{
		
		$tcpdf = new setasign\Fpdi\Tcpdf\Fpdi;
		if ($id == null) {
        	$html = $this->load->view('errors/error_404',[], true);
        	$tcpdf->WriteHTML($html);
			return $tcpdf->Output('test.pdf','D');
		}else{
		$newP12 = openssl_pkcs12_read(file_get_contents(site_url('assets/sertifikat/JAKEVO.p12')), $results, "AJ102938++!");
	    	if ($newP12){
	    		// set margins
	    		$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	    		$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	    		$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	    		$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	    		$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	    		$filename = str_replace(' ','','SuratSKIUTS' . date('YmdHis') . '.pdf'); 
				$data['datauser'] = $this->oc->cekPemohon($id);
				$data['janji'] = $this->oc->cekSurat($id);
				$data['kewajiban'] = $this->oc->detailKewajiban();
				$data['larangan'] = $this->oc->detailLarangan();
				$data['bawa'] = $this->oc->detailPermohonanAdminDinas($id);
    			$tcpdf->AddPage();
		        $html = $this->load->view('pages/suratsk',$data, true);
		        $tcpdf->WriteHTML($html);
    			$info = array(
		        	'Name' => 'DPMPTSP DKI JAKARTA',
		        	'Location' => 'DPMPTSP DKI JAKARTA',
		        	'Reason' => 'Verified Berkas',
		        	'ContactInfo' => site_url('/'),
    			);    		
    			$taut='https://perizinan.jakarta.go.id/'; 
				$tcpdf->write2DBarcode($taut, 'QRCODE,H', 20,90,20,20);
      			$tcpdf->setSignature($results['cert'], $results['pkey'], 'AJ102938++!', '', 2, $info); 
      			$tcpdf->Image(base_url('assets/sertifikat/tte4.jpg'), 117, 201, 60, 18, 'PNG'); 
      			$tcpdf->setSignatureAppearance(117, 201, 60, 18);
		        $html = $this->load->view('pages/klausul',$data, true);
		        $tcpdf->WriteHTML($html);
		        $html = $this->load->view('pages/bawaberkas',$data, true);
		        $tcpdf->WriteHTML($html);
      			// return var_dump($data['barcode']);
				$tcpdf->Output($filename, 'I'); 
				// ob_end_clean();
		    }
		}
		
	}
	function downloadpdfslf($id)
	{
		
		$tcpdf = new setasign\Fpdi\Tcpdf\Fpdi;
		if ($id == null) {
        	$html = $this->load->view('errors/error_404',[], true);
        	$tcpdf->WriteHTML($html);
			return $tcpdf->Output('test.pdf','D');
		}else{
		$newP12 = openssl_pkcs12_read(file_get_contents(site_url('assets/sertifikat/JAKEVO.p12')), $results, "AJ102938++!");
	    	if ($newP12){
	    		$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	    		$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	    		$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	    		$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	    		$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	    		$filename = str_replace(' ','','SuratSKSLF' . date('YmdHis') . '.pdf'); 
				$data['datauser'] = $this->oc->cekPemohon($id);
				$data['janji'] = $this->oc->cekSurat($id);
				$data['kewajiban'] = $this->oc->detailKewajiban();
				$data['larangan'] = $this->oc->detailLarangan();
				$data['bawa'] = $this->oc->detailPermohonanAdminDinas($id);
    			$tcpdf->AddPage();
		        $html = $this->load->view('pages/suratsk_slf',$data, true);
		        $tcpdf->WriteHTML($html);
    			$info = array(
		        	'Name' => 'DPMPTSP DKI JAKARTA',
		        	'Location' => 'DPMPTSP DKI JAKARTA',
		        	'Reason' => 'Verified Berkas',
		        	'ContactInfo' => site_url('/'),
    			);    		
    			$taut='https://perizinan.jakarta.go.id/'; 
				$tcpdf->write2DBarcode($taut, 'QRCODE,H', 20,30,20,20);
      			$tcpdf->setSignature($results['cert'], $results['pkey'], 'AJ102938++!', '', 2, $info);
      			$tcpdf->Image(base_url('assets/sertifikat/tte4.jpg'), 117, 201, 60, 18, 'PNG');  
      			$tcpdf->setSignatureAppearance(117, 201, 60, 18);
		        $html = $this->load->view('pages/lampiran1',$data, true);
		        $tcpdf->WriteHTML($html);
		        $html = $this->load->view('pages/lampiran2',$data, true);
		        $tcpdf->WriteHTML($html);
		        $html = $this->load->view('pages/lampiran3',$data, true);
		        $tcpdf->WriteHTML($html);
		        $html = $this->load->view('pages/lampiran4slf',$data, true);
		        $tcpdf->WriteHTML($html);
		        $html = $this->load->view('pages/lampiran5slf',$data, true);
		        $tcpdf->WriteHTML($html);
		        $html = $this->load->view('pages/bawaberkasslf',$data, true);
		        $tcpdf->WriteHTML($html);
      			// return var_dump($html);
				$tcpdf->Output($filename, 'I'); 
				// ob_end_clean();
		    }
		}
		
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
	function getBangunanDetail()
	{
		try {
			$code= $this->input->post('code');
			if ($code != null) {
				$data = $this->oc->cekPemohon($code);
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
	function getAllFoto()
	{
		try {
			$code= $this->input->post('code');
			if ($code != null) {
				$data = $this->oc->cekFotoPemohon($code);
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
	function VerifyFoto()
	{
		try {
			$idfoto = $this->input->post('idfoto');
			$data = $this->oc->VerifFoto($idfoto);
			if ($data) {
				$res = $this->returnResult($data);
			}else{
				$res = $this->returnResultErrorDB();
			}
		} catch (Exception $e) {
			$res = $this->returnResultCustom(false,'Tidak ada data');
		}
		echo json_encode($res);
	}
	function Tolak($value='')
	{
		# code...
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