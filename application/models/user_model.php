<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class User_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_user()
	{
		$q = "SELECT * FROM user_tb ORDER BY id DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_user_detail($id)
	{
		$q = "SELECT * FROM user_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from user_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from user_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from user_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		user_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		user_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from user_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from user_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from user_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		user_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		user_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}

	function login($email, $password){
		$sql = "select * from user_tb where email = '".$email."' and password = '".$password."' and active = 1 ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
}