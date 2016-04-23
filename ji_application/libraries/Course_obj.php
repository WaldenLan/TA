<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Course_obj
{
	// Table structure for table `ji_course_open`
	public $USER_ID;			// varchar(20)	用户 ID
	public $BSID;				// varchar(100) 课程编号
	public $XN;					// varchar(9) 	学年
	public $XQ;					// int(11) 		学期
	public $KCZWMC;				// varchar(255) 课程中文名称
	public $KCDM;				// varchar(10) 	课程代码
	public $KCJJ;				// varchar(160) 课程简介
	public $XGH;				// varchar(50)      
	public $XM;					// varchar(50)	教师姓名
	public $SCBJ;				// char(1)		删除标记
	public $CREATE_TIMESTAMP;	// timestamp	创建时间
	public $UPDATE_TIMESTAMP;	// timestamp 	更新时间
	
	public function __construct() 
	{
		
	}

	public function set_error()
	{
		$this->BSID = 0;
	}
	
	
	
	
	
}