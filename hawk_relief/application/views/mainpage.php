<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url();?>bootstrap/css/generic.css" rel="stylesheet">
	<script src="<?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Health E-Records</title>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script type="text/javascript">
		function view_call_center(button){
		};
	</script>

</head>

<body>
<div id="header"><h1><img src="<?= base_url();?>bootstrap/images/yellow-gradient-swatches.jpg"></h1></div>
<div id="container">
	<header id="header"><h1>Hawk Relief: Find a Call Center to volunteer at</h1></header>
	
		<div class="col-lg-10", id="center">
		<h3  style='text-align: center; background: yellow; border: solid; border-width: 2px; border-color: black; border-radius: 7px;'>Call centers</h3></br>
	
			<?php 
			
			$login = array(
					'name'        => 'login_submit',
					'id'          => 'login_submit',
					'value'       => 'Profile Page',
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:100px',
					'class' => 'btn-primary',
			);
			
				echo $this->session->flashdata('message');
				echo validation_errors();
				
				$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
				$this->table->set_template($table_config);
				$this->table->set_heading('id', 'City', 'State', 'Go To Page');
				
				$this->db->from('call_center');
				$query = $this->db->get();
				
				foreach ($query->result() as $row) 
				{

					$loadC = array(
							'name'        => 'load_center',
							'id'          => $row->cc_id,
							'value'       => 'View Center',
							'maxlength'   => '100',
							'size'        => '50',
							'style'       => 'width:100px',
							'class' => 'btn-primary',
					);
					
					//echo form_open('call_center/load_call_center');
					$this->table->add_row($row->cc_id, $row->city, $row->state, "<p>".form_open('call_center/load_call_center').form_hidden('id', $row->cc_id).form_submit($loadC,'load_center','View Center').form_close()."</p>");
					//echo form_close();
				}
				
				echo $this->table->generate();

	
	//Buttons to get to profile and donation page

	
	$search = array(
			'name'        => 'request_search',
			'id'          => 'request_search',
			'value'       => 'Search All Donations',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:150px',
			'class' => 'btn-primary',
	);
	
	$search2 = array(
			'name'        => 'request_search',
			'id'          => 'request_search',
			'value'       => 'Search Centers and Disasters',
			'maxlength'   => '300',
			'size'        => '50',
			'style'       => 'width:300px',
			'class' => 'btn-primary',
	);
	
	$logout = array(
			'name'        => 'logout',
			'id'          => 'logout',
			'value'       => 'Logout',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:150px',
			'class' => 'btn-primary',
	);
	
	$admin = array(
			'name'        => 'admin_submit',
			'id'          => 'admin_submit',
			'value'       => 'Admin',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:150px',
			'class' => 'btn-primary',
	);
	
	$un = $this->session->userdata('username');
 		
 	$this->db->where('username',$un);
 	$query = $this->db->get('user');
	
	if($query->num_rows() == 1){
		$row = $query->row();
		
		if($row->role == 'admin')
		{
			echo form_open('admin/a_page');
			echo "<p>";
			echo form_submit($admin, 'admin_submit', 'Admin');
			echo "</p>";
			echo form_close();
		}
	}
	
	echo form_open('call_center/request_search');
	echo "<p>";
	echo form_submit($search, 'request_search', 'Search Donations');
	echo "</p>";
	echo form_close();
	
	echo form_open('main/other_search');
	echo "<p>";
	echo form_submit($search2, 'request_search', 'Search Centers and Disasters');
	echo "</p>";
	echo form_close();
	
	echo form_open('user/profile_page');
	echo "<p>";
	echo form_submit($login,'profile_page','Profile page');
	echo "</p>";
	echo form_close();
	
	echo form_open('main/logout');
	echo "<p>";
	echo form_submit($logout,'logout_submit','Logout');
	echo "</p>";
	echo form_close();
	
	?>
		</div>
	</div>
</body>
<?php $this->load->view('commonViews/footer.php')?>