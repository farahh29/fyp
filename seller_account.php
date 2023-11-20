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
    <title>Accounts - Product Admin Template</title>
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
  </head>

  <body id="reportsPage">
    <div class="" id="home">
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
          <a class="navbar-brand" href="dashboard.php">
            <h1 class="tm-site-title mb-0"><?php

                  // Echo session variables that were set on previous page
                  echo  $_SESSION["seller_name"]  ;
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
              <a class="nav-link " href="seller_order.php">
                <i class="fas fa-shopping-bag"></i> Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="products.php">
                <i class="fas fa-bars"></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="seller_account.php">
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
      <div class="container mt-5">
        

        <?php
          $sid=$_SESSION['seller_id'];
          $sql="SELECT * FROM seller WHERE seller_id=$sid";
          $result=mysqli_query($conn, $sql);

          while($row=mysqli_fetch_array($result)){
        ?>
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-avatar">
            <div class="tm-bg-primary-dark tm-block tm-block-avatar">
              <h2 class="tm-block-title"></h2>
              <div class="tm-avatar-container">
                <img
                  src="<?php echo $row['seller_img']; ?>"
                  alt="Image"
                  class="tm-avatar img-fluid mb-4"
                />
                
            </div>
            </div>
          </div>
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Information update</h2>
              <form action="seller_account.php" method="post" class="tm-signup-form row">
                
                  <label for="name">Shop Name</label>
                  <input
                    id="name"
                    name="name"
                    type="text"
                    value="<?php echo $row['seller_name'];?>"
                    class="form-control validate"
                  />

                  <label for="email">Seller Username</label>
                  <input
                    id="uname"
                    name="uname"
                    type="text"
                    value="<?php echo $row['seller_username'];?>"
                    class="form-control validate"
                  />
                
                  <label for="phone">Contact No</label>
                  <input
                    id="sellerNo"
                    name="sellerNo"
                    type="tex5"
                    value="<?php echo $row['seller_no'];?>"
                    class="form-control validate"
                  />
                <br>
                <br><br>
                  <button
                    type="submit"
                    name="update"
                    class="btn btn-primary btn-block text-uppercase"
                  >
                    Update Your Profile
                  </button>
                
              </form>
            <?php
            }
            ?>
            </div>
          </div>
        </div>
      </div>
      <footer class="tm-footer row tm-mt-small">
        
      </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
<?php
  if (isset($_POST['update'])) {
    $msg="";
    $sellerNo=$_POST['sellerNo'];
    $sellerID=$_SESSION['seller_id'];
    $sellerName=$_POST['name'];
    $sellerUname=$_POST['uname'];

    $sql="UPDATE seller SET seller_no='$_POST[sellerNo]' WHERE seller_id='$sellerID'";
    $rs=mysqli_query($conn, $sql);

    if (!$rs) {
      echo "error".$sql. mysqli_error($conn);

    }else{
      echo '<script type="text/javascript">';
      echo ' alert("Profile updated!")';  //not showing an alert box.
      echo '</script>';
      ?>
      <script>
        window.location.href = 'seller_account.php';
      </script>
      <?php
      mysqli_close($conn);
      
    }
    } 

  ?>