<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_reply_obj
{
	// Table structure for table `ji_ta_feedback_reply`
	public $id;					// int(11) 		回复 ID
	public $user_id;			// varchar(50) 	回复者 ID
	public $content;			// text        	回复内容
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