<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student_obj extends My_obj
{
	// Table structure for table `ji_ta_info`
	public $student_id;
	public $student_name;
	public $student_bh;
	public $student_xnzydm;
	public $student_xnzymc;
	public $student_gbzydm;
	public $student_yx;
	public $student_rxnj;
	public $student_jgdm;
	public $student_xslbdm;
	public $student_xslbmc;
	public $student_xslbmxdm;
	public $student_xslbmxmc;
	public $student_sfzx;

	public function __construct($data = array())
	{
		parent::__construct($data, 'student_id');
	}


}