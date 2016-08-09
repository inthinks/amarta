<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Reach extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false) redirect('login');
		$this->load->model('reach_model');
		$this->load->model('reach_item_model');

	}
  
	function index()
	{	
		$this->data['reach'] = $this->reach_model->get_reachF();
		$this->data['content'] = 'content/reach';
		$this->data['title'] = 'How to Reach';
		$this->load->view('common/body', $this->data);
	} 

	function showPopup($id)
	{
		$content='';
		$updateContent1 = $this->reach_item_model->get_reach_item_detailF1($id);
		$updateContent2 = $this->reach_item_model->get_reach_item_detailF2($id);
		$content.=
		'
			<h2>'.$updateContent1['name'].'</h2>
            <table>
            	'; 
		$content2 = '
            </table>
            <a href="#" class="closeBtn">X</a>';
        echo $content;
        foreach($updateContent2 as $row){ 
         		echo '<tr>
                    <td style="padding-bottom:	20px;width:20%;">'.$row['title'].'</td>
                    <td ">'.$row['text'].'</td>
                </tr>
                '; }
        echo $content2;

	}

}