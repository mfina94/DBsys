<?php
 class User extends CI_Model {
 	
 	public function test(){

 		$temp = array('test_num' => '123');
 		$query = $this->db->insert('test', $temp);
 		if ($query){
 			echo 'test';
 		}
 	}
 }