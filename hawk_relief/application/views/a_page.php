<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<div id="header"><h1> Admin Page </h1></div>
	<div id="mainpage">
		<h2> Do admin things </h2>
		</br>
		<?php 
		//Call_center table need a 'delete' button
		$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
				'table_close' => '</table>');
		$this->table->set_template($table_config);
		$this->table->set_heading('Name', 'City', 'State', 'Delete');
		
		$query=$this->db->get('call_center');
		foreach ($query->result() as $row){
			
			$loadC = array(
					'name'        => 'load_center',
					'id'          => $row->cc_id,
					'value'       => 'Delete Center',
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:110px',
					'class' => 'btn-primary',
			);
			
			
			$this->table->add_row($row->Name, $row->city, $row->state, 
					"<p>".form_open('admin/deleteCC').form_hidden('id', $row->cc_id).form_submit($loadC,'load_center','Delete Center').form_close()."</p>");
		}
		echo $this->table->generate();
		//at the end of the table needs a 'Add' callcenter button
		//leave spaace
		echo "</br>";
		//Disaster table need a 'delete button'
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
		//after the table needs 'ADD' disaster button
		
		
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
	<?php 
	$this->load->view('commonViews/header.php')
	?>
</body>