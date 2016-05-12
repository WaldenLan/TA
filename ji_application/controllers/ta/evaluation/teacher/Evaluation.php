<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$data['type'] = 'teacher';
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mta_evaluation');
	}
	
	public function index()
	{
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: Evaluation Setup';
		$data['banner_id'] = 2;
		$this->load->view('ta/evaluation/evaluation/setup', $data);
	}

	public function add()
	{
		$this->load->model('Mcourse');
		$data = $this->data;
		$BSID = $this->input->get('BSID');
		if (!is_numeric($BSID))
		{
			redirect(base_url('ta/evaluation/teacher/evaluation'));
		}
		$data['course'] = $this->Mcourse->get_course_by_id($BSID);
		if ($data['course']->is_error())
		{
			redirect(base_url('ta/evaluation/teacher/evaluation'));
		}
		$data['course']->set_ta();
		$this->load->view('ta/evaluation/evaluation/setup', $data['course']);
	}

	public function receive()
	{
		$BSID = $this->input->get('BSID');
		if (!$this->Mteacher->is_now_course($_SESSION['userid'],$BSID))
		{
			echo 'error';
			exit();
		}
		$evaluation = $this->Mta_evaluation->get_evaluation_by_id($BSID);
		$content = $this->input->get('content');
		$type = $this->input->get('type');
		if ($type != '0' && $type != '1')
		{
			echo 'error';
			exit();
		}
		if($evaluation->is_error())
		{
			$this->Mta_evaluation->create($BSID,array('type'=>$type, 'content'=>$content));
			echo 'success';
			exit();
		}
		$question = json_decode(base64_decode($evaluation->question));
		if(count($question) >= 2)
		{
			echo 'You have added two question!';
			exit();
		}
		array_push($question,array('type'=>$type, 'content'=>$content));
		$this->Mta_evaluation->modify_question($BSID,$question);
		echo 'success';
		exit();
	}


}
