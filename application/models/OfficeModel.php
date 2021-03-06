<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class OfficeModel extends CI_Model {
	var $column_order = array('nama','npwp','code','email','status');
	var $column_search = array('nama','npwp','code','email','status');
	var $order = array('nama' => 'asc');
	function countdata($status)
	{
		$this->db->select('count(*) as total');
        $this->db->from('cek_izin');
        $this->db->where('status', $status);
        $q = $this->db->get();
        return $q;
	}
    function cekPemohon($idbangun)
    {
        $this->db->select('cek_izin.code,cek_izin.created_at,cek_izin.kode_sublok,cek_izin.zona,cek_izin.lat,cek_izin.lon,cek_izin.alamat_usaha,data_iuts.njop,data_iuts.nama_toko,data_iuts.nama_badan_usaha,pemohon.nama,pemohon.foto_ktp,pemohon.foto_npwp,data_iuts.nopd,,data_slf.luas_lahan,data_slf.nopd_bangunan,data_iuts.status_bangunan,data_slf.luas_tapak,data_slf.jumlah_lantai,data_slf.luas_total_bangunan,data_slf.tinggi_bangunan,data_slf.peruntukan_bangunan,data_slf.no_imb,pemohon.nama,pemohon.nama_perusahaan,pemohon.nik,pemohon.email,pemohon.npwp,pemohon.jabatan,pemohon.nib,pemohon.alamat_perusahaan,pemohon.jenis_pemohon,pemohon.no_hp,kdh_minimum.nama as id_kdh_minimum,kondisi_kdh.nama as id_kondisi_kdh,volume_sumur.nama as id_volume_sumur,kondisi_pertandaan.nama as id_pertandaan_toko, kondisi_sumur.nama as id_kondisi_sumur,kondisi_drainase.nama as id_drainase,izin_damkar.nama as id_izin_damkar,izin_tenaga_kerja.nama as id_tenaga_kerja,izin_imb.nama as id_imb,rekomendasi_slf.nama as id_layak,fasilitas_damkar.nama as id_penanggulangan_kebakaran,asuransi_toko.nama as id_asuransi,kelayakan_gedung.nama as id_renovasi,ketersedian_air.nama as id_bersih,pengelola_limbah.nama as id_limbah,pengelola_sampah.nama as id_sampah,ketersedian_listrik.nama as id_listrik,ketersedian_toilet.nama as id_toilet,kondisi_parkir.nama as id_parkir,pemutakhiran_pbb.nama as id_pem_pbb,rekomen_umkm.nama as id_rek_umkm,tata_ruang.nama as id_tata_ruang,kajian_sostek.nama as id_kasostek,asal_karyawan.nama as asal_karyawan,setuju_warga_sekitar.nama as id_warga,keterlibatan_umkm.nama as id_umkm,kelompok_usaha.nama as kelompok, data_iuts.omset , data_slf.status_milik, kondisi_iuts.jml_karyawan,kondisi_iuts.jml_atm,kondisi_iuts.jml_pengunjung,kondisi_slf.sumber_air, jalan_eksisting.nama as id_jalan_eksis, penggunaan_lahan.nama as id_penglahan, jarak_pasar.nama as id_jarak_pasar, jarak_usaha.nama as id_jarak_usaha');
        $this->db->from('cek_izin');
        $this->db->join('data_iuts', 'data_iuts.id_iuts = cek_izin.id_iuts', 'LEFT');
        $this->db->join('data_slf', 'data_slf.id_slf = cek_izin.id_slf', 'LEFT');
        $this->db->join('pemohon', 'pemohon.id_pemohon = cek_izin.id_pemohon', 'INNER');
        $this->db->join('kondisi_slf', 'kondisi_slf.id_slf = data_slf.id_slf', 'LEFT');
        $this->db->join('kondisi_iuts', 'kondisi_iuts.id_iuts = data_iuts.id_iuts', 'LEFT');
        $this->db->join('admin_teknis', 'admin_teknis.id_izin = cek_izin.id_izin', 'left');

        $this->db->join('kdh_minimum', 'kdh_minimum.id = kondisi_slf.id_kdh_minimum', 'left');
        $this->db->join('kondisi_kdh', 'kondisi_kdh.id = kondisi_slf.id_kondisi_kdh', 'left');
        $this->db->join('volume_sumur', 'volume_sumur.id = kondisi_slf.id_volume_sumur', 'left');
        $this->db->join('kondisi_pertandaan', 'kondisi_pertandaan.id = kondisi_slf.id_pertandaan_toko', 'left');
        $this->db->join('kondisi_sumur', 'kondisi_sumur.id = kondisi_slf.id_kondisi_sumur', 'left');
        $this->db->join('kondisi_drainase', 'kondisi_drainase.id = kondisi_slf.id_drainase', 'left');
        $this->db->join('izin_damkar', 'izin_damkar.id = kondisi_slf.id_izin_damkar', 'left');
        $this->db->join('izin_tenaga_kerja', 'izin_tenaga_kerja.id = kondisi_slf.id_tenaga_kerja', 'left');
        $this->db->join('izin_imb', 'izin_imb.id = kondisi_slf.id_imb', 'left');
        $this->db->join('rekomendasi_slf', 'rekomendasi_slf.id = kondisi_slf.id_layak', 'left');
        $this->db->join('fasilitas_damkar', 'fasilitas_damkar.id = kondisi_slf.id_penanggulangan_kebakaran', 'left');
        $this->db->join('asuransi_toko', 'asuransi_toko.id = kondisi_slf.id_asuransi', 'left');
        $this->db->join('kelayakan_gedung', 'kelayakan_gedung.id = kondisi_slf.id_renovasi', 'left');
        $this->db->join('ketersedian_air', 'ketersedian_air.id = kondisi_slf.id_bersih', 'left');
        $this->db->join('pengelola_limbah', 'pengelola_limbah.id = kondisi_slf.id_limbah', 'left');
        $this->db->join('pengelola_sampah', 'pengelola_sampah.id = kondisi_slf.id_sampah', 'left');
        $this->db->join('ketersedian_listrik', 'ketersedian_listrik.id = kondisi_slf.id_listrik', 'left');
        $this->db->join('ketersedian_toilet', 'ketersedian_toilet.id = kondisi_slf.id_toilet', 'left');
        $this->db->join('jalan_eksisting', 'jalan_eksisting.id = kondisi_slf.id_jalan_eksis', 'left');
        $this->db->join('kondisi_parkir', 'kondisi_parkir.id = kondisi_slf.id_parkir', 'left');

        $this->db->join('pemutakhiran_pbb', 'pemutakhiran_pbb.id = kondisi_iuts.id_pem_pbb', 'left');
        $this->db->join('kelompok_usaha', 'kelompok_usaha.id = data_iuts.kelompok_usaha', 'left');
        $this->db->join('keterlibatan_umkm', 'keterlibatan_umkm.id = kondisi_iuts.id_umkm', 'left');
        $this->db->join('rekomen_umkm', 'rekomen_umkm.id = kondisi_iuts.id_rek_umkm', 'left');
        $this->db->join('tata_ruang', 'tata_ruang.id = kondisi_iuts.id_tata_ruang', 'left');
        $this->db->join('kajian_sostek', 'kajian_sostek.id = kondisi_iuts.id_kasostek', 'left');
        $this->db->join('asal_karyawan', 'asal_karyawan.id = kondisi_iuts.asal_karyawan', 'left');
        $this->db->join('setuju_warga_sekitar', 'setuju_warga_sekitar.id = kondisi_iuts.id_warga', 'left');

        $this->db->join('jarak_pasar', 'jarak_pasar.id = admin_teknis.id_pasar', 'left');
        $this->db->join('jarak_usaha', 'jarak_usaha.id = admin_teknis.id_jarak', 'left');
        $this->db->join('penggunaan_lahan', 'penggunaan_lahan.id = admin_teknis.id_lahan', 'left');
        $this->db->where('cek_izin.id_izin', $idbangun);
        $this->db->group_by('cek_izin.code');
        $q = $this->db->get();
        return $q;
    }
    function cekFotoPemohon($idizin)
    {
        $this->db->select('foto_admin.foto_ktp,foto_admin.foto_npwp,foto_admin.foto_akta,foto_iuts.fotopbb,foto_iuts.fotoperw,foto_iuts.fotorekumkm,foto_iuts.fotokajian,foto_slf.filelahan,foto_slf.fotoluar,foto_slf.fotodalam,foto_slf.fotoimb,foto_slf.fotoslf,foto_slf.filepengkaji,foto_slf.fotodamkar,foto_slf.fototkt,foto_slf.fotoasuransi');
        $this->db->from('cek_izin');
        $this->db->join('pemohon', 'pemohon.id_pemohon = cek_izin.id_pemohon', 'INNER');
        $this->db->join('foto_slf', 'foto_slf.idizin = cek_izin.id_izin', 'INNER');
        $this->db->join('foto_iuts', 'foto_iuts.idizin = cek_izin.id_izin', 'INNER');
        $this->db->join('foto_admin', 'foto_admin.idizin = cek_izin.id_izin', 'INNER');
        $this->db->where('cek_izin.id_izin', $idizin);
        $q = $this->db->get();
        return $q;
    }
	function cekAdministrasi($id)
	{
		if($id){
            $this->db->where('id_izin',$id);
        }
        $q = $this->db->get('administrasi');
        return $q;
	}
	function cekTeknis($id)
	{
		if($id){
            $this->db->where('id_izin',$id);
        }
        $q = $this->db->get('admin_teknis');
        return $q;
	}
	function cekDinas($id)
	{
		if($id){
            $this->db->where('id_izin',$id);
        }
        $q = $this->db->get('admindinas');
        return $q;
	}
    function cekSurat($id)
    {
        if($id){
            $this->db->where('id_izin',$id);
        }
        $q = $this->db->get('janjian');
        return $q;
    }
    function detailKewajiban()
    {
        $q = $this->db->get('kewajiban_sk');
        return $q;
    }
    function detailLarangan()
    {
        $q = $this->db->get('larangan_sk');
        return $q;
    }
	function InsertAdministrasi($admin,$idizin,$ktp,$npwp,$aktaperusahaan,$fotoluar,$fotodalam,$imb,$slf,$damkar,$tkt,$asuransi,$pbb,$persetujuan_warga,$umkm,$kajian_sostek,$keterangan)
	{
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
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('administrasi',$arrayPermohonan);
		return $q;
	}
	function InsertAdminTeknis($id_bangunan,$admin,$lahansekitar,$statususaha,$statuspasar,$keterangan,$skor)
	{
		$arrayPermohonan = array(
			'id_izin' => $id_bangunan,
            'id_admin'=>$admin,
            'id_pasar' => $statuspasar,
            'id_jarak' => $statususaha,
            'id_lahan' => $lahansekitar,
            'keterangan' => $keterangan,
            'total_skor' => $skor,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('admin_teknis',$arrayPermohonan);
		return $q;
	}
	function InsertAdminDinasBaru($bangunan,$admin,$keterangan,$status,$skorslf,$skoriuts)
	{
		$arrayPermohonan = array(
            'id_izin'=>$bangunan,
			'id_admin' => $admin,
            'keterangan' => $keterangan,
            'skorakhirslf' => $skorslf,
            'skorakhiriuts' => $skoriuts,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('admindinas',$arrayPermohonan);
		return $q;
	}
    function InsertSurat($bangunan,$id_admin,$tgl,$jam)
    {
        $arrayPermohonan = array(
            'id_admin' => $id_admin,
            'id_bangunan' => $bangunan,
            'tanggal' => $tgl,
            'tgl_ambil' => $tgl,
            'jam' => $jam,
            'status'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('janjian',$arrayPermohonan);
        return $q;
    }
	function PemberitahuanAdministrasi()
	{
		$arrayPermohonan = array(
			'id_bangunan'=>$id,
			'id_pemohon'=>$id_pemohon,
			'nop'=>$nop,
			'no_reg_bangunan'=>$no_reg,
			'alamat'=>$lokasi,
			'lat'=>$lat,
			'lon'=>$lng,
			'luas_lahan'=>$luas_lahan,
			'status_milik'=>$status_milik,
			'status_bangunan'=>$status_bangunan,
			'luas_tapak'=>$ltb,
			'luas_lantai'=>$luas_lantai,
			'jumlah_lantai'=>$jml_lantai,
			'code' => $kode,
			'status' => 0,
			'status_jalan' => 0,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('bangunan_iuts',$arrayPermohonan);
		return $q;
	}	
	function UbahDataBangunan($idbangunan,$status,$status_jalan)
	{
		$where = array(
			'id_bangunan'=>$idbangunan,
		);
		$data = array(
			'status'=>$status,
			'status_jalan'=>$status_jalan,
		);
		$q = $this->db->where('bangunan_iuts', $data,$where);
		return $q;
	}
	function HapusData($idbangunan)
	{
		$where = array(
			'id_bangunan'=>$idbangunan,
		);
		$data = array(
			'status'=>4,
		);
		$q = $this->db->update('bangunan_iuts', $data,$where);
		return $q;
	}

    function AmbilSurat($id)
    {
        $this->db->select('*');
        $this->db->from('bangunan_iuts');
        $this->db->where('id_bangunan', $id);
        $this->db->where('status_jalan', 4);
        $q = $this->db->get();
        return $q;
    }
	function detailPermohonanAdminDinas($id_bangunan)
    {
        
        $this->db->select('cek_izin.lat,cek_izin.lon,kondisi_kdh.skor as skorkondisikdh,kondisi_pertandaan.skor as skorpetandaan, status_pbb.skor as skorpbb, status_npwp.skor as skornpwp, jarak_pasar.skor as skorjarakpasar, tata_ruang.skor as skortataruang, jarak_usaha.skor as skorjarakusaha, penggunaan_lahan.skor as skorpenglahan, pemutakhiran_pbb.skor as skorpempbb, keterlibatan_umkm.skor as skorketumkm, rekomen_umkm.skor as skorrekumkm, izin_imb.skor as skorimb, kajian_sostek.skor as skorkajian, volume_sumur.skor as skorvolsumur, kondisi_drainase.skor as skordrainase, kondisi_sumur.skor as skorkondisisumur, cek_izin.code, pemohon.nama, pemohon.nib, pemohon.npwp,cek_izin.zona,cek_izin.kode_sublok, cek_izin.created_at as tgl, cek_izin.alamat_usaha, admin_teknis.keterangan as ketteknis,admindinas.keterangan as ketdinas,administrasi.keterangan as ketadmin, izin_damkar.skor as skordamkar,izin_tenaga_kerja.skor as skortkt,fasilitas_damkar.skor as skorfdamkar,asuransi_toko.skor as skorasuransi,kelayakan_gedung.skor as skorlayak,rekomendasi_slf.skor as skorslf, ketersedian_air.skor as skorketersediaan,pengelola_limbah.skor as skorlimbah,pengelola_sampah.skor as skorsampah,ketersedian_listrik.skor as skorlistrik,ketersedian_toilet.skor as skortoilet,kondisi_parkir.skor as skorparkir,asal_karyawan.skor as asalkaryawan, setuju_warga_sekitar.skor as skorwarga,jalan_eksisting.skor as skorjalaneksis, ROUND(AVG(kondisi_kdh.skor + volume_sumur.skor + kondisi_pertandaan.skor + kondisi_sumur.skor + kondisi_drainase.skor + izin_damkar.skor + izin_tenaga_kerja.skor + izin_imb.skor + fasilitas_damkar.skor + asuransi_toko.skor + kelayakan_gedung.skor + ketersedian_air.skor + pengelola_limbah.skor + pengelola_sampah.skor + ketersedian_listrik.skor + ketersedian_toilet.skor + kondisi_parkir.skor + rekomendasi_slf.skor + jalan_eksisting.skor)/19,1) as skortotalslf, ROUND(AVG(pemutakhiran_pbb.skor + keterlibatan_umkm.skor + rekomen_umkm.skor + tata_ruang.skor + kajian_sostek.skor + penggunaan_lahan.skor + jarak_usaha.skor + jarak_pasar.skor)/8,1) as skoriuts');
        $this->db->from('cek_izin');
        $this->db->join('pemohon', 'pemohon.id_pemohon = cek_izin.id_pemohon', 'INNER');
        $this->db->join('data_iuts', 'cek_izin.id_iuts = data_iuts.id_iuts', 'left');
        $this->db->join('data_slf', 'data_slf.id_slf = cek_izin.id_slf', 'left');
        $this->db->join('kondisi_iuts', 'kondisi_iuts.id_iuts = data_iuts.id_iuts', 'left');
        $this->db->join('kondisi_slf', 'data_slf.id_slf = kondisi_slf.id_slf', 'left');
        $this->db->join('taxclear', 'taxclear.id_slf = data_slf.id_slf', 'left');
        $this->db->join('admin_teknis', 'admin_teknis.id_izin = cek_izin.id_izin', 'left');
        $this->db->join('admindinas', 'admindinas.id_izin = cek_izin.id_izin', 'left');
        $this->db->join('administrasi', 'administrasi.id_izin = cek_izin.id_izin', 'left');

        $this->db->join('jalan_eksisting', 'jalan_eksisting.id = kondisi_slf.id_jalan_eksis', 'left');
        $this->db->join('kdh_minimum', 'kdh_minimum.id = kondisi_slf.id_kdh_minimum', 'left');
        $this->db->join('kondisi_kdh', 'kondisi_kdh.id = kondisi_slf.id_kondisi_kdh', 'left');
        $this->db->join('volume_sumur', 'volume_sumur.id = kondisi_slf.id_volume_sumur', 'left');
        $this->db->join('kondisi_pertandaan', 'kondisi_pertandaan.id = kondisi_slf.id_pertandaan_toko', 'left');
        $this->db->join('kondisi_sumur', 'kondisi_sumur.id = kondisi_slf.id_kondisi_sumur', 'left');
        $this->db->join('kondisi_drainase', 'kondisi_drainase.id = kondisi_slf.id_drainase', 'left');
        $this->db->join('izin_damkar', 'izin_damkar.id = kondisi_slf.id_izin_damkar', 'left');
        $this->db->join('izin_tenaga_kerja', 'izin_tenaga_kerja.id = kondisi_slf.id_tenaga_kerja', 'left');
        $this->db->join('izin_imb', 'izin_imb.id = kondisi_slf.id_imb', 'left');
        $this->db->join('rekomendasi_slf', 'rekomendasi_slf.id = kondisi_slf.id_layak', 'left');
        $this->db->join('fasilitas_damkar', 'fasilitas_damkar.id = kondisi_slf.id_penanggulangan_kebakaran', 'left');
        $this->db->join('asuransi_toko', 'asuransi_toko.id = kondisi_slf.id_asuransi', 'left');
        $this->db->join('kelayakan_gedung', 'kelayakan_gedung.id = kondisi_slf.id_renovasi', 'left');
        $this->db->join('ketersedian_air', 'ketersedian_air.id = kondisi_slf.id_bersih', 'left');
        $this->db->join('pengelola_limbah', 'pengelola_limbah.id = kondisi_slf.id_limbah', 'left');
        $this->db->join('pengelola_sampah', 'pengelola_sampah.id = kondisi_slf.id_sampah', 'left');
        $this->db->join('ketersedian_listrik', 'ketersedian_listrik.id = kondisi_slf.id_listrik', 'left');
        $this->db->join('ketersedian_toilet', 'ketersedian_toilet.id = kondisi_slf.id_toilet', 'left');
        $this->db->join('kondisi_parkir', 'kondisi_parkir.id = kondisi_slf.id_parkir', 'left');

        $this->db->join('pemutakhiran_pbb', 'pemutakhiran_pbb.id = kondisi_iuts.id_pem_pbb', 'left');
        $this->db->join('keterlibatan_umkm', 'keterlibatan_umkm.id = kondisi_iuts.id_umkm', 'left');
        $this->db->join('rekomen_umkm', 'rekomen_umkm.id = kondisi_iuts.id_rek_umkm', 'left');
        $this->db->join('tata_ruang', 'tata_ruang.id = kondisi_iuts.id_tata_ruang', 'left');
        $this->db->join('kajian_sostek', 'kajian_sostek.id = kondisi_iuts.id_kasostek', 'left');
        $this->db->join('asal_karyawan', 'asal_karyawan.id = kondisi_iuts.asal_karyawan', 'left');
        $this->db->join('setuju_warga_sekitar', 'setuju_warga_sekitar.id = kondisi_iuts.id_warga', 'left');

        $this->db->join('jarak_pasar', 'jarak_pasar.id = admin_teknis.id_pasar', 'left');
        $this->db->join('jarak_usaha', 'jarak_usaha.id = admin_teknis.id_jarak', 'left');
        $this->db->join('penggunaan_lahan', 'penggunaan_lahan.id = admin_teknis.id_lahan', 'left');

        $this->db->join('status_pbb', 'status_pbb.id = taxclear.status_pbb', 'left');
        $this->db->join('status_npwp', 'status_npwp.id = taxclear.status_npwp', 'left');

        $this->db->where('cek_izin.id_izin', $id_bangunan);
        $this->db->group_by('cek_izin.id_izin');
        $query = $this->db->get();
        return $query;
        // return var_dump($this->db->last_query());
    }
    function DetailBangunan($code)
    {
    	$this->db->select('*');
        $this->db->from('cek_izin');
        $this->db->where('id_izin', $code);
        $q = $this->db->get();
        return $q;
    }
    function CekPesan($id)
    {
    	$this->db->select('*');
    	$this->db->from('message');
    	$this->db->where('id_pengirim', $id);
    	$this->db->where('id_penerima', $id);
    	$q = $this->db->get();
    	return $q;
    }
    function DetailPesan($idpesan)
    {
    	$this->db->select('*');
    	$this->db->from('message');
    	$this->db->where('id_pesan', $idpesan);
    	$q = $this->db->get();
    	return $q;
    }
    function UpdatePesan($idpesan)
    {
    	$update = array(
    		'id_pesan'=>$id_pesan,
    	);
    	$data = array(
    		'lihat'=>1,
    	);
    	$q = $this->db->update('message', $data,$update);
    	return $q;
    }
    function KirimPesan($id,$idpemohon,$pesan)
    {
    	$arrayPermohonan = array(
			'id_pengirim'=>$id,
			'id_penerima'=>$idpemohon,
			'pesan'=>$pesan,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('bangunan_iuts',$arrayPermohonan);
		return $q;
    }
    function getdatatable()
	{
		$this->db->select('pemohon.id_pemohon as id, pemohon.nama,pemohon.email, pemohon.npwp,cek_izin.id_izin as idbangunan,cek_izin.code,cek_izin.created_at,cek_izin.updated_at,cek_izin.status');
		$this->db->from('pemohon');
		$this->db->join('cek_izin', 'cek_izin.id_pemohon = pemohon.id_pemohon', 'INNER');

        foreach ($this->column_search as $item) // loop column 
        {
        	$c = 0;
        	if($_POST['search']['value'])
        	{
        		$this->db->or_like($item, $_POST['search']['value']);
        	}
        	$c++;
        }

        if(isset($_POST['order'])) // here order processing
        {
        	$test = $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
        	$order = $this->order;
        	$this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function getAll()
    {
        $status = $this->input->post('status');
        if ($status == null) {
        	$statusbangunan = null;
        }else{
        	$statusbangunan = $this->input->post('status');
    		$this->db->where('cek_izin.status', $statusbangunan);
        }
    	$this->getdatatable();
    	if($this->input->post('length') != -1)
    		$this->db->limit($this->input->post('length'), $this->input->post('start'));
    	$query = $this->db->get();
    	$data = "";
    	$i = 0;
    	$no = 1;
    	foreach ($query->result() as $key) {
    		if ($key->status == 0) {
    			$statusdata = 'Proses';
    		}elseif ($key->status == 1) {
    			$statusdata = 'Terima';
    		}else if ($key->status == 2) {
    			$statusdata = 'Tolak';
    		}else if ($key->status == 3) {
    			$statusdata = 'Expired';
    		}
    		$data[$i] = array(
    			'no' => $no++,
    			'code' => $key->code,
    			'id_pemohon' => $key->id,
    			'id_bangunan' => $key->idbangunan,
    			'npwp' => $key->npwp,
    			'tanggal' => date('d F, Y',strtotime($key->created_at)),
                'update' => date('d F, Y',strtotime($key->updated_at)),
    			'nama' => $key->nama,
    			'email' => $key->email,
    			'status' => $statusdata,
    		);
    		$i++;
    	}
    	$output = array(
    		"draw" => $this->input->post('draw'),
    		"recordsTotal" => $this->countDatatable($statusbangunan),
    		"recordsFiltered" =>  $this->filterTableData($statusbangunan),
    		"data" => $data,
    	);
    	return $output;
    }
    public function getAllJalan()
    {
        $level = $this->input->post('level');
        if ($level == 1) {
        	$statusjalan = '2';
    		$this->db->where('cek_izin.status_jalan', $statusjalan);
        }elseif ($level == 2) {
        	$statusjalan = '1';
    		$this->db->where('cek_izin.status_jalan', $statusjalan);
        }elseif ($level == 3) {
        	$statusjalan = '0';
    		$this->db->where('cek_izin.status_jalan', $statusjalan);
        }
    	$this->getdatatable();
    	if($this->input->post('length') != -1)
    		$this->db->limit($this->input->post('length'), $this->input->post('start'));
    	$query = $this->db->get();
    	$data = "";
    	$i = 0;
    	$no = 1;
    	foreach ($query->result() as $key) {
    		if ($key->status == 0) {
    			$statusdata = 'Proses';
    		}elseif ($key->status == 1) {
    			$statusdata = 'Terima';
    		}else if ($key->status == 2) {
    			$statusdata = 'Tolak';
    		}else if ($key->status == 3) {
    			$statusdata = 'Expired';
    		}
    		$data[$i] = array(
    			'no' => $no++,
    			'code' => $key->code,
    			'id_pemohon' => $key->id,
    			'id_bangunan' => $key->idbangunan,
    			'npwp' => $key->npwp,
    			'tanggal' => date('d F, Y',strtotime($key->created_at)),
                'update' => date('d F, Y',strtotime($key->updated_at)),
    			'nama' => $key->nama,
    			'email' => $key->email,
    			'status' => $statusdata,
    		);
    		$i++;
    	}
    	$output = array(
    		"draw" => $this->input->post('draw'),
    		"recordsTotal" => $this->countDatatableJalan($statusjalan),
    		"recordsFiltered" =>  $this->filterTableDataJalan($statusjalan),
    		"data" => $data,
    	);
    	return $output;
    }
    public function filterTableDataJalan($id)
    {
        $this->getdatatable();
        if ($id!=null) {
    		$this->db->where('cek_izin.status_jalan', $id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countDatatableJalan($id)
    {
        $this->getdatatable();
        if ($id!=null) {
    		$this->db->where('cek_izin.status_jalan', $id);
        }
    	return $this->db->count_all_results();
    }
    public function filterTableData($id)
    {
        $this->getdatatable();
        if ($id!=null) {
    		$this->db->where('cek_izin.status', $id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countDatatable($id)
    {
        $this->getdatatable();
        if ($id!=null) {
    		$this->db->where('cek_izin.status', $id);
        }
    	return $this->db->count_all_results();
    }
    function VerifFoto($idfoto,$status)
    {
        $where = array(
            'id_foto'=>$idfoto,
        );
        $data = array(
            'status'=>$status,
        );
        $q = $this->db->update('foto_iuts',$data,$where);
        return $q;
    }
}

/* End of file OfficeModel.php */
/* Location: ./application/models/OfficeModel.php */