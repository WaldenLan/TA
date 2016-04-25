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
		
		$data['list'] = $this->Mta_feedback->student_show_feedback_list($_SESSION['userid']);
				
		// 分页
		$this->load->library('pagination');
		$config['use_page_numbers'] = TRUE;
		$config['prefix'] = 'ta/evaluation/student/feedback/view/';
		$config['first_url'] = '1';
		$config['total_rows'] = count($data['list']);
		$config['per_page'] = 2;
		$this->pagination->initialize($config);
		
		$current_page = floor(min(max($this->uri->segment(6), 1), ($config['total_rows'] - 1) / $config['per_page'] + 1));
		if ($this->uri->segment(6) != $current_page)
		{
			redirect(base_url('ta/evaluation/student/feedback/view/'.$current_page));
		}
		$data['list'] = array_slice($data['list'], ($current_page - 1) * $config['per_page'], $config['per_page']);
		
		foreach ($data['list'] as $feedback)
		{
			$feedback->set_ta();
			$feedback->set_course();
		}
		
		
		$this->load->view('ta/evaluation/student/feedback_list', $data);

	}
	
	// 学生查看投诉
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
		
		if ($data['feedback']->user_id != $_SESSION['userid'])
		{
			redirect(base_url('ta/evaluation/student/feedback/view/'));
		}
		
		$data['manage_reply'] = $this->Mta_feedback->get_feedback_reply_by_id($data['feedback']->manage_reply_id);
		$data['teacher_reply'] = $this->Mta_feedback->get_feedback_reply_by_id($data['feedback']->teacher_reply_id);
		
		$data['state'] = $this->Mta_feedback->get_state_str($data['feedback']->state);
		$data['feedback']->set_ta();
		$data['feedback']->set_course();
		$this->load->view('ta/evaluation/student/feedback_check', $data);
	}
	
	public function submit()
	{
		$this->load->model('Mstudent');
		$this->load->library('Course_obj');
		$this->load->model('Mcourse');

		$data['course_list'] = $this->Mstudent->get_now_course($_SESSION['userid']);
		foreach ($data['course_list'] as $course)
		{
			$course->set_ta();
		}
		
		$form_data = array
		(
			'BSID'		=> $this->input->post('BSID'),
			'ta_id'		=> $this->input->post('ta_id'),
			'title'		=> $this->input->post('title'),
			'content'	=> $this->input->post('content'),
			'anonymous'	=> $this->input->post('anonymous')
		);
				
		foreach ($data['course_list'] as $course)
		{
			if ($course->BSID == $form_data['BSID'])
			{
				foreach ($course->ta_list as $ta)
				{
					if ($ta->USER_ID == $form_data['ta_id'])
					{
						if (strlen($form_data['content']) >= 10 && strlen($form_data['title']) >= 5 && strlen($form_data['title']) <= 20)
						{
							if ($form_data['anonymous'] == true)
							{
								$form_data['anonymous'] = 1;
							}
							else
							{
								$form_data['anonymous'] = 0;
							}
							$form_data['user_id'] = $_SESSION['userid'];
							echo $this->Mta_feedback->student_create_feedback($form_data);
							exit();
						}
						break;
					}
				}
				break;
			}
		}
		echo json_encode($form_data);
		exit();
	}
	
	// 学生创建投诉
	public function add()
	{	
		$this->load->model('Mstudent');
		$this->load->library('Course_obj');
		$this->load->model('Mcourse');

		$data['course_list'] = $this->Mstudent->get_now_course($_SESSION['userid']);
		foreach ($data['course_list'] as $course)
		{
			$course->set_ta();
		}

		$data['page_name'] = 'TA Evaluation System: Feedbacks';
		$data['banner_id'] = 3;
		$data['form_data'] = $form_data;
		
		$this->load->view('ta/evaluation/student/feedback_add', $data);
	}
	
	// 学生取消投诉
	public function cancel($id)
	{
		if (is_numeric($id))
		{
			$feedback = $this->Mta_feedback->get_feedback_by_id($id);
			if ($feedback->id == $id)
			{
				if ($feedback->state == 0 && $feedback->user_id == $_SESSION['userid'])
				{
					$this->Mta_feedback->student_cancel_feedback($id);
					redirect(base_url('ta/evaluation/student/feedback/check/'.$id));
				}
			}
		}
		redirect(base_url('ta/evaluation/student/feedback/view/'));
		
	}
	
	public function test()
	{
		$this->load->model('Mta_search');
		print_r($this->Mta_search->search_ta(515370910207));
	}
	
}
