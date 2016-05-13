<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Evaluation_question_obj
 *
 * The operations of ta feedbacks
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Evaluation_question_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_evaluation_question` -- */

	/** @var int    int(11)     评教问题 ID */
	public $id;
	/** @var int    varchar(50) 课程 ID */
	public $BSID;
	/** @var string varchar(10) 类型(choice/blank) */
	public $type;
	/** @var string TEXT        内容 */
	public $content;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;

	
	/** -- The vars defined for other uses -- */


	/**
	 * Evaluation_question_obj constructor.
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