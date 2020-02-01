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
    function cekCodeBangunan($id)
    {
        if($id){
            $this->db->where('id_bangunan',$id);
        }
        $q = $this->db->get('bangunan_iuts');
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
        $row = $this->db->get_where('pemohon_iuts',$where);
        if ($row->num_rows() > 0) {
            $cekrow = $row->row();
            $cekpemohon = password_verify(''.$token.'', ''.$cekrow->password.'');
            if ($cekpemohon == true) {
                $q = $this->db->get_where('pemohon_iuts',$where);
            }else{
                $q = false;
            }
        }else{
            $q = false;
        }
        
        return $q;
    }
    function loginadmin($email,$token)
    {
       $whereadmin = array(
            'username'=>$email,
        );
        $rowadmin = $this->db->get_where('users',$whereadmin);
        if ($rowadmin->num_rows() > 0) {
            $cekrow = $rowadmin->row();
            $cekuser = password_verify(''.$token.'', ''.$cekrow->password.'');
            if ($cekuser == true) {
                $q = $this->db->get_where('users',$whereadmin);
            }else{
                $q = false;
            }
        }else{
            $q = false;
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
        $this->db->select('bangunan_iuts.id_bangunan,bangunan_iuts.code,bangunan_iuts.status,bangunan_iuts.created_at,pemohon_iuts.nama');
        $this->db->from('bangunan_iuts');
        $this->db->join('pemohon_iuts', 'pemohon_iuts.id_pemohon = bangunan_iuts.id_pemohon', 'INNER');
        if ($status != '') {
            if ($status == '1') {
                $this->db->where_in('bangunan_iuts.status', [1,2]);
            }else{
                $this->db->where('bangunan_iuts.status', $status);
            }
        }
        $this->db->where('bangunan_iuts.id_pemohon', $id);
        $q = $this->db->get();
        $this->db->last_query();
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
        $this->db->where('bangunan_iuts.id_pemohon', $id);
        $q = $this->db->get();
        return $q;
    }
    function detailMessage($idpemohon)
    {
        $this->db->select('*');
        $this->db->from('message');
        $this->db->where('id_pengirim', $idpemohon);
        $this->db->or_where('id_penerima', $idpemohon);
        $q = $this->db->get();
        return $q;
    }
    function AmbilMessage($idpemohon)
    {
        $this->db->select('*');
        $this->db->from('message');
        $this->db->where('id_pengirim', $idpemohon);
        $this->db->or_where('id_penerima', $idpemohon);
        $this->db->where('lihat', 0);
        $q = $this->db->get();
        return $q;
    }
    function SendMessage($id,$pesan)
    {
        $array = array(
            'id_pengirim' => $id,
            'id_penerima' =>'administrasi',
            'pesan' => $pesan,
            'lihat' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('message',$array);
        return $q;
    }
    function detailPemohonAdministrasi($id_bangunan,$id)
    {
        $this->db->select('kelengkapan_admin.skor as skorlengkap, lama_izin.skor as skorwaktu, status_pbb.skor as skorpbb, status_npwp.skor as skornpwp, AVG(kelengkapan_admin.skor + lama_izin.skor) as skoradministrasi');
        $this->db->from('bangunan_iuts');
        $this->db->join('administrasi', 'administrasi.id_bangunan = bangunan_iuts.id_bangunan', 'INNER');
        $this->db->join('kelengkapan_admin', 'kelengkapan_admin.id = administrasi.kelengkapan', 'INNER');
        $this->db->join('lama_izin', 'lama_izin.id = administrasi.lama_waktu', 'INNER');
        $this->db->join('status_pbb', 'status_pbb.id = administrasi.status_pbb', 'INNER');
        $this->db->join('status_npwp', 'status_npwp.id = administrasi.status_npwp', 'INNER');

        $this->db->where('bangunan_iuts.id_bangunan', $id_bangunan);
        $this->db->where('bangunan_iuts.id_pemohon', $id);
        $this->db->group_by('bangunan_iuts.id_bangunan');
        $q = $this->db->get();
        return $q;
        // return var_dump($this->db->last_query());
    }

    function detailPemohonteknis($id_bangunan,$id)
    {
        $this->db->select(' jarak_pasar.skor as skorjarakpasar, rencana_jalan.skor as skorrenjalan, jalan_eksisting.skor as skorjalaneksis, tata_ruang.skor as skortataruang, jarak_usaha.skor as skorjarakusaha, penggunaan_lahan.skor as skorpenglahan, AVG(pemutakhiran_pbb.skor + rekomen_umkm.skor + perjanjian_sewa.skor + penggunaan_lahan.skor + setuju_warga_sekitar.skor + jalan_eksisting.skor) as skormanfaat ');
        $this->db->from('bangunan_iuts');
        $this->db->join('kondisi_bangunan', 'kondisi_bangunan.id_bangunan = bangunan_iuts.id_bangunan', 'INNER');
        $this->db->join('admin_teknis', 'admin_teknis.id_bangunan = bangunan_iuts.id_bangunan', 'INNER');


        $this->db->join('jarak_pasar', 'jarak_pasar.id = admin_teknis.id_pasar', 'INNER');
        $this->db->join('rencana_jalan', 'rencana_jalan.id = admin_teknis.id_rencana', 'INNER');
        $this->db->join('jalan_eksisting', 'jalan_eksisting.id = admin_teknis.id_rencana_eksisting', 'INNER');
        $this->db->join('tata_ruang', 'tata_ruang.id = admin_teknis.id_tata_ruang', 'INNER');
        $this->db->join('jarak_usaha', 'jarak_usaha.id = admin_teknis.id_jarak', 'INNER');
        $this->db->join('penggunaan_lahan', 'penggunaan_lahan.id = admin_teknis.id_lahan', 'INNER');
        $this->db->where('bangunan_iuts.id_bangunan', $id_bangunan);
        $this->db->where('bangunan_iuts.id_pemohon', $id);
        $this->db->group_by('bangunan_iuts.id_bangunan');
        $q = $this->db->get();
        return $q;
        // return var_dump($this->db->last_query());
    }
    function detailPemohonDinas($id_bangunan,$id)
    {
        $this->db->select('admindinas.skor_akhir, admindinas.status, janjian.tanggal');
        $this->db->from('bangunan_iuts');
        $this->db->join('admindinas', 'admindinas.id_bangunan = bangunan_iuts.id_bangunan', 'INNER');
        $this->db->join('janjian', 'janjian.id_bangunan = bangunan_iuts.id_bangunan', 'INNER');

        $this->db->where('bangunan_iuts.id_bangunan', $id_bangunan);
        $this->db->where('bangunan_iuts.id_pemohon', $id);
        $this->db->group_by('bangunan_iuts.id_bangunan');
        $q = $this->db->get();
        return $q;
        // return var_dump($this->db->last_query());
    }
    function detailPemohonAmbil($id_bangunan)
    {
        $this->db->select('janjian.tgl_ambil');
        $this->db->from('janjian');
        $this->db->where('janjian.id_bangunan', $id_bangunan);
        $this->db->group_by('janjian.id_bangunan');
        $q = $this->db->get();
        return $q;
        // return var_dump($this->db->last_query());
    }
}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */