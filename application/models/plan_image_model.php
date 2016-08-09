<?php if(!defined('BASEPATH')) exit('Hack attemp?');
class Plan_Image_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_plan_image_detail()
	{
		$q = "SELECT * FROM layout_plan_image_tb ";
		$query = $this->db->query($q);
		return $query->row_array();  
	}
}