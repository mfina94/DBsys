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
	
	echo '<p>Zip Code: ';
	echo $row->zipcode;
	echo '</p>';
	
	echo '<p>First Name: ';
	echo $row->firstname;
	echo '</p>';
	
	//back
	$homepage = array(
			'name'        => 'homepage',
			'id'          => 'homepage',
			'value'       => 'Back to homepage',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:150px',
			'class' => 'btn-primary',
	);
	
	echo form_open('main/index');
	echo "<p>";
	echo form_submit($homepage,'homepage_submit','Back to homepage');
	echo "</p>";
	echo form_close();
	?>

</div>

</body>