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
	<link href="css/mystyles.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="css/cart.css">
	<style>
		.btn-cancel {
	    height: 40px;
	    width: 100%;
	    padding: 5px;
	    border-radius: 12px;
	    background-color: red;
	    font-size: 15px;
	    font-weight: bold;
	}
	.btn-cancel:hover {
	    background-color: darkred;
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
				                <!--<li class="nav-li"><a href="cart.php" class="nav-link">Cart</a></li>-->
				                <?php
                          if (isset($_SESSION['cust_id'])) {
                            $cust_id = $_SESSION['cust_id'];
                            $cart="SELECT * FROM cart WHERE cust_id = $cust_id";
                            $cart_check=mysqli_query($conn, $cart);
                            $count=mysqli_num_rows($cart_check);

                            if ($count>0) {
                            ?>
                              <li class="nav-li"><a href="cart.php" class="nav-link">Cart(<?php echo $count;?>)</a></li>
                            <?php
                            }else{
                              ?>
                              <li class="nav-li"><a href="cart.php" class="nav-link">Cart</a></li>
                              <?php

                            }
                            
                          }else{
                            ?>
                            <li class="nav-li"><a href="cart.php" class="nav-link">Cart</a></li>
                            <?php
                          }
                        ?>
				                <?php 
				                if(isset($_SESSION['cust_id']))
				                {
				                  ?>
				                  <li class="nav-li "><a href="cust_profile.php" class="nav-link">Profile</a></li>
				                  <li class="nav-li"><a href="logout.php" class="nav-link">Logout</a></li>
				                  
				                  <?php
				                }else {
				                  ?>
				                  <li class="nav-li"><a href="cust_login.php" class="nav-link">Login</a></li>

				                  <?php
				                }
				                  
				                 ?>
				          <li class="nav-li"><a href="review.php" class="nav-link ">Review</a></li>
							</ul>
						</nav>	
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row welcome-section">
				<h2 class="col-12 text-center section-title"><?php
				if (isset($_SESSION['cust_id'])) {
					// Echo session variables that were set on previous page
                  	echo  ' ',$_SESSION["cust_name"] ,' ' ;
				}
            	?> Order History</h2>
			
			</header>

		</main>
		<div class="category-links">
				<nav>
					<ul>
						<li class="category-item"><a href="cust_order.php" class="category-link">All</a></li>
						<li class="category-item"><a href="cust_order.php?filter=Pending" class="category-link">Pending</a></li>
						<li class="category-item"><a href="cust_order.php?filter=Processing" class="category-link">Processing</a></li>
						<li class="category-item"><a href="cust_order.php?filter=Delivering" class="category-link">Delivering</a></li>
						<li class="category-item"><a href="cust_order.php?filter=Completed" class="category-link">Completed</a></li>
					</ul>
				</nav>
			</div>
		<!-- Cart container-->
		<div class="basket" style=" width:90%;  margin:0px 50px; border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; text-align: center;"  >
			<!-- Cart heading -->
			<div class="basket-labels">
        <ul style ="list-style: none; margin: 0; padding: 0;">
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 20%; scroll-margin-block-end:;" class="item item-heading">ORDER ID</li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 30%;" class="price">TOTAL ORDER</li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 30%;" class="quantity">PAYMENT METHOD</li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0;" class="subtotal">DELIVERY STATUS</li>
        </ul>
      </div>
     
    <?php
      $filter = (isset($_GET['filter']) ? $_GET['filter'] : null);

      if(isset($_SESSION['cust_id']))
      {
      	$custID = $_SESSION['cust_id'];
      	
      	if ($filter=="Pending") {
      		$status="Pending";
      		$sql = "SELECT * FROM ordination WHERE cust_id = $custID AND ord_status= '$status' ";
      } else if ($filter=="Processing") {
      		$status="Processing";
      		$sql = "SELECT * FROM ordination WHERE cust_id = $custID AND ord_status= '$status' ";
      } else if ($filter=="Delivering") {
      		$status="Delivering";
      		$sql = "SELECT * FROM ordination WHERE cust_id = $custID AND ord_status= '$status' ";
      }else if ($filter=="Completed") {
      		$status="Completed";
      		$sql = "SELECT * FROM ordination WHERE cust_id = $custID AND ord_status= '$status' ";
      }else{
      	$sql = "SELECT * FROM ordination WHERE cust_id = $custID ";
      }
        $sql_run = mysqli_query($conn,$sql);
        if (mysqli_num_rows($sql_run)>0) {
                while($row = mysqli_fetch_assoc($sql_run)) {
      ?>
    
      <!-- Order List -->
      <div class="basket-product" style="text-align: center;">
        <div class="item_ord">
          <div class="price " style ="width: 70%; " >
            <a href="custOrd_details.php?ordID=<?php echo $row['ord_id'];?>"><h2 ><strong ><?php echo $row['ord_id'];?></strong></h2></a>
          </div>
        </div>
        <div  class="price" style ="width: 30%; " >RM <?php echo $row['ord_amt'];?></div>
        <div class="price" style ="width: 28%; "><?php echo $row['pay_method'];?></div>
			<div class="price">
			<?php
				//fetch order status
				$process=$row['ord_status'];
				$ordID=$row['ord_id'];

				$fdback="SELECT * FROM feedback, ordination WHERE ordination.ord_id=feedback.ord_id AND ordination.ord_id='$ordID'";
				$rs=mysqli_query($conn, $fdback);

				if (mysqli_num_rows($rs)>0) {
					?>
					<button class="btn-comp">Reviewed</button>
					<?php
				}
				//if complete colour green
				 else if ($process=="Completed") {
			?>
				<a href="feedback.php?oid=<?php echo $ordID;?>"><button class="btn-comp" name="review"><?php echo $row['ord_status'];?></button></a>
			<?php
				} else if ($process=="Canceled") {
					//change to red
			?>
				<button class="btn-cancel"><?php echo $row['ord_status'];?></button>
			<?php
				}else {
				//else color orange (process)
			?>
				<button class="btn-process"><?php echo $row['ord_status'];?></button>
			<?php
				}
			?>
			</div>
      
    </div>
      <?php
        }//while
        
      }//if

    }//isset
  ?>


		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<footer class="tm-footer text-center">
			
		</footer>
	</div>
	
    <script src="js/main.js"></script>  
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	
</body>
</html>