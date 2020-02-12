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
        $this->db->select('*');
        $this->db->from('cek_izin');
        $this->db->join('data_iuts', 'data_iuts.id_iuts = cek_izin.id_iuts', 'LEFT');
        $this->db->join('data_slf', 'data_slf.id_slf = cek_izin.id_slf', 'LEFT');
        $this->db->join('pemohon_iuts', 'pemohon_iuts.id_pemohon = cek_izin.id_pemohon', 'INNER');
        $this->db->join('kondisi_slf', 'kondisi_slf.id_slf = data_slf.id_slf', 'LEFT');
        $this->db->join('kondisi_iuts', 'kondisi_iuts.id_iuts = data_iuts.id_iuts', 'LEFT');
        $this->db->where('cek_izin.id_izin', $idbangun);
        $this->db->group_by('cek_izin.code');
        $q = $this->db->get();
        return $q;
    }
    function cekFotoPemohon($idizin)
    {
        $this->db->select('foto_slf.jenis_foto as jenisslf,foto_iuts.jenis_foto as jenisiuts,foto_slf.foto as fotoslf,foto_iuts.foto as fotoiuts');
        $this->db->from('cek_izin');
        $this->db->join('data_iuts', 'data_iuts.id_iuts = cek_izin.id_iuts', 'LEFT');
        $this->db->join('data_slf', 'data_slf.id_slf = cek_izin.id_slf', 'LEFT');
        $this->db->join('pemohon_iuts', 'pemohon_iuts.id_pemohon = cek_izin.id_pemohon', 'INNER');
        $this->db->join('foto_slf', 'foto_slf.id_slf = data_slf.id_slf', 'LEFT');
        $this->db->join('foto_iuts', 'foto_iuts.id_iuts = data_iuts.id_iuts', 'LEFT');
        $this->db->where('cek_izin.id_izin', $idbangun);
        $this->db->group_by('cek_izin.code');
        $q = $this->db->get();
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
            $this->db->where('id_bangunan',$id);
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
	function InsertAdministrasi($bangunan,$id_admin,$lama,$npwp,$pbb,$skor,$keterangan)
	{
		$arrayPermohonan = array(
			'id_bangunan' => $bangunan,
            'id_admin'=>$id_admin,
            // 'kelengkapan' => $kelengkapan,
            'lama_waktu' => $lama,
            'status_pbb' => $pbb,
            'status_npwp' => $npwp,
            'total_skor' => $skor,
            'keterangan' => $keterangan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('administrasi',$arrayPermohonan);
		return $q;
	}
	function InsertAdminTeknis($id_bangunan,$admin,$lahansekitar,$rencanajalan,$eksitingjalan,$statususaha,$statuspasar,$keterangan,$skor)
	{
		$arrayPermohonan = array(
			'id_izin' => $id_bangunan,
            'id_admin'=>$admin,
            'id_pasar' => $statuspasar,
            'id_rencana' => $rencanajalan,
            'id_rencana_eksisting' => $eksitingjalan,
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
	function InsertAdminDinasBaru($bangunan,$admin,$keterangan,$status,$skor)
	{
		$arrayPermohonan = array(
            'id_izin'=>$bangunan,
			'id_admin' => $admin,
            'keterangan' => $keterangan,
            'skor_akhir' => $skor,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('admindinas',$arrayPermohonan);
		return $q;
	}
    function InsertSurat($bangunan,$id_admin,$tgl)
    {
        $arrayPermohonan = array(
            'id_admin' => $id_admin,
            'id_bangunan' => $bangunan,
            'tanggal' => $tgl,
            'tgl_ambil' => $tgl,
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
        
        $this->db->select('kondisi_kdh.skor as skorkondisikdh,kondisi_pertandaan.skor as skorpetandaan, status_pbb.skor as skorpbb, status_npwp.skor as skornpwp, jarak_pasar.skor as skorjarakpasar, rencana_jalan.skor as skorrenjalan, jalan_eksisting.skor as skorjalaneksis, tata_ruang.skor as skortataruang, jarak_usaha.skor as skorjarakusaha, penggunaan_lahan.skor as skorpenglahan, pemutakhiran_pbb.skor as skotpempbb, keterlibatan_umkm.skor as skorketumkm, rekomen_umkm.skor as skorrekumkm, izin_imb.skor as skorimb, kajian_sostek.skor as skorkajian, volume_sumur.skor as skorvolsumur, kondisi_drainase.skor as skordrainase, kondisi_sumur.skor as skorkondisisumur, kdh_minimum.skor as skorkdhmini, data_slf.code, pemohon_iuts.nama, pemohon_iuts.nib, pemohon_iuts.npwp,data_iuts.zona,data_iuts.kode_sublok, data_iuts.created_at as tgl, data_iuts.alamat_usaha, admin_teknis.keterangan as ketteknis,rekomendasi_slf.skor as rekskor,izin_damkar.skor as skordamkar,izin_tenaga_kerja.skor as skortkt,fasilitas_damkar.skor as skorfdamkar,asuransi_toko.skor as skorasuransi,kelayakan_gedung.skor as skorlayak,ketersedian_air.skor as skorketersediaan,pengelola_limbah.skor as skorlimbah,pengelola_sampah.skor as skorsampah,ketersedian_listrik.skor as skorlistrik,ketersedian_toilet.skor as skortoilet,kondisi_parkir.skor as skorparkir,ROUND(AVG(kdh_minimum.skor + kondisi_kdh.skor + volume_sumur.skor + kondisi_pertandaan.skor + kondisi_sumur.skor + kondisi_drainase.skor + rekomendasi_slf.skor + izin_damkar.skor + izin_tenaga_kerja.skor + izin_imb.skor + fasilitas_damkar.skor + asuransi_toko.skor + kelayakan_gedung.skor + ketersedian_air.skor + pengelola_limbah.skor + pengelola_sampah.skor + ketersedian_listrik.skor + ketersedian_toilet.skor + kondisi_parkir.skor)/19,1) as skorslf, ROUND(AVG(pemutakhiran_pbb.skor + keterlibatan_umkm.skor + rekomen_umkm.skor + tata_ruang.skor + kajian_sostek.skor + penggunaan_lahan.skor + jalan_eksisting.skor + jarak_usaha.skor + jarak_pasar.skor + rencana_jalan.skor)/10,1) as skoriuts');
        $this->db->from('data_slf');
        $this->db->join('pemohon_iuts', 'pemohon_iuts.id_pemohon = data_slf.id_pemohon', 'left');
        $this->db->join('data_iuts', 'data_slf.id_slf = data_iuts.id_slf', 'left');
        $this->db->join('kondisi_iuts', 'kondisi_iuts.id_iuts = data_iuts.id_iuts', 'left');
        $this->db->join('kondisi_slf', 'data_slf.id_slf = kondisi_slf.id_slf', 'left');
        $this->db->join('taxclear', 'taxclear.id_slf = data_slf.id_slf', 'left');
        $this->db->join('admin_teknis', 'admin_teknis.id_bangunan = data_slf.id_slf', 'left');

        $this->db->join('kdh_minimum', 'kdh_minimum.id = kondisi_slf.id_kdh_minimum', 'left');
        $this->db->join('kondisi_kdh', 'kondisi_kdh.id = kondisi_slf.id_kondisi_kdh', 'left');
        $this->db->join('volume_sumur', 'volume_sumur.id = kondisi_slf.id_volume_sumur', 'left');
        $this->db->join('kondisi_pertandaan', 'kondisi_pertandaan.id = kondisi_slf.id_pertandaan_toko', 'left');
        $this->db->join('kondisi_sumur', 'kondisi_sumur.id = kondisi_slf.id_kondisi_sumur', 'left');
        $this->db->join('kondisi_drainase', 'kondisi_drainase.id = kondisi_slf.id_drainase', 'left');
        $this->db->join('rekomendasi_slf', 'rekomendasi_slf.id = kondisi_slf.id_rek_slf', 'left');
        $this->db->join('izin_damkar', 'izin_damkar.id = kondisi_slf.id_izin_damkar', 'left');
        $this->db->join('izin_tenaga_kerja', 'izin_tenaga_kerja.id = kondisi_slf.id_tenaga_kerja', 'left');
        $this->db->join('izin_imb', 'izin_imb.id = kondisi_slf.id_imb', 'left');
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

        $this->db->join('jarak_pasar', 'jarak_pasar.id = admin_teknis.id_pasar', 'left');
        $this->db->join('rencana_jalan', 'rencana_jalan.id = admin_teknis.id_rencana', 'left');
        $this->db->join('jalan_eksisting', 'jalan_eksisting.id = admin_teknis.id_rencana_eksisting', 'left');
        $this->db->join('jarak_usaha', 'jarak_usaha.id = admin_teknis.id_jarak', 'left');
        $this->db->join('penggunaan_lahan', 'penggunaan_lahan.id = admin_teknis.id_lahan', 'left');

        $this->db->join('status_pbb', 'status_pbb.id = taxclear.status_pbb', 'left');
        $this->db->join('status_npwp', 'status_npwp.id = taxclear.status_npwp', 'left');

        $this->db->where('kondisi_slf.id_slf', $id_bangunan);
        $this->db->group_by('kondisi_slf.id_slf');
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
		$this->db->select('pemohon_iuts.id_pemohon as id, pemohon_iuts.nama,pemohon_iuts.email, pemohon_iuts.npwp,cek_izin.id_izin as idbangunan,cek_izin.code,cek_izin.created_at,cek_izin.updated_at,cek_izin.status');
		$this->db->from('pemohon_iuts');
		$this->db->join('cek_izin', 'cek_izin.id_pemohon = pemohon_iuts.id_pemohon', 'INNER');

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
        	$statusjalan = '1';
    		$this->db->where('cek_izin.status_jalan', $statusjalan);
        }elseif ($level == 2) {
        	$statusjalan = '0';
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
}

/* End of file OfficeModel.php */
/* Location: ./application/models/OfficeModel.php */