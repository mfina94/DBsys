<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commonViews/header.php')
?>
<body>
<header id="header"><h1>Welcome to Call Center Page!</h1></header>
<div class="container">
	<div class="col-lg-10", id="center">
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
				echo "<p>".$id."</p>";
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
