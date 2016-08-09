<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Register extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('admin_model');
	}

	function index()
	{	
		$this->data['content'] = 'content/register';
        $this->data['title'] = 'Register';
		$this->load->view('common/body', $this->data);
	}

	function do_register()
	{
		//$name = $this->input->post('name');
		$username = $this->input->post('username');

		if(!$username){
			
            $this->session->set_flashdata('notif','All Filed Required!');
            redirect('register');
        }
        else if(!preg_match('/(^\w+([\.-]*\w+)*@unilever.com$|^$)/',$username))
        {
        	$this->session->set_flashdata('notif','Username must containt @unilever.com');
            redirect('register');
        }
        else{

        	$check = $this->admin_model->check_user($username);
        	if(!$check){
        	$password = rand(111111,999999);
        	// $data=array('surname'=>$name,'username'=>$username,'password'=>$password);
        	// $this->general_model->insert_data('credential_tb',$data);

        	//$password_md5 = md5($password);
        	$data2=array('password'=>$password,'email'=>$username,'active'=>1,'created_date'=>date('Y-m-d H:i:s'));
        	$this->general_model->insert_data('user_tb',$data2);

		
				$to_email = $username; 
				$subject = 'Amarta Register';
				$email_content = 
				'Hi, '.$username.'<br/>'.
				'Your password is: '.$password.

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
				$this->session->set_flashdata('notif','Username Already Used');
            	redirect('register');
			}
		     	
		}
		$this->session->set_flashdata('check', 'Silahkan cek email Anda untuk melihat password');
		redirect('login');
        	// if(!preg_match ("^.+@.+\.((com))$",$username)){
        	// 	$this->session->set_flashdata('notif','Email must containt @unilever.com');
         //    	redirect('register');
        	// }
        
	}



}?>