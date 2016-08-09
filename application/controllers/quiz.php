<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')==false){
			redirect('login');
		}
		$this->load->model('quiz_model');
		$this->load->model('answer_model');
		$this->load->model('general_model');
		$this->load->model('question_model');
		$this->load->model('answer_model');
		$this->load->model('user_model');
		$playLimit = $this->answer_model->getGameData();
		$counter = $this->quiz_model->getCountPlay($this->session->userdata('id'));
		if($counter >= $playLimit['game_limit']){
			redirect('home');
		}
		// if (!$this->input->is_ajax_request()){
			/*$dummy = array(
					'time_score' => 0,
					'user_id'	=> $this->session->userdata('id')
				);
			$this->general_model->insert_data('quiz_count_tb', $dummy);
			$id = $this->db->insert_id();*/
		// }

	}

	function index(){
		if (!$this->input->is_ajax_request()) {
			$dummy = array(
				'created_date' => date('Y-m-d H:i:s'),
				'time_score' => 0,
				'user_id'	=> $this->session->userdata('id')
			);
			$this->general_model->insert_data('quiz_count_tb', $dummy);
			$id = $this->db->insert_id();
		
		$this->data['content'] = 'content/quiz';
		$this->data['title'] = 'Puzzle Quiz';
		$this->data['id'] = $id;
		$this->data['questions'] = $this->question_model->getActiveQuestion();
		$this->load->view('common/body', $this->data);
		}
	}

	/*function save($score, $id, $email1=null, $email2=null, $email3=null){
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		// $score='0018';
		$x = substr_replace('10'.$score,':',-2, 0); 
		$time = substr_replace($x,':',2, 0);
		$parsed = date_parse($time);
		$score = $parsed['minute'] * 60 + $parsed['second'];
		
		// pre($parsed);
		// echo $id; exit();
		$playLimit = $this->answer_model->getGameData();
		$emailData = $this->user_model->get_user();
		foreach ($emailData as $list ) {
			$cek = str_replace('@amarta.com', '', $list['email']);
			if($email1 == $cek){
				$score = $score - $playLimit['time_bonus']; 
			}
			if($email2 == $cek){
				$score = $score - $playLimit['time_bonus']; 	
			}
			if($email3 == $cek){
				$score = $score - $playLimit['time_bonus']; 	
			}
		}

		// $times = gmdate("i:s", $score);
		$minutes = floor(($score / 60) % 60);
		$seconds = $score % 60;

		$times = $minutes.":".$seconds;
		// echo $playLimit['time_bonus']; exit();
		$data = array(
				'time_score' => '00:'.$times,
				'user_id' => $this->session->userdata('id'),
				);
		$this->general_model->update_data('quiz_count_tb', $data, array('id' => $id));

	}*/


}  