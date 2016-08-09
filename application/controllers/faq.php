<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Faq extends CI_Controller {

	function __construct(){

		parent::__construct();

		if($this->session->userdata('logged_in')==false){

			redirect('login');

		}

		$this->load->model('contentelement_model');

		$this->load->model('quiz_model');

		$this->load->model('answer_model');

		$this->load->model('general_model');

		$this->load->model('question_model');

		$this->load->model('answer_model');

		$this->load->model('user_model');

		$this->load->model('contact_us_model');

	}



	function index(){	

		$this->data['xx'] = $this->contact_us_model->get_contact_usActive();

		$this->data['desc'] = $this->contact_us_model->get_contact_us_desc();

		$this->data['content'] = 'content/faq';

		$this->data['title'] = 'Contact Us';

		$this->load->view('common/body', $this->data);

	} 



	function showPopup()

	{

		$myscore = $this->quiz_model->getMyscore();

		$myscoreout = $this->quiz_model->getMyScoreOut();

		$content='';

		$lastcontent='';

		$no=1;

		$number = 1;

		$board = $this->quiz_model->getLeaderBoard();



		foreach($myscoreout as $score){

			if($score['sid'] == $myscore['cek']) {

				$lastcontent.=

			 '<li>

                <div class="winner-name"><font color="red">'.$number.'. '.str_replace("@unilever.com", "", $score["email"]).'</font></div>

                <div class="winner-time"><time><font color="red">'.substr($score["time"],3,8).'</font></time></div>

              </li>';

			}

		$number++; }

		



		foreach($board as $list){

			if($myscore['cek'] == $list['qid']){

				$content.=

			 '<li>

                <div class="winner-name"><font color="red">'.$no.'. '.str_replace("@unilever.com", "", $list["email"]).'</font></div>

                <div class="winner-time"><time><font color="red">'.$list["time"].'</font></time></div>

              </li>';

          	} else {

          	$content.='<li>

                <div class="winner-name">'.$no.'. '.str_replace("@unilever.com", "", $list["email"]).'</div>

                <div class="winner-time"><time>'.$list["time"].'</time></div>

                </li>';

          	}

        $no++;}



        foreach($board as $list){

			if($myscore['cek'] == $list['qid']){

				$data['contents'] = $content;

				$data['lastcontent'] = '';

				echo json_encode($data); exit();			

			}

		}

			$data['contents'] = $content;

			$data['lastcontent'] = $lastcontent;

				echo json_encode($data);

	}



	function save($score, $id, $email1=null, $email2=null, $email3=null){

		if (!$this->input->is_ajax_request()) {

			show_404();

		}

		

		// $score = '0018';

		// $id= 224;



		$x = substr_replace('10'.$score,':',-2, 0); 

		$time = substr_replace($x,':',2, 0);

		$parsed = date_parse($time);

		$score = $parsed['minute'] * 60 + $parsed['second'];

		

		$playLimit = $this->answer_model->getGameData();

		if($email1 != ''){

			$score = $score - $playLimit['time_bonus']; 

		}

		if($email2 != ''){

			$score = $score - $playLimit['time_bonus']; 	

		}

		if($email3 != ''){

			$score = $score - $playLimit['time_bonus']; 	

		}



		// echo $score; exit();



		//validasi email lewat db

		/*$emailData = $this->user_model->get_user();

		foreach ($emailData as $list ) {

			$cek = str_replace('@unilever.com', '', $list['email']);

			if($email1 == $cek){

				$score = $score - $playLimit['time_bonus']; 

			}

			if($email2 == $cek){

				$score = $score - $playLimit['time_bonus']; 	

			}

			if($email3 == $cek){

				$score = $score - $playLimit['time_bonus']; 	

			}

		}*/



		

		$minutes = floor(($score / 60) % 60);

		$seconds = $score % 60;



		$times = $minutes.":".$seconds;

		

		$data = array(

				'time_score' => '00:'.$times,

				'user_id' => $this->session->userdata('id'),

				'created_date' => date('Y-m-d H:i:s')

				);

		$this->general_model->update_data('quiz_count_tb', $data, array('id' => $id));





		//Kirim share email  

		$user = $this->quiz_model->getPlayer($id);

		$board = $this->user_model->get_user_detail($user['user_id']); //get user email

		$email = $board['email'];

		$listEmails = array("indra@isysedge.com","hanny@isysedge.com");

		

		if ($email1 != "")

		{

			array_push($listEmails , $email1);

		}

		if ($email2 != "")

		{

			array_push($listEmails , $email2);

		}

		if ($email3 != "")

		{

			array_push($listEmails , $email3);

		}





		

		$to_email = $listEmails; 

		$isi = 'Halo teman-teman,<br>

		Yuk, ikutan kuis Amarta Puzzle di www.amartaforabetterchange.com/activity 
		dan menangkan hadiah voucher belanja dari Unilever!<br>

		Ikutan kuisnya dan share hasilmu ke teman-teman lainnya.<br>


		Semoga beruntung!<br>

		Best regards,<br>


		';

		$subject = 'Quiz Dari Unilever';

		$email_content = $isi. "<br>". str_replace('@unilever.com','',$board['email']);

		

		// if($name && $email && $no_telp && $pertanyaan){

		// if($_POST){

		$this->load->library('email');

		$config['protocol'] = "smtp";

		$config['smtp_host'] = "smtp.mandrillapp.com";

		$config['smtp_port'] = "587";

		$config['smtp_user'] = "no-reply@amartaforabetterchange.com";

		$config['smtp_pass'] = "ePKMR7eIRCBJDY55KkFEEw";

		$config['charset'] = "utf-8";

		$config['mailtype'] = "html";

		$config['newline'] = "\r\n";



		$this->email->initialize($config);



		//$this->email->from($email);

		$this->email->from("no-reply@amartaforabetterchange.com");

		$this->email->to($to_email);



		$this->email->subject($subject);

		$this->email->message($email_content);

		if($this->email->send()){

			echo 'sukses'; exit();

		} //send email 

		else {

			echo 'gagal'; exit();

		}

	}





}  