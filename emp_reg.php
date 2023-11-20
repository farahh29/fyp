<?php
include("include/connect.php");
?>
<?php
                  $msg= "";
                  if(isset($_POST['register']))
                    {
                      
                      $emp_name = $_POST['emp_name'];
                      $emp_uname = $_POST['emp_uname'];
                      $emp_pwd = $_POST['emp_pwd'];
                      $emp_no=$_POST['emp_no'];
                      $emp_email=$_POST['emp_email'];
                      

                      $sql = "INSERT INTO employee (emp_id, emp_name, emp_uname, emp_pwd, emp_no, emp_email) VALUES('', '$emp_name', '$emp_uname', '$emp_pwd','$emp_no','$emp_email') ";

                      $result = mysqli_query($conn, $sql);

                      if($result)
                      {
                          echo '<script type="text/javascript">';
                          echo ' alert("Successfully registered as an employee. Please continue to login")';  //not showing an alert box.
                          echo '</script>';
                          ?>
                          <!--Redirect page to dashboard-->
                          <script type="text/javascript">
                          window.location.href = 'emp_login.php';
                          </script>
                      <?php
                        }
                        else
                        {
                          echo"error".$sql."<br>".mysqli_error($conn); 
                        }

                        //connection closed.
                        mysqli_close($con);
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
                <h2 class="tm-block-title mb-4">Employee Register form</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form  method="post" action="emp_reg.php" enctype="multipart/form-data" class="tm-login-form">
                  <div class="form-group">
                    <label for="name">Employee Name</label>
                    <input 
                      class="form-control validate"
                      type="text"
                      name="emp_name"    
                      required
                    />
                  </div>
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
                  <div class="form-group">
                    <label for="emp_no">Contact Number</label>
                    <input 
                      class="form-control validate"
                      type="text"
                      name="emp_no"    
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="emp_email">Email Address</label>
                    <input 
                      class="form-control validate"
                      type="text"
                      name="emp_email"    
                      required
                    />
                  </div>
                  <!--<button class="mt-5 btn btn-primary btn-block text-uppercase">
                    Forgot your password?
                  </button> -->
                  <div class="form-group mt-4">
                    <button
                      type="submit" name="register"
                      class="btn btn-primary btn-block text-uppercase"
                    ><strong>
                      Register</strong>
                    </button>
                  </div>
                </form>

                  <div class="form-group mt-4">
                    <a href = "emp_login.php"><button
                      type="submit" name="seller_login"
                      class="btn btn-primary btn-block "
                    >
                      Already registered? Click here to Login
                    </button></a>
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
            