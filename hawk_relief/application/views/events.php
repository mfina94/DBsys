<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body></body>
<header id="header"><h1>Hawk Relief: Events</h1></header>
 
<div class="">

	<br>
        	<p>Please fill in the necessary info for your request:</p>
        	<p><span class="error">* required field.</span></p>
	<h2>Events Page</h2>

<?php 
// Don't know what to write in the <div >
	$event_submit = array(
			'name'        => 'event_submit',
			'id'          => 'event_submit',
			'value'       => 'Sign up',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:70px',
			'class' => 'btn-primary',
	);
	
	//haven't write in the controllers
	$attributes = array('class' => 'form-group', 'role' => 'form');
	echo form_open('call_center/verify_event', $attributes);
	
	echo validation_errors();
	
	echo "<p> Type: ";
	echo form_input('type',$this->input->post('type'));
	echo "<span> *</span></p>";
	
	echo "<p> Street Address: ";
	echo form_input('street_address',$this->input->post('street_address'));
	echo "<span> *</span></p>";
	
	echo "<p> City: ";
	echo form_input('city',$this->input->post('city'));
	echo "<span> *</span></p>";
	
	echo "<p> State: ";
	echo form_input('state',$this->input->post('state'));
	echo "<span> *</span></p>";
	
	echo "<p> Zip Code: ";
	echo form_input('zip_code',$this->input->post('zip_code'));
	echo "<span> *</span></p>";
	
	echo "<p> Country: ";
	echo form_input('country',$this->input->post('country'));
	echo "<span> *</span></p>";
	
	echo "<p> Start Date: ";
	echo form_input('start_date',$this->input->post('start_date'));
	echo " Please use format YYYY-MM-DD";
	echo "</p>";
	
	echo "<p> End Date: ";
	echo form_input('end_date',$this->input->post('end_date'));
	echo " Please use format YYYY-MM-DD";
	echo "</p>";
	
	echo form_close();
	?>
	
</div>
</body>
<?php $this->load->view('commonViews/footer.php')?>