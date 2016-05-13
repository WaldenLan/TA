<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'teacher';
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mta_evaluation');
		$this->load->model('Mteacher');
		$this->load->library('Evaluation_obj');
	}
	
	public function index()
	{
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: Evaluation Setup';
		$data['banner_id'] = 2;

		$this->load->library('Course_obj');

		$data['course_list'] = $this->Mteacher->get_now_course($_SESSION['userid']);
		foreach ($data['course_list'] as $course)
		{
			/** @var $course Course_obj */
			$course->set_ta();
		}

		$this->load->view('ta/evaluation/evaluation/setup', $data);
	}

	public function add()
	{
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: Evaluation Setup';
		$data['banner_id'] = 2;

		$this->load->model('Mcourse');

		$BSID = $this->input->get('BSID');
		if (!$this->Mteacher->is_now_course($_SESSION['userid'], $BSID))
		{
			redirect(base_url('ta/evaluation/teacher/evaluation'));
		}
		$data['course'] = $this->Mcourse->get_course_by_id($BSID);
		if ($data['course']->is_error())
		{
			redirect(base_url('ta/evaluation/teacher/evaluation'));
		}
		$data['course']->set_ta();

		$this->load->view('ta/evaluation/evaluation/setup', $data);
	}

	public function evaluate()
	{
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: Evaluation Setup';
		$data['banner_id'] = 2;

		$this->load->model('Mcourse');

		$BSID = $this->input->get('BSID');
		if (!$this->Mteacher->is_now_course($_SESSION['userid'], $BSID))
		{
			redirect(base_url('ta/evaluation/teacher/evaluation'));
		}
		$data['course'] = $this->Mcourse->get_course_by_id($BSID);
		if ($data['course']->is_error())
		{
			redirect(base_url('ta/evaluation/teacher/evaluation'));
		}
		$data['course']->set_ta();


		$this->load->view('ta/evaluation/evaluation/setup', $data);
	}

	public function receive()
	{
		$content = $this->input->get('content');
		$type = $this->input->get('type');
		if ($type != 'choice' && $type != 'blank')
		{
			echo 'error question type';
			exit();
		}
		$BSID = $this->input->get('BSID');
		if (!$this->Mteacher->is_now_course($_SESSION['userid'], $BSID))
		{
			echo 'error';
			exit();
		}
		$question_list = $this->Mta_evaluation->get_evaluation_questions($BSID);
		if (count($question_list) >= 2)
		{
			echo 'You have added two question!';
			exit();
		}
		$this->Mta_evaluation->create_question(array(
			                                       'BSID'    => $BSID,
			                                       'type'    => $type,
			                                       'content' => $content));
		echo 'success';
		exit();
	}


}
