<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Feedback_obj
 *
 * The operations of ta feedbacks
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mta_feedback
 * @uses       Mcourse
 * @uses       Mta
 * @uses       Feedback_reply_obj
 */
class Evaluation_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_feedback` -- */
	
	/** @var int    int(11)     投诉 ID */
	public $id;
	/** @var int    varchar(50) TA ID */
	public $ta_id;
	/** @var int    varchar(50) 课程 ID */
	public $BSID;
	/** @var int    varchar(50) 问题 */
	public $question;
	/** array(
             array('type'=>xxx, 'content'=>'xxx')
	    )json_encode() */
	/** @var int    varchar(50) 回答 */
	public $answer;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间 */
	public $UPDATE_TIMESTAMP;
	
	/** -- The vars defined for other uses -- */
	/** -- The constants of $state, processed in binary -- */
	
	const STATE_CLOSED        = 0x00;
	const STATE_OPEN          = 0x01;
	const STATE_NOT_MANAGE    = 0x00;
	const STATE_MANAGE        = 0x02;
	const STATE_STUDENT       = 0x00;
	const STATE_TEACHER       = 0x04;
	const STATE_NOT_PROCESSED = 0x00;
	const STATE_PROCESSED     = 0x08;

	/**
	 * Feedback_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if(!$this->is_error())
		{
			$this->question = base64_decode($this->question);
		}
	}

}