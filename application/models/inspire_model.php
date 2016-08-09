<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Inspire_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_inspire()
	{
		$q = "SELECT * FROM inspire_tb ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getActiveinspire()
	{
		$q = "SELECT * FROM inspire_tb where active =1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_inspireActive()
	{
		$q = "SELECT * FROM inspire_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_inspire_edit()
	{
		$q = "SELECT pertanyaan.id, pertanyaan.inspire, jawaban.inspire_id FROM inspire_tb pertanyaan join answer_tb jawaban group by id ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_inspireF()
	{
		$q = "SELECT * FROM inspire_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_inspire_detail($id)
	{
		$q = "SELECT * FROM inspire_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from inspire_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from inspire_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from inspire_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		inspire_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		inspire_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from inspire_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from inspire_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from inspire_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		inspire_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		inspire_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}