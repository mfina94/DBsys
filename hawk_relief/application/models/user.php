<?php
 class User extends CI_Model {


 	//store sign up data temporarily
 	public function add_temp($link)
 	{
 		//store form data as an array to pass to db
 		$temp = array('username' => $this->input->post('username'),
 				//use md5 hash to store password
 				'password' => md5($this->input->post('password')),
 				'email' => $this->input->post('email'),
 				'link' => $link);
 		//insert data into db
 		$query = $this->db->insert('temp_users',$temp);
 		//check if a problem was encountered trying to insert temp user data
 		if ($query)
 		{
 			return true;
 		}
 		else
 		{
 			return false;
 		}
 	}
 	
 	
 	//check link sent to new user's email
 	public function valid_link($link)
 	{
 		//access temp_users table and look for link value
 		$this->db->where('link',$link);
 		$query = $this->db->get('temp_users');
 	
 		//check if a match was found
 		if ($query->num_rows()==1)
 		{
 			return true;
 		}
 		else return false;
 	}
 	
 	
 	//make a temp user a permanent user
 	public function new_user($link)
 	{
 		//find link value in temp_users table
 		$this->db->where('link',$link);
 		$query = $this->db->get('temp_users');
 	
 		if ($query)
 		{
 			//store row corresponding to link value
 			$row = $query->row();
 			//store row values in array
 			/*$userinfo = array(
 			 'username' => $row->username,
 			 'password' => $row->password,
 			 'email' => $row->email,
 			'role' => $row->role);
 			//insert user from temp_users table into userinfo table
 			$user_added = $this->db->insert('userinfo',$userinfo);*/
 				
 			//save session data in an array
 			$sessiondata = array('username' => $row->username, 'link' => $link, 'is_logged_in' => 1);
 			//create session with session data
 			$this->session->set_userdata($sessiondata);
 			return true;
 		}
 		else return false;
 	}
 }