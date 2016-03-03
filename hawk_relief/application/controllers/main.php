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
}