<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<header id="header"><h1>Welcome to Hawk Relief!</h1></header>

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
			'value'       => 'Login',
			'maxlength'   => '100',
			'size'        => '50',
			'style'       => 'width:70px',
			'class' => 'btn-primary',
	);
	echo form_open('user/profile_page');
	echo "<p>";
	echo form_submit($login,'profile_page','Profile page');
	echo "</p>";
	echo form_close();
	?>
	</div>
</body>
<?php $this->load->view('commonViews/footer.php')?>