<?php
    ob_start();
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
    include_once('functions/functions.php');
    include("functions/form_functions.php");
    $user = $_SESSION['admin']; 
    confirm_logged_in();
	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	//edit qty

	$del_sql = "DELETE FROM sales_order WHERE transaction_id={$id}";
    $del_query = mysqli_query($db_connect, $del_sql);
    if($del_query){
        header("location: Dashboard.php?page=pages/retail_sales&id=$sdsd&invoice=$c&prod_id=&client_id=");
    }
?>