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
	<link href="css/cust-style.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
								<li class="tm-nav-li"><a href="index.php" class="tm-nav-link active">Home</a></li>
				                <li class="tm-nav-li"><a href="cust_order.php" class="tm-nav-link">Orders</a></li>
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
				                  <li class="tm-nav-li"><a href="cust_login.php" class="tm-nav-link">Login</a></li>

				                  <?php
				                }
				                  
				                 ?>
				                 <li class="tm-nav-li"><a href="review.php" class="tm-nav-link ">Review</a></li>
							</ul>
						</nav>	
					</div>
				</div>
			</div>
		</div>


		<main>
			<header class="row tm-welcome-section">
				
			</header>
			<div class="search-container">

				<form method="POST" action="searchproduct.php">
					<input style="width:400px; height:50px; margin-left: 400px;"type="text"  placeholder="Search for a product, and category" name="search" required>
					<button type="submit"><i class="far fa-search"></i></button>
				</form>
		<br><br>
				<form method="POST" action="filterprice.php">
					<label style="margin-left: 280px;">Filter by price :&nbsp;</label><input style="width:200px; height:40px; "type="number" min="1"  placeholder="Start Price" name="startprice" required>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="width:200px; height:40px;  "type="number" min="1" placeholder="End Price" name="endprice" required>
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
		</div>
		<br><br><br>
		<!--
			<div class="tm-paging-links">
				<nav>
					<ul>
						

					</ul>
				</nav>
			</div>
			-->
			<!-- Product-->
			<div class="row tm-gallery">
				
				<div id="tm-gallery-page-pizza" class="tm-gallery-page">
					<?php
					         
						$search=$_POST['search'];
						$shopID=$_POST['shopID'];

					          // $sql="SELECT p.*,ps.name as psname FROM product p,petstore ps WHERE p.petstoreid = ps.id AND (ps.name LIKE '%$search%' OR p.name LIKE '%$search%' OR ps.state LIKE '%$search%')";
					    $sql="SELECT  p.pd_id, p.shop_id, p.pdCat_id, pc.pdCat_name, p.pd_name, p.pd_desc, p.pd_price, p.pd_expdate, p.pd_img, p.pd_stock 
					    		FROM product as p
					    		INNER JOIN  product_cat as pc ON p.pdCat_id=pc.pdCat_id
					    		WHERE p.shop_id = '$shopID' AND (pc.pdCat_name LIKE '%$search%' OR p.pd_name LIKE '%$search%' ) ";
					    $res=mysqli_query($conn, $sql);

					    $count=mysqli_num_rows($res);
					           
					 		echo "<font color='red'>TOTAL RESULTS : $count</font>"; 
					 		?>
					 		<?php
					                 if($count>0){
					                while($row=mysqli_fetch_assoc($res)){
					                
								//$id = $row[''];	

                    ?>
								<form  action=" " method="post">
								  	<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
										<figure>
											<img  name = "pd_img" src="<?php echo $row['pd_img']; ?>"  alt="" style="width: 250px; height:250px"  />
											<figcaption>
												
											<h4 name ="pd_name" class="tm-gallery-title" ><?php echo htmlentities($row['pd_name']);?></h4>
											<input type="hidden" id = "shop_id" name = "shop_id" value="<?php echo $shopID; ?>">
											<input type="hidden" id = "product_id" name = "product_id" value="<?php echo $pd_id; ?>">
											<p name = "pd_desc" class="tm-gallery-description"><?php echo htmlentities($row['pd_desc']);?></p>
											<p name ="pd_price" class="tm-gallery-description">Price: RM<?php echo htmlentities($row['pd_price']);?>
											</p>
											<p name = "pd_expdate" class="tm-gallery-description" >Expire Date: <?php echo htmlentities($row['pd_expdate']);?></p>
											<p name = "pd_stock" class="tm-gallery-description" >Stock: <?php echo htmlentities($row['pd_stock']);?></p>
											<div>
											<input  type="text" name="quantity" value="1" min="1" id="numberPlace" style="width:50%; height:30px;" />
											<button type="submit" value="add_cart" name="add_cart"><i class="fa fa-shopping-cart" style="font-size:20px"></i> Add to Cart</button>
											</div>
										</figcaption>
										</figure>
									</article>
								</form>
									
								  <?php
									//}
							}//while
						}//if

						//}
					?>
				</div> <!-- gallery page 1 -->
			</div>
			<?php
					$msg ="";
								  if (isset($_POST['add_cart'])) {

										if(!isset($_SESSION['cust_login'])){
											echo "Please login before adding to cart";
											?>
											<script type="text/javascript">
												window.location.href='cust_login.php';
											</script>
											
											<?php
											//header("Location: cust_login.php");
											//exit;
										} else {
											
												$shopID = $_POST['shop_id'];
												$custID = $_SESSION["cust_id"];
												$pdID = $_POST['product_id'];
												$qty = $_POST['quantity'];

												$query = "SET FOREIGN_KEY_CHECKS=0";
	                							$disabled_foreign_key = mysqli_query($conn,$query);

												$sql_cart = "INSERT INTO cart(cart_id, cust_id, shop_id, pd_id,quantity) VALUES ('','$custID', '$shopID','$pdID', '$qty')";
												$add_cart = mysqli_query($conn, $sql_cart);

												if($add_cart)
										   		{
									               	echo '<script type="text/javascript">';
													//echo ' alert("Item added to cart.")';//not showing an alert box.
												
										     		 echo '</script>';
																	              
												}else{
													echo"error".$sql_cart."<br>".mysqli_error($conn);
												}

											}
										}	

	?>
			
		</main>

		<footer class="tm-footer text-center">
			<p></p>
		</footer>
	</div>
	
    <script src="js/main.js"></script>  
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script>
		$(document).ready(function(){
			// Handle click on paging links
			$('.tm-paging-link').click(function(e){
				e.preventDefault();
				
				var page = $(this).text().toLowerCase();
				$('.tm-gallery-page').addClass('hidden');
				$('#tm-gallery-page-' + page).removeClass('hidden');
				$('.tm-paging-link').removeClass('active');
				$(this).addClass("active");
			});
		});
	</script>
</body>
</html>

