<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model {

	function getSelect($table)
	{
		return $this->db->get($table);
	}
	function getSelectNilai($id,$table)
	{
		$this->db->select('skor');
		$this->db->from($table);
		$this->db->where('id', $id);
		return $this->db->get();
	}

}

/* End of file MainModel.php */
/* Location: ./application/models/MainModel.php */