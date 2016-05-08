<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Mcourse extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Course_obj');
	}
	
	public function get_course_by_id($id)
	{
		$query = $this->db->get_where('ji_course_open', array('BSID' => $id, 'SCBJ' => 'N'));
		$course = new Course_obj($query->row(0));
		return $course;
	}
	
	public function get_course_ta($id)
	{
		$this->load->model('Mta');
		$query = $this->db->select('USER_ID')->from('ji_course_ta')->where(array(
			                                                                   'BSID' => $id,
			                                                                   'SCBJ' => 'N'))
		                  ->get();
		$user_list = array();
		foreach ($query->result() as $user)
		{
			$user_list[] = $user->USER_ID;
		}
		$ta_list = array();
		foreach ($user_list as $userid)
		{
			$ta = $this->Mta->get_ta_by_id($userid);
			if (!$ta->is_error())
			{
				$ta_list[] = $ta;
			}
		}
		return $ta_list;
	}

	public function get_course_feedback($id)
	{
		$this->load->library('Feedback_obj');
		$query = $this->db->select('*')->from('ji_ta_feedback')->where(array('BSID' => $id))->get();
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

	public function get_course_student($id)
	{
		$this->load->model('Mstudent');
		$query = $this->db->select('USER_ID')->from('ji_course_select')->where(array(
			                                                                       'BSID' => $id,
			                                                                       'SCBJ' => 'N'))
		                  ->get();
		$user_list = array();
		foreach ($query->result() as $user)
		{
			$user_list[] = $user->USER_ID;
		}
		$student_list = array();
		foreach ($user_list as $userid)
		{
			$student = $this->Mstudent->get_student_by_id($userid);
			if (!$student->is_error())
			{
				$student_list[] = $student;
			}
		}
		return $student_list;
	}

}