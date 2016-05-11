<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'teacher';
		$this->Mta_site->redirect_login($this->data['type']);
	}
	
	public function index()
	{
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: TA Report';
		$data['banner_id'] = 4;
		$this->load->view('ta/evaluation/report/teacher', $data);
	}
}
