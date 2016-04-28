<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<header id="header"><h1>Welcome to Call Center Page!</h1></header>
<div class="container">
	<div class="col-lg-10", id="center">
	<?php 
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
	
			$this->table->set_heading('Disaster ID','Type','City','State','Delete');
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
				$this->table->add_row($row->disaster_id, $row->type, $row->city, $row->state,
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
