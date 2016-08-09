<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class About_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_about()
	{
		$q = "SELECT * FROM about_tb ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getActiveabout()
	{
		$q = "SELECT * FROM about_tb where active =1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_aboutActive()
	{
		$q = "SELECT * FROM about_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_about_edit()
	{
		$q = "SELECT pertanyaan.id, pertanyaan.about, jawaban.about_id FROM about_tb pertanyaan join answer_tb jawaban group by id ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_aboutF()
	{
		$q = "SELECT * FROM about_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_about_detail()
	{
		$q = "SELECT * FROM about_tb";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from about_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from about_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from about_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		about_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		about_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from about_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from about_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from about_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		about_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		about_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}