<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Reach_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_reach()
	{
		$q = "SELECT * FROM how_to_reach_tb ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_reach_list()
	{
		$q = "SELECT * FROM how_to_reach_tb ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_reachF()
	{
		$q = "SELECT * FROM how_to_reach_tb where active=1";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_reach_detail($id)
	{
		$q = "SELECT * FROM how_to_reach_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from how_to_reach_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from how_to_reach_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from how_to_reach_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		how_to_reach_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		how_to_reach_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from how_to_reach_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from how_to_reach_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from how_to_reach_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		how_to_reach_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		how_to_reach_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}