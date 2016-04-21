<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<div id="header"><h1><img id="banner" src="<?= base_url();?>bootstrap/images/yellow-gradient-swatches.jpg" alt="logo"></h1></div>


<div id="mainpage">
<h2>Fast and Easy Disaster Relief</h2>


<table class="table table-hover">	
      <thead class="fixedHeader">
			<tr>
				<th>
					#
				</th>
				<th>
					Location
				</th>
				<th>
					Current Status/Event
				</th>
				<th>
					Number of Donations
				</th>
			</tr>
			</thead>
	   <tbody style="display: block;overflow: auto;height: 100px;width: 400px;">
			<tr>
				<td>
					001
				</td>
				<td>
					Denver
				</td>
				<td>
					Flood
				</td>
				<td>
					20
				</td>
			</tr>
		</tbody>
	</table>
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
	
	$request = array(
			'name'        => 'request_start',
			'id'          => 'request_start',
			'value'       => 'Request a Donation!',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:150px',
			'class' => 'btn-primary',
	);
	
	$search = array(
			'name'        => 'request_search',
			'id'          => 'request_search',
			'value'       => 'Search Donations',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:150px',
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
	
	$event = array(
			'name'        => 'event_submit',
			'id'          => 'event_submit',
			'value'       => 'Create Event',
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
	
	echo form_open('call_center/request_start');
	echo "<p>";
	echo form_submit($request, 'request_start', 'Request a Donation!');
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
	
	echo form_open('call_center/create_event');
	echo "<p>";
	echo form_submit($event,'event_submit','Create Event');
	echo "</p>";
	echo form_close();
	?>
	</div>
</body>
<?php $this->load->view('commonViews/footer.php')?>