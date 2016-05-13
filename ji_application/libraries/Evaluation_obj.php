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
 */
class Evaluation_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_feedback` -- */

	/** @var int    varchar(50) 课程 ID */
	public $BSID;
	/** @var string TEXT        问题 */
	public $question;
	/** @var string TEXT        回答 */
	public $evaluation;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间 */
	public $UPDATE_TIMESTAMP;
	
	/** -- The vars defined for other uses -- */


	/**
	 * Feedback_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'BSID');
		if (!$this->is_error())
		{
			$this->question = json_decode(base64_decode($this->question), true);
			$this->evaluation = json_decode(base64_decode($this->evaluation), true);
		}
	}

}