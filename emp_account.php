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
    <title>Employee - Accounts</title>
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
                  echo  $_SESSION["emp_name"]  ;
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
              <a class="nav-link  " href="emp_ord.php">
                <i class="fas fa-shopping-bag"></i> Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="emp_account.php">
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
      <div class="container mt-5">
        

        <?php
          $eid=$_SESSION['emp_id'];
          $sql="SELECT * FROM employee WHERE emp_id=$eid";
          $result=mysqli_query($conn, $sql);

          while($row=mysqli_fetch_array($result)){
        ?>
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-avatar">
          </div>
          <div class="tm-block-col tm-col-account-settings" style="margin:50px 200px 0px;" >
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Information update</h2>
              <form action="emp_account.php" method="post" class="tm-signup-form row">
                
                  <label for="name">Name</label>
                  <input
                    id="name"
                    name="name"
                    type="text"
                    value="<?php echo $row['emp_name'];?>"
                    class="form-control validate"
                    required
                  />

                  <label for="uname">Username</label>
                  <input
                    id="uname"
                    name="uname"
                    type="text"
                    value="<?php echo $row['emp_uname'];?>"
                    class="form-control validate"
                    required
                  />
                
                  <label for="phone">Contact No</label>
                  <input
                    id="empNo"
                    name="empNo"
                    type="number"
                    value="<?php echo $row['emp_no'];?>"
                    class="form-control validate"
                    required
                  />
                  <label for="phone">Email address</label>
                  <input
                    id="empEmail"
                    name="empEmail"
                    type="email"
                    value="<?php echo $row['emp_email'];?>"
                    class="form-control validate"
                    required
                  />
                  <input type="hidden" name="empID" value="<?php echo $row['emp_id'];?>">
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
      <br>
      <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
          <p class="text-center text-white mb-0 px-4 small">
           
          </p>
        </div>
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
    $empNo=$_POST['empNo'];
    $empEmail=$_POST['empEmail'];
    $empID=$_POST['empID'];
    $empName=$_POST['name'];
    $empUname=$_POST['uname'];

    $sql="UPDATE employee SET 
          emp_name='$_POST[name]',
          emp_uname='$_POST[uname]',
          emp_no='$_POST[empNo]',
          emp_email='$_POST[empEmail]'
          WHERE emp_id= '$empID'";
    $rs=mysqli_query($conn, $sql);

    if (!$rs) {
      echo "error".$sql. mysqli_error($conn);

    }else{
      echo '<script type="text/javascript">';
      echo ' alert("Your profiel has been updated!")';  //not showing an alert box.
      echo '</script>';
      ?>
      <script type="text/javascript">
        window.location.href = 'emp_account.php';
      </script>
      <?php
      mysqli_close($conn);
      
    }
    } 

  ?>