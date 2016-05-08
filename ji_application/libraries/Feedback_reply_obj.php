<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Feedback_reply_obj
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Feedback_reply_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_feedback_reply` -- */

	/** @var int    int(11)     回复 ID*/
	protected $id;
	/** @var int    varchar(50) 回复者 ID*/
	protected $user_id;
	/** @var string text        回复内容*/
	protected $content;
	/** @var int    int(4)      回复状态 */
	protected $state;
	/** @var string timestamp   创建时间*/
	protected $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间*/
	protected $UPDATE_TIMESTAMP;

	/**
	 * Feedback_reply_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if(!$this->is_error())
		{
			$this->content = base64_decode($this->content);
		}
	}

	/**
	 * Return whether the object is error
	 * @return bool
	 */
	public function is_error()
	{
		return $this->error_flag;
	}

	/**
	 * @param $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return isset($this->$key) ? $this->$key : NULL;
	}
	
}