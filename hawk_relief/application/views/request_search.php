<?php
$this->load->view('commonViews/header');?>


<body>
	<header id="header"><h1>Hawk Relief: Search Donations</h1></header>
	<div id="container">
		<div class="col-lg-10", id="center">
			<?php 
				echo validation_errors();
				
				$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
				$this->table->set_template($table_config);
				$this->table->set_heading('Name', 'Description', 'Date Requested');
				
				$this->db->from('donations');
				$query = $this->db->get();
				
				foreach ($query->result() as $row) 
				{
					$this->table->add_row($row->name, $row->description, $row->date_request);
				}
				
				echo $this->table->generate();
			?>
		</div>
	</div>
	
</body>        	
<?php $this->load->view('commonViews/footer.php')?>