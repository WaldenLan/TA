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
		$data['page_name'] = 'TA Evaluation System: Evaluation Setup';
		$data['type'] = 'teacher';
		$data['banner_id'] = 2;
		$this->load->view('ta/evaluation/evaluation/setup', $data);
	}
}
