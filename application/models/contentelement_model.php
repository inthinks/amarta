<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contentelement_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
    function get_all_contentelement($content){
		$q="SELECT * FROM content_element_tb where content = '".esc($content)."'";
		$query = $this->db->query($q);
		return $query->row_array();
	}

	function get_all_contentelement_all(){
		$q="SELECT * FROM content_element_tb";
		$query = $this->db->query($q);
		return $query->result_array();
	}
    
    /*function get_all_contentelement_by_subcontent($subcontent){
		$q="SELECT * FROM content_element_tb WHERE subcontent = '".$subcontent."' order by precedence";
		$query = $this->db->query($q);
		return $query->result_array();
	}*/
    
	function add_contentelement($description,$title,$alias,$picture,$type,$content,$created_by){
		$date = date('Y-m-h H:i:s');
		$q="INSERT INTO content_element_tb (description,title,alias,image,type,active,content,created_date,created_by) VALUES ('".esc($description)."','".esc($title)."','".esc($alias)."','".esc($picture)."','".esc($type)."','1','".$content."','".$date."','".$created_by."')";		
		$this->db->query($q);
	}
    
    function get_contentelement_home($content){
		$q="SELECT *
            FROM content_element_tb 
            WHERE content='".esc($content)."' && active = 1 ";
		$query = $this->db->query($q);
		return $query->row_array();
	}

	function get_contentelement_detail($id){
		$q="SELECT *
            FROM content_element_tb 
            WHERE id='".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();
	}
    
/*    function up_contentelement($id){
		$q="select * from content_element_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from content_element_tb where id = '.$id ));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from content_element_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		$sql1 = "update		content_element_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		content_element_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);	
		
	}
    
	function down_contentelement($id){
		$q="select * from content_element_tb where id='".esc($id)."'";
		
		$query = $this->db->query($q);
		$item= $query->row_array();
		
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from content_element_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from content_element_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		$sql1 = "update		content_element_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		content_element_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);	
		$this->db->query($sql2);
		
	}*/
    
    function active_contentelement($id,$status){
		$q = "update content_element_tb set active = '".esc($status)."' where id = '".esc($id)."'";
		$query = $this->db->query($q);	
	}
    
    function edit_contentelement($id,$title,$alias,$type,$description,$picture,$updated_by){
    	$date = date('Y-m-h H:i:s');
		$q="UPDATE content_element_tb SET image = '".esc($picture)."', type ='".esc($type)."', updated_by ='".esc($updated_by)."', updated_date ='".($date)."', alias ='".esc($alias)."', title ='".esc($title)."', description='".esc($description)."' WHERE id='".esc($id)."'";	
			
		$this->db->query($q);
	}
    
    function delete_contentelement($id){
        $q="DELETE FROM content_element_tb WHERE id ='".esc($id)."'";
        $this->db->query($q);
    }
    
    /*function update_subcontent($id,$subcontent){
        $q = "update content_element_tb set subcontent = '".esc($subcontent)."' where id = '".esc($id)."'";
        $this->db->query($q);
    }*/
}