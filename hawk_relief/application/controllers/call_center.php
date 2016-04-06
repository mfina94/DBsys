<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Call_Center extends CI_Controller
{
	public function __construct() {
		parent::__construct();
	}
	
	public function verify_call_center_signup() {
		
		$this->load->model('callcenter');
		
		if ($this->callcenter->call_center_sign_up())
		{
			
			$this->load->view('mainpage');
		}
		else
		{
			$this->load->view('registration_cc');
		}
	}
	
	public function verify_request(){
		$this->load->model('callcenter');
		
		if ($this->callcenter->submit_request())
		{
			$this->load->view('mainpage');
		}
		else
		{
			$this->load->view('request_submit_view');
		}
	
	}
	
	public function request_start() {
		$this->load->view('request_submit_view');
	}
}
	

