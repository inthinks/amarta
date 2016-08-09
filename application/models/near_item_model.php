<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Near_Item_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_near_item($category_id)
	{
		$q = "SELECT a.title, b.* FROM category_what_near_tb a 
		join what_near_item_tb b where a.id = b.category_what_near_id and b.category_what_near_id = '".$category_id."' ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_near_itemF()
	{
		$q = "SELECT a.title, b.* FROM category_what_near_tb a 
		join what_near_item_tb b where a.id = b.category_what_near_id ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_near_item_detail($id)
	{
		$q = "SELECT * FROM what_near_item_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from what_neat_item_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from what_neat_item_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from what_neat_item_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		what_neat_item_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		what_neat_item_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from what_neat_item_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from what_neat_item_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from what_neat_item_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		what_neat_item_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		what_neat_item_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}