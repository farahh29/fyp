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
    <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link href="css/cust-style.css" rel="stylesheet" />
  <style>
    input[type=text]{
      width: 100%;
      padding: 25px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border-radius: 4px;
      font-size: 15px;
    }
  </style>
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
               <li class="tm-nav-li"><a href="index.php" class="tm-nav-link ">Home</a></li>
                <li class="tm-nav-li"><a href="cust_order.php" class="tm-nav-link">Orders</a></li>
                <li class="tm-nav-li"><a href="cart.php" class="tm-nav-link">Cart</a></li>

                <?php 
                  if(isset($_SESSION['cust_id']))
                  {
                    ?>
                    <li class="tm-nav-li "><a href="cust_profile.php" class="tm-nav-link active">Profile</a></li>
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
            </nav>  
          </div>
        </div>
      </div>
    </div>

    <main>
      <header class="row tm-welcome-section">
        
      </header>
    
      <h1 class="col-12 text-center tm-section-title"><b>Profile</b></h1>

      <?php
        if (isset($_SESSION['cust_id'])) {
          $custID = $_SESSION['cust_id'];
          $query=mysqli_query($conn,"select cust_name, cust_email, cust_username, cust_no , cust_address from customer where cust_id=$custID") or die(mysql_error());
          $row=mysqli_fetch_array($query)or die(mysql_error());
      ?>
         <form  method="post" action="cust_profile.php">
        
        <div class="container-form">
          <input type="hidden" name="cust_id" value="<?php echo $custID?>">
          <label for="cust_name"><b>Name</b></label>
          <input type="text" placeholder="Enter Full Name" name="cust_name" value = "<?php echo $row['cust_name'];?>" required>

          <label for="cust_email" ><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="cust_email" value = "<?php echo $row['cust_email'];?>" required>

          <label for="cust_username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="cust_username" value = "<?php echo $row['cust_username'];?>"  required>

          <label for="cust_no"><b>Contact No</b></label>
          <input type="text" placeholder="Enter Contact No" name="cust_no" value = "<?php echo $row['cust_no'];?>" required>

          <label for="cust_address"><b> Address</b></label>
          <input type="text" placeholder="Enter Delivery Address" name="cust_address" value = "<?php echo $row['cust_address'];?>" >
        <br><br><br>
          <button type="submit" name ="update_profile" class="button-reg" onclick="return confirm('Confirm update profile?')">Update</button>
        
          
        </div>

     
      </form>
         <?php
         }
      ?>
      <?php
        $msg = "";
          if (isset($_POST["update_profile"])) {
            $custID = $_POST['cust_id'];
            $custName= $_POST['cust_name'];
            $custEmail= $_POST['cust_email'];
            $custUname=$_POST['cust_username'];
            $custNo = $_POST['cust_no'];
            $custAddr=$_POST['cust_address'];       

            $sql = "UPDATE customer SET
                    cust_id='$_POST[cust_id]',
                    cust_name = '$_POST[cust_name]',
                    cust_email = '$_POST[cust_email]',
                    cust_username = '$_POST[cust_username]',
                    cust_no = '$custNo',
                    cust_address = '$_POST[cust_address]'
                    WHERE cust_id = '$custID'";

            $sql_run = mysqli_query($conn, $sql);
          
            if(!mysqli_query($conn, $sql))
                  {
                    print "query failed: $upd \n\n<br />" . mysqli_error();
                
                  }
                  else{
                    echo '<script type="text/javascript">';
                    echo ' alert("Profile Updated!")';  //not showing an alert box.
                    echo '</script>';
                    ?>
                    <!--Redirect page to product-->
                      <script type="text/javascript">
                        window.location.href = 'cust_profile.php';
                      </script>
                      <?php
                  }
        }
      ?>
          
      
    </main>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <footer class="tm-footer text-center">
      
    </footer>
  </div>

  
    <script src="js/main.js"></script>  
  <script src="js/jquery.min.js"></script>
  <script src="js/parallax.min.js"></script>
  
</body>
</html>