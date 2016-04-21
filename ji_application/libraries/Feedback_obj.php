<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_obj
{
	// Table structure for table `ji_ta_feedback`
	public $id;					// int(11) 		投诉 ID
	public $ta_id;				// varchar(50) 	TA ID
	public $user_id;			// varchar(50) 	投诉者 ID
	public $course_id;			// varchar(50) 	课程 ID
	public $content;			// text        	投诉内容
	public $anonymous;			// tinyint(1) 	是否匿名
	public $admin_reply_id;		// int(11)      管理员回复 ID
	public $teacher_reply_id;	// int(11)      教师回复 ID
	public $status;				// int(4) 		投诉状态
	public $CREATE_TIMESTAMP;	// timestamp	创建时间
	public $UPDATE_TIMESTAMP;	// timestamp 	更新时间
	
	public function __construct() 
	{
		
	}

	public function set_error()
	{
		$this->id = 0;
	}
	
	
	
	
	
}