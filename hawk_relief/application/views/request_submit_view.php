<?php
$this->load->view('commonViews/header');?>

<body>
	<header id="header"><h1>Hawk Relief: Request a Donation</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-10", id="center">
        <br>
        	<p>Please fill in the necessary info for your request:</p>
        	<p><span class="error">* required field.</span></p>
        	<?php 
        	$request_submit = array(
        			'name'        => 'request_submit',
        			'id'          => 'request_submit',
        			'value'       => 'Sign up',
        			'maxlength'   => '100',
        			'size'        => '50',
        			'style'       => 'width:70px',
        			'class' => 'btn-primary',
        	);
        	
        	$attributes = array('class' => 'form-group', 'role' => 'form');
        	echo form_open('call_center/verify_request', $attributes);
        	
        	echo validation_errors();
        	
        	echo "<p> Name of Request: ";
        	echo form_input('name',$this->input->post('name'));
        	echo "<span> *</span></p>";
        	echo form_hidden('disaster_id', $id);
        	//store dropdown box options as an array
        	//Must change based on db items
        	
        	$query = $this->db->get('category');
			$search = array(''=>'Select Cateogry');
			foreach ($query->result() as $row){
				$search[$row->category_id]= $row->name;
			}
					
			echo "<p>Category: ";
			
			echo form_dropdown('category', $search,'','id="cat"');
			echo "</p>";
        	
			
			echo "<p>Quantity: ";
			echo form_input('quantity',$this->input->post('quantity'));
			echo "</p>";
        	
        	echo "<p> Request Description: <span> *</span></p>";
        	echo form_textarea('description',$this->input->post('description'));
        	
        	echo "<p>";
        	echo form_submit('request_submit', 'Submit Request');
        	echo "</p>";
        	
        	//Need to post the date of the Request
        	echo "<p> Date of the Request: ";
        	echo date("m/d/Y");
        	echo "</p>";
        	//$this->input->post('request_date');
        	
        	echo form_close();
        	?>
        	</div>
        </div>
     </div>
</body>        	
<?php $this->load->view('commonViews/footer.php')?>