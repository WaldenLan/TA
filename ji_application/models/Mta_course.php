<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mta_course extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->library('Course_obj');
    }
	
	public function get_course_by_id($id)
	{
		$query = $this->db->get_where('ji_course_open', 'BSID='.$id);
		if ($query->num_rows() == 1)
		{
			return $query->row(0, 'Course_obj');
			
		}
		$course = new Course_obj();
		$course->set_error();
		return $course;
	}
	
	
}