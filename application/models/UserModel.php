<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	function cekPemohon($nik='')
    {
        if($nik){
            $this->db->where('nik',$nik);
        }
        $q = $this->db->get('pemohon_iuts');
        return $q;
    }
    function cekBangunan($data)
    {
        if($data){
            $this->db->where('no_reg_bangunan',$data);
        }
        $q = $this->db->get('bangunan_iuts');
        return $q;
    }
    function cekSkor($id)
    {
    	if($id){
            $this->db->where('id_bangunan',$id);
        }
        $q = $this->db->get('skor_bangunan');
        return $q;
    }
	function InsertBangunan($id,$id_pemohon,$nop,$no_reg,$luas_lahan,$ltb,$luas_lantai,$jml_lantai,$status_bangunan,$status_milik,$lokasi,$lat,$lng)
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
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
        $q = $this->db->insert('bangunan_iuts',$arrayPermohonan);
        return $q;
	}
	function InsertPemohon($id,$nama,$nik,$nib,$npwp,$no_telp,$njop,$email,$token)
	{
		$array = array(
			'id_pemohon'=>$id,
            'nama' => $nama,
            'nik' => $nik,
            'nib' => $nib,
            'email' => $email,
            'npwp' => $npwp,
            'no_hp' => $no_telp,
            'njop' => $njop,
            'password'=>password_hash($token, PASSWORD_DEFAULT),
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('pemohon_iuts',$array);
        return $q;
	}
	function InsertSkor($bangunan,$hasil,$teknis,$dampak,$rata)
	{

		if ($rata =< 1.5) {
			$status = '2';
		}else if($rata >= 1.5 ){
			$status = '0';
		}else if ($rata >= 2.5) {
			$status = '1';
		}
		$array = array(
            'id_bangunan' => $bangunan,
            'total_admin' => $hasil,
            'total_teknis' => $teknis,
            'total_dampak' => $dampak,
            'rata-rata' => $rata,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('skor_bangunan',$array);
        return $q;
		
	}

}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */