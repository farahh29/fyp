<?php
session_start();
include("include/connect.php");
?>

<?php
                  $msg= "";
                  if(isset($_POST['emp_login']))
                    {
                      $emp_uname = $_POST['emp_uname'];
                      $emp_pwd = $_POST['emp_pwd'];

                      $sql = "SELECT * FROM employee WHERE emp_uname ='$emp_uname' LIMIT 1";
                      $result = mysqli_query($conn, $sql);
                      if(mysqli_num_rows($result) == 1)
                      {
                        $row = mysqli_fetch_assoc($result);
                        if ($emp_uname==$row['emp_uname'] && $emp_pwd==$row['emp_pwd']) 
                        {
                          $_SESSION["emp_id"] = $row["emp_id"];//the first record set, bind to userID
                          $_SESSION["emp_name"] = $row["emp_name"];
                          ?>
                          <!--Redirect page to product(homepage for now)-->
                          <script type="text/javascript">
                          window.location.href = 'emp_ord.php';
                          </script>
                      <?php
                        }
                        else
                        {
                          echo "Invalid Username or Password";  
                        }
                      }
                       else {
                        echo "<h2>Login error, username does not exist.Please try again</h2>";
                      } 
                  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Employee</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/admin-style.css">
    <style >
      a{
        color: green;
      }
    </style>
  </head>

  <body>
    <div>
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
      
        </div>
      </nav>
    </div>

    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto tm-login-col">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12 text-center">
                <h2 class="tm-block-title mb-4">Welcome Rider, Login</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form  method="post" action="emp_login.php" class="tm-login-form">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                      class="form-control validate"
                      type="text"
                      name="emp_uname"    
                      required
                    />
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input 
                      class="form-control validate"
                      type="password"
                      name="emp_pwd"
                      required
                    />
                  </div>
                  <div class="form-group mt-4">
                    <button
                      type="submit" name="emp_login"
                      class="btn btn-primary btn-block text-uppercase"
                    >
                      Login
                    </button>
                  </div>
                  
                  <!--<button class="mt-5 btn btn-primary btn-block text-uppercase">
                    Forgot your password?
                  </button> -->
                </form>

                <div class="form-group mt-4">
                    <a href = "emp_reg.php"><button
                      type="submit" name="emp_reg"
                      class="btn btn-primary btn-block text-uppercase"
                    >
                      Register
                    </button></a>
                  </div>
                  <div class="form-group mt-4">
                    <a href = "index.php">
                      Homepage
                    </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href = "seller_login.php">
                      Shop Owner
                    </a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
    </footer>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>