<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends TA_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'manage';
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mta_search');
	}
	
	public function index()
	{
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: Search';
		$data['banner_id'] = 3;
		$this->load->view('ta/evaluation/search/index', $data);
	}
	
	private function redirect()
	{
		redirect(base_url('ta/evaluation/manage/search'));
	}
	
	public function course($id)
	{
		if (!is_numeric($id))
		{
			$this->redirect();
		}
		
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: Course';
		$data['banner_id'] = 3;
		
		$this->load->model('Mcourse');
		$data['course'] = $this->Mcourse->get_course_by_id($id);
		if ($data['course']->is_error())
		{
			$this->redirect();
		}
		
		$data['course']->set_ta()->set_feedback()->set_student();
		
		
		$this->load->view('ta/evaluation/search/course', $data);
		
	}

	public function ta($id)
	{
		if (!is_numeric($id))
		{
			$this->redirect();
		}

		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: Course';
		$data['banner_id'] = 3;

		$this->load->model('Mta');
		$data['ta'] = $this->Mta->get_ta_by_id($id);
		if ($data['ta']->is_error())
		{
			$this->redirect();
		}

		$data['ta']->set_course()->set_feedback();


		$this->load->view('ta/evaluation/search/ta', $data);
	}

	public function view()
	{
		$item = $this->input->get('item');
		$key = $this->input->get('key');
		$keys = explode(' ', $key);
		foreach ($keys as $index => $value)
		{
			if ($value == '')
			{
				unset($keys[$index]);
			}
		}
		$data = array();
		if ($item == 'course')
		{
			$data = $this->Mta_search->search_course($keys);
		}
		else if ($item == 'ta')
		{
			$data = $this->Mta_search->search_ta($keys);
		}
		echo json_encode($data);
		exit();
	}
	
	
}
