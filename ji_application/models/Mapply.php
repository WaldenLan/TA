<?php
	class Mapply extends CI_Model{
		
		public function getAll(){
//			$res = $this->db->query("SELECT * FROM testcourse;");
			$res = $this->db->get('testcourse');
			return $res->result();
		}
				
		public function saveapplyinfo($data){
			$bool=$this->db->insert('ji_ta_appinfo',$data);
			return $bool;
		}
		
		public function saveapplyrecord($data){
			$bool=$this->db->insert('ji_ta_apprecord',$data);
			return $bool;
		}
		
		public function showmyapplication($id){
			$sql='SELECT name,student_id,faculty,app_course,self_introduction,comment,email,status FROM ji_ta_appinfo WHERE student_id = ?';
			$res=$this->db->query($sql,array($id));
			return $res->result();
		}
		
		public function deleteappinfo($id,$courseid){
//			$bool=$this->db->delete('ji_ta_appinfo',array('id'=>$id,'app_course'=>$course_id));
			$sql='DELETE FROM ji_ta_appinfo WHERE student_id = ? AND app_course = ?';
			$bool=$this->db->query($sql,array($id,$courseid));
			return $bool;
		}
		
		public function savedeleteinfo($data){
			$bool=$this->db->insert('ji_ta_apprecord',$data);
			return $bool;
		}
		
	}
?>