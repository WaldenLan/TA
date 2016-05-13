<?php
	class Meditman extends CI_Model{
	
		public function gettime(){
			$res=$this->db->select('obj,data')
				->from('ji_ta_config')
				->where('obj','ta_recruitment_start')
				->or_where('obj','ta_recruitment_end')
				->get();
			return $res->result();
		}
		
		public function searchtime($obj){
			$sql='select * from ji_ta_config where obj = ?';
			$res=$this->db->query($sql,array($obj));
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
			$sql='SELECT * 
FROM ji_course_info
RIGHT JOIN ji_course_open ON ji_course_info.BSID = ji_course_open.BSID WHERE xq= ? and xn = ? ';
			$res=$this->db->query($sql, array($xq,$xn));
			return $res->result();
		}
		
		public function searchcourseinfo($xq,$xn,$cid){
			if ($xq == 0){
				if ($xn == 0){
					$sql='SELECT * FROM ji_course_info RIGHT JOIN ji_course_open on ji_course_info.BSID = ji_course_open.BSID WHERE ji_course_open.KCDM = ?';
					$res=$this->db->query($sql, array($cid));
				} else {
					$sql='SELECT * FROM ji_course_info RIGHT JOIN ji_course_open on ji_course_info.BSID = ji_course_open.BSID WHERE xn = ? and ji_course_open.KCDM = ?';
					$res=$this->db->query($sql, array($xn,$cid));
				}
			} else {
				if ($xn == 0){
					$sql='SELECT * FROM ji_course_info RIGHT JOIN ji_course_open on ji_course_info.BSID = ji_course_open.BSID WHERE xq = ? and ji_course_open.KCDM = ?';
					$res=$this->db->query($sql, array($xq,$cid));
				} else {
					$sql='SELECT * FROM ji_course_info RIGHT JOIN ji_course_open on ji_course_info.BSID = ji_course_open.BSID WHERE xq = ? and xn = ? and ji_course_open.KCDM = ?';
					$res=$this->db->query($sql, array($xq,$xn,$cid));
				}
			}
			return $res->result();
		}

		public function showstuapp($type,$id){
			if ($type == 0){
				$sql='SELECT * FROM ji_ta_appinfo WHERE student_id = ?';
			} else if ($type == 1){
				$sql='SELECT * FROM ji_ta_appinfo WHERE name = ?';
			} else {
				$sql='SELECT * FROM ji_ta_appinfo WHERE name = ?';
			}
			$res=$this->db->query($sql,array($id));
			return $res->result();
		}
	}
?>