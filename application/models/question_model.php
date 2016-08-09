<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Question_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_question()
	{
		$q = "SELECT * FROM question_tb ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getActiveQuestion()
	{
		$q = "SELECT * FROM question_tb where active =1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_questionActive()
	{
		$q = "SELECT * FROM question_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_question_edit()
	{
		$q = "SELECT pertanyaan.id, pertanyaan.question, jawaban.question_id FROM question_tb pertanyaan join answer_tb jawaban group by id ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_questionF()
	{
		$q = "SELECT * FROM question_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_question_detail($id)
	{
		$q = "SELECT * FROM question_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from question_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from question_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from question_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		question_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		question_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from question_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from question_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from question_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		question_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		question_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}