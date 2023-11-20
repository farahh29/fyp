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
    <title>Seller - Add Product</title>
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
          <h1 class="tm-site-title mb-0">
            <?php
                if (isset($_SESSION["seller_id"])) {

                   echo  $_SESSION["seller_name"]  ;
                  // Echo session variables that were set on previous page
                 }
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
              <a class="nav-link active" href="products.php">
                <i class="fas fa-bars"></i> Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="seller_account.php">
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
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Add Product</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form method="post" action="add_product.php" enctype="multipart/form-data"
                class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <label
                      for="pd_name"
                      >Product Name
                    </label>
                    <input
                      id="pd_name"
                      name="pd_name"
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
                      name="pd_desc";
                      class="form-control validate"
                      rows="2"

                    ></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="pd_price"
                      >Product Price
                    </label>
                    <input
                      id="pd_price"
                      name="pd_price"
                      type="number"
                      class="form-control validate"
                      required
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="pd_cat"
                      >Product Category</label
                    >
                    <select
                      name="pd_cat"
                      class="custom-select tm-select-accounts"
                    >
                        <option value="" disable selected>Select category</option>
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
                  <div class="row">
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="expire_date"
                            >Expire Date
                          </label>
                          <input
                            id="expire_date"
                            name="expire_date"
                            type="date"
                            class="form-control validate"
                            data-large-mode="true"
                          />
                        </div>
                        <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="stock"
                            >Units In Stock
                          </label>
                          <input
                            id="pd_stock"
                            name="pd_stock"
                            type="number"
                            class="form-control validate"
                            required
                          />
                        </div>
                  </div>
                  
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                <div>
                    <label for="pd_img">Upload Product Image</label>
                    <input
                      type="file"
                      name="fileToUpload"
                      id="fileToUpload"
                      required
                    >
                  </div>
              </div>
              <div class="col-12">
                <button type="submit"name="add_product" class="btn btn-primary btn-block text-uppercase">Add Product Now</button>
              </div>
            </form>
            <br><br><br>
            <div class="col-12">
                    <a href = "products.php"><button
                      class="btn btn-primary btn-block "
                      type="submit" name="backPd"
                    >
                      BACK
                    </button></a>
                  </div>
                  
            <?php
              if (isset($_SESSION['seller_id'])) {
                $msg= " ";
                if(isset($_POST['add_product']))
                {
                  $sellerID = $_SESSION['seller_id'];
                  $target="img/product/".basename($_FILES["fileToUpload"]["name"]);
                  $pdName = $_POST['pd_name'];
                  $pdDesc = $_POST['pd_desc'];
                  $selected = $_POST['pd_cat'];
                  $expDate = $_POST['expire_date'];
                  $pdPrice = $_POST['pd_price'];
                  $pdStock = $_POST['pd_stock'];
                  $pdPic = $_FILES['fileToUpload']['name'];
                  
                  $query = "SET FOREIGN_KEY_CHECKS=0";
                  $disabled_foreign_key = mysqli_query($conn,$query);

                  $pd_check_query = "SELECT * FROM product WHERE pd_name='$pdName' AND pd_desc='$pdDesc' LIMIT 1";
                  $result = mysqli_query($conn, $pd_check_query);
                  $product = mysqli_fetch_assoc($result);

                  if(mysqli_num_rows($result) == 1)
                  {
                      echo "<p><b>Error:</b> Product Exist, cannot add product</p>";
                  } else {

                    $sql="INSERT INTO product (pd_id,shop_id,pdCat_id, pd_name,pd_desc,pd_price,pd_expdate,pd_img,pd_stock, status) 
                      VALUES('', '$sellerID ','$selected','$pdName','$pdDesc','$pdPrice', '$expDate','$target','$pdStock', '1') ";

                    $rs = mysqli_query($conn, $sql);

                    if($rs)
                    {
                      echo '<script type="text/javascript">';
                      echo ' alert("New product added")';  //not showing an alert box.
                      echo '</script>';
                      ?>
                      <script type="text/javascript">
                        window.location.href ='products.php';
                      </script>
                      <?php
                    }else{
                      echo"error".$sql."<br>".mysqli_error($conn);
                    }
                }//else num row
              }//if num row
                //connection closed
                mysqli_close($conn);
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
