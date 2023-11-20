<?php
session_start();
include("include/connect.php");

if (!isset($_SESSION['cust_id'])) {
  header('location:cust_login.php');
}
?>
<?php
        
          if(isset($_POST['minus'])){
            $qty_item=$_POST['quantity'];
            if($qty_item>=1){
              $qty_item-1;
              $id = $_POST['id'];

              $qty_min = "UPDATE cart SET quantity='$qty_item' WHERE cart_id=$id";
              $rs=mysqli_query($conn,$qty_min);

              if($rs)
             {
                  header('location: cart.php');
                }else{
                  echo"error".$rs."<br>".mysqli_error($conn);
              }
            }

          }
          
        ?>

        <?php
        
          if(isset($_POST['plus'])){
            $qty_item=$_POST['quantity'];
            $qty_item+1;
            $id = $_POST['id'];

            $qty_plus = "UPDATE cart SET quantity='$qty_item' WHERE cart_id='$id'";
            $rs=mysqli_query($conn,$qty_plus);

              if($rs)
             {
                
                //echo '<script type="text/javascript">';
                //echo ' alert("Customer information updated")';  //not showing an alert box.
                //echo '</script>';
                 // header('location: cart.php');
          
              }else{
                echo"error".$qty_plus."<br>".mysqli_error($conn);
            }
          }
          
        ?>
        
