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
	
	public function verify_event(){
		$this->load->model('callcenter');
		if($this->callcenter->event_submit())
		{
			$this->load->view('request_search');
		}
		else{
			$this->load->view('mainpage');
		}
	}
	
	public function create_event(){
		$this->load->view('events');
	}
	

	public function load_call_center() {
		$id = $this->input->post('id');
		$data['id'] = $id;
		$this->load->view('cc_view', $data);
	}
	
	
	public function request_start() {
		$this->load->view('request_submit_view');
	}
	
	public function request_search() {
		$this->load->view('request_search');
	}
	
	public function disaster_search(){
		$type = $this->input->post('type');
		
		$this->load->model('callcenter');
		$query = $this->callcenter->centers_by_disaster_type($type);
		if ($query){
		
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
		$this->table->set_heading('id', 'City', 'State');
		
			foreach ($query->result() as $row)
			{
				$this->table->add_row($row->cc_id,$row->city,$row->state);
			}
			echo $this->table->generate();
			}
		else echo "<p>No match found for that type of disaster</p>";
		
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
			$this->table->set_heading('Name', 'Description', 'Quantity','Date Requested', 'Donate!');
	
			foreach ($query->result() as $row)
			{
				$this->table->add_row($row->name,
						$row->description,
						$row->quantity,
						$row->date_request,
						'<input id="'.$row->donation_id.'"type="button" value="Donate!" onclick="load_quantity(this)" />');
			}
	
			echo "<h3  style='text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;'>Results from Search</h3></br>".$this->table->generate();
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
			$this->table->set_heading('Name', 'Description', 'Quantity','Date Requested', 'Donate!');
				
			foreach ($query->result() as $row)
			{
				$this->table->add_row($row->name,
						$row->description,
						$row->quantity,
						$row->date_request,
						'<input id="'.$row->donation_id.'"type="button" value="Donate!" onclick="load_quantity(this)" />');
			}
				
			echo "<h3  style='text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;'>Results from Search</h3></br>".$this->table->generate();
		}
		else echo "<p>No match found for that name</p>";
	}
	
	public function cc_city_search() {
		$city = $this->input->post('city');
		
		$this->load->model('callcenter');
		$query = $this->callcenter->centers_by_city($city);
		if ($query)
		{
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			$this->table->set_heading('id', 'City', 'State');
		
			foreach ($query->result() as $row)
			{
				$this->table->add_row($row->cc_id,$row->city,$row->state);
			}
			echo $this->table->generate();
			}
		else echo "<p>No match found for that city</p>";
	}
	
	public function cc_state_search() {
		$city = $this->input->post('state');
	
		$this->load->model('callcenter');
		$query = $this->callcenter->centers_by_state($state);
		if ($query)
		{
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			$this->table->set_heading('id', 'City', 'State');
	
			foreach ($query->result() as $row)
			{
				$this->table->add_row($row->cc_id,$row->city,$row->state);
			}
			echo $this->table->generate();
		}
		else echo "<p>No match found for that state</p>";
	}
}
	
