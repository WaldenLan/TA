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

	/** @var int    int(11)     回复 ID */
	public $id;
	/** @var int    varchar(50) 回复者 ID */
	public $user_id;
	/** @var string text        回复内容 */
	public $content;
	/** @var int    int(4)      回复状态 */
	public $state;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间 */
	public $UPDATE_TIMESTAMP;

	/**
	 * Feedback_reply_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if (!$this->is_error())
		{
			$this->content = base64_decode($this->content);
		}
	}
}