<?php 
	require "frontend_header.php";
 ?>

	
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Login </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container my-5">

		<div class="row justify-content-center">
			<div class="col-5">
				 <!-- session msg -->
			        <?php if (isset($_SESSION['regsuccess'])) { ?>
			        <div class="alert alert-success" role="alert">
			          <?= $_SESSION['regsuccess'];  ?>
		          		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    			<span aria-hidden="true">&times;</span>
			        </div>
			        <?php } unset($_SESSION['regsuccess']); ?>
			        <!-- end session msg -->

			         <!-- session msg -->
			        <?php if (isset($_SESSION['loginfail'])) { ?>
			        <div class="alert alert-danger" role="alert">
			          <?= $_SESSION['loginfail'];  ?>
		          		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    			<span aria-hidden="true">&times;</span>
			        </div>
			        <?php } unset($_SESSION['loginfail']); ?>
			        <!-- end session msg -->

				<form action="signin.php" method="POST">
		      		<div class="form-group">
		      			<label class="small mb-1" for="inputEmailAddress">Email</label>
		      			<input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" name="email" />
		      		</div>
		      		
		      		<div class="form-group">
		      			<label class="small mb-1" for="inputPassword">Password</label>
		      			<input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" name="password" />
		      		</div>
		      
		      		<div class="form-group">
		          		<div class="custom-control custom-checkbox">
		          			<input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
		          			<label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>


		          		</div>

		          		<a class="small" href="#">Forgot Password?</a>

		      		</div>
		      		
		      		<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
		        		
		        		<button type="submit" class="btn btn-secondary mainfullbtncolor btn-block">Login</button>
		      		</div>


		  		</form>

		  		<div class=" mt-3 text-center ">
		  			<a href="register.php" class="loginLink text-decoration-none">Need an account? Sign Up!</a>
		  		</div>
			</div>
		</div>
		
		
		

	</div>
	


<?php 
	require "frontend_footer.php";
 ?>