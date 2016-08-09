<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Forget_password extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	function index()
	{	
		$this->data['content'] = 'content/forget_password';
        $this->data['title'] = 'Forget Password';
		$this->load->view('common/body', $this->data);
	}

	function do_forget_password()
	{
		$username = $this->input->post('username1');
		// echo $username;exit();

		$check = $this->admin_model->check_user($username);
		//$name = $this->admin_model->check_name($username);

		if($username =="")
		{
			$this->session->set_flashdata('notif','Please fill your username!');
            redirect('forget_password');
		}
		else{

			if($check)
			{
				$to_email = $username; 
				$subject = 'Amarta Forget Password';
				$email_content = 
				'Hi, '.$check['email'].'<br/>'.
				'Your password is: '.$check['password'];

				// if($name && $email && $no_telp && $pertanyaan){
				// if($_POST){
				$this->load->library('email');
				$config['protocol'] = "smtp";
				$config['smtp_host'] = "smtp.mandrillapp.com";
				$config['smtp_port'] = "465";
				$config['smtp_user'] = "no-reply@amartaforabetterchange.com";
				$config['smtp_pass'] = "Y52Wa_SjxDbopdtSXqXagg";
				$config['charset'] = "utf-8";
				$config['mailtype'] = "html";
				$config['newline'] = "\r\n";

				$this->email->initialize($config);

				$this->email->from('unilever');
				$this->email->to($to_email);

				$this->email->subject($subject);
				$this->email->message($email_content);
				$this->email->send();
			}
			else{

				$this->session->set_flashdata('notif','Your username is incorrect');
            	redirect('forget_password');
			}
		}
		$this->session->set_flashdata('check', 'Silahkan cek email Anda untuk melihat password');
		redirect('login');
	}

}?>