<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct() {
		parent::__construct();
	}
	
	public function a_page(){
		$this->load->view('a_page');
	}
	
	public function deleteCC(){
		$this->db->where('cc_id',$this->input->post("id"));
		$query=$this->db->delete("call_center");
		if ($query){
			$this->load->view('a_page');
		} else{
			$this->load->view('mainpage');
		}
	}
	
	public function deleteD(){
		$this->db->where('disaster_id',$this->input->post("id"));
		$query=$this->db->delete("disasters");
		if ($query){
			$this->load->view('a_page');
		} else{
			$this->load->view('mainpage');
		}
	}
}