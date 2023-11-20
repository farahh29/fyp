<?php
include("include/connect.php");


if (isset($_GET['delID'])) {
    $pdCat_id=$_GET['delID'];

    // sql to delete a record
    $sql = "DELETE FROM product_cat WHERE pdCat_id=$pdCat_id";

    if ($conn->query($sql) === TRUE) {
       header("Location: cat.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin - Categories</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
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
    <div class="container mt-5" style="margin:0px 700px;">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products"> <!-- container for table -->
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Shop Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">&nbsp;</th>
                    
                  </tr>
                </thead>
                <?php
                  $query = " SELECT * FROM shop_cat";
                  $result = mysqli_query($conn,$query);

                  while($rows = mysqli_fetch_array($result))
                  {
                ?>
                <tbody>
                  <tr>
                    <th scope="row"><?php echo $rows['shopCat_id'];?></th>
                    <td class="tm-catShop-name" ><?php echo $rows['shopCat_name'];?></td>
                    <td><?php echo $rows['shopCat_desc'];?></td>
                    <!--edit shop category-->
                    <td>
                      <a href="admin_editSCat.php?sid=<?php echo $rows['shopCat_id']; ?>" class="tm-product-edit-link">
                        <i class="far fa-edit tm-product-edit-icon"></i>
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
          
          </div>
        </div>
        <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products"> <!-- container for table -->
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
               
                <?php
                    // SQL query to select data from database
                    $sql = " SELECT * FROM product_cat ";
                    $rs = mysqli_query($conn,$sql);
                    
                  
                    //PHP CODE TO FETCH DATA FROM ROWS
                    //LOOP TILL END OF DATA

                        while($rows = mysqli_fetch_array($rs)){

                    ?>
                <tbody>
                  <tr>
                    <th scope = "row"><?php echo $rows['pdCat_id']; ?></th>
                    <td class="tm-catPd-name"><?php echo $rows['pdCat_name']; ?></td>
                    <td><?php echo $rows['pdCat_desc']; ?></td>
                    <!--edit product category-->
                    <td>
                      <a href="admin_editPCat.php?pid=<?php echo $rows['pdCat_id']; ?>" class="tm-product-edit-link">
                        <i class="far fa-edit tm-product-edit-icon"></i>
                      </a>
                    </td>
                    <td>
                      <a href="cat.php?delID=<?php echo $rows['pdCat_id'];?>" class="tm-product-delete-link" onclick="return confirm('Confirm to delete this product category?')">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <?php
                        } //close while product
                  ?>
                </tbody>
                
              </table>
            </div>
            <!-- table container -->
            <a
              href="add_catPd.php"
              class="btn btn-primary btn-block text-uppercase mb-3">Add new product category</a>
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