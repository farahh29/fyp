<?php
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
                <h2 class="tm-block-title mb-4">Register form</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form  method="post" action="seller_reg.php" enctype="multipart/form-data" class="tm-login-form">
                  <div class="form-group">
                    <label for="username">Shop Name</label>
                    <input 
                      class="form-control validate"
                      type="text"
                      name="seller_name"    
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                      class="form-control validate"
                      type="text"
                      name="seller_username"    
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
                  <div class="form-group mt-3">
                    <label for="seller_img">Upload Shop Image</label>
                    <input
                      type="file"
                      name="fileToUpload"
                      id="fileToUpload"
                      required
                    >
                  </div>
                  <div >
                    <label for="shop_cat">Shop Category</label><br>
                    <select  id="shop_cat" name="shop_cat" class="custom-select tm-select-accounts">
                      <option  value="" disabled selected>Select Category</option>
                      <option  value="1">Grocery</option>
                      <option  value="2">Personal Care</option>
                      <option  value="3">Health Care</option>
                      <option  value="4">Stationary</option>
                      <option  value="5">Technology</option>
                    </select>
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
                    <a href = "seller_login.php"><button
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
            <?php
                  $msg= "";
                  if(isset($_POST['register']))
                    {
                      $target="img/shop/".basename($_FILES["fileToUpload"]["name"]);
                      $seller_name = $_POST['seller_name'];
                      $seller_username = $_POST['seller_username'];
                      $seller_pwd = $_POST['seller_pwd'];
                      $shopPic = $_FILES['fileToUpload']['name'];
                      $selected = $_POST['shop_cat'];

                      $sql = "INSERT INTO seller (seller_id, seller_name, seller_username, seller_pwd, seller_img, seller_cat) VALUES('', '$seller_name', '$seller_username', '$seller_pwd','$target','$selected') ";

                      $result = mysqli_query($conn, $sql);

                      if($result)
                      {
                          echo '<script type="text/javascript">';
                          echo ' alert("Successfully registered. Please continue to login")';  //not showing an alert box.
                          echo '</script>';
                          ?>
                          <!--Redirect page to dashboard-->
                          <script type="text/javascript">
                          window.location.href = 'seller_login.php';
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