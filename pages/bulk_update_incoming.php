<?php
    ob_start();
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
    include_once('functions/functions.php');
    $user = $_SESSION['admin']; 
    $user_iid = $_SESSION['user_id'];
    confirm_logged_in();
?>
<?php
if(isset($_POST['submit'])){
    
    $_SESSION['prod_code'] = trim(mysqli_real_escape_string($db_connect, $_POST['prod_code']));
    $_SESSION['pcs'] = trim(mysqli_real_escape_string($db_connect, $_POST['pcs']));
    $_SESSION['no_cartons'] = trim(mysqli_real_escape_string($db_connect, $_POST['no_cartons']));
    $_SESSION['barcode'] = trim(mysqli_real_escape_string($db_connect, $_POST['barcode']));

}
$prod_code = $_SESSION['prod_code'];
$barcode = $_SESSION['barcode'];
$_SESSION['update_id'] = trim(mysqli_real_escape_string($db_connect, $_POST['update_id']));
$expiration = trim(mysqli_real_escape_string($db_connect, $_POST['expiration']));
$date = date("Y-m-d");
$bulk_update_id= $_SESSION['update_id'];

if(empty($_POST['no_cartons'])){
	$no_cartons = 0;
	$no_pcs = $_SESSION['pcs'];
}elseif(empty($_POST['pcs'])){
	$no_cartons = $_SESSION['no_cartons'];
	$no_pcs = 0;
}else{
	$no_pcs = $_SESSION['pcs'];
	$no_cartons = $_SESSION['no_cartons'];
}
$query = "SELECT * FROM product LEFT JOIN category ON product.category_id = category.category_id WHERE product.prod_code='{$prod_code}' OR product.prod_code='$barcode'";
        $prod_set = mysqli_query($db_connect, $query);
        $prodList_rs = mysqli_fetch_assoc($prod_set);
		if(empty($prodList_rs)){
			$error = "No product is selected, Kindly select a product and proceed";
              header("location:dashboard.php?page=pages/bulk_update_product&bulk_update_id&update_id=$bulk_update_id&prod_id=&error{$error}");
		}else{
        $prod_id = $prodList_rs['prod_id'];
        $prod_code = $prodList_rs['prod_code'];
        $ctn_num = $prodList_rs['ctn_num'];
        $name = $prodList_rs['prod_name'];
        $categ = $prodList_rs['category_name'];
        $divider = $prodList_rs['divider'];
        $category_id= $prodList_rs['category_id'];
        $qty_left = $prodList_rs['qty_left'];
        $expiration1 = $prodList_rs['expiration'];
		$new_qty = ($divider * $no_cartons) + $no_pcs;
        $qty_out = "0";
        if(empty($expiration)){
            $expiration = $expiration1;
        }else{
            
        }
            // query
            $qty = $no_cartons + $no_pcs;
            $description = "product update";
            $status = "pending";
            $query = "INSERT INTO update_product_order (update_product_id, prod_code, name, qty_in, qty_out, category, description, status, user_id, expiration, date) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $db_connect->prepare($query);
            $stmt->bind_param("sssssssssss", $bulk_update_id, $prod_code, $name, $new_qty, $qty_out, $category_id, $description, $status, $user_iid, $expiration, $date);
            $stmt->execute();
            $stmt->close();
            if($stmt){
              header("location:dashboard.php?page=pages/bulk_update_product&update_id=$bulk_update_id&prod_id="); 
            }else{
                echo "Unable to insert";
            } 
        }
?>