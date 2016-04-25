<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mta extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('Mta_site');
    }
	
	/*public function get_now_course($id)
	{
		$site_config = $this->Mta_site->get_site_config();
		
		$query = $this->db->select('BSID')->from('ji_course_select')->where(array('USER_ID'=>$id, 'SCBJ'=>'N'))->get();
		
		$course_list = array();
		foreach ($query->result() as $course)
		{
			array_push($course_list, $course->BSID);
		}
		if (count($course_list) == 0)
		{
			return array();
		}
		
		$query = $this->db->select('*')->from('ji_course_open')->where(array('XQ'=>$site_config['ji_academic_term'], 'XN'=>$site_config['ji_academic_year'], 'SCBJ'=>'N'))->where_in('BSID', $course_list)->get();

		return $query->result();
	}*/
	
}