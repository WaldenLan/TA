<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mstudent extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('Mta_site');
    }
	
	public function get_all_course($id)
	{
		$query = $this->db->get_where('ji_course_select', 'USERID='.$id);
		return $query->result();
	}
	
	public function get_now_course($id)
	{
		$query = $this->db->get('ji_course_select')->where('USERID='.$id)->where_in('BSID', $this->db->get('ji_course_open')->where('XN='.$));
		return $query->result();
	}
	
}