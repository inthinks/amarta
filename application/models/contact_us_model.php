<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Contact_us_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_contact_us()
	{
		$q = "SELECT * FROM contact_us_tb  where precedence >0 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function getActivecontact_us()
	{
		$q = "SELECT * FROM contact_us_tb where active =1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_contact_usActive()
	{
		$q = "SELECT * FROM contact_us_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_contact_us_edit()
	{
		$q = "SELECT pertanyaan.id, pertanyaan.contact_us, jawaban.contact_us_id FROM contact_us_tb pertanyaan join answer_tb jawaban group by id ";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_contact_usF()
	{
		$q = "SELECT * FROM contact_us_tb where active=1 ORDER BY precedence DESC";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_contact_us_detail($id)
	{
		$q = "SELECT * FROM contact_us_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function get_contact_us_desc()
	{
		$q = "SELECT * FROM description_tb";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from contact_us_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from contact_us_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from contact_us_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		contact_us_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		contact_us_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from contact_us_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from contact_us_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from contact_us_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		contact_us_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		contact_us_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
}