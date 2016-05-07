<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['page_name'] = 'TA Evaluation System: TA Evaluation';
		$data['type'] = 'student';
		$data['banner_id'] = 2;
		$this->load->view('ta/evaluation/evaluation/student', $data);
	}
}
