<?php
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
    include_once('functions/functions.php');
    $user = $_SESSION['admin'];
    $user_iid = $_SESSION['user_id'];
    $bulk_update_id = $_GET['update_id'];
	$description = "Bulk Update Price list";
	$date = date('Y-m-d');
echo $bulk_update_id;
?>
<?php
        /*$client_name = trim(mysqli_real_escape_string($db_connect,$_POST['client_name'])); 
        $cashier = trim(mysqli_real_escape_string($db_connect,$_POST['cashier'])); 
        $location = trim(mysqli_real_escape_string($db_connect,strtoupper($_POST['location']))); 
		$date = date("Y-m-d");
		if(empty($_POST['truck_no'])){
			$truck_no = "Nill";
		}else{
			$truck_no = trim(mysqli_real_escape_string($db_connect,$_POST['truck_no']));
		}*/


// query
        $prod_query = "SELECT * FROM update_product_price_list WHERE update_product_id='{$bulk_update_id}'";
        $prod_set = mysqli_query($db_connect, $prod_query);
        confirm_query($prod_set);
        if(mysqli_num_rows($prod_set) != 0) {
            ?>
            <center>
                <div class="row" style="margin-left: -1%; margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="col-md-4 alert alert-danger">Error! Bulk update already added!</div>
                    </div>
                </div>
            </center>           
            <?php     
        }else{

        // Insert query
        $query = "INSERT INTO update_product_price_list (update_product_id, description, date, user_id) VALUES ('{$bulk_update_id}','{$description}','{$date}','{$user_iid}')";
        $result = mysqli_query($db_connect, $query);

        // Ledger insertion
        
        if ($result) {
            header("location:dashboard.php?page=pages/bulk_update_product_pricelist_preview&update_id=$bulk_update_id");
        } else {
            die(mysqli_error($db_connect));
            echo "Unable to insert";
        }
    }
?>
