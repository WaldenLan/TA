<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Course_obj
{
	// Table structure for table `ji_course_open`
	public $USER_ID;            // varchar(20)	用户 ID
	public $BSID;                // varchar(100) 课程编号
	public $XN;                    // varchar(9) 	学年
	public $XQ;                    // int(11) 		学期
	public $KCZWMC;                // varchar(255) 课程中文名称
	public $KCDM;                // varchar(10) 	课程代码
	public $KCJJ;                // varchar(160) 课程简介
	public $XGH;                // varchar(50)      
	public $XM;                    // varchar(50)	教师姓名
	public $SCBJ;                // char(1)		删除标记
	public $CREATE_TIMESTAMP;    // timestamp	创建时间
	public $UPDATE_TIMESTAMP;    // timestamp 	更新时间
	
	public $ta_list;
	
	public function __construct()
	{
		//$this->ta = $this->Mcourse->get_course_ta($this->BSID);
	}
	
	public function set_error()
	{
		$this->BSID = 0;
	}
	
	public function set_ta()
	{
		$CI =& get_instance();
		$CI->load->database();
		
		$query =
			$CI->db->select('USER_ID')->from('ji_course_ta')->where(array('BSID' => $this->BSID, 'SCBJ' => 'N'))->get();
		
		$user_list = array();
		
		foreach ($query->result() as $user)
		{
			array_push($user_list, $user->USER_ID);
		}
		
		if (count($user_list) == 0)
		{
			$this->ta_list = array();
		}
		else
		{
			$query = $CI->db->select('*')->from('ji_ta_info')->where_in('USER_ID', $user_list)->get();
			$this->ta_list = $query->result();
		}
		return $this->ta_list;
	}
	
}