<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

class ValidasiController extends CI_Controller {

	function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin:*');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

		$this->load->model('MainModel', 'mm');
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
	function incrementalHash($len = 6){
        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $base = strlen($charset);
        $result = '';

        $now = explode(' ', microtime())[1];
        while ($now >= $base){
          $i = $now % $base;
          $result = $charset[$i] . $result;
          $now /= $base;
        }
        return substr($result, -6);
    }
    function randstr ($len=4, $abc="aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789") {
        $letters = str_split($abc);
        $str = "";
        for ($i=0; $i<=$len; $i++) {
            $str .= $letters[rand(0, count($letters)-1)];
        };
        return $str;
    }
	function getallSelect()
	{
		try {
			$table = $this->input->get('table');
			$query = $this->mm->getSelect($table);
			if ($query) {
				$json = $this->returnResult($query);
			}else{
				$json = $this->returnResultErrorDB();
			}
		} catch (Exception $e) {
			$json = $this->returnResultCustom(false,$e);
		}
		echo json_encode($json);
	}
    function getNilai()
    {
        try {
            $table = $this->input->get('table');
            $id = $this->input->get('id');
            $query = $this->mm->getSelectNilai($id,$table);
            if ($query) {
                $json = $this->returnResult($query);
            }else{
                $json = $this->returnResultErrorDB();
            }
        } catch (Exception $e) {
            $json = $this->returnResultCustom(false,$e);
        }
        echo json_encode($json);
    }
	function ValidasiIzin()
	{
		try {
            $json = json_decode($this->input->post('dataRegist'));

	        $kondisi = htmlspecialchars($json[0]->kondisi_eksisting);
			$mengajukan = htmlspecialchars($json[0]->lama_izin);
			$pbb = htmlspecialchars($json[0]->pemutakhiran_pbb);
			$umkm = htmlspecialchars($json[0]->keterlibatan_umkm);
			$sewa = htmlspecialchars($json[0]->perjanjian_sewa);
			$warga = htmlspecialchars($json[0]->persetujuan_warga);
			$rek_umkm = htmlspecialchars($json[0]->rekomendasi_umkm);
			$kajian = htmlspecialchars($json[0]->kajian_sostek);
			$imb = htmlspecialchars($json[0]->imb_eksisting);
			$slf = htmlspecialchars($json[0]->slf_eksisting);
			$kondisi_sumur = htmlspecialchars($json[0]->kondisi_sumur_r);
			$drainase = htmlspecialchars($json[0]->drainase_disekeliling);
			$kdh_minimum = htmlspecialchars($json[0]->kdh_minimum);
			$kondisi_kdh = htmlspecialchars($json[0]->kondisi_kdh);
			$sampah = htmlspecialchars($json[0]->pengelolaan_sampah);
			$parkir = htmlspecialchars($json[0]->kondisi_parkir);
			$volume = htmlspecialchars($json[0]->volumeSumur);

            //Tambahan 

            $nik = htmlspecialchars($json[0]->nomorInKepen);
			$email = htmlspecialchars($json[0]->emailAktif);
            $janji_sewa_input = htmlspecialchars($json[0]->janji_sewa_input);
            $keterlibatan_umkm_input = htmlspecialchars($json[0]->keterlibatan_umkm_input);
            $lama_izin_input = htmlspecialchars($json[0]->lama_izin_input);
            $detail_kondisi_input = htmlspecialchars($json[0]->detail_kondisi_input);
            $sublock = htmlspecialchars($json[0]->idsubblok);
            // return var_dump($json);
            if(empty($kondisi) OR $kondisi == '-'){
                echo json_encode($this->returnResultCustom(false,"Kondisi Eksisting Tidak Boleh Kosong"));
                return;
            }else if(empty($mengajukan) OR $mengajukan == '-'){
            	echo json_encode($this->returnResultCustom(false,"Lama Izin Mengajukan Tidak Boleh Kosong"));
                return;
            }else if(empty($pbb) OR $pbb == '-'){
            	echo json_encode($this->returnResultCustom(false,"Pemutakhiran PBB Tidak Boleh Kosong"));
                return;
            }else if(empty($umkm) OR $umkm == '-'){
            	echo json_encode($this->returnResultCustom(false,"Keterlibatan UMKM Tidak Boleh Kosong"));
                return;
            }else if(empty($sewa) OR $sewa == '-'){
            	echo json_encode($this->returnResultCustom(false,"Perjanjian Sewa Tidak Boleh Kosong"));
                return;
            }else if(empty($warga) OR $warga == '-'){
            	echo json_encode($this->returnResultCustom(false,"Persetujuan Warga Tidak Boleh Kosong"));
                return;
            }else if(empty($rek_umkm) OR $rek_umkm == '-'){
            	echo json_encode($this->returnResultCustom(false,"Rekomendasi UMKM Tidak Boleh Kosong"));
                return;
            }else if(empty($kajian) OR $kajian == '-'){
            	echo json_encode($this->returnResultCustom(false,"Kajian Sosek Tidak Boleh Kosong"));
                return;
            }else if(empty($imb) OR $imb == '-'){
            	echo json_encode($this->returnResultCustom(false,"IMB Eksisting Tidak Boleh Kosong"));
                return;
            }else if(empty($slf) OR $slf == '-'){
            	echo json_encode($this->returnResultCustom(false,"Slf Eksisting Tidak Boleh Kosong"));
                return;
            }else if(empty($kondisi_sumur) OR $kondisi_sumur == '-'){
            	echo json_encode($this->returnResultCustom(false,"Kondisi Sumur Resapan Tidak Boleh Kosong"));
                return;
            }else if(empty($drainase) OR $drainase=='-' ){
            	echo json_encode($this->returnResultCustom(false,"Drainase Sekeliling Tidak Boleh Kosong"));
                return;
            }else if(empty($kdh_minimum) OR $kdh_minimum=='-' ){
            	echo json_encode($this->returnResultCustom(false,"KDH Minimum Tidak Boleh Kosong"));
                return;
            }else if(empty($kondisi_kdh) OR $kondisi_kdh=='-' ){
            	echo json_encode($this->returnResultCustom(false,"Kondisi KDH Tidak Boleh Kosong"));
                return;
            }else if(empty($sampah) OR $sampah=='-' ){
            	echo json_encode($this->returnResultCustom(false,"Pengelolaan Sampah Tidak Boleh Kosong"));
                return;
            }else if(empty($parkir) OR $parkir=='-' ){
            	echo json_encode($this->returnResultCustom(false,"Kondisi Parkir Tidak Boleh Kosong"));
                return;
            }else if(empty($volume) OR $volume=='-' ){
            	echo json_encode($this->returnResultCustom(false,"Volume Sumur Tidak Boleh Kosong"));
                return;
            }


            // Administrasi
            if ($kondisi == '1') {
            	$skor = 0;
            }elseif ($kondisi == '2') {
            	$skor = 1;
            }elseif($kondisi == '3'){
            	$skor = 2;
            }else if($kondisi == '4'){
            	$skor = 3;
            }else{
            	$skor = 0;
            }
            if ($mengajukan == '1') {
            	$skor1 = 0;
            }elseif ($mengajukan == '2') {
            	$skor1 = 1;
            }elseif($mengajukan == '3'){
            	$skor1 = 2;
            }else if($mengajukan == '4'){
            	$skor1 = 3;
            }else{
            	$skor1 = 0;
            }

            $hasiladmin = ($skor + $skor1) / 2;

            // Admin Teknis
            if ($pbb == '1') {
            	$skorteknis = 0;
            }elseif ($pbb == '2') {
            	$skorteknis = 1;
            }elseif($pbb == '3'){
            	$skorteknis = 2;
            }else if($pbb == '4'){
            	$skorteknis = 3;
            }else{
            	$skorteknis = 0;
            }


            if ($umkm == '1') {
            	$skorteknis1 = 0;
            }elseif ($umkm == '2') {
            	$skorteknis1 = 1;
            }elseif($umkm == '3'){
            	$skorteknis1 = 2;
            }else if($umkm == '4'){
				$skorteknis1 = 3;
            }else{
            	$skorteknis1 = 0;
            }

            if ($sewa == '1') {
            	$skorteknis2 = 0;
            }elseif ($sewa == '2') {
            	$skorteknis2 = 1;
            }elseif($sewa == '3'){
            	$skorteknis2 = 2;
            }else if($sewa == '4'){
            	$skorteknis2 = 3;
            }else{
            	$skorteknis2 = 0;
            }
            if ($warga == '1') {
            	$skorteknis3 = 0;
            }elseif ($warga == '2') {
            	$skorteknis3 = 1;
            }elseif($warga == '3'){
            	$skorteknis3 = 2;
            }else if($warga == '4'){
            	$skorteknis3 = 3;
            }else{
            	$skorteknis3 = 0;
            }

            $hasilteknis = ($skorteknis + $skorteknis1 + $skorteknis2 + $skorteknis3) / 4;

            // Dampak 
            if ($rek_umkm == '1') {
            	$skordampak = 0;
            }elseif ($rek_umkm == '2') {
            	$skordampak = 1;
            }elseif($rek_umkm == '3'){
            	$skordampak = 2;
            }else if($rek_umkm == '4'){
            	$skordampak = 3;
            }else{
            	$skordampak = 0;
            }

            if ($kajian == '1') {
            	$skordampak1 = 0;
            }elseif ($kajian == '2') {
            	$skordampak1 = 1;
            }elseif($kajian == '3'){
            	$skordampak1 = 2;
            }else if($kajian == '4'){
            	$skordampak1 = 3;
            }else{
            	$skordampak1 = 0;
            }

            if ($imb == '1') {
            	$skordampak2 = 0;
            }elseif ($imb == '2') {
            	$skordampak2 = 1;
            }elseif($imb == '3'){
            	$skordampak2 = 2;
            }else if($imb == '4'){
            	$skordampak2 = 3;
            }else{
            	$skordampak2 = 0;
            }

            if ($slf == '1') {
            	$skordampak3 = 0;
            }elseif ($slf == '2') {
            	$skordampak3 = 1;
            }elseif($slf == '3'){
            	$skordampak3 = 2;
            }else if($slf == '4'){
            	$skordampak3 = 3;
            }else{
            	$skordampak3 = 0;
            }

            if ($kondisi_sumur == '1') {
            	$skordampak4 = 0;
            }elseif ($kondisi_sumur == '2') {
            	$skordampak4 = 1;
            }elseif($kondisi_sumur == '3'){
            	$skordampak4 = 2;
            }else if($kondisi_sumur == '4'){
            	$skordampak4 = 3;
            }else{
            	$skordampak4 = 0;
            }

            if ($drainase == '1') {
            	$skordampak5 = 0;
            }elseif ($drainase == '2') {
            	$skordampak5 = 1;
            }elseif($drainase == '3'){
            	$skordampak5 = 2;
            }else if($drainase == '4'){
            	$skordampak5 = 3;
            }else{
            	$skordampak5 = 0;
            }

            if ($kdh_minimum == '1') {
            	$skordampak6 = 0;
            }elseif ($kdh_minimum == '2') {
            	$skordampak6 = 1;
            }elseif($kdh_minimum == '3'){
            	$skordampak6 = 2;
            }else if($kdh_minimum == '4'){
            	$skordampak6 = 3;
            }else{
            	$skordampak6 = 0;
            }

            if ($kondisi_kdh == '1') {
            	$skordampak7 = 0;
            }elseif ($kondisi_kdh == '2') {
            	$skordampak7 = 1;
            }elseif($kondisi_kdh == '3'){
            	$skordampak7 = 2;
            }else if($kondisi_kdh == '4'){
            	$skordampak7 = 3;
            }else{
            	$skordampak7 = 0;
            }

            if ($sampah == '1') {
            	$skordampak8 = 0;
            }elseif ($sampah == '2') {
            	$skordampak8 = 1;
            }elseif($sampah == '3'){
            	$skordampak8 = 2;
            }else if($sampah == '4'){
            	$skordampak8 = 3;
            }else{
            	$skordampak8 = 0;
            }

            if ($parkir == '1') {
            	$skordampak9 = 0;
            }elseif ($parkir == '2') {
            	$skordampak9 = 1;
            }elseif($parkir == '3'){
            	$skordampak9 = 2;
            }else if($parkir == '4'){
            	$skordampak9 = 3;
            }else{
            	$skordampak9 = 0;
            }

            if ($volume == 0 OR $volume == null) {
            	$skordampak10 = 0;
            }elseif ($volume < 25) {
            	$skordampak10 = 1;
            }else if($volume >= 25){
            	$skordampak10 = 3;
            }else{
            	$skordampak10 = 0;
            }
           	$hasildampak = ($skordampak + $skordampak1 + $skordampak2 + $skordampak3 + $skordampak4 + $skordampak5 + $skordampak6 + $skordampak7 + $skordampak8 + $skordampak9 + $skordampak10) / 11;

          	$rarata = ($hasiladmin + $hasildampak + $hasilteknis) / 3;

          		$savepemohon = $this->savePemohon($json);
          		$bangunan = $this->saveBangunan($savepemohon,$json);
          		$skor = $this->saveSkor($bangunan,$hasiladmin,$hasilteknis,$hasildampak,$rarata);
                $savekondisi = $this->saveKondisi($bangunan,$kondisi,$mengajukan,$pbb,$umkm,$sewa,$warga,$rek_umkm,$kajian,$imb,$slf,$kondisi_sumur,$drainase,$kdh_minimum,$kondisi_kdh,$sampah,$parkir,$volume,$janji_sewa_input,$keterlibatan_umkm_input,$lama_izin_input,$detail_kondisi_input,$sublock);
			if ($skor == true) {
				$json = $this->returnResultCustom(true,'Berhasil Simpan Data');
				$this->sendmail($nik);
          	}else{
          		$json = $this->returnResultErrorDB();
          	}
		} catch (Exception $e) {
			$json = $this->returnResultCustom(false,'Throws');
		}
		echo json_encode($json);
	}
	function savePemohon($data)
	{
		$nama = htmlspecialchars($data[0]->namaLengkap);
		$nik = htmlspecialchars($data[0]->nomorInKepen);
		$nib = htmlspecialchars($data[0]->nomorInBeru);
        $jabatan = htmlspecialchars($data[0]->jabatan);
		$npwp = htmlspecialchars($data[0]->npwp);
        $npwp_usaha = htmlspecialchars($data[0]->npwp_perusahaan);
		$njop = htmlspecialchars($data[0]->njop);
        $barang_jasa = htmlspecialchars($data[0]->barang_jasa);
		$no_telp = htmlspecialchars($data[0]->no_telp);
		$email = htmlspecialchars($data[0]->emailAktif);
        $alamat_perusahaan = htmlspecialchars($data[0]->alamat_perusahaan);

		$cek = $this->us->cekPemohon($nik);
		$idpemohon = $cek->row();
		$token = $this->incrementalHash(8);
		if ($cek->num_rows() > 0) {
			$tgl = $idpemohon->created_at;
			$id = $idpemohon->id_pemohon;
            $where = array(
                'id_pemohon'=>$id
            );
             $arrayPermohonan = array(
                'nama'=>$nama,
                'nik'=>$nik,
                'nib'=>$nib,
                'email'=>$email,
                'npwp'=>$npwp,
                'njop'=>$njop,
                'jabatan'=>$jabatan,
                'npwp_usaha'=>$npwp_usaha,
                'alamat_perusahaan'=>$alamat_perusahaan,
                'password'=>password_hash($token, PASSWORD_DEFAULT),
                'token'=>$token,
                'created_at' => $tgl,
                'updated_at' => date('Y-m-d H:i:s'),
            );
        $q = $this->db->update('pemohon_iuts',$arrayPermohonan,$where);
		}else{
			$this->load->library('uuid');
			$uuid = $this->uuid->v4();
        	$id = str_replace('-', '', $uuid);
			$q = $this->us->InsertPemohon($id,$jabatan,$npwp_usaha,$alamat_perusahaan,$nama,$nik,$nib,$npwp,$no_telp,$njop,$email,$token);
		}
		
        if ($q) {
        	return $id;
        }else{
        	$json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
       echo json_encode($json);
	}
	function saveBangunan($idpemohon,$data)
	{
		$nop = htmlspecialchars($data[0]->nop);
		$no_reg = htmlspecialchars($data[0]->nrb);
        $nama_toko = htmlspecialchars($data[0]->nama_toko);
        $nama_badan_usaha = htmlspecialchars($data[0]->nama_usaha);
		$luas_lahan = htmlspecialchars($data[0]->luas_lahan);
		$ltb = htmlspecialchars($data[0]->ltb);
		$luas_lantai = htmlspecialchars($data[0]->luas_lantai);
		$jml_lantai = htmlspecialchars($data[0]->jml_lantai);
		$status_bangunan = htmlspecialchars($data[0]->status_bangunan);
		$status_milik = htmlspecialchars($data[0]->status_milik);
		$lokasi = htmlspecialchars($data[0]->alamat);
        $alamatpemohon = htmlspecialchars($data[0]->alamat_lengkap);
        $kelompok = htmlspecialchars($data[0]->kelompok);
        $untuk_toko = htmlspecialchars($data[0]->peruntukan_toko);
        $kontak_pemohon = htmlspecialchars($data[0]->kontak_pemohon);

		$lat = htmlspecialchars($data[0]->lat);
		$lng = htmlspecialchars($data[0]->lng);
        $zona = htmlspecialchars($data[0]->subzona);
        $sublock = htmlspecialchars($data[0]->idsubblok);
        $kecamatan = htmlspecialchars($data[0]->kecamatan);

		$kondisi = htmlspecialchars($data[0]->kondisi_eksisting);
		$mengajukan = htmlspecialchars($data[0]->lama_izin);
		$pbb = htmlspecialchars($data[0]->pemutakhiran_pbb);
		$umkm = htmlspecialchars($data[0]->keterlibatan_umkm);
		$sewa = htmlspecialchars($data[0]->perjanjian_sewa);
		$warga = htmlspecialchars($data[0]->persetujuan_warga);
        $atm = htmlspecialchars($data[0]->jumlah_atm);
        $jasa = htmlspecialchars($data[0]->barang_jasa);
		$rek_umkm = htmlspecialchars($data[0]->rekomendasi_umkm);
		$kajian = htmlspecialchars($data[0]->kajian_sostek);
		$imb = htmlspecialchars($data[0]->imb_eksisting);
		$slf = htmlspecialchars($data[0]->slf_eksisting);
		$kondisi_sumur = htmlspecialchars($data[0]->kondisi_sumur_r);
		$drainase = htmlspecialchars($data[0]->drainase_disekeliling);
		$kdh_minimum = htmlspecialchars($data[0]->kdh_minimum);
		$kondisi_kdh = htmlspecialchars($data[0]->kondisi_kdh);
		$sampah = htmlspecialchars($data[0]->pengelolaan_sampah);
		$parkir = htmlspecialchars($data[0]->kondisi_parkir);
		$volume = htmlspecialchars($data[0]->volumeSumur);

		$cek = $this->us->cekBangunan($no_reg);
        $kode = $this->randstr();
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id_bangunan;
            $where = array(
                'id_bangunan'=>$id
            );
            $arrayPermohonan = array(
                'id_pemohon'=>$idpemohon,
                'nop'=>$nop,
                'no_reg_bangunan'=>$no_reg,
                'nama_usaha'=>$nama_toko,
                'nama_badan_usaha'=>$nama_badan_usaha,
                'alamat'=>$lokasi,
                'alamat_lengkap'=>$alamatpemohon,
                'kelompok_usaha'=>$kelompok,
                'peruntukan_toko'=>$untuk_toko,
                'lat'=>$lat,
                'lon'=>$lng,
                'kecamatan'=>$kecamatan,
                'jml_atm'=>$atm,
                'jasa'=>$jasa,
                'zona'=>$zona,
                'kode_sublok'=>$sublock,
                'luas_lahan'=>$luas_lahan,
                'status_milik'=>$status_milik,
                'status_bangunan'=>$status_bangunan,
                'luas_tapak'=>$ltb,
                'luas_lantai'=>$luas_lantai,
                'jumlah_lantai'=>$jml_lantai,
                'kontak_pemohon'=>$kontak_pemohon,
                'code'=>$kode,
                'status' => 0,
                'status_jalan' =>0,
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update('bangunan_iuts',$arrayPermohonan,$where);
		}else{
			$this->load->library('uuid');
			$uuid = $this->uuid->v4();
        	$id = str_replace('-', '', $uuid);
			$q = $this->us->InsertBangunan($id,$nama_toko,$nama_badan_usaha,$kelompok,$untuk_toko,$kecamatan,$idpemohon,$nop,$no_reg,$luas_lahan,$ltb,$luas_lantai,$jml_lantai,$status_bangunan,$status_milik,$lokasi,$lat,$lng,$kode,$jasa,$atm);
		}
        if ($q) {
        	return $id;
        }else{
        	$json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
       echo json_encode($json);
	}
    function saveKondisi($bangunan,$kondisi,$mengajukan,$pbb,$umkm,$sewa,$warga,$rek_umkm,$kajian,$imb,$slf,$kondisi_sumur,$drainase,$kdh_minimum,$kondisi_kdh,$sampah,$parkir,$volume,$janji_sewa_input,$keterlibatan_umkm_input,$lama_izin_input,$detail_kondisi_input,$sublock)
    {
        $cek = $this->us->cekKondisi($bangunan);
        $spasial = $this->us->cekSpasial($subzona);
        if ($spasial->num_rows() > 0) {
            $row = $spasial->row();
            $id_tata = $row->id;
        }else{
            $id_tata = 1;
        }
        if ($cek->num_rows() > 0) {
            $getdata = $cek->row();
            $id = $getdata->id;
            $where = array(
                'id_bangunan' => $bangunan,
            );
             $array = array(
                'id_kondisi' => $kondisi,
                'kondisi_eksisting' => $detail_kondisi_input,
                'id_waktu' => $mengajukan,
                'lama_izin' => $lama_izin_input,
                'id_pbb' => $pbb,
                'id_umkm' => $umkm,
                'keterlibatan_umkm' => $keterlibatan_umkm_input,
                'id_sewa' => $sewa,
                'perjanjian_sewa' => $janji_sewa_input,
                'id_warga' => $warga,
                'id_rek_umkm' => $rek_umkm,
                'id_tata_ruang' => $id_tata,
                'id_kajian' => $kajian,
                'id_imb' => $imb,
                'id_slf' => $slf,
                'id_volume_sumur' => $volume,
                'id_kondisi_sumur' => $kondisi_sumur,
                'id_drainase' => $drainase,
                'id_kdh_minimum' => $kdh_minimum,
                'id_kondisi_kdh' => $kondisi_kdh,
                'id_sampah' => $sampah,
                'id_parkir' => $parkir,
                'created_at' => $getdata->created_at,
            );
        $q = $this->db->update('kondisi_bangunan',$array,$where);
        }else{
            $q = $this->us->InsertKondisi($bangunan,$kondisi,$mengajukan,$pbb,$umkm,$sewa,$warga,$rek_umkm,$kajian,$imb,$slf,$kondisi_sumur,$drainase,$kdh_minimum,$kondisi_kdh,$sampah,$parkir,$volume,$janji_sewa_input,$keterlibatan_umkm_input,$lama_izin_input,$detail_kondisi_input,$id_tata);
        }
        return $q;
    }
	function saveSkor($bangunan,$hasil,$teknis,$dampak,$rata)
	{
        if ($rata < 1.5) {
            $status = '2';
        }else if($rata > 1.5 ){
            $status = '0';
        }else if ($rata > 2.5) {
            $status = '1';
        }

		$cek = $this->us->cekSkor($bangunan);
		if ($cek->num_rows() > 0) {
			$getdata = $cek->row();
			$id = $getdata->id;
            $where = array(
                'id_bangunan' => $bangunan,
            );
            $array = array(
            'total_admin' => $hasil,
            'total_teknis' => $teknis,
            'total_dampak' => $dampak,
            'rata-rata' => $rata,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),
        );
            $q = $this->db->update('skor_bangunan',$array,$where);
		}else{
			$q = $this->us->InsertSkor($bangunan,$hasil,$teknis,$dampak,$rata);
		}
        return $q;
	}
    function DetailPemohon()
    {
        try {
            $idbangunan = $this->input->post('idbangunan');
            $id = $this->input->post('id');
            $start = $this->input->post('start');
            $offset = $this->input->post('offset');
            $data = $this->us->DetailPermohonan($id,$idbangunan,$status,$start,$offset);
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

	function sendmail($nik)
	{
        $dPemohon = $this->us->cekPemohon($nik);
        $result = $this->returnResult($dPemohon);
        $json = json_encode($result);
        $decoder = json_decode($json);
        if($decoder->rowCount>0){
            $decodeData = $decoder->row[0];
            $emailpemohon = $decodeData->email;
            $tokenpemohon = $decodeData->token;
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
            $mesg = $this->load->view('pages/mail', $data, true);
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

/* End of file ValidasiController.php */
/* Location: ./application/controllers/ValidasiController.php */