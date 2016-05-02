<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<div id="header"><h1> Admin Page </h1></div>
	<div id="mainpage">
		<?php 
		//Call_center table need a 'delete' button
		$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
				'table_close' => '</table>');
		$this->table->set_template($table_config);
		$this->table->set_heading('Name', 'City', 'State', 'View','Delete');
		
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
			
			$loadCC = array(
					'name'        => 'load_center',
					'id'          => $row->cc_id,
					'value'       => 'View Center',
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:110px',
					'class' => 'btn-primary',
			);
			
			
			$this->table->add_row($row->Name, $row->city, $row->state, 
					"<p>".form_open('call_center/load_call_center').form_hidden('id', $row->cc_id).form_submit($loadCC,'load_center','View Center').form_close()."</p>",
					"<p>".form_open('admin/deleteCC').form_hidden('id', $row->cc_id).form_submit($loadC,'load_center','Delete Center').form_close()."</p>");
		}?>
		<h3 style="text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;">Manage Call Centers</h3>
		<?php 
		echo $this->table->generate();
		//at the end of the table needs a 'Add' callcenter button
		//leave spaace
		echo "</br>";
		
		$newCC = array(
				'name'        => 'load_center',
				'id'          => $row->cc_id,
				'value'       => 'Add Center',
				'maxlength'   => '100',
				'size'        => '50',
				'style'       => 'width:110px',
				'class' => 'btn-primary',
		);
		
		echo "<p>".form_open('main/new_call_center');
		echo form_submit($newCC,'','');
		echo form_close()."</p>";
		echo "</br>";

		echo "<h3>Assign an operator to a center</h3>";
		$qu = $this->db->get('call_center');
		
		$centers = array(''=>'Select Center');
		echo "<p>".form_open('main/add_operator');
		foreach($qu->result() as $row){
			$centers[$row->cc_id] = $row->Name;
			
		}
		echo form_dropdown('center', $centers, '', 'id="cent"');
		
		$this->db->where('role', "CCOP");
		$q1 = $this->db->get('user');//all operators in q1
		
		$ops = array('' => 'Select Operator');
		foreach($q1->result() as $row1)
		{
			$ops[$row1->id] = $row1->username;		
		}
		$add = array(
				'name'        => 'load_center',
				'id'          => $row->cc_id,
				'value'       => 'Add operator',
				'maxlength'   => '100',
				'size'        => '50',
				'style'       => 'width:150px',
				'class' => 'btn-primary',
		);
		echo form_dropdown('operators', $ops, '', 'id="ops"');
		echo form_submit($add,'','');
		echo form_close();
		echo "</br>";
		
		//Disaster table need a 'delete button'
		$this->table->set_heading('Disaster ID','Type','City','State','View','Delete');
		$query2=$this->db->get('disasters');
		foreach($query2->result() as $row){
			$loadDi = array(
					'name'        => 'load_center',
					'id'          => $row->cc_id,
					'value'       => 'View Disaster',
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:150px',
					'class' => 'btn-primary',
			);
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
					"<p>".form_open('call_center/load_disaster').form_hidden('id', $row->cc_id).form_submit($loadDi,'load_center','View Disaster').form_close()."</p>",
					"<p>".form_open('admin/deleteD').form_hidden('id', $row->disaster_id).form_submit($loadD,'load_center','Delete Disaster').form_close()."</p>");
		}?>
		<h3 style="text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;">Manage Disasters</h3>
		<?php 
		echo "</br>";
		
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