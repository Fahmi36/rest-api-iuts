<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainModel extends CI_Model {

	function getSelect($table)
	{
		return $this->db->get($table);
	}

}

/* End of file MainModel.php */
/* Location: ./application/models/MainModel.php */