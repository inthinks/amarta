<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Quiz_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function getCountPlay($user_id)
	{
		$q = "SELECT COUNT(user_id) AS count FROM quiz_count_tb where user_id ='".$user_id."' "; 
		$query = $this->db->query($q);
		$counter = $query->row_array();  
		return $counter['count'];
	}

	function getLeaderBoard(){
		$q = "SELECT user.email,quiz.user_id,quiz.id AS qid, DATE_FORMAT(quiz.time_score, '%i:%s') as time FROM quiz_count_tb quiz join user_tb user ON user.id = quiz.user_id where SECOND(quiz.time_score) > 0 ORDER BY time_score ASC limit 0,3 "; 
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getMyscore(){
		$q = "SELECT MAX(id) AS cek, user_id from quiz_count_tb"; 
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function getMyscoreOut(){
		$q = "SELECT quiz.id AS sid, quiz.user_id, quiz.time_score AS time, user.* from quiz_count_tb quiz join user_tb user ON user.id = quiz.user_id ORDER BY time_score"; 
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getListScore(){
		$q = "SELECT quiz.created_date AS cdate, user.email,quiz.user_id,quiz.id AS qid, DATE_FORMAT(quiz.time_score, '%i:%s') as time FROM quiz_count_tb quiz join user_tb user ON user.id = quiz.user_id where SECOND(quiz.time_score) > 0 ORDER BY time_score, cdate ASC"; 
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getPlayer($id)
	{
		$q = "SELECT * FROM quiz_count_tb where id ='".$id."' "; 
		$query = $this->db->query($q);
		return $query->row_array();  
		
	}
}