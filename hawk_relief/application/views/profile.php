<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<header id="header"><h1>Welcome to Hawk Relief!</h1></header>

<div id="mainpage">
	<h2>Profile Page</h2>
	<?php 
	$username = $this->session->userdata('username');
	$query = $this->db->get('user');
	$row = $query->row();
	
	echo '<p>First Name: ';
	echo $row->firstname;
	echo '</p>';
	
	echo '<p>Last Name: ';
	echo $row->lastname;
	echo '</p>';
	
	echo '<p>Date of Birth: ';
	echo $row->dob;
	echo '</p>';
	
	echo '<p>Phone: ';
	echo $row->phone;
	echo '</p>';
	
	echo '<p>Role: ';
	echo $row->role;
	echo '</p>';
	
	echo '<p>Zip Code: ';
	echo $row->zipcode;
	echo '</p>';
	
	echo '<p>First Name: ';
	echo $row->firstname;
	echo '</p>';
	?>

</div>

</body>