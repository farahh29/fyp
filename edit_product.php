<?php
session_start();
include ("include/connect.php");

?>
<?php
   if(isset($_POST["edit_product"])){
    $msg="";
    $pdID = $_POST['pd_id'];
    //$pdName = $_POST['pdName'];
    //$pdDesc = $_POST['pdDesc'];
    //$pdPrice = $_POST['pdPrice'];
    //$expdate = $_POST['expdate'];
    //$pdStock = $_POST['pdStock'];

    $sql = "UPDATE product SET
            pd_name= '$_POST[pdName]',
            pd_desc= '$_POST[pdDesc]',
            pd_price = '$_POST[pdPrice]',
            pd_expdate = '$_POST[expdate]',
            pd_stock = '$_POST[pdStock]'
            WHERE pd_id=  '$pdID' ";

      $sql_run = mysqli_query($conn, $sql);


      if(!mysqli_query($conn, $sql))
      {
        print "query failed: $sql \n\n<br />" . mysqli_error();
        
      } else{
          echo '<script type="text/javascript">';
          echo ' alert("Product information updated!")';  //not showing an alert box.

          echo '</script>';
          ?>
          <script type="text/javascript">
            window.location.href = 'products.php';
          </script>
          <?php
          //echo"error".$sql_run."<br>".mysqli_error($conn);
          }
      }
  ?>
  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Seller - Edit Product</title>
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
   
  </head>

  <body>
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="#">
          <h1 class="tm-site-title mb-0"><?php
                if (isset($_SESSION["seller_id"])) {

                   echo  $_SESSION["seller_name"]  ;
                 
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
                <h2 class="tm-block-title d-inline-block">Edit Product</h2>
              </div>
            </div>
            <?php
              /*$pdID = 0;
              if(isset($_GET['pdID']) && is_numeric($_GET['pdID'])){
                $pdID = $_GET['pdID'];
                //change value pdID;
              }*/
              //$pdID = $_SESSION['pdID'];
            $pdID = (isset($_GET['id']) ? $_GET['id'] : null);
              $sql_pd = "SELECT * FROM product WHERE pd_id= '$pdID'";
              $res_pd = mysqli_query($conn, $sql_pd);
              

               if (mysqli_num_rows($res_pd)>0) {
                $row = mysqli_fetch_assoc($res_pd);
                // code...

            ?>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form method="post" action="edit_product.php" class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <input type="hidden" name="pd_id" value="<?php echo $pdID;?>">
                    <label for="pdName">Product Name </label>
                    <input type="text" name="pdName" value="<?php echo $row['pd_name'];?>" class="form-control validate">
                  </div>
                  <div class="form-group mb-3">
                    <label for="pdDesc">Description</label>
                    <textarea class="form-control validate tm-small" rows="2" name="pdDesc"> <?php echo $row['pd_desc'];?> </textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label for="pdPrice">Product Price</label>
                    <input type="number" name="pdPrice" value="<?php echo $row['pd_price'];?>" class="form-control validate" required>
                  </div>
                  <div class="row">
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label for="expdate">Expire Date</label>
                          <input type="date" name="expdate" value="<?php echo $row['pd_expdate'];?>" class="form-control validate" data-large-mode="true" >
                      </div>
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                        <label for="pdStock">Units In Stock</label>
                        <input type="number" name="pdStock" value="<?php echo $row['pd_stock'];?>" class="form-control validate">
                      </div>
                  </div>

                   <?php
                    }
                    
                  ?>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                <div class="tm-product-img-edit mx-auto">
                  <img src="<?php echo $row['pd_img'];?>" alt="Product image" class="img-fluid d-block mx-auto">
                  
                </div>
                
              </div>
                  
              <div class="col-12">
                <button type="submit" name="edit_product" class="btn btn-primary btn-block text-uppercase">Update Now</button>
              </div>
              
            </form>
         
            <br><br><br>
              <div class="col-12">
                <button id="backPd" class="btn btn-primary btn-block text-uppercase">Back</button>
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
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    
    <script type="text/javascript">
    document.getElementById("backPd").onclick = function () {
        location.href = "products.php";
    };
</script>
  </body>
</html>
