<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->model('user');
		$this->load->view('homepage');
        #asdfasdfasdf
	}
	
	public function new_user() {
		$this->load->view('signup_view');
	}
	
	public function user_login() {
		$this->load->view('login_view');
	}
	
	//calls user function to check username and password in database
	public function verify_password($str)
	{
		if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str) && strlen($str)>5) {
			return TRUE;
		}
		$this->form_validation->set_message('verify_password','Your password must have a length of at least 6, and contain at least one number');
		return false;
	}
	
	public function verify_signup(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[user.username]');
		$this->form_validation->set_message('username','This username has already been taken');
		//check password field
		$this->form_validation->set_rules('password','Password','required|trim|callback_verify_password');
		//$this->form_validation->set_rules('password','Password','required|trim|min_length[6]');
		//check cpassword field and make sure it matches password
		$this->form_validation->set_rules('cpassword','Confirm_Password','required|trim|matches[password]');
		$this->form_validation->set_message('cpassword','Your password does not match');
		//check email field
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		$this->form_validation->set_message('email','Please enter a valid email');
	
		//check if form has valid entries
		if ($this->form_validation->run())
		{
			//generate a random new user key to send as a link
			$link = md5(uniqid());
	
			//set up email address for healtherecords20@gmail.com account
			$config=Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'uigroupfinder',
					'smtp_pass' => 'kill4cyc',
					'mailtype'  => 'html',
					'charset'   => 'iso-8859-1'
			);
			//load email library
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			//set up email to be sent
			$this->email->from('admin@healtherecords.com','Hawk Reliefs Registration');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Confirm your Hawk Reliefs account!');
	
			//set up contents of email message
			$msg="<p>Follow the link to confirm registration: </p>";
			//when user navigates to the link, the user_confirmation function is called
			$msg.="<p><a href='".base_url()."index.php/main/user_confirmation/$link'>Click Here!</a></p>";
			$this->email->message($msg);
	
			//load user model to add new user to temp db table
			$this->load->model('user');
	
			//add user key to temp db
			if ($this->user->add_temp($link))
			{
				//send the email
				if ($this->email->send())
				{
					$this->load->view('email_sent_view');
				}
				else echo 'Email could not be sent.';
			}
			else echo 'User could not be created.';
	
		}
		else //form validation failed
		{
			//reload signup page
			$this->load->view('signup_view');
		}
	}
	
	//user visits confirmation link
	public function user_confirmation($link)
	{
		//load user model
		$this->load->model('user');
	
		//send link to valid_link user function
		if ($this->user->valid_link($link))
		{
			//link is valid, try creating new user
			if($this->user->new_user($link))
			{
				//user created, send to registration completion page to enter info
				//load registration view
				$this->load->view('homepage');
			}
			else echo 'Error creating new user.';
		}
		else echo 'Invalid link.';
	}
}