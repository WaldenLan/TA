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
		$this->load->library('Evaluation_question_obj');
		$this->load->library('Evaluation_answer_obj');
	}
	
	public function get_evaluation_questions($BSID)
	{
		$query = $this->db->get_where('ji_ta_evaluation_question', array('BSID' => $BSID));
		$question_list = array();
		foreach ($query->result() as $row)
		{
			$question = new Evaluation_question_obj($row);
			if (!$question->is_error())
			{
				$question_list[] = $question;
			}
		}
		return $question_list;
	}

	/**
	 * @param array $data
	 */
	public function create_question($data)
	{
		$data['content'] = $this->Mta_site->html_base64($data['content']);
		$this->db->insert('ji_ta_evaluation_question', $data);
	}
	
}