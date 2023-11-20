<?php
session_start();
include("include/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Ranau Groceries</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />    
    <link rel="stylesheet" type="text/css" href="css/styles.css">
	<link href="css/cust-style.css" rel="stylesheet" />
	<style>
		a{
			color: white;
			text-decoration: none;
		}
	</style>
	
</head>
<body> 

	<div class="container">
	<!-- Top box -->
		<!-- Logo & Site Name -->
		<div class="placeholder">
			<div class="parallax-window" data-parallax="scroll" data-image-src="img/header.jpg">
				<div class="tm-header">
					<div class="row tm-header-inner">
						<div class="col-md-6 col-12">
							
							<div class="tm-site-text-box">
								<h1 class="tm-site-title">Centralized </h1>
								<h6 class="tm-site-description">Online Grocery Shopping in Ranau</h6>
							</div>
						</div>
						<nav class="col-md-6 col-12 tm-nav">
							<ul class="tm-nav-ul">
								<li class="tm-nav-li"><a href="index.php" class="tm-nav-link">Home</a></li>
				                <li class="tm-nav-li"><a href="#" class="tm-nav-link">Orders</a></li>
				                <li class="tm-nav-li"><a href="cart.php" class="tm-nav-link">Cart</a></li>
				                <?php 
				                if(isset($_SESSION['cust_id']))
				                {
				                  ?>
				                  <li class="tm-nav-li"><a href="logout.php" class="tm-nav-link">Logout</a></li>
				                  <li class="tm-nav-li"><a href="cust_profile.php" class="tm-nav-link">Profile</a></li>
				                  <?php
				                }else {
				                  ?>
				                  <li class="tm-nav-li"><a href="cust_login.php" class="tm-nav-link active">Login</a></li>

				                  <?php
				                }
				                  
				                 ?>
								
				                 <li class="nav-li"><a href="review.php" class="nav-link">Review</a></li>
							</ul>
						</nav>	
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row tm-welcome-section">
				
			</header>
		
			<h1 class="col-12 text-center tm-section-title"><b>Register Form</b></h1>

			<form  method="post" action="cust_reg.php">
			  
			  <div class="container-form">
			  	<label for="uname"><b>Name</b></label>
			    <input type="text" placeholder="Enter Full Name" name="cust_name" required>

			    <label for="uname"><b>Email</b></label>
			    <input type="text" placeholder="Enter Email" name="cust_email" required>

			    <label for="uname"><b>Username</b></label>
			    <input type="text" placeholder="Enter Username" name="cust_username" required>

			    <label for="psw"><b>Password</b></label>
			    <input type="password" placeholder="Enter Password" name="cust_pwd" required>

			    <label for="contactNo"><b>Contact No</b></label>
			    <input type="text" placeholder="Enter Contact Number" name="cust_no" required>

			    <label for="contactAddr"><b>Address</b></label>
			    <input type="text" placeholder="Enter Address" name="cust_address" required>
				<br><br><br>

			    <button type="submit" name ="reg_cust" class="button-reg">Register</button>


			    <button type="button" class="button-login">Already have an account? Login</button>


			    <a href="seller_login.php">Seller</a>
			    
			  </div>
		
		<?php

			if(isset($_POST['reg_cust']))
			{
				$custName = $_POST['cust_name'];
				$custEmail = $_POST['cust_email'];
				$custUname = $_POST['cust_username'];
				$custPwd = $_POST['cust_pwd'];
				$custNo = $_POST['cust_no'];
				$custAddr = $_POST['cust_address'];

				$user_check_query = "SELECT * FROM customer WHERE cust_username='$custUname' OR cust_email='$custEmail' LIMIT 1";
  				$result = mysqli_query($conn, $user_check_query);
  				$user = mysqli_fetch_assoc($result);
	 			
	 			if(mysqli_num_rows($result) ==1)
	 			{
	 				echo "<p><b>Error:</b> Customer Exist, cannot register</p>";
	 			} else {

	 				//This below line is a code to Send form entries to database

		        	$sql = "INSERT INTO customer (cust_id, cust_name, cust_email, cust_username, cust_pwd, cust_no, cust_address) VALUES ('', '$custName', '$custEmail','$custUname','$custPwd', '$custNo', '$custAddr')";
		        	$rs = mysqli_query($conn, $sql);

  					//$_SESSION['success'] = "You are now logged in";
		        	if($rs)
		 			{
		 				echo '<script type="text/javascript">';
					    echo ' alert("Successfully registered")';  //not showing an alert box.
					    echo '</script>';
		 				header('location: cust_login.php');
		 			}

	 			}

	 			 mysqli_close($conn);
			}

	?>
			</form>
			
					
			
		</main>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<footer class="tm-footer text-center">
			
		</footer>
	</div>


	
    <script src="js/main.js"></script>  
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script>
      $(function() {
        $(".button-login").on("click", function() {
          window.location.href = "cust_login.php";
        });
      });

    </script>	






	
</body>
</html>

