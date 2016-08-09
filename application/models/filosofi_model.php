<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Filosofi_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_filosofi_detail()
	{
		$q = "SELECT * FROM filosofi_tb";
		$query = $this->db->query($q);
		return $query->row_array();  
	}
}