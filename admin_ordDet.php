<?php
session_start();
include("include/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin - Order Details Page</title>
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
    th,td{
      background-color: whitesmoke;
      padding: 15px 50px 15px  ;
      text-align: center;
      color: black;
      border-bottom: 1px solid #ddd;
    }
    h3, h5{
      text-align: center;
    }
    table{
      border: 1px solid #aaa;
      margin-left: auto;
      margin-right: auto;

    }
    .buttonIn {
      width: auto;
      position: relative;
    }
    input[type=text]{
      margin: 0px;
      width: 100%;
      padding: 0px;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      outline: none;
      height: 35px;
      border-radius: 5px;
    }

    .button-edit{
      position: absolute;
      top: 0;
      border-radius: 5px;
      right: 0px;
      z-index: 2;
      border: none;
      top: 2px;
      height: 30px;
      cursor: pointer;
      color: white;
      background-color: whitesmoke;
      transform: translate(-5px);
    }
    .edit-icon {
      font-size: 0.9rem;
      color: darkgreen;
    }
    .btn-back {
          height: 50px;
          width: 10%;
          padding: 5px;
          border-radius: 12px;
          background-color: #04AA6D;
          font-size: 15px;
          font-weight: bold;
          margin-left: 600px;
          margin-top: 20px;
          margin-bottom: 20px;
          color: white;
      }

      .btn-back:hover {
          background-color: #1C6744;
      } 
      a{
        color: white;
      }
     
  </style>
  </head>

  <body id="reportsPage">
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="#">
          <h1 class="tm-site-title mb-0">ADMIN</h1>
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
              <a class="nav-link active " href="admin_order.php">
                <i class="fas fa-shopping-bag"></i> Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="admin_dashboard.php">
                <i class="fas fa-bars
                "></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="cat.php">
                <i class="far fa-folder" aria-hiddent="true"></i> Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="seller_list.php">
                <i class="far fa-user"></i> Seller
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="employee_list.php">
                <i class="far fa-user"></i> Rider
              </a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link d-block" href="admin_login.php">
                <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <br><br><br>
    
      <button class="btn-back" ><a href="admin_order.php">BACK</a></button>
      <br><br>
    
    <br>
    <?php
    $ordID = $_GET['ordID'];
      $sql2= "SELECT * FROM ordination, customer WHERE ordination.cust_id=customer.cust_id AND ordination.ord_id='$ordID'";
      $sql_run2= mysqli_query($conn, $sql2);
        if (mysqli_num_rows($sql_run2)>0) {
          while ($row=mysqli_fetch_assoc($sql_run2)) {
            $payMethod=$row['pay_method'];
            $custAddr=$row['cust_address'];
            $custName=$row['cust_name'];
            $custNo=$row['cust_no'];
            $ordTotal=$row['ord_amt'];
            }
          }
          
    ?>
    <!--Customer details-->
      <div style="float:left; padding:25px 50px; margin: 0px 600px; font-size: 20px; border:solid 2px; width:50%;">
          <strong>Customer Name:&nbsp;<?php echo $custName;?></strong><br>
          <strong style="float:left;">Contact Number:&nbsp;<?php echo $custNo;?></strong><br>
          <strong style="float:left;">Delivery Address:&nbsp;<?php echo $custAddr;?></strong><br>
          <strong style="float:left;">Payment Method:&nbsp;<?php echo $payMethod;?></strong><br>
          <strong style="float:left;">Total Order:&nbsp;RM <?php echo number_format($ordTotal,2);?></strong>
      </div>
        <br>
    <!-- Product details container-->
    <div class="basket" style=" width:50%;  margin:0px 600px; border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; text-align: center;"  >
      <!-- Cart heading -->
      <div class="basket-labels">
        <ul style ="list-style: none; margin: 0; padding: 0;">
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 40%; scroll-margin-block-end:;" class="item item-heading"><b>Product Info</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 20%; scroll-margin-block-end:;" class="item item-heading"><b>Price</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 40%;" class="price"><b>Subtotal</b></li>
         
        </ul>
      </div>
      <?php
        //$seller_id=$_SESSION['seller_id'];
        $sql = "SELECT * FROM ord_product, product WHERE ord_product.pd_id=product.pd_id AND ord_product.ord_id='$ordID' ";
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
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
  
</html>

