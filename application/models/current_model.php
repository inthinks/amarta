<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Current_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function get_current_detail()
	{
		$q = "SELECT * FROM what_around_office_tb";
		$query = $this->db->query($q);
		return $query->row_array();  
	}
}