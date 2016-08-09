<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Image_item_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_image_item()
	{
		$q = "SELECT a.name as cat_name, b.* FROM image_category_tb a join image_item_tb b where a.id = b.image_category_id order by b.precedence desc";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_image_item_list()
	{
		$q = "SELECT * FROM image_item_tb ORDER BY id DESC";
		$query = $this->db->query($q);
		return $query->result_array();      
	}

	function get_image_gallery0()
	{
		$q = "SELECT a.name, b.* FROM image_category_tb a join image_item_tb b where a.id = b.image_category_id && a.name = 'photos' && b.active = 1 order by b.precedence desc limit 0,4" ;
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	function get_image_gallery1()
	{
		$q = "SELECT a.name as cat_name, b.* FROM image_category_tb a join image_item_tb b where a.id = b.image_category_id && a.name = 'videos' && b.active = 1 order by b.precedence desc limit 0,4";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

	/*function get_image_gallery2()
	{
		$q = "SELECT a.name as cat_name, b.* FROM image_category_tb a join image_item_tb b where a.id = b.image_category_id && a.name = 'constraction progress' && b.active = 1 order by b.precedence desc";
		$query = $this->db->query($q);
		return $query->result_array();  
	}*/

	function get_image_item_detail($id)
	{
		$q = "SELECT * FROM image_item_tb WHERE id = '".$id."' ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}

	function down($id){
		$q="select * from image_item_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from image_item_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from image_item_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		image_item_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		image_item_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}
	
	function up($id){
		$q="select * from image_item_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from image_item_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from image_item_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		
		//echo "from ".$from['id']." precedence ".$from['precedence']." to ".$to['id']." precedence ".$to['precedence'];
		
		
		$sql1 = "update		image_item_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		image_item_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
	}

	//load morre
	function getImage($offset, $limit){
	    $sql = "SELECT a.name, b.* FROM image_category_tb a join image_item_tb b where a.id = b.image_category_id && a.name = 'photos' && b.active = 1 order by b.precedence limit ".$offset." , ".$limit."";
	    $result = $this->db->query($sql)->result_array();
	    return $result;
	}

	function getVideo($off, $lim){
	    $sql = "SELECT a.name as cat_name, b.* FROM image_category_tb a join image_item_tb b where a.id = b.image_category_id && a.name = 'videos' && b.active = 1 order by b.precedence desc limit ".$off." , ".$lim."";
	    $result = $this->db->query($sql)->result_array();
	    return $result;
	}
}