<?php
session_start();
include("include/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ranau Groceries</title>
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
    <script src="https://kit.fontawesome.com/9a93df3d22.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link  rel="stylesheet" href="css/templatemo-style.css" />
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">-->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<!--

Simple House

https://templatemo.com/tm-539-simple-house

-->
<body> 

  <div class="container" >
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
                              <li class="tm-nav-li"><a href="cart.php" class="tm-nav-link">Cart</a></li>
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
        <h2 class="col-12 text-center tm-section-title">Checkout</h2>
        
      </header>
    

    <!-- Left containcer -->

    <div style=" float: left; width:70%; border: 1px solid #aaa; padding: 1rem; box-sizing: border-box;  " >
      <div class="summary-total-items"><span class="total-items"></span> Order Summary</div>
      <div class="summary-subtotal">
        <?php
             
              if(isset($_SESSION['cust_id']))
              {
                $custID = $_SESSION['cust_id'];
                $cartTotal=0;

                $sql = "SELECT * FROM product, cart WHERE product.pd_id = cart.pd_id AND cart.cust_id = $custID ";
                $sql_run = mysqli_query($conn,$sql);

                //$cart = "SELECT * FROM cart WHERE cust_id = $custID";
                //$rows = mysqli_query($conn,$cart);

               if (mysqli_num_rows($sql_run)>0) {
                while($row = mysqli_fetch_assoc($sql_run)) {
                
             ?>
             <div class="item" style="width:auto;">
              <table>
                <thead>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </thead>
                <tbody>
                   <tr>
                      <td><img name = "pd_img" src="<?php echo $row['pd_img']; ?>" alt=" " style="border: 1px solid #aaa; width: 100px; height: 100px;"></td>
                      <?php 
                        
                        $qty = $row['quantity'];
                        $sub = $row['subtotal'];
                        $cartTotal = $cartTotal + $sub;
                        
                      ?>
                      <td class="product-details"><?php echo $row['pd_name'];?><br>x<?php echo $row['quantity'];?><br>RM <?php echo $row['subtotal'];?></td> 
                  </tr>   
                </tbody>
              </table>
            </div>
             <?php
            
                } 
              }
            }
        ?>
      </div>

    </div>

    <!-- Right containcer -->
      <div style="float: right; width:30%;  border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; " >
        <div class="summary-total-items"><span class="total-items"></span> Order Summary</div>
        <div class="summary-subtotal">
          <!--<div class="subtotal-title">Item </div> <br>-->

             <?php
             
              if(isset($_SESSION['cust_id']))
              {
                $custID = $_SESSION['cust_id'];
                $cartTotal=0;

                $sql = "SELECT * FROM product, cart WHERE product.pd_id = cart.pd_id AND cart.cust_id = $custID ";
                $sql_run = mysqli_query($conn,$sql);

                //$cart = "SELECT * FROM cart WHERE cust_id = $custID";
                //$rows = mysqli_query($conn,$cart);

               if (mysqli_num_rows($sql_run)>0) {
                while($row = mysqli_fetch_assoc($sql_run)) {
                
                        $qty = $row['quantity'];
                        $sub = $row['subtotal'];
                        $cartTotal = $cartTotal + $sub;
                        
            
                   } //while 
                 } //if row
               }// if isset
            ?>

          <div class="subtotal-title">Total item </div>
          <div style="float: right;" id="basket-total">RM <?php echo number_format($cartTotal,2); ?></div>
          <!--
          <div class="subtotal-title">Delivery charges </div>
          <div style="float: right;">RM 3.00</div>
          -->
        </div>
        <div class="summary-total">
          <div class="total-title">Total</div>
          <div style="float: right;" id="basket-total">RM <?php echo number_format($cartTotal,2); ?></div>
        </div>
        <div id="paypal-payment-button">

        </div>
        

        
      </div>
      
      
    </main>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <footer class="tm-footer text-center">
      <p>Copyright &copy; 2022 Centralized Online Grocery Shopping </p>
    </footer>
  </div>


  
   <script src="js/main.js"></script>  
  <script src="js/jquery.min.js"></script>
  <script src="js/parallax.min.js"></script>
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->

  <script src="https://www.paypal.com/sdk/js?client-id=AXlQ2zVwlMo4dvL4Ft4w3v0juqSRkB2itsNShhhOlaSEqPTqeGUG7HgN57MeYiR6qstPwswHUxHB3gt4&disable-funding=credit,card"></script>
  <script>
    paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: '0.1'
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            window.location.replace("http://localhost/FYP/success.php")
        })
    },
    onCancel: function (data) {
        window.location.replace("http://localhost/FYP/paypalCancel.php")
    }
    }).render('#paypal-payment-button');
</script>
</body>
</html>

