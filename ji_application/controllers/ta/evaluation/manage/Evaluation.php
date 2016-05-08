<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'manage';
		$this->Mta_site->redirect_login($this->data['type']);

	}
	
	public function index()
	{
		$data = $this->data;
		$data['page_name'] = 'TA Evaluation System: TA Evaluation';
		$data['banner_id'] = 2;
		$this->load->view('ta/evaluation/evaluation/manage', $data);
	}
}
