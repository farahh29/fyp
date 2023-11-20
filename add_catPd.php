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
                <h3 class="tm-block-title d-inline-block">Add Product Category</h3>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form method="post" action="add_catPd.php" class="tm-edit-product-form">
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
                      rows="3"
                      name = "catDesc"
                      required
                    ></textarea>
                  </div>
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
                    readonly />
                  </div>
              </div>
              <script>
                var time = new Date();
                var date = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate();
                var today= time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
                var dateTime = date+' '+today;
                document.getElementById("createDate").value = dateTime;
              </script>
              
              </div>
              <div class="col-12">
                <button type="submit" name="add_catPd" class="btn btn-primary btn-block text-uppercase">Add Product Category Now</button>
              </div>
              <br>
              
            </form>
            <div class="col-12">
                <button id="backCat" class="btn btn-primary btn-block text-uppercase">Back</button>
              </div>
            <?php
              $msg= " ";
              if(isset($_POST['add_catPd']))
              {
                $cat_pdName = $_POST['catName'];
                $cat_pdDesc = $_POST['catDesc'];
                $dateCreate = $_POST['createDate'];

                $query_check="SELECT * FROM product_cat WHERE pdCat_name = '$cat_pdName' LIMIT 1 ";
                $result = mysqli_query($conn, $query_check);

                if (mysqli_num_rows($result) == 1) {
                  echo "<p><b>Error:</b> Product Category Exist, unable to add</p>";
                } else{
                  $sql="INSERT INTO product_cat (pdCat_id,pdCat_name,pdCat_desc, creation_date) 
                    VALUES('', '$cat_pdName','$cat_pdDesc', '$dateCreate') ";
                  $rs = mysqli_query($conn, $sql);
                  if($rs)
                  {
                      echo '<script type="text/javascript">';
                  echo ' alert("New shop category added")';  //not showing an alert box.
                  echo '</script>';
                  ?>
                    <script type="text/javascript">
                      window.location.href='cat.php';
                    </script>
                  <?php
                
                  }else{
                    echo"error".$sql."<br>".mysqli_error($conn);
                  }
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
        
    </footer> 

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    
    <script type="text/javascript">
    document.getElementById("backCat").onclick = function () {
        location.href = "cat.php";
    };
</script>
  </body>
</html>
