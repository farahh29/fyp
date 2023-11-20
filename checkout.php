<?php
session_start();
include("include/connect.php");
?>

<?php
    if(isset($_POST['username']))
    {
      $custID = $_SESSION['cust_id'];
      $cust_name = $_POST['cust_name'];

      $sql = "UPDATE customer SET cust_name = '$cust_name' WHERE cust_id=$custID";

      $edit = mysqli_query($conn, $sql);
       if($edit)
     {
        echo '<script type="text/javascript">';
        echo ' alert("Customer information updated")';  //not showing an alert box.
        echo '</script>';
            header('location: checkout.php');
        }else{
          echo"error".$sql."<br>".mysqli_error($conn);
        }

    }
?>

<?php
    if(isset($_POST['contact']))
    {
      $custID = $_SESSION['cust_id'];
      $cust_no = $_POST['cust_no'];

      $sql = "UPDATE customer SET cust_no = '$cust_no' WHERE cust_id=$custID";

      $edit = mysqli_query($conn, $sql);
       if($edit)
     {
        echo '<script type="text/javascript">';
        echo ' alert("Customer information updated")';  //not showing an alert box.
        echo '</script>';
            header('location: checkout.php');
        }else{
          echo"error".$sql."<br>".mysqli_error($conn);
        }

    }
?>

