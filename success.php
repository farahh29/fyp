<?php 
session_start();
include("include/connect.php");
//$_SESSION['success']= $success;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>

    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <style type="text/css">
        button{
            padding: 10px;
            font-size: 20px;
            background-color: whitesmoke;
            border-radius: 10px;
        }
    </style>

</head>
<body>
<main id="cart-main">

    <div class="site-title text-center">
        <div><img src="./img/checked.png" alt=""></div>
        <h1 class="font-title">Payment Done Successfully...!</h1>
        <?php 
            $id = (isset($_GET['oid']) ? $_GET['oid'] : null);
        ?>
        <form action="success.php" method="post">
            <input type="hidden" name="oid" value="<?php echo $id;?>">
            <button type="submit" name="ord">Continue to order</button>
        </form>

        <?php
            if (isset($_POST['ord'])) {
                $oid=$_POST['oid'];
                $custID=$_SESSION["cust_id"];

                $sql="DELETE from cart WHERE cust_id = $custID";
                $rs = mysqli_query($conn, $sql);

                if(!$rs){
                    echo"error".$sql."<br>".mysqli_error($conn);
                }else{
                    echo '<script type="text/javascript">';
                    echo ' alert("Payment received. Please wait while your order is processed.")';  //not showing an alert box.
                    echo '</script>';
                            //unset($_SESSION["oid"]);
                    ?>
                    <script type="text/javascript">
                        window.location.href='cust_order.php';
                    </script>
                    <?php
                }
            } else{
                echo "";
            }
        ?>


    </div>

</main>

</body>
</html>
