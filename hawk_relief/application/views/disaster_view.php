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
				window.location.reload();
			}
	});
};
</script>
<body>
<header id="header"><h1>Welcome to the Disaster Page!</h1></header>
<div class="container">
	<div class="col-lg-10", id="center">
		
		<?php 
		$this->db->where('cc_id', $id);
		$query = $this->db->get('disasters');
		$row = $query->row();
		?>
		<h3  style='text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;'><?php echo $row->type;?> in <?php echo $row->city;?></h3></br>
		</br><p>City: <?php echo $row->city;?></p>
		</br><p>State: <?php echo $row->state;?></p>
		</br><p>Start Date: <?php echo $row->start_date;?></p>
		
		<?php 
		
		$this->db->where('disaster_id', $row->disaster_id);
		$query2 = $this->db->get('donations');
		$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
				'table_close' => '</table>');
		$this->table->set_template($table_config);
		$this->table->set_heading('Name', 'Description', 'Quantity','Date Requested', 'Donate!');
		
		foreach ($query2->result() as $row2)
		{
			$this->table->add_row($row2->name,
					$row2->description,
					$row2->quantity,
					$row2->date_request,
					'<input id="'.$row2->donation_id.'"type="button" value="Donate!" onclick="load_quantity(this)" />');
		}
		
		echo "<h3  style='text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;'>Requests for Disaster</h3></br>".$this->table->generate();
		
		
		$request = array(
			'name'        => 'request_start',
			'id'          => 'request_start',
			'value'       => 'Request a Donation!',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:150px',
			'class' => 'btn-primary',
		);
		
		$homepage = array(
				'name'        => 'homepage',
				'id'          => 'homepage',
				'value'       => 'Back to homepage',
				'maxlength'   => '100',
				'size'        => '50',
				'style'       => 'width:150px',
				'class' => 'btn-primary',
		);
		?>
		
		</br>
		<div id='quantity'></div>
		</br>
		<div id='message'></div>
		</br>
		
		<?php 
		echo form_open('call_center/request_start');
		echo form_hidden('disaster_id', $row->disaster_id);
		echo "<p>";
		echo form_submit($request, 'request_start', 'Request a Donation!');
		echo "</p>";
		echo form_close();
		
				echo form_open('main/index');
				echo "<p>";
				echo form_submit($homepage,'homepage_submit','Back to homepage');
				echo "</p>";
				echo form_close();
		?>
	</div>
</div>
<?php $this->load->view('commonViews/footer.php')?>
</body>