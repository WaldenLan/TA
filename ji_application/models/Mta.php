<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mta extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('Mta_site');
		$this->load->library('Ta_obj');
    }
	
	public function get_ta_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_info', 'USER_ID='.$id);
		if ($query->num_rows() == 1)
		{
			return $query->row(0, 'Ta_obj');
		}
		$ta = new Ta_obj();
		$ta->set_error();
		return $ta;
	}
	
}