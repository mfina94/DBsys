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
 	
 	public function call_center_sign_up(){
 		
 		$un = $this->session->userdata('username');
 		
 		$this->db->where('username',$un);
 		$query = $this->db->get('user');
 		
 		if($query->num_rows() == 1)
 		{
 			$row = $query->row();
 			$id = $row->id;
 		}
 		
 		$temp = array('street_address' => $this->input->post('street_address'),
 				'city' => $this->input->post('city'),
 				'state' => $this->input->post('state'),
 				'country' => $this->input->post('country'),
 				'zip_code' => $this->input->post('zipcode'),
 				'operator_id' => $id
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