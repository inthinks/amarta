<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class About extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false) redirect('login');
		$this->load->model('about_model');

	}
  
	function index()
	{	
		$this->data['about'] = $this->about_model->get_about_detail();
		$this->data['content'] = 'content/about';
		$this->data['title'] = 'About';
		$this->load->view('common/body', $this->data);
	} 

	function destroy(){
		$this->session->sess_destroy();
		redirect('login');
	}


}