<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mta_feedback
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mta_site
 * @uses       Evaluation_obj
 * @uses       Evaluation_question_obj
 * @uses       Evaluation_answer_obj
 * @uses       Evaluation_config_obj
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

	public function get_answer_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_evaluation_answer', array('id' => $id));
		$answer = new Evaluation_answer_obj($query->row(0));
		return $answer;
	}

	/**
	 * @param int|string $id
	 * @return Evaluation_config_obj
	 */
	public function get_evaluation_config($id)
	{
		if ($id == 'student' || $id == 'teacher')
		{
			$id = $this->Mta_site->site_config['ta_evaluation_config_' . $id];
		}
		$query = $this->db->get_where('ji_ta_evaluation_config', array('id', $id));
		$config = new Evaluation_config_obj($query->row(0));
		return $config;
	}
	
	/**
	 * @param int    $BSID
	 * @param string $type
	 * @param string $content
	 */
	public function create_question($BSID, $type, $content)
	{
		$data = array(
			'BSID'    => $BSID,
			'type'    => $type,
			'content' => $this->Mta_site->html_base64($content));
		$this->db->insert('ji_ta_evaluation_question', $data);
	}
	
	public function create_answer($BSID, $USER_ID, $TA_ID, $content)
	{
		$data = array(
			'BSID'    => $BSID,
			'USER_ID' => $USER_ID,
			'TA_ID'   => $TA_ID,
			'content' => $this->Mta_site->html_base64(json_encode($content))
		);
		$this->db->insert('ji_ta_evaluation_answer', $data);
	}

	public function get_answer($BSID, $USER_ID, $TA_ID = 0)
	{
		$this->db->select('*')->from('ji_ta_evaluation_answer')
		                  ->where(array(
			                          'BSID'    => $BSID,
			                          'USER_ID' => $USER_ID,));
		if(is_array($TA_ID))
		{
			$this->db->where_in('TA_ID', $TA_ID);
		}
		$answer_list = array();
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$answer = new Evaluation_answer_obj($row);
			if (!$answer->is_error())
			{
				$answer_list[] = $answer;
			}
		}
		return $answer_list;
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
	
	/**
	 * @return int
	 */
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