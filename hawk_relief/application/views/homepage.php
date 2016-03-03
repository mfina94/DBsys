<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<header id="header"><h1>Welcome to Hawk Relief!</h1></header>
<?php 
	$signup = array(
			'name'        => 'signup_submit',
			'id'          => 'signup_submit',
			'value'       => 'Sign up',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:70px',
			'class' => 'btn-primary',
	);
	
	$login = array(
			'name'        => 'login_submit',
			'id'          => 'login_submit',
			'value'       => 'Sign up',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:70px',
			'class' => 'btn-primary',
			);

	echo form_open('main/new_user');
	echo "<p>";
	echo form_submit($signup, 'signup_submit', 'Sign Up');
	echo "</p>";
	echo form_close();
	
	echo form_open('main/user_login');
	echo "<p>";
	echo form_submit($login, 'login_submit', 'Login');
	echo "</p>";
	echo form_close();
?>
</body>

<?php $this->load->view('commonViews/footer.php')?>