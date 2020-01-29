<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class OfficeModel extends CI_Model {

	function InsertAdministrasi()
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
	function InsertAdminTeknis()
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
	function InsertAdminDinas()
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
	function UbahAdministrasi()
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
		$q = $this->db->update('bangunan_iuts',$arrayPermohonan,$where);
		return $q;
	}
	function UbahAdminTeknis()
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
		$q = $this->db->update('bangunan_iuts',$arrayPermohonan,$where);
		return $q;
	}
	function UbahAdminDinas()
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
		$q = $this->db->update('bangunan_iuts',$arrayPermohonan,$where);
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
	function detailPermohonanAdmin($id_bangunan,$code)
    {
        $this->db->select('*');
        $this->db->from('bangunan_iuts');
        $this->db->join('administrasi', 'administrasi.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->join('admin_teknis', 'admin_teknis.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->join('admindinas', 'admindinas.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->where('bangunan_iuts.id_bangunan', $id_bangunan);
        $this->db->where('bangunan_iuts.code', $code);
        $q = $this->db->get();
        return $q;
    }
    function CekPesan()
    {
    	$this->db->select('*');
    	$this->db->from('message');
    	$this->db->where('id_penerima', 0);
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
}

/* End of file OfficeModel.php */
/* Location: ./application/models/OfficeModel.php */