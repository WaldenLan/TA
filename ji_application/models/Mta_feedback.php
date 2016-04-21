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
	 * `status`           int(4)      投诉状态（取消:-1,申请:0,老师正在处理:1,已处理:2）
	 * `CREATE_TIMESTAMP` timestamp   创建时间
	 * `UPDATE_TIMESTAMP` timestamp   更新时间
	 *
     */
    function __construct()
    {
        parent::__construct();
		$this->load->model('Mta_site');
    }
	
	/**
     * 检查投诉ID是否存在
     * @param   $id   (str) 投诉 ID
     * @return  true/false
     */
	private function examine_feedback_id($id)
	{
		$query = $this->db->get_where('ji_ta_feedback', 'id='.$id);
		if ($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
     * 学生创建投诉TA申请
     * @param   $data ta_id       => (str)  TA ID
	 *                user_id     => (str)  投诉者 ID
	 *                content     => (str)  内容
	 *                anonymous   => (bool) 是否匿名
     * @return  true/false
     */
	public function student_create_feedback($data)
	{
		$data['content'] = $this->Mta_site->html_purify($data['content']);
		$this->db->insert('ji_ta_feedback', $data);
		return true;
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
		$data['content'] = $this->Mta_site->html_purify($data['content']);
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
		$this->db->update('ji_ta_feedback', array('status'=>-1), 'id='.$id);
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
			->where('submit_id='.$student_id)
			->order_by('UPDATE_TIMESTAMP', 'DESC')
			->get();
		return $query->result_array();
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
	 *                manage      => (bool) 管理员是否可以处理
	 *                content     => (str)  管理员处理意见
     * @return  true/false
     */
	public function admin_manage_feedback($data)
	{
		if (!$this->examine_feedback_id($data['id']))
		{
			return false;
		}
		$data['content'] = $this->Mta_site->html_purify($data['content']);
		$this->load->model('Mta_mail');
		if ($data['manage'] == true)
		{
			// 管理员可以处理，回复学生邮件
			$this->db->update('ji_ta_feedback', array('status'=>1, 'admin_reply'=>$data['content']), 'id='.$data['id']);
		}
		else
		{
			// 管理员不能处理，提交给老师处理
			$this->db->update('ji_ta_feedback', array('status'=>2, 'admin_reply'=>$data['content']), 'id='.$data['id']);
		}
	}
	
	/**
     * 老师处理投诉TA申请
     * @param   $data id          => (str)  投诉 ID
	 *                content     => (str)  老师处理意见
     * @return  true/false
     */
	public function teacher_manage_feedback($data)
	{
		if (!$this->examine_feedback_id($data['id']))
		{
			return false;
		}
		$data['content'] = $this->Mta_site->html_purify($data['content']);
		$this->load->model('Mta_mail');
		$this->db->update('ji_ta_feedback', array('status'=>3, 'teacher_reply'=>$data['content']), 'id='.$data['id']);
	}
	
	
}