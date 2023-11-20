<?php
session_start();
include("include/connect.php");

$custID=$_SESSION['cust_id'];
$oid = (isset($_GET['oid']) ? $_GET['oid'] : null);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Ranau Groceries</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />    
	<link href="css/mystyles.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="css/cart.css">
	<style>
		textarea{
			width: 100%;
			height: 150px;
			padding: 12px 20px;
			border: 2px solid #ccc;
			border-radius: 6px;
			background-color: whitesmoke;
			font-size: 14px;
			resize: none;
		}
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
		<div class="container-nav">			
			<div class="parallax-window" data-parallax="scroll" data-image-src="img/header.jpg">
				<div class="tm-header">
					<div class="row tm-header-inner">
						<div class="col-md-6 col-12">
							
							<div class="tm-site-text-box">
								<h1 class="tm-site-title">Centralized </h1>
								<h6 class="tm-site-description">Online Grocery Shopping in Ranau</h6>	
							</div>
						</div>
						<nav class="col-md-6 col-12 nav">
							<ul class="nav-ul">
								<li class="nav-li"><a href="index.php" class="nav-link ">Home</a></li>
				                <li class="nav-li"><a href="cust_order.php" class="nav-link active">Orders</a></li>
				                <li class="nav-li"><a href="cart.php" class="nav-link">Cart</a></li>
				                <?php 
				                if(isset($_SESSION['cust_id']))
				                {
				                  ?>
				                  <li class="nav-li"><a href="cust_profile.php" class="nav-link">Profile</a></li>
				                  <li class="nav-li"><a href="logout.php" class="nav-link">Logout</a></li>
				                  
				                  <?php
				                }else {
				                  ?>
				                  <li class="nav-li"><a href="cust_login.php" class="nav-link">Login</a></li>

				                  <?php
				                }
				                  
				                 ?>

				                 <li class="tm-nav-li"><a href="review.php" class="tm-nav-link">Review</a></li>
							</ul>
						</nav>	
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row welcome-section">
				<h2 class="col-12 text-center section-title"> Feedback</h2>
			</header>
		</main>
		
		<!-- Feedback container-->
		<div class="basket" style=" width:90%;  margin:0px 50px; border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; text-align: center;"  >
			<!-- Feedback heading -->
			<div class="basket-labels">
        <ul style ="list-style: none; margin: 0; padding: 0;">
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 20%; scroll-margin-block-end:;" class="item item-heading"><b>ORDER ID &nbsp; </b></li>
        </ul>
      </div><br><br><br>
      <!--Feedback form-->
      <?php

      $fdback="SELECT ord_product.ord_id, ord_product.pd_id, product.shop_id, seller.seller_name
      								FROM ord_product
      								INNER JOIN product ON ord_product.pd_id=product.pd_id 
      								INNER JOIN seller ON product.shop_id=seller.seller_id
  										WHERE ord_product.ord_id='$oid'";
  		$rs = mysqli_query($conn,$fdback);
  		//$shopName=$row['seller_name'];

  		?>
      <form method="post" action="feedback.php">
      	<h4></h4>
          <textarea id="cust_review" name="cust_review" >
         	</textarea>
         	<div>
         	<input type="hidden" name="oid" value="<?php echo $oid;?>">
      	<button type="submit" name="submit" class="btn-comp" style="width:20%; float: right;">SUBMIT</button>
      </div>
		</div>

      </form>
      
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<footer class="tm-footer text-center">
			<p></p>
		</footer>
	</div>
	
    <script src="js/main.js"></script>  
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>

</body>
</html>

<?php
if (isset($_POST['submit'])) {
	$msg="";
	$cust_review=$_POST['cust_review'];
	$ordID=$_POST['oid'];
	
	$sql="INSERT into feedback (fdback_id, cust_id, ord_id, comment) VALUES ('', '$custID', '$ordID', '$cust_review')";
	$result=mysqli_query($conn, $sql);

	if ($result) {
		echo '<script type="text/javascript">';
		echo ' alert("Thank you for your feedback!")';  //not showing an alert box.
		echo '</script>';
		?>
          <script type="text/javascript">
            window.location.href = 'cust_order.php';
          </script>
          <?php
    }else{
			echo"error".$sql."<br>".mysqli_error($conn);
		}
	}

?>