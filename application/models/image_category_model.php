<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Image_category_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_image_category()
	{
		$q = "SELECT * FROM image_category_tb ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_image_categoryF()
	{
		$q = "SELECT * FROM image_category_tb where active=1 ORDER BY precedence ASC ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_image_category_list()
	{
		$q = "SELECT * FROM image_category_tb ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_image_category_detail($id)
	{
		$q = "SELECT * FROM image_category_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from image_category_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from image_category_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from image_category_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		image_category_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		image_category_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from image_category_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from image_category_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from image_category_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		image_category_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		image_category_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}