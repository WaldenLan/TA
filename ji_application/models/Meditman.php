<?php
	class Meditman extends CI_Model{
	
		public function gettime(){
			$res=$this->db->select('obj,data')
				->from('ji_ta_config')
				->where('obj','ta_recruitment_start')
				->or_where('obj','ta_recruitment_end')
				->get();
//			$res=$this->db->get('ji_ta_config');
			return $res->result();
		}
		
		public function searchtime($obj){
			$sql='select * from ji_ta_config where obj = ?';
			$res=$this->db->query($sql,array($obj));
//			$res=$this->db->select('data')
//				->from('ji_ta_config')
//				->where('obj',$obj)
//				->get();
			return $res->result();
		}
		
		public function edittime($data,$obj){
			$bool=$this->db->update('ji_ta_config',$data,array('obj'=>$obj));
			return $bool;
		}
	
		public function getxqxn(){
			$res=$this->db->select('obj,data')
				->from('ji_common_config')
				->where('obj','ji_academic_year')
				->or_where('obj','ji_academic_term')
				->get();
			return $res->result();
		}
		
		
		public function savexqxn($data,$obj){
			$bool=$this->db->update('ji_common_config',$data,array('obj'=>$obj));
			return $bool;
		}
		
		public function getcourseinfo($xq,$xn){
			$sql='SELECT * FROM ji_course_info NATURAL JOIN ji_course_open WHERE xq= ? and xn = ? ';
/*			$res=$this->db->select('*')
				->from('ji_course_info')
				->where('xq',$xq)
				->where('xn',$xn)
				->get();*/
			$res=$this->db->query($sql, array($xq,$xn));
			return $res->result();
		}
		
		public function searchcourseinfo($xq,$xn,$cid){
			$sql='SELECT * FROM ji_course_info NATURAL JOIN ji_course_open WHERE xq= ? and xn = ? and KCDM = ?';
/*			$res=$this->db->select('*')
				->from('ji_course_info')
				->where('xq',$xq)
				->where('xn',$xn)
				->get();*/
			$res=$this->db->query($sql, array($xq,$xn,$cid));
			return $res->result();
		}
		
	}
?>