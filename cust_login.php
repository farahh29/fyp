<?php

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
		
			<h1 class="col-12 text-center tm-section-title"><b>Login Form</b></h1>

			<form action="cust_login.php" method="post">
			  
			  <div class="container-form">
			    <label for="uname"><b>Username</b></label>
			    <input type="text" placeholder="Enter Username" name="cust_username" required>

			    <label for="psw"><b>Password</b></label>
			    <input type="password" placeholder="Enter Password" name="cust_pwd" required>
			        
			    <button type="submit" name="login" class="button-login">Login</button>

			    <button type="submit"class="button-reg">Register</button>

			    <a href="seller_login.php">Seller</a>
			    
			  </div>
		
	<?php
		$msg= "";
		if(isset($_POST['login']))
		{
			$cust_username = $_POST['cust_username'];
			$cust_pwd = $_POST['cust_pwd'];

			$sql = "SELECT * FROM customer WHERE cust_username='$cust_username' LIMIT 1";
			$result = mysqli_query($conn, $sql);
 			
 			if(mysqli_num_rows($result) ==1)
 			{
 				$row = mysqli_fetch_assoc($result);

 				if($cust_username==$row['cust_username'] && $cust_pwd==$row['cust_pwd'])
	 			{
	 				session_start();
	 				$_SESSION["cust_id"] = $row["cust_id"];
	 				$_SESSION["cust_name"] = $row['cust_name'];
	 				header('location:index.php');
	 			} else {
	 				echo "Invalid Username or Password";
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
        $(".button-reg").on("click", function() {
          window.location.href = "cust_reg.php";
        });
      });

    </script>

    	



	
</body>
</html>

