<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Activity_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_activity()
	{
		$q = "SELECT * FROM activity_tb ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_activityF()
	{
		$q = "SELECT * FROM activity_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_activity_detail($id)
	{
		$q = "SELECT * FROM activity_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from activity_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from activity_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from activity_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		activity_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		activity_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from activity_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from activity_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from activity_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		activity_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		activity_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}