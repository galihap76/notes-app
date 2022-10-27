<!doctype html>
<html lang="en">
  <head>
  	<title>Sign In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">

	</head>

	<body>
	<section class="ftco-section">
		<div class="container">
		
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Sign In</h3>

				  <!-- FORM LOGIN -->
				 <form action="<?php echo base_url('auth'); ?>" class="login-form" method="post">

				 <!-- Pesan dalam login-->
					<?php

					// untuk beri pesan jika username tidak valid
					if ($this->session->flashdata('username tidak valid')) {
							echo $this->session->flashdata('username tidak valid');

					// untuk beri pesan jika password tidak valid
					}else if($this->session->flashdata('password tidak valid')){
							echo $this->session->flashdata('password tidak valid');

					// untuk beri pesan jika user berhasil sign up
					}else if ($this->session->flashdata('pesan sukses')) {
							echo $this->session->flashdata('pesan sukses');

					// untuk beri pesan jika password berhasil di perbarui
					}else if ($this->session->flashdata('password baru')) {
							echo $this->session->flashdata('password baru');

					}
					?>

		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Username" name="username" value="<?php echo set_value('username'); ?>"  autocomplete="off" maxlength="15">
						  <?php echo form_error('username', '<div class="text-danger">', '</div>'); ?>
		      		</div>

	            <div class="form-group">
	              <input type="password" class="form-control rounded-left" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" autocomplete="off">
				  <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
	            </div>

	            <div class="form-group d-md-flex">	
					<div class="text-md-right">
						<a href="<?php echo base_url('auth/lupa_password');?>">Lupa Password</a>
					</div>
	            </div>
				<hr>
				<div class="text-center">
					<a href="<?php echo base_url('auth/signup');?>">Sign Up</a>
				</div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>
	</body>
</html>
