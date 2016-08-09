<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false) redirect('login');
		
		$this->load->model('banner_model');
		
		$this->load->model('current_model');
		$this->load->model('filosofi_model');
		  
		
		$this->load->model('near_item_model');
		$this->load->model('plan_image_model');
		$this->load->model('plan_item_model');
		$this->load->model('reach_model');
		$this->load->model('small_banner_model');
	}

	function index()
	{	
		
		$this->data['banner'] = $this->banner_model->get_bannerF();
		$this->data['current'] = $this->current_model->get_current_detail();
		$this->data['filosofi'] = $this->filosofi_model->get_filosofi_detail();
		$this->data['near_item'] = $this->near_item_model->get_near_itemF();
		$this->data['plan_image'] = $this->plan_image_model->get_plan_image_detail();
		$this->data['plan_item'] = $this->plan_item_model->get_plan_itemF();
		$this->data['reach'] = $this->reach_model->get_reach();
		$this->data['small'] = $this->small_banner_model->get_small_bannerF();
		$this->data['content'] = 'content/home';
		$this->data['title'] = 'Home';
		$this->load->view('common/body', $this->data);
	} 
}