<?php
session_start();
if(isset($_SESSION["cust_id"])){
	unset($_SESSION["cust_id"]);
	unset($_SESSION["cust_name"]);
	//unset($_SESSION["cart_item"]);
	header("location:index.php");
}	
?>

