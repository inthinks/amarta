<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Admin_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function login($username, $password){
		$sql = "select * from admin_tb where username = '".$username."' and password = '".$password."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function check_user($username){
		$sql = "select * from user_tb where email = '".$username."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function check_name($username){
		$sql = "select * from credential_tb where username = '".$username."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

}?>