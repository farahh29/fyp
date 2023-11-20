<?php
session_start();
include("include/connect.php");

if (!isset($_SESSION['seller_id'])) {
  header('location:seller_login.php');
}
    if (isset($_GET['delID'])) {
    $pd_id=$_GET['delID'];

    // sql to delete a record
    $sql = "DELETE FROM product WHERE pd_id=$pd_id";

    if ($conn->query($sql) === TRUE) {
       header("Location: products.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    //$conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Seller - Product Page</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="#">
          <h1 class="tm-site-title mb-0"><?php
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
    <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products"> <!-- container for table -->
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">IMAGE</th>
                    <th scope="col">ID</th>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">IN STOCK</th>
                    <th scope="col">EXPIRE DATE</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <?php

                  if (isset($_SESSION['seller_id'])) {
                    
                    $shopID = $_SESSION['seller_id'];
                    $query = " SELECT * FROM product WHERE shop_id = '".$shopID."' ";
                    $result = mysqli_query($conn,$query);

                    if (mysqli_num_rows($result)>0) {
                      while($rows = mysqli_fetch_array($result))
                      {
                       
                  ?>

               <tbody>
                  <tr>
                    <td>
                        <img src="<?php echo $rows['pd_img'] 
                         ?>"  style= "width:50px; height:50px;" class="img-responsive" />
                    </td>
                    <td ><?php echo $rows['pd_id'];?></td>
                    <td class="tm-product-name"><?php echo $rows['pd_name'];?></td>
                    <td>RM <?php echo $rows['pd_price'];?></td>
                    <td><?php echo $rows['pd_stock'];?></td>
                    <td><?php echo $rows['pd_expdate'];?></td>
                    <td>
                      <a href="edit_product.php?id=<?php echo $rows['pd_id']; ?>" class="tm-product-edit-link">
                        <i class="far fa-edit tm-product-edit-icon"></i>
                      </a>
                    </td>
                    <td>
                      <a href="products.php?delID=<?php echo $rows['pd_id'];?>" class="tm-product-delete-link" onclick="return confirm('Are you sure to delete this product?')">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>

                  </tr>
                  <?php
                    //close while loop
                    }
                  }//close if loop
                }//close isset
                  ?> 
                </tbody>
              </table>
            </div>
            <!-- table container -->
            <a
              href="add_product.php"
              class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
          </div>
        </div>

        
        <!--Product Categories-->
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
            <h2 class="tm-block-title">Product Categories</h2>
            <div class="tm-product-table-container">
              <table class="table tm-table-small tm-product-table">
                <?php
                    $query = " SELECT * FROM product_cat ";
                    $result = mysqli_query($conn,$query);
                    //PHP CODE TO FETCH DATA FROM ROWS
                    //LOOP TILL END OF DATA

                        while($rows = mysqli_fetch_array($result))
                        {
                ?>
                <tbody>
                  <tr>
                    <td  class="tm-product-cat"><?php //echo $rows['pdCat_id']; ?>&nbsp;&nbsp;&nbsp; <?php echo $rows['pdCat_name']; ?> </td>
                    <td class="text-center">
                      
                    </td>
                  </tr>
                 <?php
                      }
                 ?>
                  
                </tbody>
              </table>
            </div>
           
          </div>
        </div> <!--Product Categories-->
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

