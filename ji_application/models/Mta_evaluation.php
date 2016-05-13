<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mta_feedback
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mta_site
 * @uses       Feedback_obj
 * @uses       Feedback_reply_obj
 */
class Mta_evaluation extends CI_Model
{
	/**
	 * Mta_evaluation constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->library('Evaluation_obj');
	}

	/**
	 * 从评价ID获得评价
	 * @param int $BSID
	 * @return Evaluation_obj
	 */
	public function get_evaluation_by_id($BSID)
	{
		$query = $this->db->get_where('ji_ta_evaluation', array('BSID' => $BSID));
		$evaluation = new Evaluation_obj($query->row(0));
		return $evaluation;
	}


	/**
	 * @param int   $BSID
	 * @param array $question
	 */
	public function create($BSID, $question = array())
	{
		if ($question != array())
		{
			$question = array($question);
		}
		$question = $this->Mta_site->html_base64(json_encode($question));
		$this->db->insert('ji_ta_evaluation', array(
			'BSID'     => $BSID,
			'question' => $question
		));
	}

	public function modify_question($BSID, $question)
	{
		$question = $this->Mta_site->html_base64(json_encode($question));
		$this->db->update('ji_ta_evaluation', array('question' => $question), array('BSID' => $BSID));
	}
}