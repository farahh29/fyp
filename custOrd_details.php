<?php
session_start();
include("include/connect.php");

$custID=$_SESSION['cust_id'];
$oid = (isset($_GET['ordID']) ? $_GET['ordID'] : null);
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
      .btn-cancel{
        float: right;
        height: 40px;
          width: 15%;
          padding: 5px;
          border-radius: 12px;
          background-color: red;
          font-size: 15px;
          font-weight: bold;
          margin-right: 50px;
          margin-top: 20px;
          margin-bottom: 20px;
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
                  <li class="nav-li"><a href="review.php" class="nav-link ">Review</a></li>
              </ul>
            </nav>  
          </div>
        </div>
      </div>
    </div>

    <main>
      <header class="row welcome-section">
        <h2 class="col-12 text-center section-title"> Order Details</h2>
      </header>
    </main>
    <div >
      <a href="cust_order.php"><button class="btn-back">BACK</button></a>
    </div>
    <?php
    $custID=$_SESSION['cust_id'];
    $sql= "SELECT * FROM ordination, customer WHERE ordination.cust_id=customer.cust_id AND customer.cust_id='$custID'";
    $sql_run= mysqli_query($conn, $sql);
        if (mysqli_num_rows($sql_run)>0) {
          while ($row=mysqli_fetch_assoc($sql_run)) {
            $payMethod=$row['pay_method'];
            $custAddr=$row['cust_address'];
            $custNo=$row['cust_no'];
            $custName=$row['cust_name'];
            $date=$row['ord_date'];

          }
        }
    ?>
    <div style="float:left; padding:25px 50px; margin-left: 50px; font-size: 20px; border:solid 2px; width:90%;">
        <strong>Customer Name:&nbsp;<?php echo $custName;?></strong><br>
        <strong style="float:left;">Contact Number:&nbsp;<?php echo $custNo;?></strong><br>
        <strong style="float:left;">Delivery Address:&nbsp;<?php echo $custAddr;?></strong><br>
        <strong style="float:left;">Payment Method:&nbsp;<?php echo $payMethod;?></strong><br>
        <strong style="float:left;">Order Created:&nbsp;<?php echo $date;?></strong>
    </div>
    <!-- Feedback container-->
        <!-- Cart container-->
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
        $sql2 = "SELECT * FROM ord_product, product WHERE ord_product.pd_id=product.pd_id AND ord_product.ord_id='$oid' ";
        $sql_run2 = mysqli_query($conn,$sql2);

        
        if (mysqli_num_rows($sql_run2)>0) {
                while($row = mysqli_fetch_assoc($sql_run2)) {
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

    <?php
      $status="SELECT * FROM ordination WHERE ord_id='$oid'";
      $status_run=mysqli_query($conn, $status);

      while($row=mysqli_fetch_array($status_run)){
        $ord_status=$row['ord_status'];
      }
      if ($ord_status=="Canceled") {
        ?>
    <div >
      <form action="custOrd_details.php" method="post">
        <input type="hidden" name="oid" value="<?php echo "$oid";?>">
      </form>
    </div>
        <?php
      } else{
        ?>
      <div >
      <form action="custOrd_details.php" method="post">
        <input type="hidden" name="oid" value="<?php echo "$oid";?>">

        <button type="submit" class="btn-cancel" name="cancel" onclick="return confirm('Are you sure you want to cancel order?')">CANCEL ORDER</button>
      </form>
    </div>
        <?php
      }
    ?> 
    
    </div>
    
      
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer class="tm-footer text-center">
      <p><br><br></p>
      <br><br><br><br><br><br>
    </footer>
  </div>
  
    <script src="js/main.js"></script>  
  <script src="js/jquery.min.js"></script>
  <script src="js/parallax.min.js"></script>
 
</body>
</html>
<?php
  if (isset($_POST['cancel'])) {

    $ordID=$_POST['oid'];
    $sql="UPDATE ordination SET ord_status='Canceled' WHERE ord_id=$ordID ";
    $result=mysqli_query($conn, $sql);

    if ($result) {
      $sql2="SELECT ord_product.pd_id, ord_product.quantity, product.pd_stock 
      FROM ord_product 
      INNER JOIN product ON ord_product.pd_id=product.pd_id 
      WHERE ord_product.ord_id=$ordID";
      $sql_run2=mysqli_query($conn, $sql2);
      while($row=mysqli_fetch_array($sql_run2)){
        $pdStock=$row['pd_stock'];
        $qtyItem=$row['quantity'];
        $pd_id=$row['pd_id'];
        $newStock= $pdStock+$qtyItem;

        $upd_stock="UPDATE product SET pd_stock=$newStock WHERE pd_id=$pd_id";
        $upd_stock_run=mysqli_query($conn, $upd_stock);

        if($upd_stock_run){
          ?>
          <script type="text/javascript">
              window.location.href = 'cust_order.php';
          </script>
          <?php
        }else{
          echo"error".$sql2."<br>".mysqli_error($conn);
        }//else
      }//while
    }// if result
  }//isset
?>