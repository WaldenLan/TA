<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Mta extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->library('Ta_obj');
	}
	
	public function get_ta_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_info', array('USER_ID' => $id));
		$ta = new Ta_obj($query->row(0));
		return $ta;
	}
	
	public function get_ta_course($id)
	{
		$this->load->model('Mcourse');
		$query =
			$this->db->select('BSID')->from('ji_course_ta')->where(array('USER_ID' => $id))->get();
		$course_list = array();
		foreach ($query->result() as $course)
		{
			$course_list[] = $course->BSID;
		}
		$list = array();
		foreach ($course_list as $BSID)
		{
			$course = $this->Mcourse->get_course_by_id($BSID);
			if (!$course->is_error())
			{
				$list[] = $course;
			}
		}
		return $list;
	}

	public function get_ta_feedback($id)
	{
		$this->load->library('Feedback_obj');
		$query = $this->db->select('*')->from('ji_ta_feedback')->where(array('ta_id' => $id))
			->get();
		$feedback_list = array();
		foreach ($query->result() as $result)
		{
			$feedback = new Feedback_obj($result);
			if (!$feedback->is_error())
			{
				$feedback_list[] = $feedback;
			}
		}
		return $feedback_list;
	}
	
	public function get_ta_report($id)
	{

		$report_list = array();

		return $report_list;
	}
}