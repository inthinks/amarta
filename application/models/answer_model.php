<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Answer_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_answer($id)
	{
		$q = "SELECT jawaban.*, pertanyaan.id AS no, pertanyaan.question AS quest FROM answer_tb jawaban join question_tb pertanyaan ON pertanyaan.id=jawaban.question_id where jawaban.question_id = '".$id."' ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getTrueAnswer(){
		$q = "SELECT answer FROM answer_tb where correct = 1 ORDER BY precedence DESC";	
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getGameData(){
		$q = "SELECT * FROM game_setting_tb";	
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function get_answerF()
	{
		$q = "SELECT * FROM answer_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_answer_detail($id)
	{
		$q = "SELECT * FROM answer_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function selectOn($id, $parent)
	{
		$q =  "UPDATE answer_tb set correct = 1 WHERE id = '".$id."' AND question_id = '".$parent."'  ";
		$this->db->query($q);
	}

	function selectOff($id, $parent)
	{
		$q =  "UPDATE answer_tb set correct = 0 WHERE correct = 1 AND id != '".$id."' AND question_id = '".$parent."' ";
		$this->db->query($q);
	}

	function down($id, $parent){
		$q="select * from answer_tb where id='".esc($id)."' && question_id='".esc($parent)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query("select id, precedence from answer_tb where id = '".$id."' && question_id = '".$parent."' "));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from answer_tb where precedence < '.$from['precedence'].' && question_id = '.$parent.' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		answer_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		answer_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id, $parent){
		$q="select * from answer_tb where id='".esc($id)."' && question_id='".esc($parent)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query("select id, precedence from answer_tb where id = '".$id."' && question_id = '".$parent."' "));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from answer_tb where precedence > '.$from['precedence'].' && question_id = '.$parent.' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		answer_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		answer_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}