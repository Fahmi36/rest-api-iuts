<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
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
    function cekKondisi($id)
    {
        if($id){
            $this->db->where('id_bangunan',$id);
        }
        $q = $this->db->get('kondisi_bangunan');
        return $q;
    }
	function InsertBangunan($id,$id_pemohon,$nop,$no_reg,$luas_lahan,$ltb,$luas_lantai,$jml_lantai,$status_bangunan,$status_milik,$lokasi,$lat,$lng,$kode)
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
    function InsertKondisi($bangunan,$kondisi,$mengajukan,$pbb,$umkm,$sewa,$warga,$rek_umkm,$kajian,$imb,$slf,$kondisi_sumur,$drainase,$kdh_minimum,$kondisi_kdh,$sampah,$parkir,$volume,$volume_sumur_input,$kdh_kondisi_input,$janji_sewa_input,$keterlibatan_umkm_input,$lama_izin_input,$detail_kondisi_input)
    {
        $array = array(
            'id_bangunan' => $bangunan,
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
            'id_kajian' => $kajian,
            'id_imb' => $imb,
            'id_slf' => $slf,
            'id_volume_sumur' => $volume,
            'volume_sumur' => $volume_sumur_input,
            'id_kondisi_sumur' => $kondisi_sumur,
            'id_drainase' => $drainase,
            'id_kdh_minimum' => $kdh_minimum,
            'id_kondisi_kdh' => $kondisi_kdh,
            'kondisi_kdh' => $kdh_kondisi_input,
            'id_sampah' => $sampah,
            'id_parkir' => $parkir,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('kondisi_bangunan',$array);
        return $q;
    }
	function InsertSkor($bangunan,$hasil,$teknis,$dampak,$rata)
	{

		if ($rata <= 1.5) {
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
    function loginuser($email,$token)
    {
        $where = array(
            'email'=>$email,
            'token'=>$token,
        );
        $row = $this->db->get('pemohon_iuts',$where)->row();
        $cekpemohon = password_verify(''.$token.'', ''.$row->password.'');
        if ($cekpemohon == true) {
            $q = $this->db->get('pemohon_iuts',$where);
        }else{
            $whereadmin = array(
                'username'=>$email,
                'password'=>$token,
            );
            $rowadmin = $this->db->get('users',$whereadmin);
            if ($rowadmin->num_rows() > 0) {
              $cekrow = $rowadmin->row();
              $cekuser = password_verify(''.$token.'', ''.$cekrow->password.'');
              if ($cekuser == true) {
                    $q = $this->db->get('pemohon_iuts',$where);
                }else{
                    $q = false;
                }
            }else{
                $q = false;
            }
        }
        return $q;
    } 
    function loginemail($token)
    {
        $where = array(
            'token'=>$token,
        );
        $row = $this->db->get('pemohon_iuts',$where)->row();
        $cekpemohon = password_verify(''.$token.'', ''.$row->password.'');
        if ($cekpemohon == true) {
            $q = $this->db->get('pemohon_iuts',$where);
        }else{
            $q = false;
        }
        return $q;
    }
    function listPermohonan($id,$status='',$awal,$akhir)
    {
        $this->db->select('bangunan_iuts.code,bangunan_iuts.status,bangunan_iuts.created_at,pemohon_iuts.nama');
        $this->db->from('bangunan_iuts');
        $this->db->join('pemohon_iuts', 'pemohon_iuts.id_pemohon = bangunan_iuts.id_pemohon', 'left');
        if ($status != '') {
            $this->db->where('bangunan_iuts.status', $status);
        }
        $this->db->where('bangunan_iuts.id_pemohon', $id);
        $this->db->where('bangunan_iuts.status !=', 4);
        $q = $this->db->get();
        return $q;
    }
    function detailPermohonan($id,$id_bangunan,$code)
    {
        $this->db->select('*');
        $this->db->from('bangunan_iuts');
        $this->db->join('administrasi', 'administrasi.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->join('admin_teknis', 'admin_teknis.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->join('admindinas', 'admindinas.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->where('bangunan_iuts.id_bangunan', $id_bangunan);
        $this->db->where('bangunan_iuts.code', $code);
        $this->db->where('bangunan_iuts.id_pemohon', $id);
        $this->db->where('bangunan_iuts.status !=', 4);
        $q = $this->db->get();
        return $q;
    }
    function detailMessage($id,$idpemohon)
    {
        $this->db->select('*');
        $this->db->from('message');
        $this->db->where('id_pesan', $id);
        $this->db->where('id_pengirim', $idpemohon);
        $this->db->where('id_penerima', $idpemohon);
        $q = $this->db->get();
        return $q;
    }
    function SendMessage()
    {
        $array = array(
            'id_pesan' => $bangunan,
            'id_pengirim' => $hasil,
            'id_penerima' =>0,
            'pesan' => $dampak,
            'lihat' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('message',$array);
        return $q;
    }
}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */