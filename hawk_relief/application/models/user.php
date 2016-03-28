<?php
 class User extends CI_Model {
	
 	public function login()
 	{
 		//find the matching user in the database, as well as check password	
 		$this->db->where('Username',$this->input->post('username'));
		$this->db->where('Password',md5($this->input->post('password')));
		
		//store result of datanase query
		$query = $this->db->get('user');
		
		//if match was found 
		if($query->num_rows()==1)
		{
			//return the matching user
			return $query->result();
		}
		
		//no match was found in DB
		else
		{
			return false;	
		}
 	}
 	 	
 	public function isGeneralUser($link)
 	{
 		$this->db->where('link',$link);
 		$query = $this->db->get('temp_users');
 		
 		if($query->num_rows() == 1)
 		{
 			$row = $query->row();
 			if ($row->role == 'user' || $row->role == 'admin'){
 				return true;
 			}
 			return false;
 		}
 		else
 		{
 			return false;
 		}
 	}
 	
 	//store sign up data temporarily
 	public function add_temp($link)
 	{
 		//store form data as an array to pass to db
 		$temp = array('username' => $this->input->post('username'),
 				//use md5 hash to store password
 				'password' => md5($this->input->post('password')),
 				'email' => $this->input->post('email'),
 				'link' => $link,
 				'role' => $this->input->post('role'),
 				'zipcode' => $this->input->post('zipcode')
 		);
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
 	
 	public function complete_new_user()
 	{
 		$this->db->where('link',$this->session->userdata('link'));
 		$query = $this->db->get('temp_users');
 		
 		if ($query)
 		{
 			//store row corresponding to link value
 			$row = $query->row();
 			//store row values in array
 			$userinfo = array(
 					'username' => $row->username,
 					'password' => $row->password,
 					'email' => $row->email,
 					'role' => $row->role,
 					'zipcode' => $row->zipcode
 			);
 			//insert user from temp_users table into userinfo table
 			$user_added = $this->db->insert('user',$userinfo);
 		}

 		$username = $this->session->userdata("username");
 		//store common form data as an array to pass to userinfo table
 		$temp = array('firstname' => $this->input->post('firstname'),
 				'lastname' => $this->input->post('lastname'),
 				'dob' => $this->input->post('dob'),
 				'phone' => $this->input->post('phone'));
 		//insert data into db
 		$this->db->where('username',$username);
 		$query = $this->db->update('user',$temp);
 		
 		if($query){
 			return true;
 		}
 		else return false;
 	}
 	
 	public function reg_validation()
 	{
 		//load form validation functions
 		$this->load->library('form_validation');
 		$this->form_validation->set_rules('firstname','First Name','required|trim');
 		$this->form_validation->set_rules('lastname','Last Name','required|trim');
 		$this->form_validation->set_rules('dob','Date of Birth','required|trim|regex_match[/^[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
 		$this->form_validation->set_rules('phone','Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
 	
 		if($this->form_validation->run())
 			return true;
 		else return false;
 	
 	}
 }