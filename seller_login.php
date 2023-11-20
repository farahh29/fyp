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
    <title>Seller</title>
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
    <style>
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
                <h2 class="tm-block-title mb-4">Welcome Seller, Login</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form  method="post" action="seller_login.php" class="tm-login-form">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                      class="form-control validate"
                      type="text"
                      name="seller_uname"    
                      required
                    />
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input 
                      class="form-control validate"
                      type="password"
                      name="seller_pwd"
                      required
                    />
                  </div>
                  <div class="form-group mt-4">
                    <button
                      type="submit" name="seller_login"
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
                    <a href = "seller_reg.php"><button
                      type="submit" name="seller_reg"
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
                    <a href = "emp_login.php">
                      Rider
                    </a>
                     &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href = "admin_login.php">
                      Admin
                    </a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
      <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
         
          
        </p>
      </div>
    </footer>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
<?php
                  $msg= "";
                  if(isset($_POST['seller_login']))
                    {
                      $seller_username = $_POST['seller_uname'];
                      $seller_pwd = $_POST['seller_pwd'];

                      $sql = "SELECT * FROM seller WHERE seller_username ='$seller_username' LIMIT 1";
                      $result = mysqli_query($conn, $sql);
                      if(mysqli_num_rows($result) == 1)
                      {
                        $row = mysqli_fetch_assoc($result);
                        if ($seller_username==$row['seller_username'] && $seller_pwd==$row['seller_pwd']) 
                        {
                          $_SESSION["seller_id"] = $row["seller_id"];//the first record set, bind to userID
                          $_SESSION["seller_name"] = $row["seller_name"];
                          ?>
                          <!--Redirect page to product(homepage for now)-->
                          <script type="text/javascript">
                          window.location.href = 'seller_order.php';
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