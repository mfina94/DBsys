<!DOCTYPE html>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href=" <?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
<link href=" <?= base_url();?>bootstrap/css/generic.css" rel="stylesheet">
<script src=" <?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<title>Hawk Relief</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script>

$(document).ready(function(){
	//send post when category dropdown value changes
	$("#city").change(function(){
		$.ajax({
			//run category function of call center controller
			url:"http://[::1]/hawk_relief/index.php/call_center/cc_city_search",
			//set data value of POST to value selected in dropdown box
			data: {city: $(this).val()},
			type: "POST",
			//update table with what is returned
			success: function(data){
				//update results div
				$("#results").html(data);
			}
		});
	});
});


$(document).ready(function(){
	//send post when category dropdown value changes
	$("#state").change(function(){
		$.ajax({
			//run category function of call center controller
			url:"http://[::1]/hawk_relief/index.php/call_center/cc_state_search",
			//set data value of POST to value selected in dropdown box
			data: {state: $(this).val()},
			type: "POST",
			//update table with what is returned
			success: function(data){
				//update results div
				$("#results").html(data);
			}
		});
	});
});


$(document).ready(function(){
	//send post when category dropdown value changes
	$("#type").change(function(){
		$.ajax({
			//run category function of call center controller
			url:"http://[::1]/hawk_relief/index.php/call_center/disaster_search",
			//set data value of POST to value selected in dropdown box
			data: {type: $(this).val()},
			type: "POST",
			//update table with what is returned
			success: function(data){
				//update results div
				$("#results").html(data);
			}
		});
	});
});
</script>

<body>
	<header id="header"><h1>Hawk Relief: Search Centers and Disasters</h1></header>
	<div id="container">
	<div class="col-lg-10", id="center">
		<?php 
			echo "<p>Search call center by city: ";
			echo form_input('city',$this->input->post('city'), 'id="city"');
			echo "</p>";
			echo "<br>";
			echo "<p>Search call center by state: ";
			echo form_input('state',$this->input->post('state'), 'id="state"');
			echo "</p>";
			echo "<br>";
			
			$this->db->distinct();
			$this->db->select('type');
			$query = $this->db->get('disasters');
			
			$search = array(''=>'Select Type');
			foreach ($query->result() as $row){
				$cat = $row->type;
				$search[$cat]= $cat;
			}
			
			echo "<p>Search disaster by type: ";
			
			echo form_dropdown('type', $search,'','id="type"');
			echo "</p>";
			echo "<br>";
		?>
		
		<?php 
					$attributes = array('id'=>'results_form');
					echo form_open('', $attributes);
				?>
				<div id="results"></div>
				<?php echo form_close(); ?>
				
				<?php echo form_close(); 
				
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
				
	</div></div>

</body>