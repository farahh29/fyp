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
								<li class="nav-li"><a href="index.php" class="nav-link active">Home</a></li>
				                <li class="nav-li"><a href="cust_order.php" class="nav-link">Orders</a></li>
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
				                  <li class="nav-li"><a href="cust_profile.php" class="nav-link">Profile</a></li>
				                  <li class="nav-li"><a href="logout.php" class="nav-link">Logout</a></li>
				                  
				                  <?php
				                }else {
				                  ?>
				                  <li class="nav-li"><a href="cust_login.php" class="nav-link">Login</a></li>

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
			<header class="row welcome-section">
				<h2 class="col-12 text-center section-title"><?php
				if (isset($_SESSION['cust_id'])) {
					// Echo session variables that were set on previous page
                  	echo  'Hi , ',$_SESSION["cust_name"] ,'! ' ;
				}
            	?> Welcome to Ranau Groceries</h2>
			
			</header>
		<!--
		<div>
			<form action="search.php" method="GET">
				<input type="" name="">
				<button type="submit" name="search">Search</button>
			</form>
		</div>
	-->
			<div class="category-links">
				<nav>
					<ul>
						<li class="category-item"><a href="index.php?cat=1" class="category-link">Grocery</a></li>
						<li class="category-item"><a href="index.php?cat=2" class="category-link">Personal Care</a></li>
						<li class="category-item"><a href="index.php?cat=3" class="category-link">Health Care</a></li>
						<li class="category-item"><a href="index.php?cat=4" class="category-link">Stationary</a></li>
						<li class="category-item"><a href="index.php?cat=5" class="category-link">Technology</a></li>
					</ul>
				</nav>
			</div>

			
			<!-- Gallery -->
			<div class="row gallery">
				<!-- gallery page 1 -->
				<div id="gallery-shop" class="gallery-page">
					<?php
						//if categories clicked
						if (isset($_GET['cat'])) {

							$catCurr = $_GET['cat'];

							$sql_cat = "SELECT * FROM shop_cat, seller WHERE shop_cat.shopCat_id = seller.seller_cat AND shop_cat.shopCat_id = $catCurr";
							$res_cat = mysqli_query($conn, $sql_cat);

							if (mysqli_num_rows($res_cat)>0) {
								while($row = mysqli_fetch_assoc($res_cat)) {
									?>
									<article class="col-lg-3 col-md-4 col-sm-6 col-12 gallery-item">
									<figure>

							<!--Link to that shop using shop ID from clicking image-->
						  	
							<a href="vendor.php?shopid=<?php echo $row['seller_id']; ?>" target="new window">
								<img src="<?php echo $row['seller_img'];
								 ?>" alt="Shop" title="<?php echo $row['seller_name']; ?>" class="img-responsive img-shop" />

							</a>

							<figcaption>
								<h4 class="gallery-title"><?php echo htmlentities($row['seller_name']);?></h4>
							</figcaption>
						</figure>
					</article>


					<?php
							} //while
						}//if
					}//first if
							//no categories clicked
							else{
							$sql = "SELECT * FROM seller";
							$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($result) > 0) {
							  // output data of each row
							  while($row = mysqli_fetch_assoc($result)) {
							  	//$shopID = $row['shop_id'];
					?>

					<article class="col-lg-3 col-md-4 col-sm-6 col-12 gallery-item">
						<figure>
							<!--Link to that shop using shop ID from clicking image-->
							<?php 
							//test outpu
							//echo $row['seller_id'];
							?>
						  	
							<a href="vendor.php?shopid=<?php echo $row['seller_id']; ?>" target="new window">
								<img src="<?php echo $row['seller_img'];
								 ?>" alt="Shop" title="<?php echo $row['seller_name']; ?>" class="img-responsive img-shop" />

							</a>

							<figcaption>
								<h4 class="gallery-title"><?php echo htmlentities($row['seller_name']);?></h4>
							</figcaption>
						</figure>
					</article>

					<?php 
						}//while
					}//if
						else {
							echo "Sorry, 0 result found";
					} 
					}//else first
					mysqli_close($conn);

					?>

				</div>
			</div>
			
		</main>

		<footer class="tm-footer text-center">
			<p></p>
		</footer>
	</div>
	
    <script src="js/main.js"></script>  
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>

</body>
</html>