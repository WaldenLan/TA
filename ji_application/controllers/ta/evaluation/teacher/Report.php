<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['page_name'] = 'TA Evaluation System: TA Report';
		$data['type'] = 'teacher';
		$data['banner_id'] = 4;
		$this->load->view('ta/evaluation/report/teacher', $data);
	}
}
