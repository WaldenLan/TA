<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mta_feedback extends CI_Model {
	
	
	/**
	 * Table structure for table `ji_ta_feedback`
	 *
	 * `id`               int(11)     投诉 ID
	 * `ta_id`            varchar(50) TA ID
	 * `user_id`          varchar(50) 投诉者 ID
	 * `content`          text        投诉内容
	 * `anonymous`        tinyint(1)  是否匿名
	 * `state`            int(4)      投诉状态（取消:-1,申请:0,老师正在处理:1,已处理:2）
	 * `CREATE_TIMESTAMP` timestamp   创建时间
	 * `UPDATE_TIMESTAMP` timestamp   更新时间
	 *
     */
    function __construct()
    {
        parent::__construct();
		$this->load->model('Mta_site');
		$this->load->library('Feedback_obj');
		$this->load->library('Feedback_reply_obj');
    }
	
	public function get_state_str($id)
	{
		switch ($id)
		{
			case 0 : return 'applying to manager';
			case 1 : return 'disposed by manager';
			case 2 : return 'applying to teacher';
			case 3 : return 'disposed by teacher';
			case -1: return 'cancelled';
			default: return 'undefined state';
		}
	}
	
	/**
     * 检查投诉ID是否存在
     * @param   $id   (str) 投诉 ID
     * @return  true/false
     */
	private function examine_feedback_id($id)
	{
		return $id == $this->get_feedback_by_id($id)->id;
	}
	
	/**
     * 使用 ID 获取投诉
     * @param   $id   (str) 投诉 ID
     * @return  Feedback_obj
     */
	public function get_feedback_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_feedback', 'id='.$id);
		if ($query->num_rows() == 1)
		{
			return $query->row(0, 'Feedback_obj');
			
		}
		$feedback = new Feedback_obj();
		$feedback->set_error();
		return $feedback;
	}
	
	/**
     * 使用 ID 获取投诉回复
     * @param   $id   (str) 回复 ID
     * @return  Feedback_reply_obj
     */
	public function get_feedback_reply_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_feedback_reply', 'id='.$id);
		if ($query->num_rows() == 1)
		{
			return $query->row(0, 'Feedback_reply_obj');
			
		}
		$reply= new Feedback_reply_obj();
		$reply->set_error();
		return $reply;
	}
	
	/**
     * 学生创建投诉TA申请
     * @param   $data ta_id       	=> (str)  TA ID
	 *                user_id     	=> (str)  投诉者 ID
	 *                BSID   		=> (str)  课程 ID
	 *                content     	=> (str)  内容
	 *                anonymous   	=> (bool) 是否匿名
     * @return  投诉 ID
     */
	public function student_create_feedback($data)
	{
		$data['title'] = $this->Mta_site->html_base64($data['title']);
		$data['content'] = $this->Mta_site->html_base64($data['content']);
		$this->db->insert('ji_ta_feedback', $data);
		return $this->db->insert_id();
	}
	
	/**
     * 学生修改投诉TA申请
     * @param   $data id          => (str)  投诉 ID
	 *                content     => (str)  内容
	 *                anonymous   => (bool) 是否匿名
     * @return  true/false
     */
	public function student_alter_feedback($data)
	{
		if (!$this->examine_feedback_id($data['id']))
		{
			return false;
		}
		$data['content'] = $this->Mta_site->html_base64($data['content']);
		$this->db->update('ji_ta_feedback', $data, 'id='.$data['id']);
		return true;
	}
	
	/**
     * 学生取消投诉TA申请
     * @param   $id   (str) 投诉 ID
     * @return  true/false
     */
	public function student_cancel_feedback($id)
	{
		if (!$this->examine_feedback_id($id))
		{
			return false;
		}
		$this->db->update('ji_ta_feedback', array('state'=>-1), 'id='.$id);
		return true;
	}
	
	/**
     * 学生显示投诉TA申请列表
     * @param   $student_id   (str) 投诉者 ID
     * @return  array[][]
     */
	public function student_show_feedback_list($student_id)
	{
		$query = $this->db
			->select('*')
			->from('ji_ta_feedback')
			->where('user_id='.$student_id)
			->order_by('UPDATE_TIMESTAMP', 'DESC')
			->get();
		return $query->result('Feedback_obj');
	}
	
	/**
     * 老师显示投诉TA申请列表
     * @param   $teacher_id   (str) 老师 ID
     *          $state   	  (int) 状态（2：未处理 3：已处理）
     * @return  array[][]
     */
	public function teacher_show_feedback_list($teacher_id, $state)
	{
		$this->load->model('Mteacher');
		$this->load->library('Course_obj');
		$course_list = array();
		foreach ($this->Mteacher->get_now_course($teacher_id) as $course)
		{
			array_push($course_list, $course->BSID);
		}
		if (count($course_list) == 0)
		{
			return array();
		}
		
		$query = $this->db
			->select('*')
			->from('ji_ta_feedback')
			->where('state='.$state)
			->where_in('BSID', $course_list)
			->order_by('UPDATE_TIMESTAMP', 'DESC')
			->get();
		return $query->result('Feedback_obj');
	}
	
	/**
     * 管理员或老师查看投诉TA申请
     * @param   $id   (str) 投诉 ID
     * @return  array[][]
     */
	public function check_feedback($id)
	{
		$query = $this->db->get_where('ji_ta_feedback', 'id='.$id);
		return $query->result_array();
	}
	
	/**
     * 管理员处理投诉TA申请
     * @param   $data id          => (str)  投诉 ID
	 				  user_id     => (str)  管理员 ID
	 *                manage      => (bool) 管理员是否可以处理
	 *                content     => (str)  管理员处理意见
     * @return  true/false
     */
	public function manage_add_feedback($data)
	{
		if (!$this->examine_feedback_id($data['id']))
		{
			return false;
		}
		$data['content'] = $this->Mta_site->html_base64($data['content']);
		echo $data['content'];
		$this->load->model('Mta_mail');
		$this->db->insert('ji_ta_feedback_reply', array('user_id'=>$data['user_id'], 'content'=>$data['content']));
				
		if ($data['manage'] == true)
		{
			// 管理员可以处理，回复学生邮件
			$this->db->update('ji_ta_feedback', array('state'=>1, 'manage_reply_id'=>$this->db->insert_id()), 'id='.$data['id']);
			
		}
		else
		{
			// 管理员不能处理，提交给老师处理
			$this->db->update('ji_ta_feedback', array('state'=>2, 'manage_reply_id'=>$this->db->insert_id()), 'id='.$data['id']);
			
		}
	}
	
	/**
     * 老师处理投诉TA申请
     * @param   $data id          => (str)  投诉 ID
	 				  user_id     => (str)  老师 ID
	 *                content     => (str)  老师处理意见
     * @return  true/false
     */
	public function teacher_add_feedback($data)
	{
		if (!$this->examine_feedback_id($data['id']))
		{
			return false;
		}
		$data['content'] = $this->Mta_site->html_base64($data['content']);
		$this->load->model('Mta_mail');
		$this->db->insert('ji_ta_feedback_reply', array('user_id'=>$data['user_id'], 'content'=>$data['content']));
		$this->db->update('ji_ta_feedback', array('state'=>3, 'teacher_reply_id'=>$this->db->insert_id()), 'id='.$data['id']);
	}
	
	
}