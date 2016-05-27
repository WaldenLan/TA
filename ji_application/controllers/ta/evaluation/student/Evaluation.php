<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'student';
		$this->data['page_name'] = 'TA Evaluation System: TA Evaluation';
		$this->data['banner_id'] = 2;
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mstudent');
		$this->load->model('Mta_evaluation');
		$this->data['state'] = $this->Mta_evaluation->get_evaluation_state();
		
	}
	
	/**
	 * @param int $BSID
	 * Evaluation homepage
	 */
	public function index($BSID = 0)
	{
		if ($BSID == 0)
		{
			redirect(base_url('ta/evaluation/student/evaluation/view'));
		}
		else
		{
			redirect(base_url('ta/evaluation/student/evaluation/evaluate/' . $BSID));
		}
	}
	
	/**
	 * @param int $BSID
	 * @return Course_obj
	 */
	private function validate_course($BSID)
	{
		$this->load->model('Mcourse');
		if (!$this->Mstudent->is_now_course($_SESSION['userid'], $BSID))
		{
			$this->index();
		}
		$course = $this->Mcourse->get_course_by_id($BSID);
		if ($course->is_error())
		{
			$this->index();
		}
		return $course;
	}
	
	public function view()
	{
		$data = $this->data;
		$this->load->library('Course_obj');
		$data['course_list'] = $this->Mstudent->get_now_course($_SESSION['userid']);
		foreach ($data['course_list'] as $course)
		{
			/** @var $course Course_obj */
			$course->set_ta()->set_question()->set_answer();
		}
		$this->load->view('ta/evaluation/evaluation/list', $data);
	}
	
	public function evaluate($BSID)
	{
		$data = $this->data;
		if ($data['state'] != 0)
		{
			$this->index();
		}
		$data['course'] = $this->validate_course($BSID);
		$data['course']->set_answer();
		if (count($data['course']->answer_list) > 0)
		{
			$this->index();
		}
		$data['course']->set_ta()->set_question();
		$default = $this->Mta_evaluation->get_default_question($this->data['type']);
		$data['choice_list'] = $default['choice'];
		$data['blank_list'] = $default['blank'];
		$this->load->view('ta/evaluation/evaluation/evaluation', $data);
	}
	
	public function review($BSID)
	{
		$data = $this->data;
		$data['course'] = $this->validate_course($BSID);
		$data['course']->set_answer();
		if (count($data['course']->answer_list) == 0)
		{
			$this->index();
		}
		$data['course']->set_ta()->set_question();
		$default = $this->Mta_evaluation->get_default_question($data['course']->answer_list[0]->config_id);
		$data['choice_list'] = $default['choice'];
		$data['blank_list'] = $default['blank'];
		$this->load->view('ta/evaluation/evaluation/evaluation', $data);
	}
	
	public function answer()
	{
		$BSID = $this->input->post('BSID');
		$course = $this->validate_course($BSID);
		$course->set_answer();
		if (count($course->answer_list) > 0)
		{
			echo 'You have submitted the answer';
			exit();
		}
		$course->set_question();
		$answer_list = $this->input->post('answer');
		$data = array('choice' => array(), 'blank' => array(), 'addition' => array());
		foreach ($answer_list as $answer)
		{
			if ($answer['num'] <= 0)
			{
				continue;
			}
			switch ($answer['type'])
			{
			case 'choice':
			case 'blank':
			case 'addition':
				$data[$answer['type']][$answer['num']] = $answer['answer'];
			}
		}
		$config = $this->Mta_evaluation->get_evaluation_config($this->data['type']);
		if ($config->is_error())
		{
			echo 'config error';
			exit();
		}
		$config = array(
			'choice'   => $config->choice,
			'blank'    => $config->blank,
			'addition' => count($course->question_list));
		foreach ($config as $key => $value)
		{
			for ($index = 1; $index <= $value; $index++)
			{
				if (!isset($data[$key][$index]))
				{
					echo 'validation error';
					exit();
				}
			}
		}
		$this->Mta_evaluation->create_answer($BSID, $_SESSION['userid'], 0, $this->data['type'], $data);
		echo 'success';
		exit();
	}
}
