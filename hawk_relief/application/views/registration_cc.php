<?php
$this->load->view('commonViews/header');?>

<body>
	<header id="header"><h1>Hawk Relief: New User Info</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-10", id="center">
        <br>
        	<p>Please fill in your information for Call Center:</p>
        	
        	<?php 
        	$attributes = array('class' => 'form-group', 'role' => 'form');
        	echo form_open('call_center/verify_call_center_signup', $attributes);
        	
        	echo validation_errors();
        	
        	echo "<p> Street Address:";
        	echo form_input('street_address',$this->input->post('street_address'));
        	echo "</p>";
        	
        	echo "<p> City:";
        	echo form_input('city',$this->input->post('city'));
        	echo "</p>";
        	
        	echo "<p> State:";
        	echo form_input('state',$this->input->post('state'));
        	echo "</p>";
        	
        	echo "<p> Zipcode:";
        	echo form_input('zipcode',$this->input->post('zipcode'));
        	echo "</p>";
        	
        	echo "<p> Country:";
        	echo form_input('country',$this->input->post('country'));
        	echo "</p>";
        	
        	echo "<p>";
        	echo form_submit('signup_submit', 'SUBMIT!');
        	echo "</p>";
        	
        	echo form_close();
        	
        	?>
        	
        	<a href = '<?php 
				echo base_url(),"index.php/main"
				?>'>Back to Login</a><p></p>
        </div>
	  </div>
</div>
</body>
<?php $this->load->view('commonViews/footer');?>