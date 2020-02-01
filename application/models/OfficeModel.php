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
	function InsertAdministrasi($bangunan,$kelengkapan,$lama,$npwp,$pbb,$skor,$keterangan)
	{
		$arrayPermohonan = array(
			'id_bangunan' => $bangunan,
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
	function InsertAdminTeknis($bangunan,$pasar,$rencana,$rencana_eksi,$tata_ruang,$jarak,$lahan,$keteranga,$skor,$cek)
	{
		$arrayPermohonan = array(
			'id_bangunan' => $bangunan,
            'id_pasar' => $pasar,
            'id_rencana' => $rencana,
            'id_rencana_eksisting' => $rencana_eksis,
            'id_tata_ruang' => $tata_ruang,
            'id_jarak' => $jarak,
            'id_lahan' => $lahan,
            'keterangan' => $keterangan,
            'total_skor' => $skor,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('admin_teknis',$arrayPermohonan);
		return $q;
	}
	function InsertAdminDinas()
	{
		$arrayPermohonan = array(
			'keterangan' => $keterangan,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
		);
		$q = $this->db->insert('admindinas',$arrayPermohonan);
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