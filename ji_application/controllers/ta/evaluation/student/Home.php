<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['server_time'] = date();
		$this->load->view('ta/evaluation/student/index', $data);
	}
}
