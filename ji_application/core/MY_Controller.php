<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TA_Controller extends CI_Controller
{
	public $site_config;
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
		
		$_SESSION['userid'] = 5060109016;
		$_SESSION['username'] = '隔壁老王';
		
        $this->output->enable_profiler(TRUE);
		
        //全局传递网站设置数据
        $this->load->model('Mta_site');
        $this->site_config = $this->Mta_site->get_site_config();
        $this->load->vars($this->site_config);
		
    }
	
	public function get_site_config($key)
	{
		return $this->site_config[$key];
	}
}