<br>
<br>

<?php
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
	$user = $_SESSION['admin'];
	$useridd = $_SESSION['user_id']
?>
<?php      
		$prod_id = trim(mysqli_real_escape_string($db_connect,$_POST['prod_id']));  
        $prod_code = trim(mysqli_real_escape_string($db_connect,$_POST['prod_code'])); 
        $category_id = trim(mysqli_real_escape_string($db_connect,$_POST['category_id'])); 
        $prod_name = trim(mysqli_real_escape_string($db_connect, strtoupper($_POST['prod_name'])));        
        $ctn_num = trim(mysqli_real_escape_string($db_connect,$_POST['ctn_num']));
        $pcs = trim(mysqli_real_escape_string($db_connect,$_POST['pcs']));
        $qty = trim(mysqli_real_escape_string($db_connect,$_POST['qty']));
		//$qty_left = $pcs;
		$divider = trim(mysqli_real_escape_string($db_connect,$_POST['divider']));
		$cost_price = trim(mysqli_real_escape_string($db_connect,$_POST['cost_price']));
        $selling_price = trim(mysqli_real_escape_string($db_connect,$_POST['selling_price']));
        $ctn_price = trim(mysqli_real_escape_string($db_connect,$_POST['ctn_price']));
        $expiry_date = trim(mysqli_real_escape_string($db_connect,$_POST['expiry_date']));
        $date = date('Y-m-d');
        $qty_left .= $qty * $divider;
        $qty = $pcs;
        $prod_query = "SELECT * FROM product WHERE prod_name='{$prod_name}'";
        $prod_set = mysqli_query($db_connect, $prod_query);
        confirm_query($prod_set);
        if(mysqli_num_rows($prod_set) != 0) {
            ?>
            <center>
                <div class="row" style="margin-left: -1%; margin-top: -55px;">
                    <div class="col-md-12">
                       <div class="col-md-4 alert alert-danger">Error! Product already exists!</div>
                        <?php
                            $error = "Error! Product already exists!";
                            header("Location:dashboard.php?page=pages/view_products&error={$error}");                
                        ?>
                    </div>
                </div>
            </center>           
            <?php 
        }else{
            // Using prepared statement for both cases
            $query = "INSERT INTO product( prod_id, prod_code, category_id, prod_name, ctn_num, pcs, qty_left, divider, cost_price, selling_price, expiration, date ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $db_connect->prepare($query);
            $stmt->bind_param("ssisssssssss", $prod_id, $prod_code, $category_id, $prod_name, $ctn_num, $pcs, $qty_left, $divider, $cost_price, $selling_price, $expiry_date, $date);
            $stmt->execute();
            $stmt->close();
            
            $qty_out = '0';
            $description = "stock in";
            $status = "processed";
            $query_product_log = "INSERT INTO product_movement_log (update_product_id, prod_code, name, qty_in, qty_out, category, expiration, description, status, user_id, date) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt1 = $db_connect->prepare($query_product_log);
            $stmt1->bind_param("ssissssssss", $prod_id, $prod_code, $prod_name, $pcs, $qty_out, $category_id, $expiry_date, $description, $status, $useridd, $date);
            $stmt1->execute();
            $stmt1->close();
            
            if($stmt && $stmt1) {
                mysqli_close($db_connect);
                $sucess = $prod_name." Product successully created.";
                header("Location:dashboard.php?page=pages/view_products&success={$sucess}"); 
                } else {
                    echo "Unable to insert";
                }
            }
?>