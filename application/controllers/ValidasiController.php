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
        // $email = htmlspecialchars($json[0]->emailAktif);
        // $jenis = htmlspecialchars($json[0]->jenis_izin);

        //     //SLF
        // $kdh_zonasi = htmlspecialchars($json[0]->kdh_zonasi);
        // $kdh_minimum = htmlspecialchars($json[0]->kdh_minimum);
        // $kondisi_kdh = htmlspecialchars($json[0]->kondisi_kdh);
        // $volume = htmlspecialchars($json[0]->volumeSumur);
        // $kondisipertandaan = htmlspecialchars($json[0]->kondisi_pertandaan_toko);
        // $kondisi_sumur = htmlspecialchars($json[0]->kondisi_sumur_r);
        // $drainase = htmlspecialchars($json[0]->drainase_disekeliling);

        // $rek_slf = htmlspecialchars($json[0]->rekomendasi_slf);
        // $damkar = htmlspecialchars($json[0]->izin_dinas_pkp);
        // $tenaga_kerja = htmlspecialchars($json[0]->izin_dinas_tkt);
        // $imb = htmlspecialchars($json[0]->imb);

        // $fasilitas = htmlspecialchars($json[0]->fasilitas_penang_kebakaran);
        // $asuransi = htmlspecialchars($json[0]->ketersediaan_asuransi_toko);
        // $kelayakan = htmlspecialchars($json[0]->waktu_pembaruan_k_g);
        // $air = htmlspecialchars($json[0]->air_bersih);
        // $sumber_air = htmlspecialchars($json[0]->sumber_air_bersih);
        // $limbah = htmlspecialchars($json[0]->pengelolaan_air_kotor);
        // $sampah = htmlspecialchars($json[0]->pengelolaan_sampah);
        // $listrik = htmlspecialchars($json[0]->ketersediaan_listrik);
        // $toilet = htmlspecialchars($json[0]->ketersediaan_toilet);
        // $parkir = htmlspecialchars($json[0]->kondisi_parkir);

        //     //END SLF


        //     // Mulai IUTS

        // /*Administrasi Bangunan*/
        //     // $kondisi = htmlspecialchars($json[0]->kondisi_eksisting);
        //     // $detail_kondisi_input = htmlspecialchars($json[0]->detail_kondisi_input);
        // $sublock = htmlspecialchars($json[0]->idsubblok);
        // /*Administrasi Bangunan*/

        // /*Kebermanfaatan Usaha*/
        // $pbb = htmlspecialchars($json[0]->pemutakhiran_pbb);
        // $umkm = htmlspecialchars($json[0]->keterlibatan_umkm);
        // $keterlibatan_umkm_input = htmlspecialchars($json[0]->keterlibatan_umkm_input);
        // $warga = htmlspecialchars($json[0]->persetujuan_warga);
        // $jumlah_karyawan = htmlspecialchars($json[0]->jumlah_karyawan);
        // $asal_karyawan = htmlspecialchars($json[0]->asal_karyawan);
        // $jumlah_atm = htmlspecialchars($json[0]->jumlah_atm);
        // $jumlah_pengunjung = htmlspecialchars($json[0]->jumlah_pengunjung_b);
        // $status_milik_usaha = htmlspecialchars($json[0]->status_milik_usaha);
        // $peng_lahan = htmlspecialchars($json[0]->penggunaan_lahan);
        // /*Kebermanfaatan Usaha*/

        // /*Informasi Antisipasi Dampak/Resiko*/
        // $rek_umkm = htmlspecialchars($json[0]->rekomendasi_umkm);
        // $kajian = htmlspecialchars($json[0]->kajian_sostek);
        // /*Informasi Antisipasi Dampak/Resiko*/

        // $status_npwp = htmlspecialchars($json[0]->status_npwp);
        // $status_pbb = htmlspecialchars($json[0]->status_pbb);

        // $spasial = $this->us->cekSpasial($sublock);
        $slf = $this->saveSlf($json);
        // if ($spasial->num_rows() > 0) {
        //     $row = $spasial->row();
        //     $id_tata = $row->id;
        // }else{
        //     $id_tata = 1;
        // }
        // if(empty($status_npwp) OR $status_npwp=='-' OR $status_npwp=='0'){
        //     echo json_encode($this->returnResultCustom(false,"Harus Melakukan Verifikasi NIK dan PBB"));
        //     return;
        // }else if(empty($status_pbb) OR $status_pbb =='-' OR $status_pbb=='0'){
        //     echo json_encode($this->returnResultCustom(false,"Harus Melakukan Verifikasi NIK dan PBB"));
        //     return;
        // }else if (empty($sublock) OR $sublock=='-') {
        //     echo json_encode($this->returnResultCustom(false,"Mohon Pilih lokasi maps dekat dengan layar yang berwarna "));
        //     return;
        // }else if ($sublock == 'H.2') {
        //     echo json_encode($this->returnResultCustom(false,"Tidak Boleh di Zona Hijau"));
        //     return;
        // }
        //     if ($jenis == '1') { // IUTS
        //         if(empty($pbb) OR $pbb =='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Pemutakhiran PBB Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($umkm) OR $umkm =='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Keterlibatan UMKM Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($warga) OR $warga =='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Persetujuan Warga Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($keterlibatan_umkm_input) OR $keterlibatan_umkm_input =='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Detail Keterlibatan UMKM Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($asal_karyawan) OR $asal_karyawan=='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Asal Karyawan Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($jumlah_atm)){
        //             echo json_encode($this->returnResultCustom(false,"Jumlah Karyawan Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($jumlah_pengunjung)){
        //             echo json_encode($this->returnResultCustom(false,"Jumlah Pengunjung Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($peng_lahan) OR $peng_lahan=='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Pengelolaan Lahan Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($rek_umkm) OR $rek_umkm=='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Rekomendasi UMKM Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kajian) OR $kajian=='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Kajian Sosek Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($jumlah_karyawan)){
        //             echo json_encode($this->returnResultCustom(false,"Jumlah Karyawan Tidak Boleh Kosong"));
        //             return;
        //         }
        //     }else if ($jenis == '2') { // SLF
        //         if(empty($kdh_zonasi) OR $kdh_zonasi == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Silakan Pilih Koefisien Daearh Hijau di Peta"));
        //             return;
        //         }else if(empty($kdh_minimum) OR $kdh_minimum == '-'){
        //             echo json_encode($this->returnResultCustom(false,"KDH Eksisting Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kondisi_kdh) OR $kondisi_kdh == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Kondisi KDH Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($volume) OR $volume == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Volume Sumur Resapan Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kondisipertandaan) OR $kondisipertandaan == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Kondisi Pertandaan Toko Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kondisi_sumur) OR $kondisi_sumur == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Kondisi Sumur Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($drainase) OR $drainase == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Drainase Sekeliling Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($rek_slf) OR $rek_slf == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Rekomendasi SLF Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($damkar) OR $damkar == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Izin Dinas Penganggulangan Kebakaran dan Penyelamatan Harus Di Isi"));
        //             return;
        //         }else if(empty($tenaga_kerja) OR $tenaga_kerja == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Izin Dinas Tenaga Kerja dan Transmigrasi Harus Di Isi"));
        //             return;
        //         }else if(empty($imb) OR $imb == '-'){
        //             echo json_encode($this->returnResultCustom(false,"IMB Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($fasilitas) OR $fasilitas == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Fasilitas Penganggulangan Kebakaran Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($asuransi) OR $asuransi == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Asuransi Toko Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kelayakan) OR $kelayakan == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Waktu Pembaharuan Terakhir Kelayakan Gedung Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($ket_air) OR $ket_air == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Ketersediaan Air Bersih Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($limbah) OR $limbah == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Pengelolaan Air Kotor / Limbah Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($sampah) OR $sampah == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Pengelolaan Sampah Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($listrik) OR $listrik == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Ketersediaan Listrik Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($toilet) OR $toilet == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Ketersediaan Toilet Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($parkir) OR $parkir == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Kondisi Parkir Tidak Boleh Kosong"));
        //             return;
        //         }
        //     }else if ($jenis == '3'){ //SLF dan IUTS 
        //         if(empty($kdh_zonasi) OR $kdh_zonasi == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Silakan Pilih Koefisien Daearh Hijau di Peta"));
        //             return;
        //         }else if(empty($kdh_minimum) OR $kdh_minimum == '-'){
        //             echo json_encode($this->returnResultCustom(false,"KDH Eksisting Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kondisi_kdh) OR $kondisi_kdh == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Kondisi KDH Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($volume) OR $volume == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Volume Sumur Resapan Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kondisipertandaan) OR $kondisipertandaan == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Kondisi Pertandaan Toko Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kondisi_sumur) OR $kondisi_sumur == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Kondisi Sumur Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($drainase) OR $drainase == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Drainase Sekeliling Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($rek_slf) OR $rek_slf == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Rekomendasi SLF Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($damkar) OR $damkar == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Izin Dinas Penganggulangan Kebakaran dan Penyelamatan Harus Di Isi"));
        //             return;
        //         }else if(empty($tenaga_kerja) OR $tenaga_kerja == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Izin Dinas Tenaga Kerja dan Transmigrasi Harus Di Isi"));
        //             return;
        //         }else if(empty($imb) OR $imb == '-'){
        //             echo json_encode($this->returnResultCustom(false,"IMB Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($fasilitas) OR $fasilitas == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Fasilitas Penganggulangan Kebakaran Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($asuransi) OR $asuransi == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Asuransi Toko Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kelayakan) OR $kelayakan == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Waktu Pembaharuan Terakhir Kelayakan Gedung Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($ket_air) OR $ket_air == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Ketersediaan Air Bersih Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($limbah) OR $limbah == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Pengelolaan Air Kotor / Limbah Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($sampah) OR $sampah == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Pengelolaan Sampah Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($listrik) OR $listrik == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Ketersediaan Listrik Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($toilet) OR $toilet == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Ketersediaan Toilet Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($parkir) OR $parkir == '-'){
        //             echo json_encode($this->returnResultCustom(false,"Kondisi Parkir Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($pbb) OR $pbb =='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Pemutakhiran PBB Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($umkm) OR $umkm =='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Keterlibatan UMKM Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($warga) OR $warga =='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Persetujuan Warga Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($keterlibatan_umkm_input) OR $keterlibatan_umkm_input =='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Detail Keterlibatan UMKM Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($asal_karyawan) OR $asal_karyawan=='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Asal Karyawan Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($jumlah_atm)){
        //             echo json_encode($this->returnResultCustom(false,"Jumlah Karyawan Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($jumlah_pengunjung)){
        //             echo json_encode($this->returnResultCustom(false,"Jumlah Pengunjung Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($peng_lahan) OR $peng_lahan=='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Pengelolaan Lahan Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($rek_umkm) OR $rek_umkm=='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Rekomendasi UMKM Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($kajian) OR $kajian=='-' ){
        //             echo json_encode($this->returnResultCustom(false,"Kajian Sosek Tidak Boleh Kosong"));
        //             return;
        //         }else if(empty($jumlah_karyawan)){
        //             echo json_encode($this->returnResultCustom(false,"Jumlah Karyawan Tidak Boleh Kosong"));
        //             return;
        //         }
            //         $savepemohon = $this->savePemohon($json);
            //         if ($savepemohon) {
            //          $slf = $this->saveSlf($json);
            //          if ($slf) {
            //             $KondisiSlf = $this->saveKondisiSlf($slf,$json);
            //             if ($KondisiSlf) {
            //                 $iuts = $this->saveIuts($json);
            //                 if ($iuts) {
            //                     $kondisiiuts = $this->saveKondisiIuts($iuts,$json,$id_tata);
            //                     if ($kondisiiuts) {
            //                         $cekizin = $this->saveIzin($savepemohon,$slf,$iuts,$json);
            //                         $skor = $this->saveSkor($slf);
            //                         if ($skor) {
            //                             $tax = $this->saveTaxClear($slf,$status_npwp,$status_pbb);
            //                             if ($tax) {                                            
            //                                 $foto_slf = $this->saveFotoslf();
            //                                 if ($foto_slf) {
            //                                     $fotoiuts = $this->saveFotoIuts();
            //                                     if ($fotoiuts) {
            //                                         $json = $this->returnResultCustom(true,'Berhasil Simpan Data');
            //                                         $this->sendmail($email);
            //                                     }else{
            //                                         $json = $this->returnResultCustom(false,'Gagal Masukan Foto IUTS');
            //                                     }
            //                                 }else{
            //                                     $json = $this->returnResultCustom(false,'Gagal Masukan Foto SLF');
            //                                 }
            //                             }else{
            //                                 $json = $this->returnResultCustom(false,'Gagal Masukan Tax Clear');
            //                             }
            //                         }else{
            //                             $json = $this->returnResultCustom(false,'Gagal Masukan Data Skor');
            //                         }

            //                     }else{
            //                         $json = $this->returnResultCustom(false,'Gagal Masukan Data Kondisi IUTS');
            //                     }
            //                 }else{
            //                     $json = $this->returnResultCustom(false,'Gagal Masukan Data IUTS');
            //                 }
            //             }else{
            //                 $json = $this->returnResultCustom(false,'Gagal Masukan Data Kondisi Slf');
            //             }
            //         }else{
            //             $json = $this->returnResultCustom(false,'Gagal Masukan Data Data Slf');
            //         }
            //     }else{
            //         $json = $this->returnResultCustom(false,'Gagal Masukan Data Pemohon');
            //     }
            // }else{
            //     echo json_encode($this->returnResultCustom(false,"Silakan Pilih Izin Di Awal"));
            //     return;
            // }
        } catch (Exception $e) {
            $json = $this->returnResultCustom(false,'Throws');
        }
        echo json_encode($json);
    }
    function savePemohon($data)
    {
      $status_pemohon = htmlspecialchars($data[0]->status_pemohon);
      $namaLengkap = htmlspecialchars($data[0]->namaLengkap);
      $nama_perusahaan = htmlspecialchars($data[0]->nama_perusahaan);
      $jabatan = htmlspecialchars($data[0]->jabatan);
      $nomorInKepen = htmlspecialchars($data[0]->nomorInKepen);
      $nomorInBeru = htmlspecialchars($data[0]->nomorInBeru);
      $npwp = htmlspecialchars($data[0]->npwp);
      $alamat_perusahaan = htmlspecialchars($data[0]->alamat_perusahaan);
      $no_telp = htmlspecialchars($data[0]->no_telp);
      $emailAktif = htmlspecialchars($data[0]->emailAktif);
      // Foto Bangunan
        $foto_luar_bangunan = $data[0]->foto_luar_bangunan;
        $foto_dalam_bangunan = $data[0]->foto_dalam_bangunan;
        // Foto Bangunan

        $uploadfoto1 = $this->uploadFotoLuar($foto_luar_bangunan);
        $uploadfoto2 = $this->uploadFotoDalam($foto_dalam_bangunan);

      $cek = $this->us->cekPemohon($nomorInKepen,$status_pemohon);


      $idpemohon = $cek->row();
      $token = $this->incrementalHash(8);
     //  if ($cek->num_rows() > 0) {
     //     $tgl = $idpemohon->created_at;
     //     $id = $idpemohon->id_pemohon;
     //     $where = array(
     //        'id_pemohon'=>$id
     //    );
     //     $arrayPermohonan = array(
     //        'nama'=>$namaLengkap,
     //        'nama_perusahaan'=>$nama_perusahaan,
     //        'jabatan'=>$jabatan,
     //        'nik'=>$nomorInKepen,
     //        'foto_ktp'=>$fotoktp,
     //        'nib'=>$nomorInBeru,
     //        'npwp'=>$npwp,
     //        'alamat_perusahaan'=>$alamat_perusahaan,
     //        'no_hp'=>$no_telp,
     //        'email'=>$emailAktif,
     //        'foto_npwp'=>$fotonpwp,
     //        'jenis_pemohon'=>$status_pemohon,
     //        'password'=>password_hash($token, PASSWORD_DEFAULT),
     //        'token'=>$token,
     //        'created_at' => $tgl,
     //        'updated_at' => date('Y-m-d H:i:s'),
     //    );
     //     $q = $this->db->update('pemohon_iuts',$arrayPermohonan,$where);
     // }else{
         $this->load->library('uuid');
         $uuid = $this->uuid->v4();
         $id = str_replace('-', '', $uuid);
         $q = $this->us->InsertPemohon($id,$namaLengkap,$nama_perusahaan,$jabatan,$nomorInKepen,$fotoktp,$nomorInBeru,$npwp,$alamat_perusahaan,$no_telp,$emailAktif,$fotonpwp,$status_pemohon,$token);
     // }

        if ($q) {
            return $id;
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
        echo json_encode($json);
    }
    function saveSlf($data)
    {

        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);

        // $luas_lahan = htmlspecialchars($data[0]->luas_lahan);
        // $status_milik = htmlspecialchars($data[0]->status_milik);
        // $ltb = htmlspecialchars($data[0]->ltb);
        // $jml_lantai = htmlspecialchars($data[0]->jml_lantai);
        // $luas_bangunan = htmlspecialchars($data[0]->luas_bangunan);
        // $tinggi_bangunan = htmlspecialchars($data[0]->tinggi_bangunan);
        // $peruntukan_bangunan = htmlspecialchars($data[0]->peruntukan_bangunan);

        // // Foto Bangunan
        $foto_luar_bangunan = $data[0]->foto_luar_bangunan;
        $foto_dalam_bangunan = $data[0]->foto_dalam_bangunan;
        // Foto Bangunan

        $uploadfoto1 = $this->uploadFotoLuar($foto_luar_bangunan);
        $uploadfoto2 = $this->uploadFotoDalam($foto_dalam_bangunan);

        $arrayPermohonan = array(
            'id_slf'=>$id,
            // 'luas_lahan'=>$luas_lahan,
            // 'status_milik'=>$status_milik,
            // 'luas_tapak'=>$ltb,
            // 'jumlah_lantai'=>$jml_lantai,
            // 'luas_total_bangunan'=>$luas_lantai,
            // 'tinggi_bangunan'=>$luas_lantai_input,
            // 'peruntukan_bangunan'=>$luas_lantai_input,
            'foto_luar'=>$uploadfoto1,
            'foto_dalam'=>$uploadfoto2,
            // 'created_at' => date('Y-m-d H:i:s'),
            // 'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('data_slf',$arrayPermohonan);

        if ($q) {
            return $id;
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
        echo json_encode($json);

    }
    function saveIuts($idpemohon,$idslf,$data)
    {
        $nop = htmlspecialchars($data[0]->nop);
        $njop = htmlspecialchars($data[0]->njop);
        $nama_toko = htmlspecialchars($data[0]->nama_toko);
        $kelompok = htmlspecialchars($data[0]->kelompok);
        $nama_badan_usaha = htmlspecialchars($data[0]->nama_badan_usaha);
        $kategori_usaha = htmlspecialchars($data[0]->kategori_usaha);
        $omset_perbulan = htmlspecialchars($data[0]->omset_perbulan);
        $untuk_toko = htmlspecialchars($data[0]->peruntukan_toko);
        $status_bangunan = htmlspecialchars($data[0]->status_bangunan);

        $jumlah_atm = htmlspecialchars($data[0]->jumlah_atm);
        $this->load->library('uuid');
        $uuid = $this->uuid->v4();
        $id = str_replace('-', '', $uuid);

        $arrayPermohonan = array(
            'id_iuts'=>$id,
            'nopd'=>$nop,
            'njop'=>$njop,
            'nama_toko'=>$nama_toko,
            'kelompok_usaha'=>$kelompok,
            'nama_badan_usaha'=>$kelompok,
            'kategori_usaha'=>$kategori_usaha,
            'omset'=>$omset,
            'peruntukan_imb'=>$untuk_toko,
            'status_bangunan'=>$status_bangunan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('bangunan_iuts',$arrayPermohonan);
        if ($q) {
            return $id;
        }else{
            $json = $this->returnResultCustom(false,'Gagal Simpan Pemohon');
        }
        echo json_encode($json);

    }
    function saveKondisiSlf($slf,$data)
    {
        $kdh_zonasi = htmlspecialchars($data[0]->kdh_zonasi);
        $kdh_minimum = htmlspecialchars($data[0]->kdh_minimum);
        $kondisi_kdh = htmlspecialchars($data[0]->kondisi_kdh);
        $volume = htmlspecialchars($data[0]->volumeSumur);
        $kondisipertandaan = htmlspecialchars($data[0]->kondisi_pertandaan_toko);
        $kondisi_sumur = htmlspecialchars($data[0]->kondisi_sumur_r);
        $drainase = htmlspecialchars($data[0]->drainase_disekeliling);

        $rek_slf = htmlspecialchars($data[0]->rekomendasi_slf);
        $slf = htmlspecialchars($data[0]->slf);
        $damkar = htmlspecialchars($data[0]->izin_dinas_pkp);
        $tenaga_kerja = htmlspecialchars($data[0]->izin_dinas_tkt);
        $imb = htmlspecialchars($data[0]->imb);

        $fileRekomendasiSlf = htmlspecialchars($data[0]->fileRekomendasiSlf);
        $fileSLF = htmlspecialchars($data[0]->fileSLF);
        $fileDamkar = htmlspecialchars($data[0]->fileDamkar);
        $fileTKT = htmlspecialchars($data[0]->fileTKT);
        $fileIMB = htmlspecialchars($data[0]->fileIMB);

        $fasilitas = htmlspecialchars($data[0]->fasilitas_penang_kebakaran);
        $asuransi = htmlspecialchars($data[0]->ketersediaan_asuransi_toko);
        $kelayakan = htmlspecialchars($data[0]->waktu_pembaruan_k_g);
        $air = htmlspecialchars($data[0]->air_bersih);
        $sumber_air = htmlspecialchars($data[0]->sumber_air_bersih);
        $limbah = htmlspecialchars($data[0]->pengelolaan_air_kotor);
        $sampah = htmlspecialchars($data[0]->pengelolaan_sampah);
        $listrik = htmlspecialchars($data[0]->ketersediaan_listrik);
        $toilet = htmlspecialchars($data[0]->ketersediaan_toilet);
        $parkir = htmlspecialchars($data[0]->kondisi_parkir);


        $uploadfoto1 = $this->uploadFoto($fileRekomendasiSlf);
        $uploadfoto2 = $this->uploadFoto($fileSLF);
        $uploadfoto3 = $this->uploadFoto($fileDamkar);
        $uploadfoto4 = $this->uploadFoto($fileTKT);
        $uploadfoto5 = $this->uploadFoto($fileIMB);

        $cek = $this->us->cekKondisi($slf);
        if ($cek->num_rows() > 0) {
            $getdata = $cek->row();
            $id = $getdata->id;
            $where = array(
                'id_slf' => $slf,
            );
            $array = array(
                'kdh_zonasi' => $kdh_zonasi,
                'id_kdh_minimum' => $kdh_minimum,
                'id_kondisi_kdh' => $kondisi_kdh,
                'id_volume_sumur' => $volume,
                'id_pertandaan_toko' => $kondisipertandaan,
                'id_kondisi_sumur' => $kondisi_sumur,
                'id_drainase' => $drainase,
                'id_rek_slf' => $rek_slf,
                'rek_slf' => $uploadfoto1,
                'id_layak' => $slf,
                'layak_fungsi' => $uploadfoto2,
                'id_izin_damkar' => $damkar,
                'izin_damkar' => $uploadfoto3,
                'id_tenaga_kerja' => $tenaga_kerja, // baru
                'tenaga_kerja' => $uploadfoto4, // baru
                'id_imb' => $imb,
                'foto_imb' => $uploadfoto5,
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
            $q = $this->us->InsertKondisiSlf($slf,$kdh_zonasi,$kdh_minimum,$kondisi_kdh,$volume,$kondisipertandaan,$kondisi_sumur,$drainase,$rek_slf,$damkar,$tenaga_kerja,$imb,$fasilitas,$asuransi,$kelayakan,$air,$limbah,$sampah,$listrik,$toilet,$parkir);
        }
        return $q;
    }
    function saveKondisiIuts($idiuts,$data,$id_tata)
    {
        $pbb = htmlspecialchars($json[0]->pemutakhiran_pbb);
        $umkm = htmlspecialchars($json[0]->keterlibatan_umkm);
        $keterlibatan_umkm_input = htmlspecialchars($json[0]->keterlibatan_umkm_input);
        $warga = htmlspecialchars($json[0]->persetujuan_warga);
        $jumlah_karyawan = htmlspecialchars($json[0]->jumlah_karyawan);
        $asal_karyawan = htmlspecialchars($json[0]->asal_karyawan);
        $jumlah_atm = htmlspecialchars($json[0]->jumlah_atm);
        $jumlah_pengunjung = htmlspecialchars($json[0]->jumlah_pengunjung_b);
        $status_milik_usaha = htmlspecialchars($json[0]->status_milik_usaha);
        $peng_lahan = htmlspecialchars($json[0]->penggunaan_lahan);

        $rek_umkm = htmlspecialchars($json[0]->rekomendasi_umkm);
        $kajian = htmlspecialchars($json[0]->kajian_sostek);
        $cek = $this->us->cekKondisi($slf);
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
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update('kondisi_iuts',$array,$where);
        }else{
            $q = $this->us->InsertKondisiIuts($idiuts,$pbb,$umkm,$keterlibatan_umkm_input,$jumlah_karyawan,$asal_karyawan,$jumlah_atm,$jumlah_pengunjung,$rek_umkm,$id_tata,$kajian);
        }
        return $q;
    }
    function saveIzin($idpemohon,$idslf='',$idiuts='',$data)
    {
        $lokasi = htmlspecialchars($data[0]->alamat);

        $lat = htmlspecialchars($data[0]->lat);
        $lng = htmlspecialchars($data[0]->lng);
        $zona = htmlspecialchars($data[0]->subzona);
        $sublock = htmlspecialchars($data[0]->idsubblok);
        $alamatpemohon = htmlspecialchars($data[0]->alamat_lengkap);
        $kecamatan = htmlspecialchars($data[0]->kecamatan);
        $kelurahan = htmlspecialchars($data[0]->kelurahan);
        $jenis = htmlspecialchars($data[0]->jenis_izin);

        $kode = $this->randstr();
         $this->load->library('uuid');
            $uuid = $this->uuid->v4();
            $id = str_replace('-', '', $uuid);
        $array = array(
            'id_izin' => $id,
            'id_pemohon' => $idpemohon,
            'id_slf' => $idslf,
            'id_iuts' => $idiuts,
            'alamat_usaha' => $lokasi,
            'alamat_maps' => $alamatpemohon,
            'lat' => $lat,
            'lon' => $lng,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'zona' => $zona,
            'kode_sublok' => $sublock,
            'code' => $kode,
            'status' => 0,
            'status_jalan' => 0,
            'created_at' => $getdata->created_at,
            'updated_at' => date('Y-m-d H:i:s'),
            'id_jenis' => $jenis,
        );
            $q = $this->db->insert('cek_izin',$array);
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
        $avg =  $skor->skoriuts * $status_pbb * $status_pbb;
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

        $cek = $this->us->cekSkor($slf);
        if ($cek->num_rows() > 0) {
           $getdata = $cek->row();
           $id = $getdata->id;
           $where = array(
            'id_bangunan' => $slf,
        );
           $array = array(
            'total_slf' => $rata,
            'total_iuts' => $iuts,
            'rata-rata' => $rata,
            'status_iuts' => $status_iuts,
            'status_slf' => $status,
            'created_at' => $getdata->created_at,
            'updated_at' => date('Y-m-d H:i:s'),
        );
           $q = $this->db->update('skor_bangunan',$array,$where);
       }else{
           $q = $this->us->InsertSkor($bangunan,$hasil,$teknis,$dampak,$rata);
       }
       return $q;
   }
   function saveTaxClear($idslf,$pbb,$npwp)
   {
        $cek = $this->us->cekTax($idslf);
        if ($cek->num_rows() > 0) {
            $getdata = $cek->row();
            $id = $getdata->id;
            $where = array(
                'id_tax' => $id,
            );
            $array = array(
                'status_pbb' => $pbb,
                'status_npwp' => $npwp,
                'created_at' => $getdata->created_at,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $q = $this->db->update('taxclear',$array,$where);
        }else{
            $q = $this->us->InsertTax($bangunan,$hasil,$teknis,$dampak,$rata);
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
    function uploadFotoLuar($params)
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/fotoluar/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;

        $gl = "";
        $this->upload->initialize($config);
        if ($this->upload->do_upload($params)) {
            $s = $this->upload->data();
            if (count($s) != 14) {
                for ($i=0; $i < count($s); $i++) {
                    $abc = $s[$i]['file_name'].',';
                    $gl .= $abc;
                }
                $newfileluar = substr($gl, 0, -1);
            }else{
                $newfileluar = $s['file_name'];
            }
        }else{
            $s = $this->input->post($params);
            for ($i=0; $i < count($s); $i++) {
                $abc = $s[$i].',';
                $gl .= $abc;
            }
            $newfileluar = substr($s, 0, -1);
        }
        return $newfileluar;
    }
    function uploadFotoDalam($params)
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/fotodalam/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
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
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
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