<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mstudent extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('Mta_site');
    }
	
	public function get_all_course($id)
	{
		$query = $this->db->select('BSID')->from('ji_course_select')->where(array('USER_ID'=>$id, 'SCBJ'=>'N'))->get();
		return $query->result();
	}

	/**
	 * @param $id
	 * @return array
	 */
	public function get_now_course($id)
	{
		$this->load->library('Course_obj');
		$site_config = $this->Mta_site->get_site_config();
				
		$course_list = array();
		foreach ($this->get_all_course($id) as $course)
		{
			array_push($course_list, $course->BSID);
		}
		if (count($course_list) == 0)
		{
			return array();
		}
		
		$query = $this->db->select('*')->from('ji_course_open')->where(array('XQ'=>$site_config['ji_academic_term'], 'XN'=>$site_config['ji_academic_year'], 'SCBJ'=>'N'))->where_in('BSID', $course_list)->get();

		return $query->result('Course_obj');
	}
	
}