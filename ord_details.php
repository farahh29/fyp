<?php
session_start();
include("include/connect.php");

if ($_GET['ordID']) {
  $ordID=$_GET['ordID'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Seller - Orders Page</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://kit.fontawesome.com/9a93df3d22.js" crossorigin="anonymous"></script>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/admin-style.css">
    <link rel="stylesheet" href="css/cart.css">
    <style>
       .btn-back {
          height: 40px;
          width: 15%;
          padding: 5px;
          border-radius: 12px;
          background-color: #04AA6D;
          font-size: 15px;
          font-weight: bold;
          margin-left: 50px;
          margin-top: 20px;
          margin-bottom: 20px;
      }

      .btn-back:hover {
          background-color: #1C6744;
      } 
    </style>  
  </head>

  <body id="reportsPage">
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="#">
          <h1 class="tm-site-title mb-0"><?php
                if (isset($_SESSION["seller_id"])) {

                   echo  $_SESSION["seller_name"]  ;
                  // Echo session variables that were set on previous page
                 }
            ?></h1>
        </a>
        <button
          class="navbar-toggler ml-auto mr-0"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars tm-nav-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto h-100">
            <li class="nav-item">
              <a class="nav-link  active" href="seller_order.php">
                <i class="fas fa-shopping-bag"></i> Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="products.php">
                <i class="fas fa-bars"></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="seller_account.php">
                <i class="far fa-user"></i> Account
              </a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link d-block" href="seller_logout.php">
                <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div >
      <a href="seller_order.php"><button class="btn-back">BACK</button></a>
    </div>
    <?php
    $sql2= "SELECT * FROM ordination, customer WHERE ordination.cust_id=customer.cust_id AND ordination.ord_id='$ordID'";
    $sql_run2= mysqli_query($conn, $sql2);
        if (mysqli_num_rows($sql_run2)>0) {
          while ($row=mysqli_fetch_assoc($sql_run2)) {
            $payMethod=$row['pay_method'];
            $custAddr=$row['cust_address'];
            $custName=$row['cust_name'];
            $custNo=$row['cust_no'];
          }
        }
    ?>
    <div style="float:left; padding:25px 50px; margin-left: 50px; font-size: 20px; border:solid 2px; width:90%;">
        <strong>Customer Name:&nbsp;<?php echo $custName;?></strong><br>
        <strong style="float:left;">Contact Number:&nbsp;<?php echo $custNo;?></strong><br>
        <strong style="float:left;">Delivery Address:&nbsp;<?php echo $custAddr;?></strong><br>
        <strong style="float:left;">Payment Method:&nbsp;<?php echo $payMethod;?></strong>
    </div>

    
        <!-- Product details container-->
    <div class="basket" style=" width:90%;  margin:0px 50px; border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; text-align: center;"  >
      <!-- Cart heading -->
      <div class="basket-labels">
        <ul style ="list-style: none; margin: 0; padding: 0;">
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 40%; scroll-margin-block-end:;" class="item item-heading"><b>Product Info</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 20%; scroll-margin-block-end:;" class="item item-heading"><b>Price</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 40%;" class="price"><b>Subtotal</b></li>
         
        </ul>
      </div>
      <?php
        $seller_id=$_SESSION['seller_id'];
        $sql = "SELECT * FROM ord_product, product WHERE ord_product.pd_id=product.pd_id AND product.shop_id='$seller_id' AND ord_product.ord_id='$ordID' ";
        $sql_run = mysqli_query($conn,$sql);

        
        if (mysqli_num_rows($sql_run)>0) {
                while($row = mysqli_fetch_assoc($sql_run)) {
                  $cust_id= $row['cust_id'];
                  $pd_id=$row['pd_id'];
                  $pd_name=$row['pd_name'];
                  $pd_price=$row['pd_price'];
                  $qty=$row['quantity'];
                  $pd_img= $row['pd_img'];
                  $pd_desc=$row['pd_desc'];
                  $subtotal=$qty * $pd_price;
        ?>
        <div class="basket-product" style="text-align: center;">
        <div class="item_ord">
          <div class="price " style ="width: 50%; " >
            <img name = "pd_img" src="<?php echo $row['pd_img'];?>" alt=" " style="border: 1px solid #aaa; width: 100px; height: 100px;">
          </div>
          <div class="price " style ="width: 50%; " >
            <?php echo $pd_name;?> x<?php echo $qty;?>
          </div>
        </div>
        <div  class="price" style ="width: 40%; " >RM <?php echo $pd_price;?></div>
        <div  class="price" style ="width: 20%; " >RM <?php echo number_format($subtotal,2);?></div>
        
      </div>
        <?php
        }//while
        
      }//if

    else {
      //echo "Cart is Empty!";
    }
  
    ?>

    
    </div>
    <br>
    <!--
    <footer class="tm-footer row tm-mt-small">
    
      <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
          Copyright &copy; <b>2022</b> Centralized Online Grocery Shopping Ranau  
          
          Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
      </div>
    </footer>
  -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>


