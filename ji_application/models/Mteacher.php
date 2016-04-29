<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mteacher extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('Mta_site');
    }
	
	
	public function get_now_course($id)
	{
		$this->load->library('Course_obj');
		$site_config = $this->Mta_site->get_site_config();
		
		$query = $this->db->select('*')->from('ji_course_open')->where(array('USER_ID'=>$id, 'XQ'=>$site_config['ji_academic_term'], 'XN'=>$site_config['ji_academic_year'], 'SCBJ'=>'N'))->get();

		return $query->result('Course_obj');
	}
	
}