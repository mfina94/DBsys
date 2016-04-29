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

<script type="text/javascript">
//check doc is loaded
$(document).ready(function(){
	//send post when category dropdown value changes
	$("#cat").change(function(){
		$.ajax({
			//run category function of call center controller
			url:"http://[::1]/hawk_relief/index.php/call_center/category_search",
			//set data value of POST to value selected in dropdown box
			data: {category: $(this).val()},
			type: "POST",
			//update table with what is returned
			success: function(data){
				//update results div
				$("#results").html(data);
				$("#quantity").empty();
				$("#message").empty();
			}
		});
	});
});

	$(document).ready(function(){
		//send post when category dropdown value changes
		$("#sea").change(function(){
			$.ajax({
				//run category function of call center controller
				url:"http://[::1]/hawk_relief/index.php/call_center/name_search",
				//set data value of POST to value selected in dropdown box
				data: {search: $(this).val()},
				type: "POST",
				//update table with what is returned
				success: function(data){
					//update results div
					$("#results").html(data);
					$("#quantity").empty();
					$("#message").empty();
				}
			});
		});
	});

	function load_quantity(button)
	{
		$.ajax({
			url:"<?php echo base_url();?>index.php/main/load_quantity",
			data: {id: $(button).attr('id')},
			type: "POST",
			success: function(data){
					$("#quantity").html(data);
					$("#message").empty();
				}
		});

	};

	function update_quantity(button){
		$.ajax({
			url:"<?php echo base_url();?>index.php/main/update_quantity",
			data: {quan:$("#quanquan").val()},
			type: "POST",
			success: function(data){
					$("#quantity").empty();
					$("#message").html(data);
					$('#results').empty();
				}
		});
	}
	</script>
	</head>

	<body>
	<header id="header"><h1>Hawk Relief: Search Donations</h1></header>
	<div id="container">
	<div class="col-lg-10", id="center">
	<?php
	$query = $this->db->get('category');
	$search = array(''=>'Select Cateogry');
	foreach ($query->result() as $row){
		$cat = $row->name;
		$search[$cat]= $cat;
	}
		
	echo "<p>Category: ";
		
	echo form_dropdown('category', $search,'','id="cat"');
	echo "</p>";
	echo "<br>";
		
		
	echo "<p>Search by item name: ";
	echo form_input('search',$this->input->post('search'), 'id="sea"');
	echo "</p>";
		
	?>
				</br>
				<div id='quantity'></div>
				</br>
				<div id='message'></div>
				</br>
				<?php 
					$attributes = array('id'=>'results_form');
					echo form_open('', $attributes);
				?>
				<div id="results"></div>
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
				
				</br>
			</div>
		</div>
		
	</body>        	
	<?php $this->load->view('commonViews/footer.php')?>