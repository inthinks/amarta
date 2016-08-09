<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Reach_item_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_reach_item()
	{
		$q = "SELECT a.title as name, b.* FROM how_to_reach_tb a join how_to_reach_item_tb b where a.id = b.how_to_reach_id order by b.precedence desc";
		$query = $this->db->query($q);
		return $query->result_array();   
	}

	function get_reach_itemF()
	{
		$q = "SELECT * FROM how_to_reach_item_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_reach_item_list()
	{
		$q = "SELECT * FROM how_to_reach_item_tb ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_reach_item_detailF1($id)
	{
		$q = "SELECT a.title as name, b.* FROM how_to_reach_tb a join how_to_reach_item_tb b WHERE a.active = 1 and a.id = b.how_to_reach_id and a.id = '".$id."' " ;
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function get_reach_item_detailF2($id)
	{
		$q = "SELECT a.title as name, b.* FROM how_to_reach_tb a join how_to_reach_item_tb b WHERE a.active = 1 and b.active = 1 and a.id = b.how_to_reach_id and a.id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_reach_item_detail($id)
	{
		$q = "SELECT * FROM how_to_reach_item_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from how_to_reach_item_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from how_to_reach_item_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from how_to_reach_item_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		how_to_reach_item_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		how_to_reach_item_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from how_to_reach_item_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from how_to_reach_item_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from how_to_reach_item_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		how_to_reach_item_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		how_to_reach_item_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}