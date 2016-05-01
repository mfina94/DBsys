<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<header id="header"><h1>Hawk Relief: Disaster</h1></header>
 
<div id="container">
	<div class="row">
		<div class="col-lg-10", id="center">
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
	
	echo form_hidden('cc_id', $cc_id);
	
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
	
	$event = array(
			'name'        => 'event_submit',
			'id'          => 'event_submit',
			'value'       => 'Event Submit',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:100px',
			'class' => 'btn-primary',
	);
	
	echo "<p>";
	echo form_submit($event,'event_page','Event Submit');
	echo "</p>";
	
	echo form_close();
	
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
	</br>
		</div>
	</div>
</div>
</body>
<?php $this->load->view('commonViews/footer.php')?>