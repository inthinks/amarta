<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false){
			redirect('login');
		}
		$this->load->model('image_item_model');
		$this->load->model('image_category_model');
		
	}

	function destroy(){
		$this->session->sess_destroy();
		redirect('login');  
	}

	function index(){
    redirect('gallery/photo');
		/*$this->data['content'] = 'content/gallery';
		$this->data['title'] = 'Gallery';
		$content = 'gallery';
		$this->data['image_cat'] = $this->image_category_model->get_image_categoryF();
		// $this->data['image_item'] = $this->image_item_model->get_image_item();
		$this->data['gallery0'] = $this->image_item_model->get_image_gallery0();
		$this->data['gallery1'] = $this->image_item_model->get_image_gallery1();
		// $this->data['gallery2'] = $this->image_item_model->get_image_gallery2();
		$this->load->view('common/body', $this->data);*/
	}

  function photo(){
    $this->data['content'] = 'content/gallery';
    $this->data['title'] = 'Photos';
    $this->data['image_cat'] = $this->image_category_model->get_image_categoryF();
    $this->load->view('common/body', $this->data);
  }

  function video(){
    $this->data['content'] = 'content/videos';
    $this->data['title'] = 'Photos';
    $this->data['image_cat'] = $this->image_category_model->get_image_categoryF();
    $this->load->view('common/body', $this->data);
  }


    function loadphoto($offset, $limit){
      $limit = $this->input->post('limit');
      $offset = $this->input->post('offset');
      $result  = $this->image_item_model->getImage($offset,$limit);
      $this->data['data'] = $result;  
      $counts = counts('b.name');
      $content = $this->load->view('content/loadmore', $this->data, TRUE);

      $data['count'] = $counts;
      $data['view'] = $content;
      $data['offset'] =$offset +8;
      $data['limit'] =$limit;
      // pre($data); exit();
      echo json_encode($data);
    }

    function loadvideo($off, $lim){
      // $lim = $this->input->post('limit1');
      // $off = $this->input->post('offset1');
      $result  = $this->image_item_model->getVideo($off,$lim);
      $this->data['data'] = $result;  
      $counts = counts('b.name');
      $content = $this->load->view('content/loadmore', $this->data, TRUE);

      $data['count'] = $counts;
      $data['view'] = $content;
      $data['off'] =$off +4;
      $data['lim'] =$lim;
      // pre($data); exit();
      echo json_encode($data);
    }

  function showPopup($id){
    $content='';
    $image = $this->image_item_model->get_image_item_detail($id);
    if(!empty($image['data'])){
      $p =  $image['data'];
      $a = explode("/", $p);
      $b = str_replace('watch?v=','',$a[3]);
      
      $content.='<div class="popup" id="video">
      <iframe width="640" height="360" src="https://www.youtube.com/embed/'.$b.'" frameborder="0" allowfullscreen></iframe>
      </div>
      <a href="javascript:void(0);" class="closeBtn">X</a>';
       } else {
        $content.=
              ' <div class="popup" id="image">
              <img src="'.base_url('userdata/image_item/thumbs')."/".$image['image'].'">
                <div class="popup_gal_name">
                  <h3>'.$image['name'].'</h3>
                </div>
                </div>
                <a href="javascript:void(0);" class="closeBtn">X</a>';    
       }

      echo $content;

  }
}