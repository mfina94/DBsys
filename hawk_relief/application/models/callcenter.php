<?php
 class Callcenter extends CI_Model {
	
 	public function submit_request(){
 		//find user id by username in session, add to request
 		//also need cc_id and item_Category_id, item categories hardcoded for now
 		$temp = array(
 				'name' => $this->input->post('name'),
 				'description' => $this->input->post('description'),
 				'date_request' => date("m/d/Y")
 		);
 		$query = $this->db->insert('donations', $temp);
 		return $query;	
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