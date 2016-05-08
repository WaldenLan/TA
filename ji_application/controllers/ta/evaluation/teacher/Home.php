<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends TA_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$data['type'] = 'teacher';
		$this->Mta_site->redirect_login($this->data['type']);
	}
	
	public function index()
	{
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: Teacher Homepage';
		$data['banner_id'] = 1;
		$this->load->view('ta/evaluation/homepage', $data);
	}
}
