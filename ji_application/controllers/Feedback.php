<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Feedback extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->model('Mta_mail');
	}
	
	public function add()
	{
		$this->load->model('Mta_feedback');
		/*$this->Mta_feedback->student_create_feedback
		(
			array
			(
				'ta_id'      =>  1,
				'submit_id'  =>  2,
				'content'    =>  '随便投诉一下',
				'anonymous'  =>  false
			)
		);*/
		
	}
	
	public function check()
	{
		
		
	}
	
	
}


