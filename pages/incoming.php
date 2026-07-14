<?php
    ob_start();
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
    include_once('functions/functions.php');
    $user = $_SESSION['admin']; 
    confirm_logged_in();
?>
<?php
if(isset($_POST['submit'])){
    
    $_SESSION['product'] = trim(mysqli_real_escape_string($db_connect, $_POST['product']));
    $_SESSION['qty'] = trim(mysqli_real_escape_string($db_connect, $_POST['qty']));
    $_SESSION['barcode'] = trim(mysqli_real_escape_string($db_connect, $_POST['barcode']));
}
$invoice = $_GET['invoice'];
$client_id = $_SESSION['client_id'];
$prod_code = $_SESSION['product'];
$barcode = $_SESSION['barcode'];
$_SESSION['discount'] = trim(mysqli_real_escape_string($db_connect, $_POST['discount']));
$qty = $_SESSION['qty'];
$date = date("Y-m-d");
$query = "SELECT * FROM product LEFT JOIN category ON product.category_id = category.category_id WHERE product.prod_code='{$barcode}' OR  product.prod_code= '$prod_code'";
        $prod_set = mysqli_query($db_connect, $query);
        $prodList_rs = mysqli_fetch_assoc($prod_set);
		if(empty($prodList_rs)){
			$error = "No product is selected, Kindly select a product and proceed";
			header("location:dashboard.php?page=pages/retail_sales&invoice=$invoice&prod_id=$prod_id&client_id=$client_id&error=$error");
		}else{
		$prod_id = $prodList_rs['prod_id'];
        $prod_code = $prodList_rs['prod_code'];
        $ctn_num = $prodList_rs['ctn_num'];
        $name = $prodList_rs['prod_name'];
        $categ = $prodList_rs['category_name'];
        $category_id= $prodList_rs['category_id'];
        $_SESSION['pcs'] = $prodList_rs['pcs'];
        $qtyleft = $prodList_rs['qty_left'];
        $selling_price = $prodList_rs['selling_price'];
        $pcs = $_SESSION['pcs'];
        $discount = $_SESSION['discount'];

        
        $y1 = $selling_price * $qty;
        $y2 = $discount * $qty;    
        $amount = ($selling_price * $qty) - $y2;
		$qtyleft = $qtyleft - $qty;
        $selling_price = $selling_price - $discount;
        if($qtyleft < 0){
            $error = $name.' stock is below the required quantity, Kindly re-stock the product.';
			header("location:dashboard.php?page=pages/retail_sales&invoice=$invoice&prod_id=$prod_id&client_id=$client_id&error=$error");
        }else{
            // Using prepared statement for both cases
            $qty = $_SESSION['qty'];
            $remarks = "0";
            $status = "pending";
            $query = "INSERT INTO sales_order (invoice, prod_code, qty, amount, name, price, discount, category, date, qtyleft, remarks, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $db_connect->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ssssssssssss", $invoice, $prod_code, $qty, $amount, $name, $selling_price, $y2, $category_id, $date, $qtyleft, $remarks, $status);
                $stmt->execute();
                $stmt->close();
                mysqli_close($db_connect);
                header("location:dashboard.php?page=pages/retail_sales&invoice=$invoice&prod_id=$prod_id&client_id=$client_id");
            } else {
                echo "Unable to insert";
            }
        }

		}

?>