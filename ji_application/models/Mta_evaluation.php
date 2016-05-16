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

	/**
	 * @param array $data
	 */
	public function create_question($data)
	{
		$data['content'] = $this->Mta_site->html_base64($data['content']);
		$this->db->insert('ji_ta_evaluation_question', $data);
	}

	/**
	 * 检查内容是否符合字数规定
	 * @param $content
	 * @return bool
	 */
	public function examine_content($content)
	{
		return strlen($content) >= $this->Mta_site->site_config['ta_evaluation_content_min'] &&
		       strlen($content) <= $this->Mta_site->site_config['ta_evaluation_content_max'];
	}

	public function get_evaluation_state()
	{
		$start = strtotime($this->Mta_site->site_config['ta_evaluation_start']);
		$end = strtotime($this->Mta_site->site_config['ta_evaluation_end']);
		$now = strtotime(date('Y-m-d'));
		if ($now < $start)
		{
			return -1;
		}
		else if ($now > $end)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}