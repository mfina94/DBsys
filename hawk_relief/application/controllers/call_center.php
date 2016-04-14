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
	
	public function create_event(){
		$this->load->view('events');
	}
	
	public function verify_event(){
		
	}
	
	public function request_start() {
		$this->load->view('request_submit_view');
	}
	
	public function request_search() {
		$this->load->view('request_search');
	}
	

	//ajax function for search page
	public function category_search(){
		//get category from ajax post
		$category = $this->input->post('category');
	
		$this->load->model('callcenter');
		$query = $this->callcenter->items_by_category($category);
		if ($query){
	
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			$this->table->set_heading('Name', 'Description', 'Quantity','Date Requested');
	
			foreach ($query->result() as $row)
			{
				$this->table->add_row($row->name,
						$row->description,
						$row->quantity,
						$row->date_request);
			}
	
			echo $this->table->generate();
		}
		else echo "<p>No match found for that category</p>";
	}
	
	public function name_search(){
		$search = $this->input->post('search');
	
		$this->load->model('callcenter');
		$query = $this->callcenter->items_by_name($search);
		if ($query)
		{
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			$this->table->set_heading('Name', 'Description', 'Quantity','Date Requested');
				
			foreach ($query->result() as $row)
			{
				$this->table->add_row($row->name,
						$row->description,
						$row->quantity,
						$row->date_request);
			}
				
			echo $this->table->generate();
		}
		else echo "<p>No match found for that name</p>";
	}
}
	

