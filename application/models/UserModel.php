<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class UserModel extends CI_Model {

    function cekDataIUMK($email='')
    {
        $this->db->where('email', $email);
        $q = $this->db->get('data_iumk');
        return $q;
    }
	function cekPemohon($nik='',$id='')
    {
        if($nik){
            $this->db->where('email',$nik);
            $this->db->where('jenis_pemohon', $id);
        }
        $q = $this->db->get('pemohon');
        return $q;
    }
    function cekBangunan($data)
    {
        if($data){
            $this->db->where('nop',$data);
        }
        $q = $this->db->get('data_iuts');
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
    function cekFotoIuts($id)
    {
        $this->db->where('id_iuts', $id);
        $this->db->where('jenis_foto', $jenis);
        $q = $this->db->get('foto_iuts');
        return $q;
    }
    function cekFotoSlf($id,$jenis)
    {
        $this->db->where('id_slf', $id);
        $this->db->where('jenis_foto', $jenis);
        $q = $this->db->get('foto_slf');
        return $q;
    }
    function cekFotoAdmin($id,$jenis)
    {
        $this->db->where('idizin', $id);
        $this->db->where('jenis_foto', $jenis);
        $q = $this->db->get('foto_admin');
        return $q;
    }
    function cekFotoAll($idizin,$database)
    {
        $this->db->where('idizin', $idizin);
        $q = $this->db->get($database);
        return $q;
    }
    function SkoringWeb($slf)
    {
        $this->db->select('taxclear.status_pbb,taxclear.status_npwp,AVG(kondisi_kdh.skor + volume_sumur.skor + kondisi_pertandaan.skor + kondisi_sumur.skor + kondisi_drainase.skor + izin_damkar.skor + izin_tenaga_kerja.skor + izin_imb.skor + fasilitas_damkar.skor + asuransi_toko.skor + kelayakan_gedung.skor + ketersedian_air.skor + pengelola_limbah.skor + pengelola_sampah.skor + ketersedian_listrik.skor + ketersedian_toilet.skor + kondisi_parkir.skor + rekomendasi_slf.skor + jalan_eksisting.skor)/19 as skorslf,AVG(pemutakhiran_pbb.skor + keterlibatan_umkm.skor + rekomen_umkm.skor + tata_ruang.skor + kajian_sostek.skor)/5 as skoriuts');
        $this->db->from('cek_izin');
        $this->db->join('kondisi_slf', 'kondisi_slf.id_slf = cek_izin.id_slf', 'INNER');
        $this->db->join('kondisi_iuts', 'kondisi_iuts.id_iuts = cek_izin.id_iuts', 'INNER');
        $this->db->join('taxclear', 'taxclear.id_slf = kondisi_slf.id_slf', 'LEFT');

        $this->db->join('kondisi_kdh', 'kondisi_kdh.id = kondisi_slf.id_kondisi_kdh', 'left');
        $this->db->join('jalan_eksisting', 'jalan_eksisting.id = kondisi_slf.id_jalan_eksis', 'left');
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

        $this->db->where('kondisi_slf.id_slf', $slf);
        $query = $this->db->get();
        return $query;
    }
    function cekKondisiiuts($id)
    {
        if($id){
            $this->db->where('id_iuts',$id);
        }
        $q = $this->db->get('kondisi_iuts');
        return $q;
    }
    function cekKondisislf($id)
    {
        if($id){
            $this->db->where('id_slf',$id);
        }
        $q = $this->db->get('kondisi_slf');
        return $q;
    }
    
    function cekCodeBangunan($id)
    {
        if($id){
            $this->db->where('id_izin',$id);
        }
        $q = $this->db->get('cek_izin');
        return $q;
    }
    function cekSpasial($id)
    {
        $this->db->select('tata_ruang.id');
        $this->db->from('spasial');
        $this->db->join('zona_sub', 'zona_sub.id = spasial.id_subzona', 'INNER');
        $this->db->join('tata_ruang', 'tata_ruang.id = spasial.id_tataruang', 'INNER');
        $this->db->where('zona_sub.kode_subzona', $id);
        $this->db->where('spasial.itbx_detail', 'Mini Market');
        $q = $this->db->get();
        return $q;
    }
	function InsertBangunan($id,$idpemohon,$nop,$nama_toko,$nama_badan_usaha,$lokasi,$alamatpemohon,$kelompok,$untuk_toko,$lat,$lng,$kecamatan,$kelurahan,$zona,$sublock,$luas_lahan,$status_milik,$status_bangunan,$ltb,$luas_lantai,$luas_lantai_input,$jml_lantai,$jumlah_atm,$kode)
	{
		$arrayPermohonan = array(
                'id_bangunan'=>$id,
                'id_pemohon'=>$idpemohon,
                'nop'=>$nop,
                'nama_usaha'=>$nama_toko,
                'nama_badan_usaha'=>$nama_badan_usaha,
                'alamat'=>$lokasi,
                'alamat_lengkap'=>$alamatpemohon,
                'kelompok_usaha'=>$kelompok,
                'peruntukan_toko'=>$untuk_toko,
                'lat'=>$lat,
                'lon'=>$lng,
                'kecamatan'=>$kecamatan,
                'kelurahan'=>$kelurahan,
                'zona'=>$zona,
                'kode_sublok'=>$sublock,
                'luas_lahan'=>$luas_lahan,
                'status_milik'=>$status_milik,
                'status_bangunan'=>$status_bangunan,
                'luas_tapak'=>$ltb,
                'luas_lantai'=>$luas_lantai,
                'detail_luas_lantai'=>$luas_lantai_input,
                'jumlah_lantai'=>$jml_lantai,
                'jml_atm'=>$jumlah_atm,
                'code'=>$kode,
                'status' => 0,
                'status_jalan' =>0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
        $q = $this->db->insert('data_slf',$arrayPermohonan);
        return $q;
	}
	function InsertPemohon($id,$namaLengkap,$namadirektur,$nama_perusahaan,$jabatan,$nomorInKepen,$fotoktp,$nomorInBeru,$npwp,$alamat_perusahaan,$no_telp,$emailAktif,$fotonpwp,$status_pemohon,$token,$fotoakta,$sistem_usaha,$status_nib)
	{
        if ($namaLengkap == null) {
            $nama = $namadirektur;
        }else{
            $nama = $namaLengkap;
        }
		$array = array(
            'id_pemohon'=>$id,
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
            'foto_npwp'=>$fotonpwp,
            'jenis_pemohon'=>$status_pemohon,
            'sistem_usaha'=>$sistem_usaha,
            'status_nib'=>$status_nib,
            'akta_perusahaan'=>$fotoakta,
            'password'=>password_hash($token, PASSWORD_DEFAULT),
            'token'=>$token,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('pemohon',$array);
        return $q;
	}
    function InsertKondisiSlf($idslf,$kdh_zonasi,$jalaneksis,$kdh_minimum,$kondisi_kdh,$volume,$kondisipertandaan,$kondisi_sumur,$drainase,$slf,$damkar,$tenaga_kerja,$imb,$fasilitas,$asuransi,$kelayakan,$air,$sumber_air,$limbah,$sampah,$listrik,$toilet,$parkir)
    {
        $array = array(
            'id_slf'=>$slf,
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
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('kondisi_slf',$array);
        return $q;
    }
    function InsertKondisiIuts($idiuts,$pbb,$umkm,$keterlibatan_umkm_input,$jumlah_karyawan,$asal_karyawan,$jumlah_atm,$jumlah_pengunjung,$rek_umkm,$id_tata,$kajian,$warga)
    {
        $array = array(
            'id_iuts'=>$idiuts,
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
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('kondisi_iuts',$array);
        return $q;
    }
    function InsertKondisi($bangunan,$kondisi,$detail_kondisi_input,$pbb,$status_pbb,$status_npwp,$umkm,$keterlibatan_umkm_input,$sewa,$janji_sewa_input,$warga,$rek_umkm,$id_tata,$kajian,$imb,$slf,$volume,$kondisi_sumur,$drainase,$kdh_minimum,$kondisi_kdh,$sampah,$parkir)
    {
        $array = array(
            'id_bangunan' => $bangunan,
            'id_kondisi' => $kondisi,
            'kondisi_eksisting' => $detail_kondisi_input,
            'id_pbb' => $pbb,
            'status_pbb' => $status_pbb,
            'status_npwp' => $status_npwp,
            'id_umkm' => $umkm,
            'keterlibatan_umkm' => $keterlibatan_umkm_input,
            'id_sewa' => $sewa,
            'perjanjian_sewa' => $janji_sewa_input,
            'id_warga' => $warga,
            'id_rek_umkm' => $rek_umkm,
            'id_tata_ruang' => $id_tata, // baru
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
            'created_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('kondisi_bangunan',$array);
        return $q;
    }
    function InsertIzin($id,$idpemohon,$idslf,$idiuts,$lokasi,$alamatpemohon,$lat,$lng,$kecamatan,$kelurahan,$zona,$sublock,$kode,$jenis)
    {
        $array = array(
            'id_izin'=>$id,
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
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'id_jenis' => $jenis,
            );
            $q = $this->db->insert('cek_izin',$array);
        return $q;
    }
	function InsertSkor($slf,$totalslf,$iuts,$rata,$status_iuts,$status)
	{
		$array = array(
            'id_bangunan'=>$slf,
            'total_slf' => $totalslf,
            'total_iuts' => $iuts,
            'rata-rata' => $rata,
            'status_iuts' => $status_iuts,
            'status_slf' => $status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $q = $this->db->insert('skor_bangunan',$array);
        return $q;
		
	}
    function InsertTax($id,$pbb,$npwp,$jenis)
    {
        $array = array(
            'id_izin'=>$id,
            'total_slf' => $totalslf,
            'status_pbb' => $pbb,
            'status_npwp' => $npwp,
            'jenis_izin' => $jenis,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
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
        $row = $this->db->get_where('pemohon',$where);
        if ($row->num_rows() > 0) {
            $cekrow = $row->row();
            $cekpemohon = password_verify(''.$token.'', ''.$cekrow->password.'');
            if ($cekpemohon == true) {
                $q = $this->db->get_where('pemohon',$where);
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
        $row = $this->db->get('pemohon',$where)->row();
        $cekpemohon = password_verify(''.$token.'', ''.$row->password.'');
        if ($cekpemohon == true) {
            $q = $this->db->get('pemohon',$where);
        }else{
            $q = false;
        }
        return $q;
    }
    function listPermohonan($id,$status='',$awal,$akhir)
    {
        $this->db->select('cek_izin.id_izin,cek_izin.id_slf,cek_izin.id_iuts,cek_izin.code,cek_izin.status,cek_izin.created_at,pemohon.nama,jenis_izin.nama as jenis');
        $this->db->from('cek_izin');
        $this->db->join('data_slf', 'data_slf.id_slf = cek_izin.id_slf', 'LEFT');
        $this->db->join('data_iuts', 'data_iuts.id_iuts = cek_izin.id_iuts', 'LEFT');
        $this->db->join('pemohon', 'pemohon.id_pemohon = cek_izin.id_pemohon', 'INNER');
        $this->db->join('jenis_izin', 'jenis_izin.id_izin = cek_izin.id_jenis', 'INNER');
        $this->db->group_by('cek_izin.code');
        if ($status != '') {
            if ($status == '1') {
                $this->db->where_in('cek_izin.status', [1,2]);
            }else{
                $this->db->where('cek_izin.status', $status);
            }
        }
        $this->db->where('cek_izin.id_pemohon', $id);
        $q = $this->db->get();
        return $q;
    }
    function detailPermohonan($id,$id_bangunan,$code)
    {
        $this->db->select('*');
        $this->db->from('data_slf');
        $this->db->join('admin_teknis', 'admin_teknis.id_bangunan = data_slf.id_slf', 'left');
        $this->db->join('admindinas', 'admindinas.id_bangunan = data_slf.id_slf', 'left');
        $this->db->where('data_slf.id_slf', $id_bangunan);
        $this->db->where('data_slf.id_pemohon', $id);
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
    function detailPemohonAdministrasi($id_izin)
    {
        $this->db->select('*');
        $this->db->from('cek_izin');
        $this->db->join('administrasi', 'cek_izin.id_izin = administrasi.id_izin', 'INNER');

        $this->db->where('cek_izin.id_izin', $id_izin);
        $this->db->group_by('cek_izin.id_izin');
        $q = $this->db->get();
        return $q;
    }
    function getAllfoto()
    {
        $this->db->select('foto_iuts.status as statusiuts, foto_iuts.jenis_foto as jenisiuts, foto_slf.status as statusslf, foto_slf.jenis_foto as jenisslf, foto_slf.foto as fotoiuts, foto_iuts.foto as fotoiuts');
        $this->db->from('cek_izin');
        $this->db->join('data_iuts', 'cek_izin.id_iuts = data_iuts.id_iuts', 'INNER');
        $this->db->join('data_slf', 'cek_izin.id_slf = data_slf.id_slf', 'INNER');
        $this->db->join('foto_iuts', 'foto_iuts.id_iuts = data_iuts.id_iuts', 'INNER');
        $this->db->join('foto_slf', 'foto_slf.id_slf = data_slf.id_slf', 'INNER');

        $this->db->where('cek_izin.id_izin', $id_izin);
        $this->db->group_by('cek_izin.id_izin');
        $q = $this->db->get();
        return $q;
    }
    function detailPemohonteknis($id_bangunan,$id)
    {
        $this->db->select('jarak_pasar.skor as skorjarakpasar, jarak_usaha.skor as skorjarakusaha, penggunaan_lahan.skor as skorpenglahan, ROUND(AVG(jarak_pasar.skor + jarak_usaha.skor + penggunaan_lahan.skor) /3 ,1) as skormanfaat ');
        $this->db->from('cek_izin');
        $this->db->join('data_slf', 'cek_izin.id_slf = data_slf.id_slf', 'left');
        $this->db->join('data_iuts', 'data_iuts.id_iuts = cek_izin.id_iuts', 'left');
        $this->db->join('kondisi_slf', 'kondisi_slf.id_slf = data_slf.id_slf', 'left');
        $this->db->join('kondisi_iuts', 'kondisi_iuts.id_iuts = data_iuts.id_iuts', 'left');
        $this->db->join('admin_teknis', 'admin_teknis.id_izin = cek_izin.id_izin', 'INNER');

        $this->db->join('jarak_pasar', 'jarak_pasar.id = admin_teknis.id_pasar', 'INNER');
        $this->db->join('penggunaan_lahan', 'penggunaan_lahan.id = admin_teknis.id_lahan', 'INNER');
        $this->db->join('jarak_usaha', 'jarak_usaha.id = admin_teknis.id_jarak', 'INNER');
        $this->db->where('cek_izin.id_izin', $id_bangunan);
        $this->db->where('cek_izin.id_pemohon', $id);
        $this->db->group_by('cek_izin.id_izin');
        $q = $this->db->get();
        return $q;
        // return var_dump($this->db->last_query());
    }
    function detailPemohonDinas($id_bangunan,$id)
    {
        $this->db->select('admindinas.skorakhiriuts,admindinas.skorakhirslf, admindinas.status, janjian.tanggal,admindinas.keterangan');
        $this->db->from('cek_izin');
        $this->db->join('admindinas', 'admindinas.id_izin = cek_izin.id_izin', 'INNER');
        $this->db->join('janjian', 'janjian.id_izin = cek_izin.id_izin', 'LEFT');

        $this->db->where('cek_izin.id_izin', $id_bangunan);
        $this->db->group_by('cek_izin.id_izin');
        $q = $this->db->get();
        return $q;
        // return var_dump($this->db->last_query());
    }
    function detailPemohonAmbil($id_bangunan)
    {
        $this->db->select('janjian.tgl_ambil');
        $this->db->from('janjian');
        $this->db->where('janjian.id_izin', $id_bangunan);
        $this->db->group_by('janjian.id_izin');
        $q = $this->db->get();
        return $q;
        // return var_dump($this->db->last_query());
    }
    function KonfirmasiPemohon($idbangunan)
    {
        $fileupload = $this->Uploadfoto('file');
        $where = array(
            'id_izin'=>$idbangunan,
        );
        $data = array(
            'tgl_terima'=>date('Y-m-d'),
            'file'=>$fileupload,
        );
        $q = $this->db->update('janjian', $data,$where);
        return $q;
    }
    function FeedBack($idbangunan)
    {
        $query = $this->db->insert('feedback', array(
            'id_izin'=>$idbangunan,
            'ulasan'=>htmlspecialchars($this->input->post('pesan')),
            'created_at'=>date('Y-m-d'),
        ));
        return $query;
    }
    
    public function Uploadfoto($param)
    {
        $this->load->library('upload');
        $config['upload_path'] = './assets/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;

        $this->upload->initialize($config);
        $upload = $this->upload->do_upload($param);
        if (! $upload) {
            $image = null;
        }else{
            $data = $this->upload->data();
            $image = $data['file_name'];
        }
        return $image;
    }
}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */