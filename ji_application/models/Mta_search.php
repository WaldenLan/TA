<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Mta_search extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		//$this->load->model('Mta_site');
	}
	
	public function search_ta($data)
	{
		$query = $this->db
			->select('*')
			->from('ji_ta_info')
			->where('USER_ID', $data)
			->or_where('name_ch', $data)
			->or_where('name_en', $data)
			->or_where('email', $data)
			->or_where('phone', $data)
			->get();
		return $query->result();
	}
	
}