<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Update_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_update()
	{
		$q = "SELECT * FROM update_tb ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_updateA()
	{
		$q = "SELECT * FROM update_tb where featured = 1";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function get_updateF()
	{
		$q = "SELECT * FROM update_tb where active=1 AND featured=0 ORDER BY precedence DESC limit 0,4";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function set_featuredOn($id)
	{
		$q =  "UPDATE update_tb set featured = 1 WHERE id = '".$id."' ";
		$this->db->query($q);
	}

	function set_featuredOff($id)
	{
		$q =  "UPDATE update_tb set featured = 0 WHERE featured = 1 AND id != '".$id."' ";
		$this->db->query($q);
	}

	function get_update_detail($id)
	{
		$q = "SELECT * FROM update_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from update_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from update_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from update_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		update_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		update_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from update_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from update_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from update_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		update_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		update_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}

	function getUpdate($offset, $limit)
	{
		$q = "SELECT * FROM update_tb where active=1 AND featured=0 ORDER BY precedence DESC limit ".$offset." , ".$limit."";
		$query = $this->db->query($q);
		return $query->result_array();  
	}


}