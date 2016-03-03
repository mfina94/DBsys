<?php
$this->load->view('commonViews/header');?>

<body>
	<header id="header"><h1>Hawk Relief: New User Info</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-10", id="center">
        <br>
        	<p>Please fill in your information:</p>
			<div id="body">
				<?php 
				$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');
				
				echo form_open('main/complete_registration',$attributes);
				
				echo validation_errors();
				
				echo "<p>First Name: ";
				echo form_input('firstname',$this->input->post('firstname'));
				echo "</p>";
				
				echo "<p>Last Name: ";
				echo form_input('lastname',$this->input->post('lastname'));
				echo "</p>";
				
				echo "<p>Date of Birth: ";
				echo form_input('dob',$this->input->post('dob'));
				echo " Please use format YYYY-MM-DD";
				echo "</p>";
				
				echo "<p>Phone: ";
				echo form_input('phone',$this->input->post('phone'));
				echo " Please use format XXX-XXX-XXXX";
				echo "</p>";
				
				echo "<p>";
				echo form_submit('info_submit', 'Complete Registration!');
				echo "</p>";
				
				echo form_close();
				?>
			</div>
	
			<a href = '<?php 
			echo base_url(),"index.php/main"
			?>'>Back to Login</a><p></p>
		</div>
      </div>
</div>
</body>

<?php $this->load->view('commonViews/footer');?>