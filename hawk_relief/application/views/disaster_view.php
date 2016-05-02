<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<header id="header"><h1>Welcome to Call Center Page!</h1></header>
<div class="container">
	<div class="col-lg-10", id="center">
		
		<?php 
		$this->db->where('cc_id', $id);
		$query = $this->db->get('disasters');
		$row = $query->row();
		?>
		<h3  style='text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;'><?php echo $row->type;?> in <?php echo $row->city;?></h3></br>
		</br><p>Address: <?php echo $row->street_address;?></p>
		</br><p>City: <?php echo $row->city;?></p>
		</br><p>State: <?php echo $row->state;?></p>
		</br><p>Start Date: <?php echo $row->start_date;?></p>
		
		<?php 
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
</div>
<?php $this->load->view('commonViews/footer.php')?>
</body>