<?php
    if(isset($_POST['addr']))
    {
      $custID = $_SESSION['cust_id'];
      $cust_addr = $_POST['cust_addr'];

      $sql = "UPDATE customer SET cust_address = '$cust_addr' WHERE cust_id=$custID";

      $edit = mysqli_query($conn, $sql);
       if($edit)
     {
        echo '<script type="text/javascript">';
        echo ' alert("Customer information updated")';  //not showing an alert box.
        echo '</script>';
            header('location: checkout.php');
        }else{
          echo"error".$sql."<br>".mysqli_error($conn);
        }

    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ranau Groceries</title>
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
    <script src="https://kit.fontawesome.com/9a93df3d22.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link  rel="stylesheet" href="css/cust-style.css" />
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">-->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style type="text/css">
      a{
        color: white;
        text-decoration: none;
      }
    </style>
  
</head>
<body> 

  <div class="container" >
  <!-- Top box -->
    <!-- Logo & Site Name -->
    <div class="placeholder">     
      <div class="parallax-window" data-parallax="scroll" data-image-src="img/header.jpg">
        <div class="tm-header">
          <div class="row tm-header-inner">
            <div class="col-md-6 col-12">
              
              <div class="tm-site-text-box">
                <h1 class="tm-site-title">Centralized </h1>
                <h6 class="tm-site-description">Online Grocery Shopping in Ranau</h6> 
              </div>
            </div>
            <nav class="col-md-6 col-12 tm-nav">
              <ul class="tm-nav-ul">
                <ul class="tm-nav-ul">
                  <li class="tm-nav-li"><a href="index.php" class="tm-nav-link ">Home</a></li>
                        <li class="tm-nav-li"><a href="cust_order.php" class="tm-nav-link">Orders</a></li>
                        <li class="tm-nav-li "><a href="cart.php" class="tm-nav-link active">Cart</a></li>
                        <?php 
                        if(isset($_SESSION['cust_id']))
                        {
                          ?>
                          <li class="tm-nav-li"><a href="cust_profile.php" class="tm-nav-link">Profile</a></li>
                          <li class="tm-nav-li"><a href="logout.php" class="tm-nav-link">Logout</a></li>
                          
                          <?php
                        }else {
                          ?>
                          <li class="tm-nav-li"><a href="cust_login.php" class="tm-nav-link">Login</a></li>

                          <?php
                        }
                          
                         ?>
                          <li class="tm-nav-li"><a href="review.php" class="tm-nav-link ">Review</a></li>
              </ul>
              </ul>
            </nav>  
          </div>
        </div>
      </div>
    </div>

    <main>
      <header class="row tm-welcome-section">
        <h2 class="col-12 text-center tm-section-title">Checkout</h2>
        
      </header>
    <!-- Left containcer -->

    <div style=" float: left; width:70%; border: 1px solid #aaa; padding: 1rem; box-sizing: border-box;  " >

      <?php
        if (isset($_SESSION['cust_id'])) {
          $custID = $_SESSION['cust_id'];

          $sql = "SELECT * FROM customer WHERE cust_id = $custID";
          $sql_run = mysqli_query($conn, $sql);

          if(mysqli_num_rows($sql_run)>0)
            while ($row = mysqli_fetch_assoc($sql_run)) {
      ?>
      <form action="checkout.php" method="post">
        <div >
            <label for="uname"><b>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label> 
            <br>
            <div class="buttonIn">
              <input type="text" placeholder="Enter Full Name" name="cust_name" value = "<?php echo $row['cust_name'];?>"required>
              <button type="submit" name="username" class="button-edit"><i class="fa-solid fa-pen-to-square edit-icon"></i></button> 
            </div>
            <br><br>

            <label for="contactNo"><b><br><br>Contact No</b></label>
            <div class="buttonIn">
              <input type="number" placeholder="Enter Contact Number" name="cust_no" value = "<?php echo $row['cust_no'];?>"required>
              <button type="submit" name="contact" class="button-edit"><i class="fa-solid fa-pen-to-square edit-icon"></i></button> 
            </div><br><br>

            <label for="custAddr"><b><br><br>Delivery Address</b></label>
            <div class="buttonIn">
              <input type="text" placeholder="Enter Address" name="cust_addr" value = "<?php echo $row['cust_address'];?>"required>
              <button type="submit" name="addr" class="button-edit"><i class="fa-solid fa-pen-to-square edit-icon"></i></button>
            </div>
            <br><br><br>
            <label for="payMethod"><b><br><br><br>Payment Method</b></label>
            <br>
            <form action="checkout.php" method="post">
              <input type="radio" id="cod" name="payMethod" value="Cash on Delivery" required>
              <label for="cod">Cash on Delivery</label><br>
              <input type="radio" id="qr" name="payMethod" value="QrCode">
              <label for="cod">QrCode</label><br>
              <input type="radio" id="paypal" name="payMethod" value="Paypal">
              <label for="cod">Paypal</label><br>

              <!-- <input type="submit" name="opt" value="Get Values"> -->
            </form>
           <?php
           /*test output
            if(isset($_POST['opt'])){
              if(!empty($_POST['payMethod'])){
                echo ' ' . $_POST['payMethod'];
              } else{
                echo 'Please select Payment Method.';
              }
              }
              */
           ?>

             <input id="createDate" name="createDate" type="hidden"/>

           <script>
                var time = new Date();
                var date = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate();
                var today= time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
                var dateTime = date+' '+today;
                document.getElementById("createDate").value = dateTime;
              </script>
         <br><br><br>

            <button type="submit" name ="order" class="button-reg" onclick="return confirm('Are you sure you want to confirm order?')">Confirm Order</button>
          </form>

            <form action="cart.php">
              <button type="submit" class="button-login"><a href="cart.php">VIEW CART</a></button>
            </form>
        </div>
      

    </div>
    <?php
        }
      } 
    ?>



    <!-- Right containcer -->
      <div style="float: right; width:30%;  border: 1px solid #aaa; padding: 1rem; box-sizing: border-box; " >
        <div class="summary-total-items"><span class="total-items"></span> Order Summary</div>
        <div class="summary-subtotal">
          <div class="subtotal-title">Item </div> <br>

             <?php
             
              if(isset($_SESSION['cust_id']))
              {
                $custID = $_SESSION['cust_id'];
                $cartTotal=0;

                $sql = "SELECT * FROM product, cart WHERE product.pd_id = cart.pd_id AND cart.cust_id = $custID ";
                $sql_run = mysqli_query($conn,$sql);

                //$cart = "SELECT * FROM cart WHERE cust_id = $custID";
                //$rows = mysqli_query($conn,$cart);

               if (mysqli_num_rows($sql_run)>0) {
                while($row = mysqli_fetch_assoc($sql_run)) {
                
             ?>
             <div class="item" style="width:auto;">
              <table>
                <thead>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </thead>
                <tbody>
                   <tr>
                      <td><img name = "pd_img" src="<?php echo $row['pd_img']; ?>" alt=" " style="border: 1px solid #aaa; width: 100px; height: 100px;"></td>
                      <?php 
                        
                        $qty = $row['quantity'];
                        $sub = $row['subtotal'];
                        $cartTotal = $cartTotal + $sub;
                        
                      ?>
                      <td class="product-details"><?php echo $row['pd_name'];?><br>x<?php echo $row['quantity'];?><br>RM <?php echo $row['subtotal'];?></td> 
                  </tr>
                      
                </tbody>
           
            </table>
          <?php
            
           } 
         }
       }
        ?>
          </div>
          <div class="subtotal-value final-value" id="basket-subtotal"></div>
          
         
        
        <div class="summary-total">
          <div class="total-title">Total</div>
          <div style="float: right;" id="basket-total">RM <?php echo number_format($cartTotal,2); ?></div>
        </div>
      </div>
<?php 
      if (isset($_POST['order'])) {
        $msg = "";
        $ord_amt = $cartTotal;
        $custID = $_SESSION['cust_id'];
        $payMethod = $_POST['payMethod'];
        $deliveryAddr = $_POST['cust_addr'];
        $ordDate = $_POST['createDate'];
        $ord_status = "Pending";
        $payStatus = "Pending";

        
          //insert into ordination(order) table
          $sql = "INSERT INTO ordination (ord_id, cust_id, ord_date, ord_amt, pay_method, pay_status, ord_status) VALUES ('', '$custID', '$ordDate', '$ord_amt', '$payMethod', '$ord_status', '$ord_status')";
          $rs = mysqli_query($conn, $sql);

          if ($rs) {  
            $ordID = mysqli_insert_id($conn);
            //header('location: cust_order.php');
          } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          } 

          //insert into ord_product information
          $sql_pd = "SELECT * FROM product, cart WHERE cart.pd_id=product.pd_id AND cart.cust_id = $custID ";
          $sql_pd_run = mysqli_query($conn, $sql_pd);

          while($row = mysqli_fetch_array($sql_pd_run, MYSQLI_ASSOC)):; 
                $qty = $row['quantity'];
                $pdID = $row['pd_id'];

                  $ord_pd = "INSERT into ord_product (pd_id, ord_id, cust_id, ord_date, quantity) VALUES ('$pdID', '$ordID', '$custID', '$ordDate', '$qty')";
                  $ord_pd_run = mysqli_query($conn, $ord_pd);


             /*if($ord_pd_run)
                {
                  echo '<script type="text/javascript">';
                  //echo ' alert("Your order has been confirmed. Please wait while your order is processed.")';  //not showing an alert box.
                  echo '</script>';
                    
                  }else{
                    echo"error".$sql."<br>".mysqli_error($conn);
                  }
                */
            endwhile; // endwhile termination

            $stock="SELECT ord_product.pd_id, ord_product.quantity, product.pd_stock
                      FROM ord_product
                      INNER JOIN product ON ord_product.pd_id = product.pd_id 
                      WHERE ord_product.ord_id='$ordID';";
              $stock_run=mysqli_query($conn, $stock);

              if(mysqli_num_rows($stock_run)>0){
                while($row = mysqli_fetch_assoc($stock_run)){
                  $pdStock=$row['pd_stock'];
                  $qtyItem=$row['quantity'];
                  $pd_id=$row['pd_id'];
                  $newStock= $pdStock-$qtyItem;

                  $upd_stock="UPDATE product SET pd_stock=$newStock WHERE pd_id=$pd_id";

                  if (mysqli_query($conn, $upd_stock)) {
                    // code...
                  }else{
                    echo"error".$stock."<br>".mysqli_error($conn);

                  }//else

                }//while
                
              }//if row

            if ($payMethod=="Paypal") {
              ?>
                <script type="text/javascript">
                  window.location.href='payment.php?oid=$oid';
                </script>
              <?php
            } else{


            //delete item in cart after confirm order
            $sql_del = "DELETE FROM cart WHERE cust_id = $custID";
            $sql_del_run = mysqli_query($conn, $sql_del);
            

               // $conn->close(); 

          if($sql_del_run)
            {
              echo '<script type="text/javascript">';
              echo ' alert("Your order has been confirmed. Please wait while your order is processed.")';  //not showing an alert box.
              echo '</script>';

              //$conn->close(); 

              }else{
                echo"error".$sql."<br>".mysqli_error($conn);
                //echo"error".$sql_pd."<br>".mysqli_error($conn);
                //echo"error".$ord_pd."<br>".mysqli_error($conn);
                //echo"error".$sql_del."<br>".mysqli_error($conn);

              }  
            }
              //direct to payment page
              if ($payMethod=="QrCode") {
              $_SESSION['oid'] = $ordID;
              $_SESSION['ord_amt'] = $ord_amt;

              //header('location:qrpayment.php')
              ?>
                
                  <script type="text/javascript">
                    window.location.href = 'qrpayment.php?oid=<?php echo $ordID;?>';
                  </script>
                
              <?php
            } else{
              ?>

              <script type="text/javascript">
                window.location.href = 'cust_order.php';
              </script>

              <?php
            }
              
          //else pay method
            $conn->close(); 
          } 
    ?>
      
      
    </main>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <footer class="tm-footer text-center">
      <p></p>
    </footer>
  </div>


  
   <script src="js/main.js"></script>  
  <script src="js/jquery.min.js"></script>
  <script src="js/parallax.min.js"></script>
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->

  <script type="text/javascript">
    document.getElementById("Cart").onclick = function () {
        location.href = "cart.php";
    };
  </script>
  <script src="https://www.paypal.com/sdk/js?client-id=AXlQ2zVwlMo4dvL4Ft4w3v0juqSRkB2itsNShhhOlaSEqPTqeGUG7HgN57MeYiR6qstPwswHUxHB3gt4"></script>
  <script src="index.js"></script>
</body>
</html>

