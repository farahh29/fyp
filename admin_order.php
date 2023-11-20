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
    <title>Admin - Orders Page</title>
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
    <style >
      a{
        color: green;
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
                Admin, <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="tm-paging-links">
        <nav>
           <li class="tm-paging-item"><a href="admin_order.php" class="tm-paging-link">All</a></li>
            <li class="tm-paging-item"><a href="admin_order.php?filter=Pending" class="tm-paging-link">Pending</a></li>
            <li class="tm-paging-item"><a href="admin_order.php?filter=Processing" class="tm-paging-link">Processing</a></li>
            <li class="tm-paging-item"><a href="admin_order.php?filter=Delivering" class="tm-paging-link">Delivering</a></li>
            <li class="tm-paging-item"><a href="admin_order.php?filter=Completed" class="tm-paging-link">Completed</a></li>
            <li class="tm-paging-item"><a href="admin_order.php?filter=Canceled" class="tm-paging-link">Canceled</a></li>
          </ul>
        </nav>
      </div>
    <!-- Cart container-->
    <div class="basket" style=" width:60%;  margin:0px 600px; border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; text-align: center;"  >
      <!-- Cart heading -->
      <div class="basket-labels">
         <ul style ="list-style: none; margin: 0; padding: 0;">
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 10%; scroll-margin-block-end:;" class="item item-heading"><b>Order ID</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 15%;" class="price"><b>Total Order</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 20%;" class="price"><b>Order Created</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 15%;" class="quantity"><b>Payment Method</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 10%;" class="subtotal"><b>Payment Status</b></li>
          <li style ="color: #111; display: inline-block; padding: 0.625rem 0; width: 15%;" class="subtotal"><b>Delivery Status</b></li>
        </ul>
      </div>
      <?php
        $filter = (isset($_GET['filter']) ? $_GET['filter'] : null);

        //for filtering delivery status
        if ($filter=="Pending") {
            $status="Pending";
            $sql2 = "SELECT * FROM ordination WHERE ord_status= '$status' ";
        } else if ($filter=="Processing") {
            $status="Processing";
            $sql2 = "SELECT * FROM ordination WHERE ord_status= '$status' ";
        } else if ($filter=="Delivering") {
            $status="Delivering";
            $sql2 = "SELECT * FROM ordination WHERE ord_status= '$status'";
        }else if ($filter=="Completed") {
            $status="Completed";
            $sql2 = "SELECT * FROM ordination WHERE ord_status= '$status' ";
        }else if ($filter=="Canceled") {
            $status="Canceled";
           $sql2 = "SELECT * FROM ordination WHERE ord_status= '$status' ";
        }else{
          $sql2 = "SELECT * FROM ordination ";
        }
        
        $sql_run2 = mysqli_query($conn,$sql2);

        //$cart = "SELECT * FROM cart WHERE cust_id = $custID";
       // $rows = mysqli_query($conn,$cart);

        if (mysqli_num_rows($sql_run2)>0) {
                while($row = mysqli_fetch_assoc($sql_run2)) {
                  //from ordination
                  $cust_id= $row['cust_id'];

            $sql1 = "SELECT * FROM customer WHERE cust_id=$cust_id";
            $sql_run1 = mysqli_query($conn, $sql1);
            $cust = mysqli_fetch_assoc($sql_run1);
            $custName=$cust['cust_name'];
            $custName=$cust['cust_name'];
            $ord_status=$row['ord_status'];
            $pay_status=$row['pay_status'];

      ?>
      <!-- Order List -->
      <div class="basket-product" style="text-align: center;">
        <div class="item_ord">
          <div class="price " style ="width: 20%; " >
            <h2 ><strong ><a href="admin_ordDet.php?ordID=<?php echo $row['ord_id'];?>"><?php echo $row['ord_id'];?></a></strong></h2>
          </div>
        </div>
        <div  class="price" style ="width: 23%; " >RM <?php echo $row['ord_amt'];?></div>
        <div  class="price" style ="width: 12%; " ><?php echo $row['ord_date'];?></div>
        <div class="price" style ="width: 23%; "><?php echo $row['pay_method'];?></div>
        <div class="price" style ="width: 10%; ">
          <form action="seller_order.php" method="post">
            <input type="checkbox" name="pay"  value="Paid" 
            <?php if($pay_status=="Paid"){?> checked="checked"<?php }?>>
            <button type="submit" name="pay" class="button-edit" style="background-color:white; margin-left: 10px;" onclick="return confirm('Confirm to change payment status?')"><i class="fa-solid fa-pen-to-square edit-icon"></i></button>
             <input type="hidden" name="ordID" value="<?php echo $row['ord_id'];?>">
          </form>
        </div>
        <form method="post" action="seller_order.php">
          <div class="price" style ="width: 20%; ">
            <?php
              if ($row['ord_status']=="Canceled") {
                
                ?>
                <div class="price" style ="width: 100%; "><?php echo $row['ord_status'];?></div>
                
              </div>
                <?php
              }else{
                ?>
                 <select name="ord_status"  style="height:30px; width: auto;">

              <option value="" disable selected><?php echo $row['ord_status'];?></option>
              <option value="Processing">Processing</option>
              <option value="Delivering">Delivering</option>
              <option value="Completed">Completed</option>
            </select> 
             </div>
             <button type="submit" name="select" class="button-edit" style="background-color:white;" onclick="return confirm('Confirm to change delivery status?')"><i class="fa-solid fa-pen-to-square edit-icon"></i></button>
                <?php
              }
            ?>
           
            
            <input type="hidden" name="ordID" value="<?php echo $row['ord_id'];?>">
          
         
        </form>

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
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
   
  </body>
</html>

<?php
        if (isset($_POST['select'])) {
          $msg="";
          $selected= $_POST['ord_status'];
          $ordID= $_POST['ordID'];

          $sql="UPDATE ordination SET ord_status= '$selected' WHERE ord_id= '$ordID'";
          $sql_run=mysqli_query($conn, $sql);

          if($sql_run)
                  {
                      echo '<script type="text/javascript">';
                  echo ' alert("Delivery status updated!")';  //not showing an alert box.
                  echo '</script>';
                  mysqli_close($conn);
                  ?>
                  <script type="text/javascript">
                    window.location.href = 'seller_order.php';
                  </script>
                  <?php
                
                  }else{
                    echo"error".$sql."<br>".mysqli_error($conn);
                  }
          // code...
        }
        //connection closed
        
      ?>

