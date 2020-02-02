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
        $this->db->from('bangunan_iuts');
        $this->db->where('status', $status);
        $q = $this->db->get();
        return $q;
	}
    function cekPemohon($idbangun)
    {
        $this->db->select('pemohon_iuts.nama,pemohon_iuts.email,bangunan_iuts.code,bangunan_iuts.no_reg_bangunan,bangunan_iuts.nop,bangunan_iuts.alamat,bangunan_iuts.status,pemohon_iuts.nib,pemohon_iuts.npwp,bangunan_iuts.created_at,bangunan_iuts.zona,bangunan_iuts.kode_sublok,bangunan_iuts.lat,bangunan_iuts.lon');
        $this->db->from('bangunan_iuts');
        $this->db->join('pemohon_iuts', 'pemohon_iuts.id_pemohon = bangunan_iuts.id_pemohon', 'INNER');
        $this->db->where('id_bangunan', $idbangun);
        $this->db->group_by('pemohon_iuts.id_pemohon');
        $q = $this->db->get();
        return $q;
    }
	function cekAdministrasi($id)
	{
		if($id){
            $this->db->where('id_bangunan',$id);
        }
        $q = $this->db->get('administrasi');
        return $q;
	}
	function cekTeknis($id)
	{
		if($id){
            $this->db->where('id_bangunan',$id);
        }
        $q = $this->db->get('admin_teknis');
        return $q;
	}
	function cekDinas($id)
	{
		if($id){
            $this->db->where('id_bangunan',$id);
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
	function InsertAdministrasi($bangunan,$id_admin,$kelengkapan,$lama,$npwp,$pbb,$skor,$keterangan)
	{
		$arrayPermohonan = array(
			'id_bangunan' => $bangunan,
            'id_admin'=>$id_admin,
            'kelengkapan' => $kelengkapan,
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
	function InsertAdminTeknis($id_bangunan,$admin,$lahansekitar,$rencanajalan,$eksitingjalan,$tataruang,$statususaha,$statuspasar,$keterangan,$skor)
	{
		$arrayPermohonan = array(
			'id_bangunan' => $id_bangunan,
            'id_admin'=>$admin,
            'id_pasar' => $statuspasar,
            'id_rencana' => $rencanajalan,
            'id_rencana_eksisting' => $eksitingjalan,
            'id_tata_ruang' => $tataruang,
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
            'id_bangunan'=>$bangunan,
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
        $this->db->select('kelengkapan_admin.skor as skorlengkap, lama_izin.skor as skorwaktu, status_pbb.skor as skorpbb, status_npwp.skor as skornpwp, jarak_pasar.skor as skorjarakpasar, rencana_jalan.skor as skorrenjalan, jalan_eksisting.skor as skorjalaneksis, tata_ruang.skor as skortataruang, jarak_usaha.skor as skorjarakusaha, penggunaan_lahan.skor as skorpenglahan, kondisi_eksisting.skor as skorkondisieksis, pemutakhiran_pbb.skor as skotpempbb, keterlibatan_umkm.skor as skorketumkm, perjanjian_sewa.skor as skorsewa, setuju_warga_sekitar.skor as skorwarga, rekomen_umkm.skor as skorrekumkm, slf_eksisting.skor as skorslf, imb_eksisting.skor as skorimb, kajian_sostek.skor as skorkajian, volume_sumur.skor as skorvolsumur, kondisi_drainase.skor as skordrainase, kondisi_sumur.skor as skorkondisisumur, kdh_minimum.skor as skorkdhmini, bangunan_iuts.code, pemohon_iuts.nama, pemohon_iuts.nib, pemohon_iuts.npwp,bangunan_iuts.zona,bangunan_iuts.kode_sublok, bangunan_iuts.created_at as tgl, bangunan_iuts.alamat, administrasi.keterangan as ketadmin, admin_teknis.keterangan as ketteknis, admindinas.keterangan as ketdinas,SUM(kelengkapan_admin.skor + lama_izin.skor + kondisi_eksisting.skor) as skoradministrasi , SUM(pemutakhiran_pbb.skor + rekomen_umkm.skor + perjanjian_sewa.skor + penggunaan_lahan.skor + setuju_warga_sekitar.skor + jalan_eksisting.skor) as skormanfaat ,sum(status_npwp.skor + status_pbb.skor) as skortax,SUM(jarak_pasar.skor + rencana_jalan.skor + rekomen_umkm.skor + slf_eksisting.skor + volume_sumur.skor + kondisi_drainase.skor+tata_ruang.skor+imb_eksisting.skor+kajian_sostek.skor+jarak_usaha.skor+kdh_minimum.skor+kondisi_sumur.skor) as skordampak');
        $this->db->from('bangunan_iuts');
        $this->db->join('pemohon_iuts', 'bangunan_iuts.id_pemohon = bangunan_iuts.id_pemohon', 'left');
        $this->db->join('kondisi_bangunan', 'kondisi_bangunan.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->join('administrasi', 'administrasi.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->join('admin_teknis', 'admin_teknis.id_bangunan = bangunan_iuts.id_bangunan', 'left');
        $this->db->join('admindinas', 'admindinas.id_bangunan = bangunan_iuts.id_bangunan', 'left');

        $this->db->join('kelengkapan_admin', 'kelengkapan_admin.id = administrasi.kelengkapan', 'left');
        $this->db->join('lama_izin', 'lama_izin.id = administrasi.lama_waktu', 'left');
        $this->db->join('status_pbb', 'status_pbb.id = administrasi.status_pbb', 'left');
        $this->db->join('status_npwp', 'status_npwp.id = administrasi.status_npwp', 'left');

        $this->db->join('jarak_pasar', 'jarak_pasar.id = admin_teknis.id_pasar', 'left');
        $this->db->join('rencana_jalan', 'rencana_jalan.id = admin_teknis.id_rencana', 'left');
        $this->db->join('jalan_eksisting', 'jalan_eksisting.id = admin_teknis.id_rencana_eksisting', 'left');
        $this->db->join('tata_ruang', 'tata_ruang.id = admin_teknis.id_tata_ruang', 'left');
        $this->db->join('jarak_usaha', 'jarak_usaha.id = admin_teknis.id_jarak', 'left');
        $this->db->join('penggunaan_lahan', 'penggunaan_lahan.id = admin_teknis.id_lahan', 'left');

        $this->db->join('kondisi_eksisting', 'kondisi_eksisting.id = kondisi_bangunan.id_kondisi', 'left');
        $this->db->join('pemutakhiran_pbb', 'pemutakhiran_pbb.id = kondisi_bangunan.id_pbb', 'left');
        $this->db->join('keterlibatan_umkm', 'keterlibatan_umkm.id = kondisi_bangunan.id_umkm', 'left');
        $this->db->join('perjanjian_sewa', 'perjanjian_sewa.id = kondisi_bangunan.id_sewa', 'left');
        $this->db->join('setuju_warga_sekitar', 'setuju_warga_sekitar.id = kondisi_bangunan.id_warga', 'left');
        $this->db->join('rekomen_umkm', 'rekomen_umkm.id = kondisi_bangunan.id_rek_umkm', 'left');
        $this->db->join('slf_eksisting', 'slf_eksisting.id = kondisi_bangunan.id_slf', 'left');
        $this->db->join('imb_eksisting', 'imb_eksisting.id = kondisi_bangunan.id_imb', 'left');
        $this->db->join('kajian_sostek', 'kajian_sostek.id = kondisi_bangunan.id_kajian', 'left');
        $this->db->join('volume_sumur', 'volume_sumur.id = kondisi_bangunan.id_volume_sumur', 'left');
        $this->db->join('kondisi_drainase', 'kondisi_drainase.id = kondisi_bangunan.id_drainase', 'left');
        $this->db->join('kondisi_sumur', 'kondisi_sumur.id = kondisi_bangunan.id_kondisi_sumur', 'left');
        $this->db->join('kdh_minimum', 'kdh_minimum.id = kondisi_bangunan.id_kdh_minimum', 'left');
        $this->db->where('bangunan_iuts.id_bangunan', $id_bangunan);
        $this->db->group_by('bangunan_iuts.id_bangunan');
        $q = $this->db->get();
        return $q;
        // return var_dump($this->db->last_query());
    }
    function DetailBangunan($code)
    {
    	$this->db->select('*');
        $this->db->from('bangunan_iuts');
        $this->db->where('id_bangunan', $code);
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
		$this->db->select('pemohon_iuts.id_pemohon as id ,bangunan_iuts.id_bangunan as idbangunan,pemohon_iuts.nama,pemohon_iuts.npwp,bangunan_iuts.code,pemohon_iuts.email,pemohon_iuts.created_at,bangunan_iuts.updated_at,bangunan_iuts.status');
		$this->db->from('pemohon_iuts');
		$this->db->join('bangunan_iuts', 'bangunan_iuts.id_pemohon = pemohon_iuts.id_pemohon', 'INNER');

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
    		$this->db->where('bangunan_iuts.status', $statusbangunan);
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
    		$this->db->where('bangunan_iuts.status_jalan', $statusjalan);
        }elseif ($level == 2) {
        	$statusjalan = '1';
    		$this->db->where('bangunan_iuts.status_jalan', $statusjalan);
        }elseif ($level == 3) {
        	$statusjalan = '0';
    		$this->db->where('bangunan_iuts.status_jalan', $statusjalan);
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
    		$this->db->where('bangunan_iuts.status_jalan', $id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countDatatableJalan($id)
    {
        $this->getdatatable();
        if ($id!=null) {
    		$this->db->where('bangunan_iuts.status_jalan', $id);
        }
    	return $this->db->count_all_results();
    }
    public function filterTableData($id)
    {
        $this->getdatatable();
        if ($id!=null) {
    		$this->db->where('bangunan_iuts.status', $id);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countDatatable($id)
    {
        $this->getdatatable();
        if ($id!=null) {
    		$this->db->where('bangunan_iuts.status', $id);
        }
    	return $this->db->count_all_results();
    }
}

/* End of file OfficeModel.php */
/* Location: ./application/models/OfficeModel.php */