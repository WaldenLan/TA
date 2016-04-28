<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Feedback_obj
{
	// Table structure for table `ji_ta_feedback`
	public $id;                    // int(11) 		投诉 ID
	public $ta_id;                // varchar(50) 	TA ID
	public $user_id;            // varchar(50) 	投诉者 ID
	public $BSID;                // varchar(50) 	课程 ID
	public $title;                // text			投诉标题
	public $content;            // text        	投诉内容
	public $anonymous;            // tinyint(1) 	是否匿名
	public $manage_reply_id;    // int(11)      管理员回复 ID
	public $teacher_reply_id;    // int(11)      教师回复 ID
	public $state;                // int(4) 		投诉状态
	public $CREATE_TIMESTAMP;    // timestamp	创建时间
	public $UPDATE_TIMESTAMP;    // timestamp 	更新时间
	
	public $ta;
	public $course;
	
	public function __construct()
	{
		
	}
	
	public function set_error()
	{
		$this->id = 0;
	}
	
	public function set_ta()
	{
		$CI =& get_instance();
		$CI->load->model('Mta');
		$this->ta = $CI->Mta->get_ta_by_id($this->ta_id);
		return $this->ta;
	}
	
	public function set_course()
	{
		$CI =& get_instance();
		$CI->load->model('Mcourse');
		$this->course = $CI->Mcourse->get_course_by_id($this->BSID);
		return $this->ta;
	}
	
}