<?php
if (isset($_GET['cartid'])) {

    $cart_id=$_GET['cartid'];
    // sql to delete a record
    $sql = "DELETE FROM cart WHERE cart_id=$cart_id";

    if ($conn->query($sql) === TRUE) {
       header("Location: cart.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    //$conn->close();
  }
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
		<link rel="stylesheet" href="css/cart.css">
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
								<ul class="tm-nav-ul">
                  <li class="tm-nav-li"><a href="index.php" class="tm-nav-link ">Home</a></li>
                        <li class="tm-nav-li"><a href="cust_order.php" class="tm-nav-link ">Orders</a></li>
                        <!--<li class="tm-nav-li "><a href="cart.php" class="tm-nav-link active">Cart</a></li> -->
                        <?php
                          if (isset($_SESSION['cust_id'])) {
                            $cust_id = $_SESSION['cust_id'];
                            $cart="SELECT * FROM cart WHERE cust_id = $cust_id";
                            $cart_check=mysqli_query($conn, $cart);
                            $count=mysqli_num_rows($cart_check);

                            if ($count>0) {
                            ?>
                              <li class="tm-nav-li"><a href="cart.php" class="tm-nav-link">Cart(<?php echo $count;?>)</a></li>
                            <?php
                            }else{
                              ?>
                              <li class="tm-nav-li"><a href="cart.php" class="tm-nav-link active">Cart</a></li>
                              <?php

                            }
                            
                          }else{
                            ?>
                            <li class="tm-nav-li"><a href="cart.php" class="tm-nav-link">Cart</a></li>
                            <?php
                          }
                        ?>

                        <?php 
                        if(isset($_SESSION['cust_id']))
                        {
                          ?>
                          <li class="tm-nav-li"><a href="cust_profile.php" class="tm-nav-link">Profile</a></li>
                          <li class="tm-nav-li"><a href="logout.php" class="tm-nav-link">Logout</a></li>
                          
                          <?php
                        }else {
                          ?>
                          <li class="tm-nav-li"><a href="cust_login.php" class="tm-nav-link">Login</a></li>

                          <?php
                        }
                          
                         ?>
                  <li class="tm-nav-li"><a href="review.php" class="tm-nav-link">Review</a></li>
              </ul>
							</ul>
						</nav>	
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">My Cart</h2>
				
			</header>
		

		<!-- Cart container-->
		<div class="basket" style="float: left; width:70%;  border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; ">
			<!-- Cart heading -->
			<div class="basket-labels">
        <ul style ="list-style: none; margin: 0; padding: 0;">
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0;" class="item item-heading">Item</li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0;" class="price">Price</li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0;" class="quantity">Quantity</li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0;" class="subtotal">Subtotal</li>
        </ul>
      </div>
      <?php
        $subtotal = 0;
        $cartTotal = 0;  
        $totalQty = 0;
      ?>
      <?php

      if(isset($_SESSION['cust_id']))
      {
        $custID = $_SESSION['cust_id'];

        $sql = "SELECT * FROM product, cart WHERE product.pd_id = cart.pd_id AND cart.cust_id = $custID ";
        $sql_run = mysqli_query($conn,$sql);

        //$cart = "SELECT * FROM cart WHERE cust_id = $custID";
       // $rows = mysqli_query($conn,$cart);
        if (mysqli_num_rows($sql_run)>0) {
          while($row = mysqli_fetch_assoc($sql_run)) {
            $stock=$row['pd_stock'];
            $qty=$row['quantity'];
      ?>
    
      <!-- Cart Product List -->
      <div class="basket-product">
        <div class="item">
          <div class="product-image">
            <img name = "pd_img" src="<?php echo $row['pd_img'];?>" alt=" " style="border: 1px solid #aaa; width: 100px; height: 100px;">
          </div>
          <div class="product-details">
            <h2><strong><?php echo $row['pd_name'];?></strong></h2>
            <p><?php echo $row['pd_desc'];?></p>

          </div>
        </div>
        <div class="price">RM <?php echo $row['pd_price'];?></div>
        <div class="quantity qty-box buttons_added">
           <form action="cart.php" method="POST" > 
            <?php

             if ($qty>=$stock) {
              ?>
              <input type="submit" name="minus" value="-" class="minus" />
                <input type="number"  step ="1" min="1" max="" name="quantity" value="<?php echo $row['quantity'];?>" class="input-text qty-text text" size="4" id="<?php echo $row['cart_id'];?>" />       
                <input type="submit" name="test" value="+"  class="plus" />
              <?php
            }else{
            ?>
               <input type="submit" name="minus" value="-" class="minus" />
                <input type="number"  step ="1" min="1" max="" name="quantity" value="<?php echo $row['quantity'];?>" class="input-text qty-text text" size="4" id="<?php echo $row['cart_id'];?>" />       
                <input type="submit" name="plus" value="+"  class="plus" />
            <?php
              }
            
            ?>
            

            <input type="hidden"  name="id" value="<?php echo $row['cart_id'];?>">

         </form> 
        </div>

        

        <?php
          $subtotal = $row['pd_price'] * $row['quantity'];
          $cartTotal = $cartTotal + $subtotal;
          $id = $row['cart_id'];

          $sql_subtotal="UPDATE cart SET subtotal=$subtotal WHERE cart_id=$id";
          $rs = mysqli_query($conn, $sql_subtotal);
          if ($rs) {
            //echo '<script type="text/javascript">';
              //echo ' alert("Customer information updated")';  //not showing an alert box.
              //echo '</script>';
                  //header('location: checkout.php');
              }else{
                echo"error".$sql."<br>".mysqli_error($conn);
          }
        ?>


        <div class="subtotal">RM <?php echo number_format($subtotal,2);?></div>
      
        <div class="remove">
            <button onclick="return confirm('Are you sure you want to remove this item?')"><a href="cart.php?cartid=<?php echo $row['cart_id'];?> ">Remove</a></button>
        </div>
      </div>
    


      <?php
        //$subtotal = 0;
        //$totalQty = $totalQty + $row['quantity'];
        }//while
        
      }//if

    }//isset
    else {
      echo "Cart is Empty!";
    }
  
    ?>
		</div>
    

      <div style="float: right; width:30%;  border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; " >
        <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
        <div class="summary-subtotal">
          <div class="subtotal-title">Subtotal</div>
          <div class="subtotal-value final-value" id="basket-subtotal">RM <?php echo number_format($cartTotal,2);?></div>
          
          <div class="summary-promo hide">
            <div class="promo-title">Promotion</div>
            <div class="promo-value final-value" id="basket-promo"></div>
          </div>
        </div>
        <div class="summary-delivery">
        </div>

        <div class="summary-total">
          <div class="total-title">Total</div>
          <div class="total-value final-value" id="basket-total">RM <?php echo number_format($cartTotal,2) ;?></div>
        </div>
        <div class="summary-checkout">

          <form action="checkout.php">
            <button  type="submit" name = "checkout" class="checkout-cta" onclick="return confirm('Confirm to checkout?')">Proceed to Checkout</button>
          </form>
          <br><br>
         
        </div>
  
      </div>
    
			
		</main>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<footer class="tm-footer text-center">
			
		</footer>
	</div>


	
  <script src="js/main.js"></script>  
	<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script>
     jQuery(document).ready(($) => {
        $('.quantity').on('click', '.plus', function(e) {
            let $input = $(this).prev('input.text');
            let val = parseInt($input.val());
            $input.val( val+1 ).change();
        });
        $('.quantity').on('click', '.minus', 
            function(e) {
            let $input = $(this).next('input.text');
            var val = parseInt($input.val());
            if (val > 1) {
                $input.val( val-1 ).change();
            } 

        });

    });
  </script> 

</body>
</html>


