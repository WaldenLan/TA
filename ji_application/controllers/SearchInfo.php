<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchInfo extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function home(){
		$this->load->model('Meditman');
		$xqxn=$this->Meditman->getxqxn();
		$xq=$xqxn[0]->data;
		$xn=$xqxn[1]->data;
		$list=$this->Meditman->getcourseinfo($xq,$xn);
		var_dump($list);
		$this->load->view('manager_app_header');
		$this->load->view('manager_app_edititem');
	}

	


}
?>