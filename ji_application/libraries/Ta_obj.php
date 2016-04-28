<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Ta_obj
{
	// Table structure for table `ji_ta_info`
	public $USER_ID;            // varchar(20) 	TA ID
	public $name_ch;            // varchar(20) 	中文名
	public $name_en;            // varchar(20)	英文名
	public $gender;                // char(1) 		性别
	public $faculty;            // varchar(50) 	学院
	public $email;                // varchar(50)  管理员回复 ID
	public $phone;                // varchar(20)  教师回复 ID
	public $qq;                    // varchar(15)	投诉状态
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
	
	
}