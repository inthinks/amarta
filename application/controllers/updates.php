<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Updates extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false){
			redirect('login');
		}
		$this->load->model('update_model');
	}  
   
	function index(){
		$this->data['content'] = 'content/updates';
		$this->data['title'] = 'Updates';
		$this->data['updates'] = $this->update_model->get_updateF();
		$this->data['update'] = $this->update_model->get_updateA();
		$this->load->view('common/body', $this->data);
	}

	function showPopup($id)
	{
		$content='';
		$updateContent = $this->update_model->get_update_detail($id);
		$content.='
			<h2>'.$updateContent['title'].'</h2>
        	<img src="'.base_url('userdata/update/')."/".$updateContent['image'].'">
        	<div class="updatesInfo">
       			<p>'. $updateContent['description'].' </p><br>
        	</div>
        	<a href="javascript:void(0);" class="closeBtn">X</a>';
        echo $content;

	}

	function loadupdate($offset, $limit){
		$this->data['updates'] = $this->update_model->getUpdate($offset, $limit);
		$content = $this->load->view('content/loadupdate',$this->data, TRUE);
		$count = coun('precedence');
		$data['count'] = $count;
      	$data['view'] = $content;
      	$data['offset'] = $offset + 2;
      	$data['offsetprev'] = $offset - 2;
      	echo json_encode($data);
	}

	function loadupdate1($offsetprev, $limit){
		$this->data['updates'] = $this->update_model->getUpdate($offsetprev, $limit);
		$content = $this->load->view('content/loadupdate',$this->data, TRUE);
		$count = coun('precedence');

		$data['count'] = $count;
      	$data['view'] = $content;
      	$data['offset'] = $offsetprev;
      	$data['offsetprev'] = $offsetprev - 2;
      	$data['limit'] = $limit;
      	// pre($data); exit();
      	echo json_encode($data);
	}


}