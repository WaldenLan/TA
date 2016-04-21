<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_complain');
	}
	
	public function index()
	{
		$data['server_time'] = time();
		$this->load->view('ta/evaluation/student/index', $data);
	}
	/**
     * 学生创建投诉TA申请
     * @param   $data ta_name       => (str)  TA ID
	 *                user_name     => (str)  投诉者 ID
	 *                content     => (str)  内容
	 *                anonymous   => (bool) 是否匿名
     * @return  true/false
     */
	public function complain()
	{
		$comp_data = array(
			'course_name' => $this->input->post('course_name'),
			'ta_name' => $this->input->post('ta_name'),
			'user_name' => $this->$SESSION['user_name'],
			'anonymous' => $this->input->post('anonymous'),
			'content' => $this->input->post('content')
			);
		
		$this->Mta_complain->student_create_complain($data);
		
	}
	public function evaluate()
	{
		$eval_data = array(
			'course_name' => $this->input->post('course_name'),
			'semester' => $this->input->post('semester'),
			'ta_name' => $this->input->post('ta_name')
			
			);
		
		
	}
}
