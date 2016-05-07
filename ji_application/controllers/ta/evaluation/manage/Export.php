<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->Mta_site->redirect_login();

	}
	
	public function index()
	{
		$data['page_name'] = 'TA Evaluation System: Export to Excel';
		$data['type'] = 'manage';
		$data['banner_id'] = 5;
		$this->load->view('ta/evaluation/report/export', $data);
	}
}
