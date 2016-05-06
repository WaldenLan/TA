<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends TA_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->config->set_item('language', 'zh-cn');
		$this->load->language('ta_feedback');
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
		$data['banner_id'] = 4;
		if ($state == NULL)
		{
			redirect(base_url('ta/evaluation/manage/feedback/view/0'));
		}
		if ($state != min(max($state, 0), 3))
		{
			redirect(base_url('ta/evaluation/manage/feedback/view/' . min(max($state, 0), 3)));
		}
		$data['list'] = $this->Mta_feedback->manage_show_feedback_list($_SESSION['userid'], $state);
		
		// 分页
		$this->load->library('pagination');
		$config['use_page_numbers'] = true;
		$config['prefix'] = 'ta/evaluation/manage/feedback/view/' . $state . '/';
		$config['first_url'] = '1';
		$config['total_rows'] = count($data['list']);
		$config['per_page'] = 20;
		$this->pagination->initialize($config);
		
		$current_page =
			floor(min(max($this->uri->segment(7), 1), ($config['total_rows'] - 1) / $config['per_page'] + 1));
		if ($this->uri->segment(7) != $current_page)
		{
			redirect(base_url('ta/evaluation/manage/feedback/view/' . $state . '/' . $current_page));
		}
		$data['list'] = array_slice($data['list'], ($current_page - 1) * $config['per_page'], $config['per_page']);
		$data['page_id'] = $current_page;
		$data['state_id'] = $state;
		
		foreach ($data['list'] as $feedback)
		{
			$feedback->set_ta();
			$feedback->set_course();
		}
		
		print_r($data['list']);
		
		$this->load->view('ta/evaluation/manage/feedback_list', $data);
		
	}
	
	public function reply()
	{
		$this->load->model('Mmanage');
		$this->load->library('Course_obj');
		$id = $this->input->post('id');
		$user_id = $_SESSION['userid'];
		$content = $this->input->post('content');
		$change_flag = $this->input->post('change_flag') == 'true' ? 1 : 0;

		$feedback = $this->Mta_feedback->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			echo 'error feedback id';
		}
		else if ($this->Mmanage->get_manage_by_id($user_id)->user_id != $user_id)
		{
			echo 'error user id';
		}
		else if ($feedback->is_manage())
		{
			echo "can't reply twice";
		}
		else if (strlen($content) < $this->Mta_site->site_config['ta_feedback_content_min'] ||
		         strlen($content) > $this->Mta_site->site_config['ta_feedback_content_max']
		)
		{
			echo "the content is too short or too long";
		}
		else
		{
			$this->Mta_feedback->reply($id, Feedback_obj::STATE_MANAGE, $user_id, $change_flag);
			echo 'success';
		}
		exit();
	}
	
	// 管理员查看投诉
	public function check($id)
	{
		if (!is_numeric($id))
		{
			redirect(base_url('ta/evaluation/manage/feedback/view/'));
		}
		
		$data['page_name'] = 'TA Evaluation System: Feedbacks';
		$data['type'] = 'manage';
		$data['banner_id'] = 4;
		$data['feedback'] = $this->Mta_feedback->get_feedback_by_id($id);
		$data['state_id'] = $this->input->get('state');
		$data['page_id'] = $this->input->get('page');
		$data['feedback']->set_ta()->set_course()->set_replys();
		
		if ($data['feedback']->id != $id)
		{
			redirect(base_url('ta/evaluation/manage/feedback/view/'));
		}
		
		$this->load->model('Mmanage');
		$this->load->library('Course_obj');
		if ($this->Mmanage->get_manage_by_id($_SESSION['userid'])->user_id == $_SESSION['userid'])
		{
			
			$data['manage_reply'] = $this->Mta_feedback->get_feedback_reply_by_id($data['feedback']->manage_reply_id);
			$data['teacher_reply'] = $this->Mta_feedback->get_feedback_reply_by_id($data['feedback']->teacher_reply_id);
			
			$data['state'] = $data['feedback']->get_state_str();
			print_r($data['feedback']->replys);
			$this->load->view('ta/evaluation/feedback/check', $data);
			return;
		}
		echo $this->Mmanage->get_manage_by_id($_SESSION['userid'])->user_id;
		//redirect(base_url('ta/evaluation/manage/feedback/view/'));
		
	}
	
	
}
