<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends TA_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_feedback');
		$this->load->library('Feedback_obj');
	}
	
	public function index()
	{
		redirect(base_url('ta/evaluation/student/feedback/view/'));
	}
	
	// 学生查看投诉列表
	public function view()
	{
		$data['page_name'] = 'TA Evaluation System: Feedbacks';
		$data['banner_id'] = 3;
		
		$_SESSION['userid'] = 5060109016;
		$_SESSION['username'] = '隔壁老王';
		$data['list'] = $this->Mta_feedback->student_show_feedback_list($_SESSION['userid']);
		
		//print_r($data['list']);
		
		// 分页
		$this->load->library('pagination');
		$config['use_page_numbers'] = TRUE;
		$config['prefix'] = 'ta/evaluation/student/feedback/view/';
		$config['first_url'] = 'ta/evaluation/student/feedback/view/1';
		$config['total_rows'] = count($data['list']);
		$config['per_page'] = 20;
		$this->pagination->initialize($config);
		
		$this->load->view('ta/evaluation/student/feedback_list', $data);

	}
	
	public function check($id)
	{
		if (!is_numeric($id))
		{
			redirect(base_url('ta/evaluation/student/feedback/view/'));
		}
		
		$data['page_name'] = 'TA Evaluation System: Feedbacks';
		$data['banner_id'] = 3;
		$data['feedback'] = $this->Mta_feedback->get_feedback_by_id($id);
		
		if ($data['feedback']->id != $id)
		{
			redirect(base_url('ta/evaluation/student/feedback/view/'));
		}
		
		$data['manage_reply'] = $this->Mta_feedback->get_feedback_reply_by_id($data['feedback']->manage_reply_id);
		$data['teacher_reply'] = $this->Mta_feedback->get_feedback_reply_by_id($data['feedback']->teacher_reply_id);
		
		$data['state'] = $this->Mta_feedback->get_state_str($data['feedback']->state);
		
		$this->load->view('ta/evaluation/student/feedback_check', $data);
	}
	
	// 学生创建投诉
	public function add()
	{
		$data['page_name'] = 'TA Evaluation System: Feedbacks';
		$data['banner_id'] = 3;
		
		
		$this->load->view('ta/evaluation/student/feedback_add', $data);
	}
	
}
