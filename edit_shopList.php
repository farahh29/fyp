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
              <a class="nav-link " href="cat.php">
                <i class="far fa-folder" aria-hiddent="true"></i> Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="seller_list.php">
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
                <h3 class="tm-block-title d-inline-block">Edit Shop Information</h3>
              </div>
            </div>
            <?php 

            $id = (isset($_GET['sid']) ? $_GET['sid'] : null);
            //$sql= "SELECT * FROM seller WHERE seller_id= '$id'";
            
            $sql = "SELECT s.seller_id, s.seller_cat, sc.shopCat_name, s.seller_name, s.seller_img      
                      FROM seller as s 
                      INNER JOIN  shop_cat as sc 
                      ON s.seller_cat = sc.shopCat_id WHERE s.seller_id = '$id' ";
            $rs=mysqli_query($conn, $sql);

            while($row=mysqli_fetch_array($rs)){

            ?>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form method="post" action="edit_shopList.php" class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >Shop Name
                    </label>
                    <input
                      id="name"
                      name="shopName"
                      type="text"
                      class="form-control validate"
                      value= "<?php echo $row['seller_name'];?>"
                      required
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="pd_cat"
                      >Product Category</label
                    >
                    <select
                      name="shopCat"
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
                        <option value="<?php echo $row['seller_cat'];?>" disable selected><?php echo $row['shopCat_name'];?></option>
                        <?php
                            $sql = "SELECT * FROM `shop_cat`";
                            $all_cat = mysqli_query($conn,$sql);
                            // use a while loop to fetch data
                            // from the $all_cat variable
                            // and individually display as an option
                            while ($category = mysqli_fetch_array(
                                    $all_cat,MYSQLI_ASSOC)):;
                        ?>
                        
                        <option value="<?php echo $category["shopCat_id"];
                            // The value we usually set is the primary key
                            //seller_cat = shopCat_id
                        ?>" >
                            <?php echo $category["shopCat_name"];
                                // To show the category name to the user
                            ?>
                        </option>
                        <?php
                            endwhile;
                            // While loop is terminated
                        ?>
                    </select>
                  </div>
                  
              </div>
              
              <input type="hidden" name="sid" value="<?php echo $row['seller_id'];?>">
              </div>
              <?php
            }
              ?>
              <div class="col-12">
                <button type="submit" name="edit_shop" class="btn btn-primary btn-block text-uppercase">Edit Shop Information Now</button>
              </div>
              <br>
              <div class="col-12">
                <button id="backPCat" class="btn btn-primary btn-block text-uppercase"><a href="seller_list.php">Back</a></button>
              </div>
            </form>

            <?php
              $msg= " ";
              if(isset($_POST['edit_shop']))
              {
                $shopName = $_POST['shopName'];
                $shopCat = $_POST['shopCat'];
                //$dateCreate = $_POST['createDate'];
                $id = $_POST['sid'];
                $sql2="UPDATE seller SET 
                      seller_name= '".$shopName."',
                      seller_cat= '".$shopCat."'
                      WHERE seller_id = '$id' ";

                $result = mysqli_query($conn, $sql2);
                if($result)
                {
                    echo '<script type="text/javascript">';
                echo ' alert("Successfully edit!")';  //not showing an alert box.
                echo '</script>';
              
              ?>
              <script type="text/javascript">
                window.location.href = 'seller_list.php';
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
        
    </footer> 

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
