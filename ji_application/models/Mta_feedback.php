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
class Mta_feedback extends CI_Model
{
	/**
	 * Mta_feedback constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->library('Feedback_obj');
		$this->load->library('Feedback_reply_obj');
	}
	
	/**
	 * 使用 ID 获取投诉
	 * @param   int $id 投诉 ID
	 * @return  Feedback_obj
	 * @throws  Exception
	 */
	public function get_feedback_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_feedback', array('id' => $id));
		$feedback = new Feedback_obj($query->row(0));
		return $feedback;
	}
	
	/**
	 * 使用 ID 获取投诉回复
	 * @param   int $id 回复 ID
	 * @return  Feedback_reply_obj
	 */
	public function get_feedback_reply_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_feedback_reply', array('id' => $id));
		$reply = new Feedback_reply_obj($query->row(0));
		return $reply;
	}
	
	/**
	 * 显示投诉列表
	 * @param int $user_id
	 * @param int $identity
	 * @param int $state
	 * @return array
	 */
	public function show_list($user_id, $identity, $state = Feedback_obj::STATE_CLOSED)
	{
		switch ($identity)
		{
		case Feedback_obj::STATE_STUDENT:
			$this->db->select('*')->from('ji_ta_feedback')->where('user_id', $user_id)
			         ->order_by('CREATE_TIMESTAMP', 'DESC');
			break;
		case Feedback_obj::STATE_TEACHER:
			$this->load->model('Mteacher');
			$this->load->library('Course_obj');
			$course_list = array();
			foreach ($this->Mteacher->get_now_course($user_id) as $course)
			{
				array_push($course_list, $course->BSID);
			}
			if (count($course_list) == 0)
			{
				return array();
			}
			$this->db->select('*')->from('ji_ta_feedback')->where('state', $state)
			         ->where_in('BSID', $course_list)->order_by('BSID', 'ASC')
			         ->order_by('CREATE_TIMESTAMP', 'DESC');
			break;
		case Feedback_obj::STATE_MANAGE:
			$query = $this->db->get_where('ji_user', array('user_id' => $user_id));
			if ($query->num_rows() != 1)
			{
				return array();
			}
			$this->db->select('*')->from('ji_ta_feedback')->where('state', $state)
			         ->order_by('CREATE_TIMESTAMP', 'DESC');
			break;
		}
		$feedback_list = array();
		foreach ($this->db->get()->result() as $result)
		{
			$feedback = new Feedback_obj($result);
			if (!$feedback->is_error())
			{
				array_push($feedback_list, $feedback);
			}
		}
		return $feedback_list;
	}
	
	/**
	 * 学生创建投诉
	 * @param array $data
	 *              ta_id       => (str)    TA ID
	 *              user_id     => (str)    投诉者 ID
	 *              BSID        => (str)    课程 ID
	 *              topic       => (str)    标题
	 *              content     => (str)    内容
	 *              anonymous   => (bool)   是否匿名
	 * @return int
	 */
	public function create($data)
	{
		$data['title'] = $this->Mta_site->html_base64($data['title']);
		$data['content'] = $this->Mta_site->html_base64($data['content']);
		$reply_data = array(
			'user_id' => $data['user_id'],
			'content' => $data['content'],
			'state'   => Feedback_obj::STATE_CLOSED | Feedback_obj::STATE_NOT_MANAGE |
			             Feedback_obj::STATE_STUDENT);
		$this->db->insert('ji_ta_feedback_reply', $reply_data);
		unset($data['content']);
		$data['reply_list'] = $this->db->insert_id();
		$data['state'] =
			Feedback_obj::STATE_OPEN | Feedback_obj::STATE_NOT_MANAGE | Feedback_obj::STATE_STUDENT;
		$this->db->insert('ji_ta_feedback', $data);
		return $this->db->insert_id();
	}
	
	/**
	 * 关闭投诉
	 * @param int $id
	 * @param int $state
	 * @return bool
	 */
	public function close($id)
	{
		$feedback = $this->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			return false;
		}
		$feedback->set_state(Feedback_obj::STATE_CLOSED,
		                     Feedback_obj::STATE_MANAGE | Feedback_obj::STATE_TEACHER);
		$this->db->update('ji_ta_feedback', array('state' => $feedback->state), array('id' => $id));
		return true;
	}

	/**
	 * 回复投诉
	 * @param int    $id
	 * @param int    $identity
	 * @param int    $user_id
	 * @param string $content
	 * @param bool   $change_flag
	 * @return bool
	 */
	public function reply($id, $identity, $user_id, $content, $change_flag = false)
	{
		/** initialize */
		$feedback = $this->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			return false;
		}
		$reply_data = array(
			'user_id' => $user_id,
			'content' => $this->Mta_site->html_base64($content));

		switch ($identity)
		{
			/** student and teacher can only reply to the manage */
		case Feedback_obj::STATE_STUDENT:
		case Feedback_obj::STATE_TEACHER:
			$reply_data['state'] =
				Feedback_obj::STATE_CLOSED | Feedback_obj::STATE_NOT_MANAGE | $identity;
			$feedback->set_state(Feedback_obj::STATE_OPEN | Feedback_obj::STATE_NOT_MANAGE | 
			                     $identity);
			break;
		case Feedback_obj::STATE_MANAGE:

			if (!$change_flag)
			{
				$reply_data['state'] = Feedback_obj::STATE_OPEN | Feedback_obj::STATE_MANAGE |
				                       $feedback->is_student() ? Feedback_obj::STATE_STUDENT :
					Feedback_obj::STATE_TEACHER;
				$feedback->set_state(Feedback_obj::STATE_CLOSED | Feedback_obj::STATE_MANAGE,
				                     Feedback_obj::STATE_TEACHER);
				break;
			}

			$this->load->model('Mta_mail');
			$reply_data['state'] =
				Feedback_obj::STATE_OPEN | Feedback_obj::STATE_MANAGE | $feedback->is_student() ?
					Feedback_obj::STATE_TEACHER : Feedback_obj::STATE_STUDENT;
			$feedback->set_state(Feedback_obj::STATE_OPEN | Feedback_obj::STATE_MANAGE |
			                     $feedback->is_student() ? Feedback_obj::STATE_TEACHER :
				                     Feedback_obj::STATE_STUDENT);
			$feedback->set_replys(Feedback_obj::STATE_MANAGE);
			if ($feedback->is_student())
			{
				/** set all of student's reply available to teacher */
				foreach ($feedback->replys as $reply)
				{
					/** @var $reply Feedback_reply_obj */
					if ($feedback->is_student($reply->state) && !$feedback->is_open($reply->state))
					{
						$this->db->update('ji_ta_feedback_reply', array(
							'state' => $reply->state | Feedback_obj::STATE_OPEN),
						                  array('id' => $reply->id));
					}
				}
				/** Mail the teacher */
			}
			else
			{
				/** set last of teacher's reply avaiable to student */
				foreach (array_reverse($feedback->replys) as $reply)
				{
					/** @var $reply Feedback_reply_obj */
					if ($feedback->is_teacher($reply->state) &&
					    !$feedback->is_manage($reply->state)
					)
					{
						$this->db->update('ji_ta_feedback_reply', array(
							'state' => $reply->state | Feedback_obj::STATE_OPEN),
						                  array('id' => $reply->id));
						break;
					}
				}
				/** Mail the student */
			}
			break;
		}

		/** finalize */
		$this->db->insert('ji_ta_feedback_reply', $reply_data);
		$feedback->add_reply($this->db->insert_id());
		$data = array(
			'reply_list' => $feedback->reply_list,
			'state'      => $feedback->state);
		$this->db->update('ji_ta_feedback', $data, array('id' => $id));
	}

}