<?php
session_start();
include("include/connect.php");
?>
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
                    window.location.href = 'emp_ord.php';
                  </script>
                  <?php
                
                  }else{
                    echo"error".$sql."<br>".mysqli_error($conn);
                  }
          // code...
        }
        //connection closed
        
      ?>
<?php
        if (isset($_POST['empID'])) {
          $msg="";
          $empID= $_POST['emp_id'];
          $ordID= $_POST['ordID'];
          $checkID=$_SESSION['emp_id'];
          $comp= "Completed";
          //check if user enter correct id
          if ($empID==$checkID) {
            // check if ord status pending or not
            $sql1= "SELECT * FROM ordination WHERE ord_id='$ordID' ";
            $sql_run1 = mysqli_query($conn, $sql1);

            $row = mysqli_fetch_assoc($sql_run1);
            $pend="Pending";
            $canceled = "Canceled";
            //$empID = $row['emp_id'];
            if ($row['ord_status'] == $pend) {
              echo '<script type="text/javascript">';
              echo ' alert("Order pending, cannot accept order to delivery")';  //not showing an alert box.
              echo '</script>';
            
            } else if ($row['ord_status'] == $canceled) {
              echo '<script type="text/javascript">';
              echo ' alert("Order canceled, cannot accept order to delivery")';  //not showing an alert box.
              echo '</script>';
            } else if ($row['emp_id'] > '0') {
              echo '<script type="text/javascript">';
              echo ' alert("Order has been accepted by other rider, cannot accept order to delivery")';  //not showing an alert box.
              echo '</script>';
            }else{
                // check if there are not comlpete delivery of that rider
              $sql_check = "SELECT * FROM ordination WHERE emp_id ='$empID' AND ord_status != '$comp' ";
              $res_check = mysqli_query($conn, $sql_check);
            
                if (mysqli_num_rows($res_check)>0) {
                  echo '<script type="text/javascript">';
                  echo ' alert("Please complete your delivery first.")';  //not showing an alert box.
                  echo '</script>';
                } else{
                  //update emp_id 
                    $sql="UPDATE ordination SET emp_id= '$empID' WHERE ord_id= '$ordID'";
                    $sql_run=mysqli_query($conn, $sql);

                    if($sql_run)
                      {
                        echo '<script type="text/javascript">';
                        echo ' alert("Order delivery accepted!")';  //not showing an alert box.
                        echo '</script>';
                      ?>
                      <script type="text/javascript">
                        window.location.href = 'emp_ord.php';
                      </script>
                      <?php
                    
                      }else{
                        echo"error".$sql."<br>".mysqli_error($conn);
                      }
                }
               
            }
          } else{
            echo '<script type="text/javascript">';
            echo ' alert("Please enter your Employee ID:'.$_SESSION['emp_id'].'")';  //not showing an alert box.
            echo '</script>';
          }
        }
      ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Employee - Orders Page</title>
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
  
  <style>
    a{
      color: green;
    }
    th,td{
      background-color: whitesmoke;
      padding: 15px 50px 15px  ;
      text-align: center;
      color: black;
      border-bottom: 1px solid #ddd;
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
     
    }

  </style>
  </head>

  <body id="reportsPage">
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="#">
          <h1 class="tm-site-title mb-0"><?php
                if (isset($_SESSION["emp_id"])) {

                   echo  $_SESSION["emp_name"]  ;
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
              <a class="nav-link active " href="emp_ord.php">
                <i class="fas fa-shopping-bag"></i> Orders
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link " href="emp_account.php">
                <i class="far fa-user"></i> Account
              </a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link d-block" href="emp_logout.php">
                <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="tm-paging-links">
      <br><br>
        <nav>
          <ul>
            <li class="tm-paging-item"><a href="emp_ord.php" class="tm-paging-link">All</a></li>
            <li class="tm-paging-item"><a href="emp_ord.php?filter=Pending" class="tm-paging-link">Pending</a></li>
            <li class="tm-paging-item"><a href="emp_ord.php?filter=Processing" class="tm-paging-link">Processing</a></li>
            <li class="tm-paging-item"><a href="emp_ord.php?filter=Delivering" class="tm-paging-link">Delivering</a></li>
            <li class="tm-paging-item"><a href="emp_ord.php?filter=Completed" class="tm-paging-link">Completed</a></li>
            <li class="tm-paging-item"><a href="emp_ord.php?filter=Canceled" class="tm-paging-link">Canceled</a></li>
          </ul>
        </nav>
      </div>
      <!-- Cart heading -->
      <table>
        <thead>
          <th style ="width: 10%; ">Order ID</th>
          <th style ="width: 20%; ">Total Order</th>
          <th>Order Created</th>
          <th>Payment Method</th>
          <th>Delivery Status</th>
          <th>Employee ID</th>
        </thead>
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
        //$sql2 = "SELECT * FROM ordination ";
        $sql_run2 = mysqli_query($conn,$sql2);
        if (mysqli_num_rows($sql_run2)>0) {
                while($row = mysqli_fetch_assoc($sql_run2)) {
                  $cust_id= $row['cust_id'];

            $sql1 = "SELECT * FROM customer WHERE cust_id=$cust_id";
            $sql_run1 = mysqli_query($conn, $sql1);
            $cust = mysqli_fetch_assoc($sql_run1);
            $custName=$cust['cust_name'];

      ?>
        <tbody>
          <td style ="width:2px "><a href="order_details.php?ordID=<?php echo $row['ord_id'];?>"><?php echo $row['ord_id'];?></a></td>
          <td >RM <?php echo $row['ord_amt'];?></td>
          <td style ="width: 20%; "><?php echo $row['ord_date'];?></td>
          <td><?php echo $row['pay_method'];?></td>
          <?php 
            if ($row['ord_status']=="Canceled") {
              ?>

              <td><?php echo $row['ord_status'];?></td>
                
              </div>
              <?php
            } else if($row['ord_status']=="Pending"){
              ?>
              <td><?php echo $row['ord_status'];?></td>
            </div>
              <?php
            } else {
              ?>
            
          <form method="post" action="emp_ord.php">
            <td>
              <select name="ord_status"  style="height:30px; width: auto;">
                <option value="" disable selected><?php echo $row['ord_status'];?></option>
                <option value="Processing">Processing</option>
                <option value="Delivering">Delivering</option>
                <option value="Completed">Completed</option>
              </select> 
              <button type="submit" name="select"  style="background-color:white;"><i class="fa-solid fa-pen-to-square edit-icon"></i></button>
              <input type="hidden" name="ordID" value="<?php echo $row['ord_id'];?>">              
            </td>
          </form>
              <?php
            }
          ?>
         
          <form method="post" action="emp_ord.php">
            <td>
              <div class="buttonIn">
                <input type="text" name="emp_id" value="<?php echo $row['emp_id'];?>"required>
                <button type="submit" name="empID" class="button-edit" style="background-color:white;"><i class="fa-solid fa-pen-to-square edit-icon"></i></button>
                <input type="hidden" name="ordID" value="<?php echo $row['ord_id'];?>">  
              </div>

            </td>
          </form>
        </tbody>
      
      <?php
        }//while
        
      }//if

    else {
      //echo "Cart is Empty!";
    }
  
    ?>
    </table>
    <footer class="tm-footer row tm-mt-small">
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>



