<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<header id="header"><h1>Welcome to Call Center Page!</h1></header>
<div class="container">
	<div class="col-lg-10", id="center">
	
	
	
	<!-- CC info -->
	<?php 
		$this->db->where('cc_id', $id);
		$query = $this->db->get('call_center');
		$row = $query->row();
	?>
	<h3  style='text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;'><?php echo $row->Name;?></h3></br>
	</br><p>Address: <?php echo $row->street_address;?></p>
	</br><p>City: <?php echo $row->city;?></p>
	</br><p>State: <?php echo $row->state;?></p>
	
	</br>
	<h3  style='text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;'>Disasters for this center</h3></br>
	<!--  Disasters table -->
	<?php 
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
	
			$this->table->set_heading('Disaster ID','Type','City','State','Zipcode','Occurence of Disaster','Delete');
			$query2=$this->db->get('disasters');
			foreach($query2->result() as $row){
					
				$loadD = array(
						'name'        => 'load_center',
						'id'          => $row->cc_id,
						'value'       => 'Delete Disaster',
						'maxlength'   => '100',
						'size'        => '50',
						'style'       => 'width:150px',
						'class' => 'btn-primary',
				);
				$this->table->add_row($row->disaster_id, $row->type, $row->city, $row->state, $row->zip_code, $row->start_date,
						"<p>".form_open('admin/deleteD').form_hidden('id', $row->disaster_id).form_submit($loadD,'load_center','Delete Disaster').form_close()."</p>");
			}
			echo $this->table->generate();
			
			$homepage = array(
							'name'        => 'homepage',
							'id'          => 'homepage',
							'value'       => 'Back to homepage',
							'maxlength'   => '100',
							'size'        => '50',
							'style'       => 'width:150px',
							'class' => 'btn-primary',
					);
				echo"</br>";
				
				$event = array(
						'name'        => 'event_submit',
						'id'          => 'event_submit',
						'value'       => 'Create Disaster',
						'maxlength'   => '100',
						'size'        => '50',
						'style'       => 'width:150px',
						'class' => 'btn-primary',
				);
				
				echo form_open('call_center/create_event');
				echo form_hidden('cc_id', $id);
				echo "<p>";
				echo form_submit($event,'event_submit','Create Disaster');
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
