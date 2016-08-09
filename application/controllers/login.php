<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	function index()
	{	
		$this->data['content'] = 'content/login';
        $this->data['title'] = 'Login';
		$this->load->view('common/body', $this->data);
	} 
  
	function do_login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if(!$email || !$password){
            $this->session->set_flashdata('notif','Invalid Username or Password!');
            redirect('login');
        }
        else{
            $login = $this->user_model->login($email, $password);
            if ($login != NULL) {
                $sess_user = array (
                    'logged_in' => true,
                    'id' => $login['id'],
                    'email' => $login['email']
                );
                $this->session->set_userdata($sess_user);
                redirect ('home');
            }
            else {
                $this->session->set_flashdata('notif','Invalid Username or Password');
                redirect('login');
            }
        }
    }

}