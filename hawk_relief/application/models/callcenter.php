<?php
 class Callcenter extends CI_Model {
	
 	public function submit_request(){
 		//find user id by username in session, add to request
 		//also need cc_id and item_Category_id, item categories hardcoded for now
 		$username = $this->session->userdata('username');
 		
 		$this->db->where('username',$username);
 		$query1 = $this->db->get('user');
 		$row = $query1->row();
 		
 		$temp = array(
 				'name' => $this->input->post('name'),
 				'description' => $this->input->post('description'),
 				'date_request' => date("Y-m-d H:i:s"),
 				'item_category_id' => $this->input->post('category'),
 				'disaster_id' => $this->input->post('disaster_id'),
 				'request_id' => $row->id,
 				'quantity' => $this->input->post('quantity')
 		);
 		$query = $this->db->insert('donations', $temp);
 		return $query;	
 	}
 	
 	public function items_by_name($search){
 		
 		$this->db->from('donations');
 		$this->db->like('name', $search);
 		$query = $this->db->get();
 		return $query;
 	}
 	
 	public function centers_by_city($city){
 		$this->db->from('call_center');
 		$this->db->like('city', $city);
 		$query = $this->db->get();
 		return $query;
 	}
 	
 	public function centers_by_state($state){
 		$this->db->from('call_center');
 		$this->db->like('state', $state);
 		$query = $this->db->get();
 		return $query;
 	}
 	
 	public function centers_by_disaster_type($type){
 		$this->db->from('disasters');
 		$this->db->where('type', $type);
 		$query = $this->db->get();
 		return $query;
 	}
 	
 	public function items_by_category($category){
 		//get category id from cat table
 		$this->db->from('category');
 		$this->db->where('name', $category);
 		$query = $this->db->get();
 		
 		if($query->num_rows() == 1){
 			$row = $query->row();
 			$id = $row->category_id;
 		}
 		else{
 			return false;
 		}
 		
 		$this->db->from('donations');
 		$this->db->where('item_category_id', $id);
 		$query2= $this->db->get();
 		
 		if($query2->num_rows() > 0){
 			return $query2;
 		}
 		else {
 			return false;
 		}
 		
 	}
 	
 	public function event_submit(){
 		$temp = array('type' => $this->input->post('type'),
 					'cc_id'=> $this->input->post('cc_id'),
 					'street_address' => $this->input->post('street_address'),
 					'city' => $this->input->post('city'),
 					'state' => $this->input->post('state'),
 					'zip_code' => $this->input->post('zip_code'),
 					'country' => $this->input->post('country'),
 					'start_date' => $this->input->post('start_date'),
 					'end_date' => $this->input->post('end_date')
 		);
 		
 		$query = $this->db->insert('disasters', $temp);
 		return $query;
 	}
 	
 	public function call_center_sign_up(){
 		
 		
 		$temp = array('Name' => $this->input->post('Name'),
 				'street_address' => $this->input->post('street_address'),
 				'city' => $this->input->post('city'),
 				'state' => $this->input->post('state'),
 				'country' => $this->input->post('country'),
 				'zip_code' => $this->input->post('zipcode'),
 		);
 		
 		$query = $this->db->insert('call_center', $temp);
 		
 		if($query)
 		{
 			return true;
 		}
 		else{
 			return false;
 		}
 	}
 }