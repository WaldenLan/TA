<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'manage';
		$this->data['page_name'] = 'TA Evaluation System: TA Evaluation';
		$this->data['banner_id'] = 2;
		$this->Mta_site->redirect_login($this->data['type']);

	}
	
	public function index()
	{
		$data = $this->data;
		$this->load->view('ta/evaluation/evaluation/manage', $data);
	}

	public function settime()
	{
		$start = $this->input->get('start');
		$end = $this->input->get('end');

		if ($start > 0 && strtotime($end) > strtotime($start))
		{

			$this->Mta_site->update_site_config(array('ta_evaluation_start' => $start, 'ta_evaluation_end' => $end));
			echo 'success';
			exit();
		}
		echo lang('ta_evaluation_time_error');
		exit();
	}
}
