<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Inspire extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false) redirect('login');
		$this->load->model('inspire_model');
		// $this->load->model('reach_item_model');

	}
  
	function index()
	{	
		$this->data['inspires'] = $this->inspire_model->get_inspireActive();
		$this->data['content'] = 'content/inspire';
		$this->data['title'] = 'Inspiring Design';
		$this->load->view('common/body', $this->data);
	} 

	function destroy(){
		$this->session->sess_destroy();
		redirect('login');
	}


}