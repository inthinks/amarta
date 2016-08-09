<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Banner_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_banner()
	{
		$q = "SELECT * FROM banner_tb ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}
	function get_bannerF()
	{
		$q = "SELECT * FROM banner_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_banner_detail($id)
	{
		$q = "SELECT * FROM banner_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from banner_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from banner_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from banner_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		banner_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		banner_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from banner_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from banner_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from banner_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		banner_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		banner_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}