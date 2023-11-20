<?php
session_start();
include ("include/connect.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin - Edit Product</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!--fa fa-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
        color: green;
        background-color: transparent;
        text-decoration: none;
      }

    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="dashboard.php">
          <h1 class="tm-site-title mb-0">ADMIN</h1>
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
              <a class="nav-link active" href="admin_dashboard.php">
                <i class="fas fa-bars"></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cat.php">
                <i class="far fa-folder"></i> Categories
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
                <h2 class="tm-block-title d-inline-block">Edit Product</h2>
              </div>
            </div>
            <?php
              //$pdID = $_GET['pdID'];
              //$pdID=$_GET['pdID'];
              $pdID = (isset($_GET['pdID']) ? $_GET['pdID'] : null);
              //$sql_pd = "SELECT * FROM product WHERE pd_id = '$pdID'  ";
              $sql_pd = "SELECT p.pd_id, p.pdCat_id, pc.pdCat_name, p.pd_name, p.pd_desc, p.pd_price, p.pd_expdate, p.pd_img, p.pd_stock      FROM product as p 
                      INNER JOIN  product_cat as pc 
                      ON p.pdCat_id = pc.pdCat_id WHERE p.pd_id = '$pdID' ";
              $res_pd = mysqli_query($conn, $sql_pd);

              if (mysqli_num_rows($res_pd)>0) {
                $row = mysqli_fetch_assoc($res_pd);
                // code...

              
            ?>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="admin_editPd.php" method="post" class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <label
                      for="new_pdName"
                      >Product Name
                    </label>
                    <input
                      id="new_pdName"
                      name="new_pdName"
                      type="text"
                      value="<?php echo $row['pd_name'];?>"
                      class="form-control validate"
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="new_pdDesc"
                      >Description</label
                    >
                    <textarea                    
                      class="form-control validate tm-small"
                      rows="3"
                      name="new_pdDesc"
                      required
                    ><?php echo $row['pd_desc'];?></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="pd_cat"
                      >Product Category</label
                    >
                    <select
                      name="new_pdCat"
                      class="custom-select tm-select-accounts"
                    >
                    <?php 
                    /*
                      $pcid = $row['pdCat_id'];
                      $sql_pdCat = "SELECT * product_cat WHERE pdCat_id = '$pcid'";
                      $res_pdCat = mysqli_query($conn, $sql_pdCat);

                      if ($row=mysqli_fetch_array($res_pdCat)) {
                          $pcname= $row['pdCat_name'];
                      }*/
                    ?>
                        <option value="<?php echo $row['pdCat_id'];?>" disable selected><?php echo $row['pdCat_name'];?></option>
                        <?php
                            $sql = "SELECT * FROM `product_cat`";
                            $all_cat = mysqli_query($conn,$sql);
                            // use a while loop to fetch data
                            // from the $all_cat variable
                            // and individually display as an option
                            while ($category = mysqli_fetch_array(
                                    $all_cat,MYSQLI_ASSOC)):;
                        ?>
                        
                        <option value="<?php echo $category["pdCat_id"];
                            // The value we usually set is the primary key
                        ?>">
                            <?php echo $category["pdCat_name"];
                                // To show the category name to the user
                            ?>
                        </option>
                        <?php
                            endwhile;
                            // While loop is terminated
                        ?>
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="new_pdPrice"
                      >Product Price
                    </label>
                    <input
                      id="new_pdPrice"
                      name="new_pdPrice"
                      type="number"
                      value="<?php echo $row['pd_price'];?>"
                      class="form-control validate"
                      required
                    />
                  </div>
                  <div class="row">
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="new_expdate"
                            >Expire Date
                          </label>
                          <input
                            id="new_expdate"
                            name="new_expdate"
                            type="date"
                            value="<?php echo $row['pd_expdate'];?>"
                            class="form-control validate"
                            data-large-mode="true"
                          />
                        </div>
                        <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="new_pdStock"
                            >Units In Stock
                          </label>
                          <input
                            id="new_pdStock"
                            name="new_pdStock"
                            type="number"
                            value="<?php echo $row['pd_stock'];?>"
                            class="form-control validate"
                          />
                        </div>
                  </div>

                  
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                <div class="tm-product-img-edit mx-auto">
                  <img src="<?php echo $row['pd_img'];?>" alt="Product image" class="img-fluid d-block mx-auto">
                  
                </div>
               
              </div>
                  <?php
                    }
                    
                  ?>
              <div class="col-12">
                <button type="submit" name = "edit_pd" class="btn btn-primary btn-block text-uppercase">Update Now</button>
              </div>
              <input type="hidden" name="pdID" value="<?php echo $row['pd_id'];?>">
              <br><br><br>
              <div class="col-12">
                <button  class="btn btn-primary btn-block text-uppercase"><a href = "admin_dashboard.php">Back</a></button>
              </div>
            </form>
            <?php
              $msg="";
              if(isset($_POST['edit_pd']))
              {
                $new_pdName = $_POST['new_pdName'];
                $new_pdDesc = $_POST['new_pdDesc'];
                $new_pdPrice = $_POST['new_pdPrice'];
                $new_expdate = $_POST['new_expdate'];
                $new_pdStock = $_POST['new_pdStock'];
                $new_pdCat = $_POST['new_pdCat'];
                $pdID = $_POST['pdID'];
                $pdCat=$_POST['new_pdCat'];
                $sql_editPd = "UPDATE product set
                              pd_name='$new_pdName', 
                              pd_desc='$new_pdDesc',
                              pdCat_id='$new_pdCat', 
                              pd_price = '$new_pdPrice',
                              pd_expdate = '$new_expdate', 
                              pd_stock='$new_pdStock' 
                              WHERE pd_id= $pdID";

                $query = "SET FOREIGN_KEY_CHECKS=0";
                $disabled_foreign_key = mysqli_query($conn,$query);

                $sql_run = mysqli_query($conn, $sql_editPd);

                if($sql_run)
                {
                  echo '<script type="text/javascript">';
                  echo ' alert("Product information updated!")';  //not showing an alert box.
                  echo '</script>';
                  ?>
                  <!--Redirect page to product-->
                    <script type="text/javascript">
                      window.location.href = 'admin_dashboard.php';
                    </script>
                <?php
                }else{
                  echo"error".$sql."<br>".mysqli_error($conn);
                }
              }
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
    
    
    
  </body>
</html>