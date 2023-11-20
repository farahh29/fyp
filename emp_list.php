<?php
include("include/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin - Seller List</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style-admin.css">
    <!--
  Product Admin CSS Template
  https://templatemo.com/tm-524-product-admin
  -->
  </head>

  <body id="reportsPage">
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="#">
          <h1 class="tm-site-title mb-0">Admin</h1>
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
              <a class="nav-link " href="#">
                <i class="fas fa-shopping-cart"></i> Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="admin_dashboard.php">
                <i class="fas fa-shopping-cart"></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="cat.php">
                <i class="fas fa-shopping-cart"></i> Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="seller_list.php">
                <i class="far fa-user"></i> Seller
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link  active" href="emp_list.php">
                <i class="far fa-user"></i> Employee
              </a>
            </li>
            
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link d-block" href="seller_login.php">
                Admin, <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products"> <!-- container for table -->
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">ID</th>
                    <th scope="col">Emp Name</th>
                    
                    <th scope="col">Contact No</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <?php
                  $query = " SELECT * FROM employee";
                  $result = mysqli_query($conn,$query);

                  while($rows = mysqli_fetch_array($result))
                  {
                ?>
                <tbody>
                  <tr>
                    <td>&nbsp;</td>
                    <td><?php echo $rows['emp_id'];?></td>
                    <td class="tm-catShop-name" ><?php echo $rows['emp_name'];?></td>
                    
                    <td><?php echo $rows['emp_no'];?></td>
                    <td>
                      <a href="#" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>

                  <?php
                  //close while loop
                  }

                  ?>
                </tbody>
              </table>
            </div>
            <!-- table container -->
            
          </div>
        </div>
        
  </div>
</div>
    <footer class="tm-footer row tm-mt-small">
      <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
           Copyright &copy; <b>2022</b> Centralized Online Grocery Shopping Ranau 
          
          
        </p>
      </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <!--<script>
      $(function() {
        $(".tm-catShop-name").on("click", function() {
          window.location.href = "edit_catShop.php";
        });
      });
      $(function() {
        $(".tm-catPd-name").on("click", function() {
          window.location.href = "edit_catPd.php";
        });
      });
    </script>-->
  </body>
</html>