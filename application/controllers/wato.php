<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wato extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false){
			redirect('login');
		}
		$this->load->model('cat_near_model');
	}  

	function index(){
		$this->data['content'] = 'content/wato';
		$this->data['title'] = "What's Around Office";
		$content = 'faq';
		$this->data['cat_near'] = $this->cat_near_model->get_cat_nearF();
		$this->load->view('common/body', $this->data);
	}

	function busRoute(){
		$this->data['content'] = 'content/bus';
		$this->data['title'] = 'Bus Routes';
		$this->load->view('common/body', $this->data);
	}

	function trainRoute(){
		$this->data['content'] = 'content/train';
		$this->data['title'] = 'Train Routes';
		$this->load->view('common/body', $this->data);
	}

	function buswayRoute(){
		$this->data['content'] = 'content/busway';
		$this->data['title'] = 'Busway Routes';
		$this->load->view('common/body', $this->data);
	}	
}