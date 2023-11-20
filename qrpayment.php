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
    <link  rel="stylesheet" href="css/cust-style.css" />
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">-->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
      select{
        width: 56%;
        height: 35px;
        border-radius: 6px;
        border-color:#ccc;
        margin-left: 200px;
      }
      label,input[type=text], input[type=file]{
        margin-left: 200px;
      }

    </style>
  
</head>

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
                        <li class="tm-nav-li"><a href="cust_order.php" class="tm-nav-link">Orders</a></li>
                        <li class="tm-nav-li "><a href="cart.php" class="tm-nav-link active">Cart</a></li>
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

    <div style=" border: 1px solid #aaa; padding: 1rem; box-sizing: border-box;  " >

      <?php
        if (isset($_SESSION['cust_id'])) {
          $custID = $_SESSION['cust_id'];
          $ord_amt=$_SESSION['ord_amt'];
          $ordID=$_SESSION['oid'];

          $sql = "SELECT * FROM customer WHERE cust_id = $custID";
          $sql_run = mysqli_query($conn, $sql);

          if(mysqli_num_rows($sql_run)>0)
            while ($row = mysqli_fetch_assoc($sql_run)) {
      ?>
      <h4 style="margin-left: 35%;">SCAN QR FOR PAYMENT</h4>
      <form action="qrpayment.php" method="post" enctype="multipart/form-data">
        <div>
          <div>
            <img src="img/qrcode.jpeg" alt="QrCode" name="qrcode" style="margin-left: 35%;">
          </div>
          <h4 style="margin-left: 35%;">Order ID: <?php echo $ordID;?></h4>
          <h4 style="margin-left: 35%;">Total Payment: RM <?php echo number_format($ord_amt,2);?></h4>
            <label for="bank"><b>Bank </b></label>
                    <select name="bank" >
                        <option value="" disable selected>Select Bank</option>
                        <option value="CimbClicks">Cimb Clicks</option>
                        <option value="Maybank">Maybank</option>
                        <option value="BankIslam">Bank Islam</option>
                    </select>
             <br><br>
            <label for="ref_no"><b>Reference Number</b></label> 
            <div class="buttonIn">
              <input type="text" placeholder="Enter Reference No" name="ref_no" required>
            </div>
            <br>
            <label for="slip"><b><br><br>Transaction Slip</b></label>
            <div class="buttonIn">
              <input type="file" name="fileToUpload" id="fileToUpload" required>
            </div><br>
             <input type="hidden" id="createDate" name="createDate" />

           <script>
                var time = new Date();
                var date = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate();
                var today= time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
                var dateTime = date+' '+today;
                document.getElementById("createDate").value = dateTime;
            </script>
         <br><br><br>

            <button type="submit" name ="qrpay" class="button-reg">SUBMIT</button>
      </form>

              <br><br><br><br><br><br><br><br>
        </div>
    </div>
    <?php
        }
      } 
    ?>
    <!-- Right containcer -->
      
      
    </main>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <footer class="tm-footer text-center">
      <p></p>
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
  
</body>
</html>

 <?php
if (isset($_POST['qrpay'])) {
  $msg="";
  $ordID=$_SESSION['oid'];
  $ord_amt=$_SESSION['ord_amt'];
  $custID=$_SESSION['cust_id'];
  $bankType=$_POST['bank'];
  $refNo=$_POST['ref_no'];
  $target="img/transaction/".basename($_FILES["fileToUpload"]["name"]);
  $payProof = $_FILES['fileToUpload']['name'];
  $payDate=$_POST['createDate'];

  $sql="INSERT INTO payment(pay_id, ord_id, bank_type, ref_no, total_payment, paySlip, payDate) VALUES ('', '$ordID', '$bankType', '$refNo', '$ord_amt','$target', '$payDate')";
  $rs=mysqli_query($conn, $sql);

  if(mysqli_query($conn, $sql)){
    echo '<script type="text/javascript">';
    echo ' alert("Successfully paid for Order Number:'.$ordID.'")';  //not showing an alert box.
    echo '</script>';
    unset($_SESSION["oid"]);
    unset($_SESSION["ord_amt"]);
    ?>
    <script type="text/javascript">
      window.location.href = 'cust_order.php';
    </script>
    <?php

  }else{
    echo"error".$sql."<br>".mysqli_error($conn);
  }
}
?>