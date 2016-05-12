<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends TA_Controller
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
		$data['page_name'] = 'TA Evaluation System: Export to Excel';
		$data['banner_id'] = 5;
		$this->load->view('ta/evaluation/report/export', $data);
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
