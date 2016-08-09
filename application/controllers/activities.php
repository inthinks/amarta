<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activities extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false){
			redirect('login');
		}
		$this->load->model('activity_model');
	}

	function index(){
		$this->data['content'] = 'content/activities';
		$this->data['title'] = 'Activities';
		$this->data['activity'] = $this->activity_model->get_activityF();
		$this->load->view('common/body', $this->data);
	}

}  