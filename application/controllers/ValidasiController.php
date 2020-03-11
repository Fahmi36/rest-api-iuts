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
        $this->load->model('OfficeModel', 'om');
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

    function ValidasiAwal($urlnya='')
    {
        $alamat = $_SERVER['HTTP_REFERER'];
        $hasil = $this->getAddresses_www($alamat);
        if ($hasil == '45.13.133.94' OR $hasil == '127.0.0.1') {
            $json = $this->$urlnya($hasil);
        }else{
            $json = $this->returnResultCustom(false,'Tidak Boleh Akses');
        }
        echo json_encode($json);
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
    function ValidasiFoto()
    {
        try {
            $admin = $this->input->post('admin');
            $idizin = $this->input->post('idizin');
            $ktp = $this->input->post('ktp');
            $npwp = $this->input->post('npwp');
            $aktaperusahaan = $this->input->post('aktaperusahaan');
            $fotoluar = $this->input->post('fotoluar');
            $fotodalam = $this->input->post('fotodalam');
            $imb = $this->input->post('imb');
            $slf = $this->input->post('slf');
            $damkar = $this->input->post('damkar');
            $tkt = $this->input->post('tkt');
            $asuransi = $this->input->post('asuransi');
            $pbb = $this->input->post('pbb');
            $persetujuan_warga = $this->input->post('persetujuan_warga');
            $umkm = $this->input->post('umkm');
            $kajian_sostek = $this->input->post('kajian_sostek');
            $keterangan = $this->input->post('keterangan');

            $izinnya = $this->om->cekAdministrasi($idizin);

            if ($izinnya->num_rows() > 0) {
                $row = $izinnya->row();
                $where = array(
                    'id_administrasi'=>$row->id_administrasi,
                );
                $arrayPermohonan = array(
                    'id_admin'=>$admin,
                    'id_izin'=>$idizin,
                    'fotoktp'=>$ktp,
                    'fotonpwp'=>$npwp,
                    'fotoakta'=>$aktaperusahaan,
                    'fotoluar'=>$fotoluar,
                    'fotodalam'=>$fotodalam,
                    'fotoimb'=>$imb,
                    'fotoslf'=>$slf,
                    'fotodamkar'=>$damkar,
                    'fototkt'=>$tkt,
                    'fotoasuransi'=>$asuransi,
                    'fotopbb'=>$pbb,
                    'fotoperw'=>$persetujuan_warga,
                    'fotorekumkm'=>$umkm,
                    'fotokajian'=>$kajian_sostek,
                    'keterangan'=>$keterangan,
                    'created_at' => $row->created_at,
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $q = $this->db->update('administrasi',$arrayPermohonan,$where);
            }else{
               $q = $this->om->InsertAdministrasi($admin,$idizin,$ktp,$npwp,$aktaperusahaan,$fotoluar,$fotodalam,$imb,$slf,$damkar,$tkt,$asuransi,$pbb,$persetujuan_warga,$umkm,$kajian_sostek,$keterangan);
            }

            if ($q) {
                $json = $this->returnResultCustom(true,'Berhasil Verifikasi Foto');
                $wherefoto = array(
                    'idizin'=>$idizin,
                );
                $datafoto = array(
                    'status'=>'1',
                );
                $this->db->update('foto_admin', $datafoto,$wherefoto);
                $this->db->update('foto_iuts', $datafoto,$wherefoto);
                $this->db->update('foto_slf', $datfoto,$wherefoto);
            }else{
                $json = $this->returnResultCustom(false,'Gagal Verifikasi Foto');
            }
        } catch (Exception $e) {
            $json = $this->returnResultCustom(false,'Throws');
        }
        echo json_encode($json);
    }
    function ValidasiIzin()
    {
      try {
        // $json = json_decode($this->input->post('dataRegist'));
        $email = $this->input->post('email');
        $jenis = $this->input->post('jenis_izin');
        $status_pemohon = $this->input->post('status_pemohon');

            //SLF
        $kdh_zonasi = $this->input->post('kdh');
        $jalaneksis = $this->input->post('jln_eksisting');
        $kdh_minimum = $this->input->post('kdh_minimum');
        $kondisi_kdh = $this->input->post('kondisi_kdh');
        $volume = $this->input->post('volume_sumur_r');
        $kondisipertandaan = $this->input->post('kondisi_pertandaan_toko');
        $kondisi_sumur = $this->input->post('kondisi_sumur_r');
        $drainase = $this->input->post('drainase_disekeliling');

        $rek_slf = $this->input->post('slf');
        $damkar = $this->input->post('izin_dinas_pkp');
        $tenaga_kerja = $this->input->post('izin_dinas_tkt');
        $imb = $this->input->post('imb');

        $fasilitas = $this->input->post('fasilitas_penang_kebakaran');
        $asuransi = $this->input->post('ketersediaan_asuransi_toko');
        $kelayakan = $this->input->post('waktu_pembaruan_k_g');
        $air = $this->input->post('air_bersih');
        $sumber_air = $this->input->post('sumber_air_bersih');
        $limbah = $this->input->post('pengelolaan_air_kotor');
        $sampah = $this->input->post('pengelolaan_sampah');
        $listrik = $this->input->post('ketersediaan_listrik');
        $toilet = $this->input->post('ketersediaan_toilet');
        $parkir = $this->input->post('kondisi_parkir');

            //END SLF


            // Mulai IUTS

        /*Administrasi Bangunan*/
        $sublock = $this->input->post('idsubblok');
        /*Administrasi Bangunan*/

        /*Kebermanfaatan Usaha*/
        $pbb = $this->input->post('pemutahiran_pbb');
        $umkm = $this->input->post('keterlibatan_umkm');
        $keterlibatan_umkm_input = $this->input->post('keterlibatan_umkm_input');
        $warga = $this->input->post('persetujuan_warga');
        $jumlah_karyawan = $this->input->post('jumlah_karyawan');
        $asal_karyawan = $this->input->post('asal_karyawan');
        $jumlah_atm = $this->input->post('jumlah_atm');
        $jumlah_pengunjung = $this->input->post('jumlah_pengunjung_b');
        $status_milik_usaha = $this->input->post('status_milik_usaha');
        $peng_lahan = $this->input->post('penggunaan_lahan');
        /*Kebermanfaatan Usaha*/

        /*Informasi Antisipasi Dampak/Resiko*/
        $rek_umkm = $this->input->post('rekomendasi_umkm');
        $kajian = $this->input->post('kajian_sostek');
        /*Informasi Antisipasi Dampak/Resiko*/

        $status_npwp = $this->input->post('status_npwp');
        $status_pbb = $this->input->post('status_pbb');

        $spasial = $this->us->cekSpasial($sublock);

        if ($spasial->num_rows() > 0) {
            $row = $spasial->row();
            $id_tata = $row->id;
        }else{
            $id_tata = 1;
        }

        // if (empty($sublock) OR $sublock=='-') {
        //     echo json_encode($this->returnResultCustom(false,"Mohon Pilih lokasi maps dekat dengan layar yang berwarna "));
        //     return;
        // }else if ($sublock == 'H.2') {
        //     echo json_encode($this->returnResultCustom(false,"Tidak Boleh di Zona Hijau"));
        //     return;
        // }
        // if(empty($status_npwp) OR $status_npwp=='-' OR $status_npwp=='0'){
        //     echo json_encode($this->returnResultCustom(false,"Harus Melakukan Verifikasi NIK dan PBB"));
        //     return;
        // }else if(empty($status_pbb) OR $status_pbb =='-' OR $status_pbb=='0'){
        //     echo json_encode($this->returnResultCustom(false,"Harus Melakukan Verifikasi NIK dan PBB"));
        //     return;
        // }else 
            // if ($jenis == '1') { // IUTS
            //     if(empty($pbb) OR $pbb =='-' ){
            //         echo json_encode($this->returnResultCustom(false,"Pemutakhiran PBB Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($umkm) OR $umkm =='-' ){
            //         echo json_encode($this->returnResultCustom(false,"Keterlibatan UMKM Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($warga) OR $warga =='-' ){
            //         echo json_encode($this->returnResultCustom(false,"Persetujuan Warga Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($keterlibatan_umkm_input) OR $keterlibatan_umkm_input =='-' ){
            //         echo json_encode($this->returnResultCustom(false,"Detail Keterlibatan UMKM Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($asal_karyawan) OR $asal_karyawan=='-' ){
            //         echo json_encode($this->returnResultCustom(false,"Asal Karyawan Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($jumlah_atm)){
            //         echo json_encode($this->returnResultCustom(false,"Jumlah Karyawan Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($jumlah_pengunjung)){
            //         echo json_encode($this->returnResultCustom(false,"Jumlah Pengunjung Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($peng_lahan) OR $peng_lahan=='-' ){
            //         echo json_encode($this->returnResultCustom(false,"Pengelolaan Lahan Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($rek_umkm) OR $rek_umkm=='-' ){
            //         echo json_encode($this->returnResultCustom(false,"Rekomendasi UMKM Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($kajian) OR $kajian=='-' ){
            //         echo json_encode($this->returnResultCustom(false,"Kajian Sosek Tidak Boleh Kosong"));
            //         return;
            //     }else if(empty($jumlah_karyawan)){
            //         echo json_encode($this->returnResultCustom(false,"Jumlah Karyawan Tidak Boleh Kosong"));
            //         return;
            //     }
            // }else 
            if ($jenis == '2') { // Koperasi
                if(empty($kdh_zonasi) OR $kdh_zonasi == '-'){
                    echo json_encode($this->returnResultCustom(false,"Silakan Pilih Koefisien Daearh Hijau di Peta"));
                    return;
                }else if(empty($kdh_minimum) OR $kdh_minimum == '-'){
                    echo json_encode($this->returnResultCustom(false,"KDH Eksisting Tidak Boleh Kosong"));
                    return;
                }else if(empty($imb) OR $imb == '-'){
                    echo json_encode($this->returnResultCustom(false,"IMB Tidak Boleh Kosong"));
                    return;
                }else if(empty($kelayakan) OR $kelayakan == '-'){
                    echo json_encode($this->returnResultCustom(false,"Waktu Pembaharuan Terakhir Kelayakan Gedung Tidak Boleh Kosong"));
                    return;
                }else if(empty($ket_air) OR $ket_air == '-'){
                    echo json_encode($this->returnResultCustom(false,"Ketersediaan Air Bersih Tidak Boleh Kosong"));
                    return;
                }else if(empty($sampah) OR $sampah == '-'){
                    echo json_encode($this->returnResultCustom(false,"Pengelolaan Sampah Tidak Boleh Kosong"));
                    return;
                }else if(empty($toilet) OR $toilet == '-'){
                    echo json_encode($this->returnResultCustom(false,"Ketersediaan Toilet Tidak Boleh Kosong"));
                    return;
                }else if(empty($parkir) OR $parkir == '-'){
                    echo json_encode($this->returnResultCustom(false,"Kondisi Parkir Tidak Boleh Kosong"));
                    return;
                }
                $savepemohon = $this->savePemohon();
                if ($savepemohon) {
                 $slf = $this->saveSlf();
                 if ($slf) {
                    $KondisiSlf = $this->saveKondisiSlf($slf);
                    if ($KondisiSlf) {
                        $iuts = $this->saveKoperasi();
                        if ($iuts) {
                            $kondisiiuts = $this->saveKondisiKoperasi($iuts);
                            if ($kondisiiuts) {
                                $cekizin = $this->saveIzin($savepemohon,$slf,$iuts);
                                $skor = $this->saveSkor($cekizin);
                                if ($skor) {
                                    $this->saveFotoAdmin($cekizin);
                                    $this->saveFotoSLF($cekizin);
                                    $this->saveIuts($cekizin);                           
                                    $this->sendmail($email,$status_pemohon);
                                    $json = $this->returnResultCustom(true,'Berhasil Simpan Data');
                                }else{
                                    $json = $this->returnResultCustom(false,'Gagal Masukan Foto SLF');
                                }
                            }else{
                                $json = $this->returnResultCustom(false,'Gagal Masukan Tax Clear');
                            }
                        }else{
                            $json = $this->returnResultCustom(false,'Gagal Masukan Data Skor');
                        }

                    }else{
                        $json = $this->returnResultCustom(false,'Gagal Masukan Data Kondisi IUTS');
                    }
                }else{
                    $json = $this->returnResultCustom(false,'Gagal Masukan Data IUTS');
                }
            }else{
                $json = $this->returnResultCustom(false,'Gagal Masukan Data Kondisi Slf');
            }
            }else if ($jenis == '3'){ //SLF dan IUTS 
                if(empty($kdh_zonasi) OR $kdh_zonasi == '-'){
                    echo json_encode($this->returnResultCustom(false,"Silakan Pilih Koefisien Daearh Hijau di Peta"));
                    return;
                }else if(empty($kdh_minimum) OR $kdh_minimum == '-'){
                    echo json_encode($this->returnResultCustom(false,"KDH Eksisting Tidak Boleh Kosong"));
                    return;
                }else if(empty($kondisi_kdh) OR $kondisi_kdh == '-'){
                    echo json_encode($this->returnResultCustom(false,"Kondisi KDH Tidak Boleh Kosong"));
                    return;
                }else if(empty($volume) OR $volume == '-'){
                    echo json_encode($this->returnResultCustom(false,"Volume Sumur Resapan Tidak Boleh Kosong"));
                    return;
                }else if(empty($kondisipertandaan) OR $kondisipertandaan == '-'){
                    echo json_encode($this->returnResultCustom(false,"Kondisi Pertandaan Toko Tidak Boleh Kosong"));
                    return;
                }else if(empty($kondisi_sumur) OR $kondisi_sumur == '-'){
                    echo json_encode($this->returnResultCustom(false,"Kondisi Sumur Tidak Boleh Kosong"));
                    return;
                }else if(empty($drainase) OR $drainase == '-'){
                    echo json_encode($this->returnResultCustom(false,"Drainase Sekeliling Tidak Boleh Kosong"));
                    return;
                }else if(empty($rek_slf) OR $rek_slf == '-'){
                    echo json_encode($this->returnResultCustom(false,"Rekomendasi SLF Tidak Boleh Kosong"));
                    return;
                }else if(empty($imb) OR $imb == '-'){
                    echo json_encode($this->returnResultCustom(false,"IMB Tidak Boleh Kosong"));
                    return;
                }else if(empty($asuransi) OR $asuransi == '-'){
                    echo json_encode($this->returnResultCustom(false,"Asuransi Toko Tidak Boleh Kosong"));
                    return;
                }else if(empty($kelayakan) OR $kelayakan == '-'){
                    echo json_encode($this->returnResultCustom(false,"Waktu Pembaharuan Terakhir Kelayakan Gedung Tidak Boleh Kosong"));
                    return;
                }else if(empty($limbah) OR $limbah == '-'){
                    echo json_encode($this->returnResultCustom(false,"Pengelolaan Air Kotor / Limbah Tidak Boleh Kosong"));
                    return;
                }else if(empty($sampah) OR $sampah == '-'){
                    echo json_encode($this->returnResultCustom(false,"Pengelolaan Sampah Tidak Boleh Kosong"));
                    return;
                }else if(empty($listrik) OR $listrik == '-'){
                    echo json_encode($this->returnResultCustom(false,"Ketersediaan Listrik Tidak Boleh Kosong"));
                    return;
                }else if(empty($toilet) OR $toilet == '-'){
                    echo json_encode($this->returnResultCustom(false,"Ketersediaan Toilet Tidak Boleh Kosong"));
                    return;
                }else if(empty($parkir) OR $parkir == '-'){
                    echo json_encode($this->returnResultCustom(false,"Kondisi Parkir Tidak Boleh Kosong"));
                    return;
                }else if(empty($pbb) OR $pbb =='-' ){
                    echo json_encode($this->returnResultCustom(false,"Pemutakhiran PBB Tidak Boleh Kosong"));
                    return;
                }else if(empty($umkm) OR $umkm =='-' ){
                    echo json_encode($this->returnResultCustom(false,"Keterlibatan UMKM Tidak Boleh Kosong"));
                    return;
                }else if(empty($warga) OR $warga =='-' ){
                    echo json_encode($this->returnResultCustom(false,"Persetujuan Warga Tidak Boleh Kosong"));
                    return;
                }else if(empty($asal_karyawan) OR $asal_karyawan=='-' ){
                    echo json_encode($this->returnResultCustom(false,"Asal Karyawan Tidak Boleh Kosong"));
                    return;
                }else if(empty($jumlah_atm)){
                    echo json_encode($this->returnResultCustom(false,"Jumlah Karyawan Tidak Boleh Kosong"));
                    return;
                }else if(empty($jumlah_pengunjung)){
                    echo json_encode($this->returnResultCustom(false,"Jumlah Pengunjung Tidak Boleh Kosong"));
                    return;
                }else if(empty($rek_umkm) OR $rek_umkm=='-' ){
                    echo json_encode($this->returnResultCustom(false,"Rekomendasi UMKM Tidak Boleh Kosong"));
                    return;
                }else if(empty($kajian) OR $kajian=='-' ){
                    echo json_encode($this->returnResultCustom(false,"Kajian Sosek Tidak Boleh Kosong"));
                    return;
                }else if(empty($jumlah_karyawan)){
                    echo json_encode($this->returnResultCustom(false,"Jumlah Karyawan Tidak Boleh Kosong"));
                    return;
                }
                $savepemohon = $this->savePemohon();
                if ($savepemohon) {
                   $slf = $this->saveSlf();
                   if ($slf) {
                    $KondisiSlf = $this->saveKondisiSlf($slf);
                    if ($KondisiSlf) {
                        $iuts = $this->saveIuts();
                        if ($iuts) {
                            $kondisiiuts = $this->saveKondisiIuts($iuts,$id_tata);
                            if ($kondisiiuts) {
                                $cekizin = $this->saveIzin($savepemohon,$slf,$iuts);
                                $skor = $this->saveSkor($cekizin);
                                if ($skor) {
                                    $this->saveFotoAdmin($cekizin);
                                    $this->saveFotoSLF($cekizin);
                                    $this->saveIuts($cekizin);                           
                                    $this->sendmail($email,$status_pemohon);
                                    $json = $this->returnResultCustom(true,'Berhasil Simpan Data');
                                }else{
                                    $json = $this->returnResultCustom(false,'Gagal Masukan Foto SLF');
                                }
                            }else{
                                $json = $this->returnResultCustom(false,'Gagal Masukan Tax Clear');
                            }
                        }else{
                            $json = $this->returnResultCustom(false,'Gagal Masukan Data Skor');
                        }

                    }else{
                        $json = $this->returnResultCustom(false,'Gagal Masukan Data Kondisi IUTS');
                    }
                }else{
                    $json = $this->returnResultCustom(false,'Gagal Masukan Data IUTS');
                }
            }else{
                $json = $this->returnResultCustom(false,'Gagal Masukan Data Kondisi Slf');
            }
        }
        } catch (Exception $e) {
            $json = $this->returnResultCustom(false,'Throws');
        }
        echo json_encode($json);
    }
    public function doupload()
    {
        $desc = $this->input->post('descr');
        $fname = $this->input->post('files');
        $config = array(
            'upload_path' => "./data/helpdesk/".$fname,
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "204800", 
            // 'max_height' => "768",
            // 'max_width' => "1024"
        ); 
        $this->load->library('upload', $config);
        $data = array();
        if(!$this->upload->do_upload('files'))
        { 
            $data['success'] = false;
            $data['imageError'] =  $this->upload->display_errors();
            
        }
        else
        {
            $data['success'] = true;
            $imageDetailArray = $this->upload->data();
            $data['image'] =  $imageDetailArray['file_name'];
            $data['descr'] =  $desc;
        }

        echo json_encode($data);
        
    }

    public function inputHelp()
    {
        $iduser = $this->input->post('iduser');
        $descr = $this->input->post('descr');

        $arr = array(
            'created_by'=>$iduser,
            'created_at'=>date('Y-m-d H:i:s'),
            'descr'=>$descr,
            'status'=>'1'
        );
        $q = $this->db->insert('helpdesk',$arr);
        $res = array();
        if($q){
            $res['success']=true;
            $res['idhelp']=$this->db->insert_id();
            $res['msg']="Success add data";
        }else{
            $res['success']=false;
            $res['msg']="Failed add data";
        }
        echo json_encode($res);
    }

    public function addAttachment() {
        $data       = $this->input->post('data');
        $fileName   = $this->input->post('name');
        $serverFile = $fileName;

        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data       = base64_decode($data);
        file_put_contents('./data/fotoslf/' . $serverFile, $data);
        $returnData = array("serverFile" => $serverFile);
        echo json_encode($returnData);
    }
    public function addAttachmentIUTS() {
        $data       = $this->input->post('data');
        $fileName   = $this->input->post('name');
        $serverFile = $fileName;

        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data       = base64_decode($data);
        file_put_contents('./data/fotoiuts/' . $serverFile, $data);
        $returnData = array("serverFile" => $serverFile);
        echo json_encode($returnData);
    }
     function updateDataAdmin() {
        $idizin        = $this->input->post('id');
        $name      = $this->input->post('name');
        $jenis      = $this->input->post('jenis');

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);
        $arrUpdate = array(
            'idfotoadmin'=>$id,
            'jenis_foto'=>$jenis,
            'foto' => $name,
            'verif_by' => '1',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>'0',
            'idizin'=>$idizin,
        );
        $cek = $this->us->cekFotoAdmin($idizin,$jenis);
        if ($cek->num_rows() > 0) {
            $row = $cek->row();
            $this->db->set('foto', 'foto,'.$name.'',FALSE);
            $this->db->where('id_foto', $row->id);
            $q = $this->db->update('foto_admin');
        }else{
            $q = $this->db->insert('foto_admin', $arrUpdate);
        }
        if ($q) {
            $result = array('success' => true, 'msg' => 'Success update transaction');
        } else {
            $result = array('success' => false, 'msg' => 'Failed update transaction');
        }
        echo json_encode($result);
    }
    function updateData() {
        $idslf        = $this->input->post('id');
        $name      = $this->input->post('name');
        $jenis      = $this->input->post('jenis');

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);
        $arrUpdate = array(
            'id_foto'=>$id,
            'jenis_foto'=>$jenis,
            'foto' => $name,
            'verif_by' => '1',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>'0',
            'id_slf'=>$idslf,
        );
        $cek = $this->us->cekFotoSlf($idslf,$jenis);
        if ($cek->num_rows() > 0) {
            $row = $cek->row();
            $this->db->set('foto', 'foto,'.$name.'',FALSE);
            $this->db->where('id_foto', $row->id);
            $q = $this->db->update('foto_slf');
        }else{
            $q = $this->db->insert('foto_slf', $arrUpdate);
        }
        if ($q) {
            $result = array('success' => true, 'msg' => 'Success update transaction');
        } else {
            $result = array('success' => false, 'msg' => 'Failed update transaction');
        }
        echo json_encode($result);
    }
    function updateDataiuts() {
        $idiuts        = $this->input->post('id');
        $name      = $this->input->post('name');
        $jenis      = $this->input->post('jenis');

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);
        $arrUpdate = array(
            'id_fotoi'=>$id,
            'jenis_foto'=>$jenis,
            'foto' => $name,
            'verif_by' => '1',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>'0',
            'id_iuts'=>$idiuts,
        );
        $cek = $this->us->cekFotoIuts($idiuts,$jenis);
        if ($cek->num_rows() > 0) {
            $row = $cek->row();
            $this->db->set('foto', 'foto,'.$name.'',FALSE);
            $this->db->where('id_fotoi', $row->id);
            $q = $this->db->update('foto_iuts');
        }else{
            $q = $this->db->insert('foto_iuts', $arrUpdate);
        }
        if ($q) {
            $result = array('success' => true, 'msg' => 'Success update transaction');
        } else {
            $result = array('success' => false, 'msg' => 'Failed update transaction');
        }
        echo json_encode($result);
    }
    function savePemohon(){
      
      $status_pemohon = $this->input->post('status_pemohon');
      $namaLengkap = $this->input->post('nama_lengkap_jawab');
      $namadirektur = $this->input->post('nama_direktur');
      $nama_perusahaan = $this->input->post('nama_perusahaan');
      $jabatan = $this->input->post('jabatan');
      $nomorInKepen = $this->input->post('nomor_induk');
      $nomorInBeru = $this->input->post('nomor_induk_b');
      $npwp = $this->input->post('npwp');
      $alamat_perusahaan = $this->input->post('alamat_perusahaan');
      $no_telp = $this->input->post('no_telp');
      $emailAktif = $this->input->post('email');
      $sistem_usaha = $this->input->post('sistem_usaha');
      $status_nib = $this->input->post('status_nib');

      $fotoktp = $this->uploadFoto('foto_ktp');
      $fotonpwp = $this->uploadFoto('foto_npwp');
      $fotoakta = $this->uploadFoto('aktePerusahaan');
      $cek = $this->us->cekPemohon($emailAktif,$status_pemohon);

      $idpemohon = $cek->row();
      $token = $this->incrementalHash(8);
      if ($cek->num_rows() > 0) {
         $tgl = $idpemohon->created_at;
         $id = $idpemohon->id_pemohon;
         $where = array(
            'id_pemohon'=>$id
        );
        if ($namaLengkap == null) {
            $nama = $namadirektur;
        }else{
            $nama = $namaLengkap;
        }
         $arrayPermohonan = array(
            'nama'=>$nama,
            'nama_perusahaan'=>$nama_perusahaan,
            'jabatan'=>$jabatan,
            'nik'=>$nomorInKepen,
            'foto_ktp'=>$fotoktp,
            'nib'=>$nomorInBeru,
            'npwp'=>$npwp,
            'alamat_perusahaan'=>$alamat_perusahaan,
            'no_hp'=>$no_telp,
            'email'=>$emailAktif,
            'sistem_usaha'=>$sistem_usaha,
            'status_nib'=>$status_nib,
            'foto_npwp'=>$fotonpwp,
            'akta_perusahaan'=>$fotoakta,
            'created_at' => $tgl,
            'updated_at' => date('Y-m-d H:i:s'),
        );
         $q = $this->db->update('pemohon',$arrayPermohonan,$where);
     }else{
         $this->load->library('uuid');
         $uuid = $this->uuid->v4();
         $id = str_replace('-', '', $uuid);
         $q = $this->us->InsertPemohon($id,$namaLengkap,$namadirektur,$nama_perusahaan,$jabatan,$nomorInKepen,$fotoktp,$nomorInBeru,$npwp,$alamat_perusahaan,$no_telp,$emailAktif,$fotonpwp,$status_pemohon,$token,$fotoakta,$sistem_usaha,$status_nib);
     }

        if ($q) {
            return $id;
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
        echo json_encode($json);
    }
    function saveSlf()
    {

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);

        $nopd_bangunan = $this->input->post('nopd_bangunan');
        $luas_lahan = $this->input->post('luas_lahan');
        $status_milik = $this->input->post('status_kepem_lahan');
        $ltb = $this->input->post('ltb');
        $jml_lantai = $this->input->post('jml_lantai');
        $luas_bangunan = $this->input->post('luas_bangunan');
        $tinggi_bangunan = $this->input->post('tinggi_bangunan');
        $peruntukan_bangunan = $this->input->post('peruntukan_bangunan');
        $no_imb = $this->input->post('no_imb');
        $no_slf = $this->input->post('no_slf');

        $arrayPermohonan = array(
            'id_slf'=>$id,
            'nopd_bangunan'=>$nopd_bangunan,
            'luas_lahan'=>$luas_lahan,
            'status_milik'=>$status_milik,
            'luas_tapak'=>$ltb,
            'jumlah_lantai'=>$jml_lantai,
            'luas_total_bangunan'=>$luas_bangunan,
            'tinggi_bangunan'=>$tinggi_bangunan,
            'peruntukan_bangunan'=>$peruntukan_bangunan,
            'no_imb'=>$no_imb,
            'no_slf'=>$no_slf,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('data_slf',$arrayPermohonan);

        if ($q) {
            return $id;
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
        echo json_encode($json);

    }
    function saveIuts()
    {
        $nop = $this->input->post('nop');
        $njop = $this->input->post('njop');
        $nama_toko = $this->input->post('nama_toko');
        $kelompok = $this->input->post('kelompok_usaha');
        $nama_badan_usaha = $this->input->post('nama_badan_usaha');
        $omset_perbulan = $this->input->post('omset_perbulan');
        $untuk_toko = $this->input->post('peruntukan_toko');
        $status_bangunan = $this->input->post('status_bangunan');
        $lama_sewa = $this->input->post('lama_sewa_input');

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);

        $arrayPermohonan = array(
            'id_iuts'=>$id,
            'nopd'=>$nop,
            'njop'=>$njop, 
            'nama_toko'=>$nama_toko,
            'kelompok_usaha'=>$kelompok,
            'nama_badan_usaha'=>$nama_badan_usaha,
            'omset'=>$omset_perbulan,
            'peruntukan_imb'=>$untuk_toko,
            'status_bangunan'=>$status_bangunan,
            'lama_sewa'=>$lama_sewa,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('data_iuts',$arrayPermohonan);
        if ($q) {
            return $id;
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
        echo json_encode($json);

    }
    function saveKoperasi($idizin)
    {

        $nop = $this->input->post('nop');
        $nama_toko = $this->input->post('nama_toko');
        $tujuan_usaha = $this->input->post('tujuan_usaha');
        $lokasi_pemohon = $this->input->post('lokasi_pemohon');
        $nama_pengawas = $this->input->post('nama_pengawas');
        $nama_pengurus = $this->input->post('nama_pengurus');
        $kegiatan_usaha = $this->input->post('kegiatan_usaha');
        $omset_perbulan = $this->input->post('omset_perbulan');
        $peruntukan_toko = $this->input->post('peruntukan_toko');
        $lama_sewa_input = $this->input->post('lama_sewa_input');
        $jangka_waktu = $this->input->post('jangka_waktu');
        $status_bangunan = $this->input->post('status_bangunan');
        $jenis_usaha = $this->input->post('jenis_usaha');

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);

        $arrayPermohonan = array(
            'id_koperasi'=>$id,
            'nopd'=>$nop, 
            'nama_koperasi'=>$nama_toko,
            'tujuan_koperasi'=>$tujuan_usaha,
            'alamat'=>$lokasi_pemohon,
            'nama_pengawas'=>$nama_pengawas,
            'nama_pegurus'=>$nama_pengurus,
            'kegiatan_usaha'=>$kegiatan_usaha,
            'omset_perbulan'=>$omset_perbulan,
            'peruntuk_imb'=>$peruntukan_toko,
            'status_bangunan'=>$status_bangunan,
            'lama_sewa'=>$lama_sewa_input,
            'jangka_waktu'=>$jangka_waktu,
            'jenis_usaha'=>$jenis_usaha,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('data_iuts',$arrayPermohonan);
        if ($q) {
            return $id;
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
        echo json_encode($json);
    }
    function saveKondisiSlf($idslf)
    {
        $kdh_zonasi = $this->input->post('kdh');
        $jalaneksis = $this->input->post('jln_eksisting');
        $kdh_minimum = $this->input->post('kdh_minimum');
        $kondisi_kdh = $this->input->post('kondisi_kdh');
        $volume = $this->input->post('volume_sumur_r');
        $kondisipertandaan = $this->input->post('kondisi_pertandaan_toko');
        $kondisi_sumur = $this->input->post('kondisi_sumur_r');
        $drainase = $this->input->post('drainase_disekeliling');

        $slf = $this->input->post('slf');
        if ($slf == 4) {
            $damkar = 4;
            $tenaga_kerja = 4;
            $fasilitas = 4;
        }else{
            $damkar = $this->input->post('izin_dinas_pkp');
            $tenaga_kerja = $this->input->post('izin_dinas_tkt');
            $fasilitas = $this->input->post('fasilitas_penang_kebakaran');
        }
        $imb = $this->input->post('imb');

        $asuransi = $this->input->post('ketersediaan_asuransi_toko');
        $kelayakan = $this->input->post('waktu_pembaruan_k_g');
        $air = $this->input->post('air_bersih');
        $sumber_air = $this->input->post('sumber_air_bersih');
        $limbah = $this->input->post('pengelolaan_air_kotor');
        $sampah = $this->input->post('pengelolaan_sampah');
        $listrik = $this->input->post('ketersediaan_listrik');
        $toilet = $this->input->post('ketersediaan_toilet');
        $parkir = $this->input->post('kondisi_parkir');

        $cek = $this->us->cekKondisislf($idslf);
        if ($cek->num_rows() > 0) {
            $getdata = $cek->row();
            $id = $getdata->id;
            $where = array(
                'id_slf' => $idslf,
            );
            $array = array(
                'kdh_zonasi' => $kdh_zonasi,
                'id_jalan_eksis' => $jalaneksis,
                'id_kdh_minimum' => $kdh_minimum,
                'id_kondisi_kdh' => $kondisi_kdh,
                'id_volume_sumur' => $volume,
                'id_pertandaan_toko' => $kondisipertandaan,
                'id_kondisi_sumur' => $kondisi_sumur,
                'id_drainase' => $drainase,
                'id_layak' => $slf,
                'id_izin_damkar' => $damkar,
                'id_tenaga_kerja' => $tenaga_kerja, // baru
                'id_imb' => $imb,
                'id_penanggulangan_kebakaran' => $fasilitas,
                'id_asuransi' => $asuransi,
                'id_renovasi' => $kelayakan,
                'id_bersih' => $air,
                'sumber_air' => $sumber_air,
                'id_limbah' => $limbah,
                'id_sampah' => $sampah,
                'id_listrik' => $listrik,
                'id_toilet' => $toilet,
                'id_parkir' => $parkir,
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update('kondisi_slf',$array,$where);
        }else{
            $q = $this->us->InsertKondisiSlf($idslf,$kdh_zonasi,$jalaneksis,$kdh_minimum,$kondisi_kdh,$volume,$kondisipertandaan,$kondisi_sumur,$drainase,$slf,$damkar,$tenaga_kerja,$imb,$fasilitas,$asuransi,$kelayakan,$air,$sumber_air,$limbah,$sampah,$listrik,$toilet,$parkir);
        }
        return $q;
    }
    function saveKondisiIuts($idiuts,$id_tata)
    {
        $pbb = $this->input->post('pemutahiran_pbb');
        $umkm = $this->input->post('keterlibatan_umkm');
        $keterlibatan_umkm_input = $this->input->post('keterlibatan_umkm_input');
        $warga = $this->input->post('persetujuan_warga');
        $jumlah_karyawan = $this->input->post('jumlah_karyawan');
        $asal_karyawan = $this->input->post('asal_karyawan');
        $jumlah_atm = $this->input->post('jumlah_atm');
        $jumlah_pengunjung = $this->input->post('jumlah_pengunjung_b');
        $status_milik_usaha = $this->input->post('status_milik_usaha');

        $rek_umkm = $this->input->post('rekomendasi_umkm');
        $kajian = $this->input->post('kajian_sostek');
        $cek = $this->us->cekKondisiiuts($idiuts);
        if ($cek->num_rows() > 0) {
            $getdata = $cek->row();
            $id = $getdata->id;
            $where = array(
                'id_iuts' => $idiuts,
            );
            $array = array(
                'id_pem_pbb' => $pbb,
                'id_umkm' => $umkm,
                'keterlibatan_umkm' => $keterlibatan_umkm_input,
                'jml_karyawan' => $jumlah_karyawan,
                'asal_karyawan' => $asal_karyawan,
                'jml_atm' => $jumlah_atm,
                'jml_pengunjung' => $jumlah_pengunjung,
                'id_rek_umkm' => $rek_umkm,
                'id_tata_ruang' => $id_tata,
                'id_kasostek' => $kajian,
                'id_warga'=>$warga,
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update('kondisi_iuts',$array,$where);
        }else{
            $q = $this->us->InsertKondisiIuts($idiuts,$pbb,$umkm,$keterlibatan_umkm_input,$jumlah_karyawan,$asal_karyawan,$jumlah_atm,$jumlah_pengunjung,$rek_umkm,$id_tata,$kajian,$warga);
        }
        return $q;
    }
    function saveIzin($idpemohon,$idslf='',$idiuts='')
    {
        
        $lokasi = $this->input->post('alamat');

        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $zona = $this->input->post('subzona');
        $sublock = $this->input->post('idsubblok');
        $alamatpemohon = $this->input->post('lokasi_pemohon');
        $alamatmaps = $this->input->post('lokasi_map');
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');
        $jenis = $this->input->post('jenis_izin');

        $kode = $this->randstr();
         $this->load->library('uuid');
            $uuid = $this->uuid->v4();
            $id = str_replace('-', '', $uuid);
        $array = array(
            'id_izin' => $id,
            'id_pemohon' => $idpemohon,
            'id_slf' => $idslf,
            'id_iuts' => $idiuts,
            'alamat_usaha' => $alamatpemohon,
            'alamat_maps' => $alamatmaps,
            'lat' => $lat,
            'lon' => $lng,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'zona' => $zona,
            'kode_sublok' => $sublock,
            'code' => $kode,
            'status' => 0,
            'status_jalan' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'id_jenis' => $jenis,
        );
            $q = $this->db->insert('cek_izin',$array);
            if ($q) {
                return $id;
            }else{
                $json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
            }
        // echo json_encode($json);
        // }else{
        //     $this->load->library('uuid');
        //     $uuid = $this->uuid->v4();
        //     $id = str_replace('-', '', $uuid);
        //     $q = $this->us->InsertIzin($id,$idpemohon,$idslf,$idiuts,$lokasi,$alamatpemohon,$lat,$lng,$kecamatan,$kelurahan,$zona,$sublock,$kode,$jenis);
        // }
        return $q;
    }
    function saveSkor($slf)
    {
        $skor = $this->us->SkoringWeb($slf)->row();
        $avg =  $skor->skoriuts * 1 * 1;
        $rata = round($skor->skorslf,1);
        $iuts = round($avg,1);

        if ($rata < 1.5) {
            $status = '2';
        }else if($rata > 1.5 ){
            $status = '0';
        }else if ($rata > 2.5) {
            $status = '1';
        }

        if ($iuts < 1.5) {
            $status_iuts = '2';
        }else if($iuts > 1.5 ){
            $status_iuts = '0';
        }else if ($iuts > 2.5) {
            $status_iuts = '1';
        }
        $totalslf = $skor->skorslf;
        $cek = $this->us->cekSkor($slf);
        if ($cek->num_rows() > 0) {
           $getdata = $cek->row();
           $id = $getdata->id;
           $where = array(
            'id_bangunan' => $id,
        );
           $array = array(
            'total_slf' => $totalslf,
            'total_iuts' => $iuts,
            'rata-rata' => $rata,
            'status_iuts' => $status_iuts,
            'status_slf' => $status,
            'created_at' => $getdata->created_at,
            'updated_at' => date('Y-m-d H:i:s'),
        );
           $q = $this->db->update('skor_bangunan',$array,$where);
       }else{
           $q = $this->us->InsertSkor($slf,$totalslf,$iuts,$rata,$status_iuts,$status);
       }
       return $q;
   }
   function saveTaxClear()
   {
        $id = $this->input->post('id');
        $pbb = $this->input->post('status_pbb');
        $npwp = $this->input->post('status_npwp');
        $jenis = $this->input->post('jenis');
        $cek = $this->us->cekTax($idizin);
        if ($cek->num_rows() > 0) {
            $getdata = $cek->row();
            $id = $getdata->id;
            $where = array(
                'id_izin' => $id,
            );
            $array = array(
                'status_pbb' => $pbb,
                'status_npwp' => $npwp,
                'jenis' => $jenis,
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update('taxclear',$array,$where);
        }else{
            $q = $this->us->InsertTax($id,$pbb,$npwp,$jenis);
        }
        if ($q) {
            $json = $this->returnResultCustom(true,'Berhasil Simpan Data');
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Data');
        }

        echo json_encode($json);
    }
    function saveFotoAdmin($id)
    {
        $jenis = 'foto_admin';
        $fotoktp = $this->uploadFotoAdmin('foto_ktp');
        $fotonpwp = $this->uploadFotoAdmin('foto_npwp');
        $fotoakta = $this->uploadFotoAdmin('aktePerusahaan');
        $cek = $this->us->cekFotoAll($id,$jenis);
        if ($cek->num_rows() > 0) {
            $where = array(
                'idizin' => $id,
            );
            $array = array(
                'foto_ktp' => $fotoktp,
                'foto_npwp' => $fotonpwp,
                'foto_akta' => $fotoakta,
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update($jenis,$array,$where);
        }else{
            $this->load->library('uuid');
            $uuid = $this->uuid->v4();
            $iduniv = str_replace('-', '', $uuid);
            $data = array(
                'idfotoadmin'=>$iduniv,
                'idizin'=>$id,
                'foto_ktp' => $fotoktp,
                'foto_npwp' => $fotonpwp,
                'foto_akta' => $fotoakta,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->insert($jenis, $data);
        }
        if ($q) {
            $json = $this->returnResultCustom(true,'Berhasil Simpan Data');
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Data');
        }
        
        echo json_encode($json);
    }
    function saveFotoIUTS($id)
    {
        $jenis = 'foto_iuts';
        $filePBB = $this->uploadFotoIuts('filePBB');
        $filePerW = $this->uploadFotoIuts('filePerW');
        $fileUMKM = $this->uploadFotoIuts('fileUMKM');
        $fileSostek = $this->uploadFotoIuts('fileSostek');

        $cek = $this->us->cekFotoAll($id,$jenis);
        if ($cek->num_rows() > 0) {
            $where = array(
                'idizin' => $id,
            );
            $array = array(
                'fotopbb' => $filePBB,
                'fotoperw' => $filePerW,
                'fotorekumkm' => $fileUMKM,
                'fotokajian' => $fileSostek,
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update($jenis,$array,$where);
        }else{
            $this->load->library('uuid');
            $uuid = $this->uuid->v4();
            $iduniv = str_replace('-', '', $uuid);
            $data = array(
                'id_fotoi'=>$iduniv,
                'idizin'=>$id,
                'fotopbb' => $filePBB,
                'fotoperw' => $filePerW,
                'fotorekumkm' => $fileUMKM,
                'fotokajian' => $fileSostek,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->insert($jenis, $data);
        }
        if ($q) {
            $json = $this->returnResultCustom(true,'Berhasil Simpan Data');
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Data');
        }
        
        echo json_encode($json);

    }
    function saveFotoSLF($id)
    {
        $jenis = 'foto_slf';
        $filelahan = $this->uploadFoto('fileStatusLahan');
        $fotoluar = $this->uploadFoto('fotoluar');
        $foto_dalam_bangunan = $this->uploadFoto('foto_dalam_bangunan');
        $fileIMB = $this->uploadFoto('fileIMB');
        $fileSLF = $this->uploadFoto('fileSLF');
        $fileSuratP = $this->uploadFoto('fileSuratP');
        $fileDamkar = $this->uploadFoto('fileDamkar');
        $fileTKT = $this->uploadFoto('fileTKT');
        $fileAsuransi = $this->uploadFoto('fileAsuransi');

        $cek = $this->us->cekFotoAll($id,$jenis);
        if ($cek->num_rows() > 0) {
            $where = array(
                'idizin' => $id,
            );
            $array = array(
                'filelahan' => $filelahan,
                'fotoluar' => $fotoluar,
                'fotodalam' => $foto_dalam_bangunan,
                'fotoimb' => $fileIMB,
                'fotoslf' => $fileSLF,
                'filepengkaji' => $fileSuratP,
                'fotodamkar' => $fileDamkar,
                'fototkt' => $fileTKT,
                'fotoasuransi' => $fileAsuransi,
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update($jenis,$array,$where);
        }else{
            $this->load->library('uuid');
            $uuid = $this->uuid->v4();
            $iduniv = str_replace('-', '', $uuid);
            $data = array(
                'idfotoadmin'=>$iduniv,
                'idizin'=>$id,
                'filelahan' => $filelahan,
                'fotoluar' => $fotoluar,
                'fotodalam' => $foto_dalam_bangunan,
                'fotoimb' => $fileIMB,
                'fotoslf' => $fileSLF,
                'filepengkaji' => $fileSuratP,
                'fotodamkar' => $fileDamkar,
                'fototkt' => $fileTKT,
                'fotoasuransi' => $fileAsuransi,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->insert($jenis, $data);
        }
        if ($q) {
            $json = $this->returnResultCustom(true,'Berhasil Simpan Data');
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Data');
        }
        
        echo json_encode($json);
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
    function uploadFotoLuar($params)
    {

        $this->load->library('upload');
        $config['upload_path'] = './assets/fotoluar/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;
        // var_dump($params);
        // var_dump($this->upload->do_upload($params));
        $fb = "";
          $this->upload->initialize($config);
          for ($i=0; $i < sizeof($_FILES[$params]['name']) ; $i++) { 
                  $this->upload->do_upload($params);
                    $f = $this->upload->data();
                    if (count($f) != 14) {
                        for ($i=0; $i < count($f); $i++) {
                            $abc = $f[$i]['file_name'].',';
                            $fb .= $abc;
                        }
                        $newfotonya = substr($fb, 0, -1);
                    }else{
                        $newfotonya = $f['file_name'];
                    }
        }
          return $newfotonya;
    }
    function uploadFotoDalam($params)
    {
        $this->load->library('upload');

        $config['upload_path'] = './assets/fotodalam/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;

        $ga = "";
        $this->upload->initialize($config);
        if ($this->upload->do_upload($params)) {
            $s = $this->upload->data();
            if (count($s) != 14) {
                for ($i=0; $i < count($s); $i++) {
                    $abc = $s[$i]['file_name'].',';
                    $ga .= $abc;
                }
                $newfiledalam = substr($ga, 0, -1);
            }else{
                $newfiledalam = $s['file_name'];
            }
        }else{
            $s = $this->input->post($params);
            for ($i=0; $i < count($s); $i++) {
                $abc = $s[$i].',';
                $ga .= $abc;
            }
            $newfiledalam = substr($s, 0, -1);
        }
        return $newfiledalam;
    }
    function uploadFoto($params)
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/fileslf/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|';
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;

        $ga = "";
        $this->upload->initialize($config);
        if ($this->upload->do_upload($params)) {
            $s = $this->upload->data();
            if (count($s) != 14) {
                for ($i=0; $i < count($s); $i++) {
                    $abc = $s[$i]['file_name'].',';
                    $ga .= $abc;
                }
                $newfiledalam = substr($ga, 0, -1);
            }else{
                $newfiledalam = $s['file_name'];
            }
        }else{
            $s = $this->input->post($params);
            for ($i=0; $i < count($s); $i++) {
                $abc = $s[$i].',';
                $ga .= $abc;
            }
            $newfiledalam = substr($s, 0, -1);
        }
        return $newfiledalam;
    }
    function uploadFotoAdmin($params)
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/fileadmin/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|';
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;

        $ga = "";
        $this->upload->initialize($config);
        if ($this->upload->do_upload($params)) {
            $s = $this->upload->data();
            if (count($s) != 14) {
                for ($i=0; $i < count($s); $i++) {
                    $abc = $s[$i]['file_name'].',';
                    $ga .= $abc;
                }
                $newfiledalam = substr($ga, 0, -1);
            }else{
                $newfiledalam = $s['file_name'];
            }
        }else{
            $s = $this->input->post($params);
            for ($i=0; $i < count($s); $i++) {
                $abc = $s[$i].',';
                $ga .= $abc;
            }
            $newfiledalam = substr($s, 0, -1);
        }
        return $newfiledalam;
    }
    function uploadFotoIuts($params)
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/iuts/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|';
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;

        $ga = "";
        $this->upload->initialize($config);
        if ($this->upload->do_upload($params)) {
            $s = $this->upload->data();
            if (count($s) != 14) {
                for ($i=0; $i < count($s); $i++) {
                    $abc = $s[$i]['file_name'].',';
                    $ga .= $abc;
                }
                $newfiledalam = substr($ga, 0, -1);
            }else{
                $newfiledalam = $s['file_name'];
            }
        }else{
            $s = $this->input->post($params);
            for ($i=0; $i < count($s); $i++) {
                $abc = $s[$i].',';
                $ga .= $abc;
            }
            $newfiledalam = substr($s, 0, -1);
        }
        return $newfiledalam;
    }
    function saveRegister()
    {

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);

        if ($this->input->post('password') != $this->input->post('ulang_password')) {
            $json = $this->returnResultCustom(false,'Password Tidak Sama');
        }else{
            $cek = $this->db->get_where('data_iumk', array('email'=>$email));
            if ($cek->num_rows() > 0) {
                if ($cek->row()->status == 0) {
                    $token = $this->incrementalHash(8);
                    $data = array(
                        'code'=> $this->incrementalHash(8),
                    );
                    $datapemohon = array(
                        'token'=> $token,
                        'password'=>password_hash($token, PASSWORD_DEFAULT),
                    );
                    $where = array(
                        'email'=>$email,
                    );
                    $q = $this->db->update('data_iumk', $data,$where);
                    if ($q) {
                        $this->sendMailIumk($email);
                        $this->db->update('pemohon', $datapemohon,$where);
                        $json = $this->returnResultCustom(true,'Berhasil Kirim Email');
                    }else{
                        $json = $this->returnResultCustom(false,'Gagal kirim email');
                    }
                }else{
                    $json = $this->returnResultCustom(false,'Email Sudah Terdaftar');
                }
            }else{
                $token = $this->incrementalHash(8);
                $pemohon = array(
                    'id_pemohon'=>$id,
                    'nama'=>$this->input->post('nama'),
                    'email'=>$email,
                    'nik'=>$this->input->post('nik'),
                    'npwp'=>$this->input->post('npwp'),
                    'alamat_perusahaan'=>$this->input->post('alamat'),
                    'password'=>password_hash($token, PASSWORD_DEFAULT),
                    'token'=>$token,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                $array = array(
                    'email' => $email,
                    'user_id'=> $id,
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'ulang_password' => $this->input->post('password'),
                    'nik' => $this->input->post('nik'),
                    'nokk' => $this->input->post('nokk'),
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'wilayah' => $this->input->post('wilayah'),
                    'kelurahan' => $this->input->post('kelurahan'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kota' => $this->input->post('kota'),
                    'provinsi' => $this->input->post('provinsi'),
                    'rt' =>$this->input->post('rt'),
                    'rw' => $this->input->post('rw'),
                    'tmplahir' => $this->input->post('tmplahir'),
                    'tglahir' =>$this->input->post('tglahir'),
                    'jenis_kelamin' =>$this->input->post('jenis_kelamin'),
                    'npwp' =>$this->input->post('npwp'),
                    'notlp' =>$this->input->post('notlp'),
                    'code'=>$this->incrementalHash(8),
                    'status'=>0,
                );

                $q = $this->db->insert('data_iumk', $array);
                if ($q) {
                    $this->db->insert('pemohon', $pemohon);
                    $this->sendMailIumk($email);
                    $json = $this->returnResultCustom(true,'Berhasil Kirim Email');
                }else{
                    $json = $this->returnResultCustom(false,'Gagal kirim email');
                }
            }
        }
        echo json_encode($json);
    }
    function UpdateIumk()
    {

        $db2 = $this->load->database('jakevo',true);

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);

        $email = $this->input->post('email');
        $token = $this->input->post('token');
        $cek = $this->db->get_where('data_iumk', array('email'=>$email,'code'=>$token));
        if ($cek->num_rows() == 0) {
            $json = $this->returnResultCustom(false,'Token Tidak Aktif');
        }else{
            $data = array(
                        'status'=> 1,
                    );
            $where = array(
                        'email'=>$email,
                    );
            $q = $this->db->update('data_iumk', $data,$where);
            if ($q) {
                $dPemohon = $this->us->cekDataIUMK($email);
                $result = $this->returnResult($dPemohon);
                $json = json_encode($result);
                $decoder = json_decode($json);
                if($decoder->rowCount>0){
                    $decodeData = $decoder->row[0];
                    $data = array(
                        'id'=>$decodeData->user_id,
                        'email'=>$decodeData->email,
                        'password'=>$decodeData->password,
                        'confirmed'=>true,
                        'active'=>true,
                        'sendMail'=>true,
                    );
                    $dataprofile = array(
                        'id'=>$id,
                        'user_id'=>$decodeData->user_id,
                        'nik'=>$decodeData->nik,
                        'no_kk'=>$decodeData->nokk,
                        'nama_ktp'=>$decodeData->nama,
                        'alamat'=>$decodeData->alamat,
                        'no_rt'=>$decodeData->rt,
                        'no_rw'=>$decodeData->rw,
                        'kelurahan'=>$decodeData->kelurahan,
                        'kecamatan'=>$decodeData->kecamatan,
                        'kota'=>$decodeData->kota,
                        'provinsi'=>$decodeData->provinsi,
                        'tempat_lahir'=>$decodeData->tmplahir,
                        'tgl_lahir'=>$decodeData->tglahir,
                        'jenis_kelamin'=>$decodeData->jenis_kelamin,
                        'no_tlp'=>$decodeData->notlp,
                        'npwp'=>$decodeData->npwp,
                        'wilayah'=>$decodeData->wilayah,
                        'created_by'=>'SYSTEM',
                        'user_type'=>'pemohon',

                    );
                    $insertjak = $db2->insert('users',$data);
                    if ($insertjak) {
                        $db2->insert('user_profiles',$dataprofile);
                        $json = $this->returnResultCustom(true,'Berhasil Verifikasi Data');
                    }else{
                        $json = $this->returnResultCustom(false,'Gagal Verifikasi Data');
                    }
                }
                $json = $this->returnResultCustom(true,'Berhasil Verifikasi Data');
            }else{
                $json = $this->returnResultCustom(false,'Gagal Verifikasi Data');
            }
        }

    }
    function sendMailIumk($email)
    {
        $dPemohon = $this->us->cekDataIUMK($email);
        $result = $this->returnResult($dPemohon);
        $json = json_encode($result);
        $decoder = json_decode($json);
        if($decoder->rowCount>0){
            $decodeData = $decoder->row[0];
            $emailpemohon = $decodeData->email;
            $tokenpemohon = $decodeData->code;
            $data = array();
            $data['data'] = $decodeData;
            $data['title'] = "Token Verifikasi";
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
            $mesg = $this->load->view('pages/mailiumk', $data, true);
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
            $result = $this->returnResultCustom(false,'Tidak ditemukan data dengan nomor token '.$tokenpemohon);
        }
    }
    function sendmail($email,$status_pemohon='')
    {
        $dPemohon = $this->us->cekPemohon($email,$status_pemohon);
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
            $result = $this->returnResultCustom(false,'Tidak ditemukan data dengan nomor token '.$tokenpemohon);
        }
    }
}

/* End of file ValidasiController.php */
/* Location: ./application/controllers/ValidasiController.php */