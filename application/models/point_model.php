<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Point_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_point()
	{
		$q = "SELECT poin.*, user.email FROM user_point_tb poin join user_tb user ON poin.user_id=user.id";
		$query = $this->db->query($q);
		return $query->result_array();  
	}

}