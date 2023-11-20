<?php
include("include/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin - Product Category</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
    <!-- http://api.jqueryui.com/datepicker/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/admin-style.css">
    <style>
        a{
          color: white;
        }
        a:link {
          color: white;
          background-color: transparent;
          text-decoration: none;
        }
        a:hover{
          color: #f5a623;
        }

    </style>
   
  </head>

  <body>
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
              <a class="nav-link " href="admin_order.php">
                <i class="fas fa-shopping-bag"></i> Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="admin_dashboard.php">
                <i class="fas fa-bars
                "></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="cat.php">
                <i class="far fa-folder" aria-hiddent="true"></i> Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="seller_list.php">
                <i class="far fa-user"></i> Seller
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="employee_list.php">
                <i class="far fa-user"></i> Rider
              </a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link d-block" href="admin_login.php">
                Admin, <b>Logout</b>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h3 class="tm-block-title d-inline-block">Edit Product Category</h3>
              </div>
            </div>
            <?php 

            $id = (isset($_GET['pid']) ? $_GET['pid'] : null);
            $sql= "SELECT * FROM product_cat WHERE pdCat_id= '$id'";
            $rs=mysqli_query($conn, $sql);

            while($row=mysqli_fetch_array($rs)){

            ?>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form method="post" action="admin_editPCat.php" class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >Product Category Name
                    </label>
                    <input
                      id="name"
                      name="catName"
                      type="text"
                      class="form-control validate"
                      value= "<?php echo $row['pdCat_name'];?>"
                      required
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="description"
                      >Description</label
                    >
                    <textarea
                      class="form-control validate"
                      rows="2"
                      name = "catDesc"
                      required
                    ><?php echo $row['pdCat_desc'];?></textarea>
                  </div>
                  <!--
                  <div class="form-group mb-3">
                    <label
                      for="date"
                      >Date & Time Creation
                    </label>
                    <input
                      id="createDate"
                      name="createDate"
                      type="text"
                      class="form-control validate"
                    />
                  </div>
                -->
              </div>
              <!-- 
              <script>
                var time = new Date();
                var date = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate();
                var today= time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
                var dateTime = date+' '+today;
                document.getElementById("createDate").value = dateTime;
              </script>
              -->
              <input type="hidden" name="pcid" value="<?php echo $row['pdCat_id'];?>">
              </div>
              <?php
            }
              ?>
              <div class="col-12">
                <button type="submit" name="edit_catPd" class="btn btn-primary btn-block text-uppercase">Edit Product Category Now</button>
              </div>
              <br>
              <div class="col-12">
                <button id="backPCat" class="btn btn-primary btn-block text-uppercase"><a href="cat.php">Back</a></button>
              </div>
            </form>

            <?php
              $msg= " ";
              if(isset($_POST['edit_catPd']))
              {
                $cat_pdName = $_POST['catName'];
                $cat_pdDesc = $_POST['catDesc'];
                //$dateCreate = $_POST['createDate'];
                $id = $_POST['pcid'];
                $sql2="UPDATE product_cat SET 
                      pdCat_name= '".$cat_pdName."',
                      pdCat_desc= '".$cat_pdDesc."'
                      WHERE pdCat_id = '$id' ";

                $result = mysqli_query($conn, $sql2);
                if($result)
                {
                    echo '<script type="text/javascript">';
                echo ' alert("Successfully edit!")';  //not showing an alert box.
                echo '</script>';
              
              ?>
              <script type="text/javascript">
                window.location.href = 'cat.php';
              </script>
              <?php
                }else{
                  echo"error".$sql."<br>".mysqli_error($conn);
                }
              }

              //connection closed
              mysqli_close($conn);
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
          <!--
          <p class="text-center text-white mb-0 px-4 small">
            Copyright &copy; <b>2022</b> All rights reserved. 
            
            Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p> -->
        </div>
    </footer> 

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      $(function() {
        $("#expire_date").datepicker();
      });
    </script>
  </body>
</html>
