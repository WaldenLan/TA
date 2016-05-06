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
		redirect(base_url('ta/evaluation/teacher/feedback/view/'));
	}
	
	// 管理员查看投诉列表
	public function view($state)
	{
		$data['page_name'] = 'TA Evaluation System: Feedbacks';
		$data['banner_id'] = 3;
		
		if ($state != min(max($state, 0), 3))
		{
			redirect(base_url('ta/evaluation/teacher/feedback/view/'.min(max($state, 0), 3)));
		}
		$data['list'] = $this->Mta_feedback->manage_show_feedback_list($_SESSION['userid'], $state);
				
		// 分页
		$this->load->library('pagination');
		$config['use_page_numbers'] = TRUE;
		$config['prefix'] = 'ta/evaluation/teacher/feedback/view/'.$state.'/';
		$config['first_url'] = '1';
		$config['total_rows'] = count($data['list']);
		$config['per_page'] = 20;
		$this->pagination->initialize($config);
		
		$current_page = floor(min(max($this->uri->segment(7), 1), ($config['total_rows'] - 1) / $config['per_page'] + 1));
		if ($this->uri->segment(7) != $current_page)
		{
			redirect(base_url('ta/evaluation/teacher/feedback/view/'.$state.'/'.$current_page));
		}
		$data['list'] = array_slice($data['list'], ($current_page - 1) * $config['per_page'], $config['per_page']);
		$data['page_id'] = $current_page;
		$data['state_id'] = $state;
		
		foreach ($data['list'] as $feedback)
		{
			$feedback->set_ta();
			$feedback->set_course();
		}
		
		
		$this->load->view('ta/evaluation/teacher/feedback_list', $data);

	}
	
	public function submit()
	{
		$form_data = array
		(
			'id'		=> $this->input->post('id'),
			'user_id'	=> $_SESSION['userid'],
			'content'	=> $this->input->post('content')
		);
		
		$data['feedback'] = $this->Mta_feedback->get_feedback_by_id($form_data['id']);
		
		if ($data['feedback']->id == $form_data['id'])
		{
			$this->load->model('Mteacher');
			$this->load->library('Course_obj');
			foreach ($this->Mteacher->get_now_course($_SESSION['userid']) as $course)
			{
				if ($course->BSID == $data['feedback']->BSID)
				{
					if ($data['feedback']->state == 2)
					{
						if (strlen($form_data['content']) >= 10)
						{
							$this->Mta_feedback->teacher_add_feedback($form_data);
							echo 'success';
							exit();
						}
					}
					break;
				}
			}
		}
		echo json_encode($form_data);
		exit();
	}
	
	// 管理员查看投诉
	public function check($id)
	{
		if (!is_numeric($id))
		{
			redirect(base_url('ta/evaluation/teacher/feedback/view/'));
		}
		
		$data['page_name'] = 'TA Evaluation System: Feedbacks';
		$data['banner_id'] = 3;
		$data['feedback'] = $this->Mta_feedback->get_feedback_by_id($id);
		$data['state_id'] = $this->input->get('state');
		$data['page_id'] = $this->input->get('page');
		$data['feedback']->set_ta();
		$data['feedback']->set_course();
		
		if ($data['feedback']->id != $id)
		{
			redirect(base_url('ta/evaluation/teacher/feedback/view/'));
		}
		
		$this->load->model('Mteacher');
		$this->load->library('Course_obj');
		foreach ($this->Mteacher->get_now_course($_SESSION['userid']) as $course)
		{
			if ($course->BSID == $data['feedback']->BSID)
			{
				$data['manage_reply'] = $this->Mta_feedback->get_feedback_reply_by_id($data['feedback']->manage_reply_id);
				$data['teacher_reply'] = $this->Mta_feedback->get_feedback_reply_by_id($data['feedback']->teacher_reply_id);
				
				$data['state'] = $this->Mta_feedback->get_state_str($data['feedback']->state);
				
				$this->load->view('ta/evaluation/teacher/feedback_check', $data);
				return;
			}
		}
		redirect(base_url('ta/evaluation/teacher/feedback/view/'));
		
	}
	
	
}
