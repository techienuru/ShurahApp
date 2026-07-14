<?php
ob_start();
include_once('includes/sessions.php');
include_once('includes/db_connect.php');
include_once('functions/functions.php');
$user = $_SESSION['admin']; 
confirm_logged_in();

if (isset($_POST['submit'])) {
    $prod_code = trim(mysqli_real_escape_string($db_connect, $_POST['prod_code']));
    $cost_price = trim(mysqli_real_escape_string($db_connect, $_POST['cost_price']));
    $selling_price = trim(mysqli_real_escape_string($db_connect, $_POST['selling_price']));
    $barcode = trim(mysqli_real_escape_string($db_connect, $_POST['barcode']));
}

$_SESSION['update_id'] = trim(mysqli_real_escape_string($db_connect, $_POST['update_id']));
$date = date("Y-m-d");
$bulk_update_id = $_SESSION['update_id'];

$query = "SELECT * FROM product 
          LEFT JOIN category ON product.category_id = category.category_id 
          WHERE product.prod_code = '{$prod_code}' OR product.prod_code = '{$barcode}'";

$prod_set = mysqli_query($db_connect, $query);
$prodList_rs = mysqli_fetch_assoc($prod_set);

if (empty($prodList_rs)) {
    $error = "No product is selected, Kindly select a product and proceed";
    header("location:dashboard.php?page=pages/bulk_update_product_pricelist&update_id=$bulk_update_id&prod_id=&error={$error}");
    exit();
} else {
    $prod_id = $prodList_rs['prod_id'];
    $prod_code = $prodList_rs['prod_code'];
    $ctn_num = $prodList_rs['ctn_num'];
    $name = $prodList_rs['prod_name'];
    $categ = $prodList_rs['category_name'];
    $category_id = $prodList_rs['category_id'];
    $qty_left = $prodList_rs['qty_left'];
    $cost_price1 = $prodList_rs['cost_price'];
    $selling_price1 = $prodList_rs['selling_price'];

    // Check if cost_price or selling_price is empty or 0
    if (empty($cost_price) || $cost_price == 0) {
        $cost_price = $cost_price1;
    }
    if (empty($selling_price) || $selling_price == 0) {
        $selling_price = $selling_price1;
    }

    // Insert query
    $query = "INSERT INTO update_product_price_list_order 
              (update_product_id, prod_code, name, cost_price, selling_price, category, date) 
              VALUES 
              ('{$bulk_update_id}', '{$prod_code}', '{$name}', '{$cost_price}', '{$selling_price}', '{$categ}', '{$date}')";

    $result = mysqli_query($db_connect, $query);

    if ($result) {
        header("location:dashboard.php?page=pages/bulk_update_product_pricelist&update_id=$bulk_update_id&prod_id=");
    } else {
        echo "Unable to insert";
    }
}
?>
