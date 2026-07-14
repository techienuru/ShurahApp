<?php
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
    include_once('functions/functions.php');
    $user = $_SESSION['admin'];
    $user_iid = $_SESSION['user_id'];
    $branch_id = $_SESSION['branch_iid'];
    $id = $_GET['invoice'];
?>
<?php

$client_id = $_POST['client_id'];
if(empty($client_id)){
    //
}else{
    $sql = "SELECT * FROM clients WHERE client_id=".$client_id;
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $client = $userList_rs['name'];  
}
$prod_id = $_GET['prod_id'];
$client_name = $_POST['client_name'];
$discount = $_POST['discount'];
$bank = $_POST['bank'];
$pos_medium = $_POST['pos_medium'];
$invoice = trim(mysqli_prep($_POST['invoice']));
$cashier = trim(mysqli_prep($_POST['cashier']));
if(empty($_POST['supplied_status'])){
	$supplied_status = "";
}else{
	$supplied_status = trim(mysqli_prep($_POST['supplied_status']));
}
$date = date("Y-m-d");
$amount = trim(mysqli_prep($_GET['p_amount']));
$cash = trim(mysqli_prep($_POST['cash']));
$pos = trim(mysqli_prep($_POST['pos']));
$transfer = trim(mysqli_prep($_POST['transfer']));
$balance = trim(mysqli_prep($_POST['balance']));
$total_payment = ($cash + $pos + $transfer) ;
if($_POST['cash'] != 0){
	$payment_status = "Cash";
}elseif($_POST['pos'] != 0){
	$payment_status = "POS";
}elseif($_POST['transfer'] != 0){
	$payment_status = "Transfer";
}else{
	$payment_status = "Not Paid";
}
// query
        $prod_query = "SELECT * FROM sales WHERE invoice='{$invoice}'";
        $prod_set = mysqli_query($db_connect, $prod_query);
        confirm_query($prod_set);
        if(mysqli_num_rows($prod_set) != 0) {
            ?>
            <center>
                <div class="row" style="margin-left: -1%; margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="col-md-4 alert alert-danger">Error! Invoice already added!</div>
                    </div>
                </div>
            </center>           
            <?php     
        }else{
if(empty($client_id)){
    if($balance > 0){
     //client_id is empty and balance is > 0
	 echo "<br>";
     echo "Anonymous client must not have balance";      
    }else{
        // client_id is empty and balance is 0
        // Insert query
		if($supplied_status == 'NOT SUPPLIED'){
		$status = 'NOT SUPPLIED';
        $query = "INSERT INTO sales (prod_id, invoice, cashier, date, cash, pos, transfer, discount, bank, pos_medium, client_id, amount, balance, total_payment, client_name, status, user_id) VALUES ('{$prod_id}', '{$invoice}', '{$cashier}', '{$date}', '{$cash}', '{$pos}', '{$transfer}', '{$discount}', '{$bank}', '{$pos_medium}', '{$client_id}', '{$amount}', '{$balance}', '{$total_payment}','{$client_name}','{$status}','{$user_iid}')";
        $result = mysqli_query($db_connect, $query);
        // Ledger insertion
        if ($result) {
            header("location:dashboard.php?page=pages/preview_not_supllied&invoice=$invoice&bal=$balance&cash_tendered=$total_payment&client_name=$client_name&status=$supplied_status&pay_mode=$payment_status");
        } else {
            die(mysqli_error($db_connect));
            echo "Unable to insert";
        }
			
		}else{
		$status = 'SUPPLIED';
        $query = "INSERT INTO sales (prod_id, invoice, cashier, date, cash, pos, transfer, discount, bank, pos_medium, client_id, amount, balance, total_payment, client_name, status, user_id) VALUES ('{$prod_id}', '{$invoice}', '{$cashier}', '{$date}', '{$cash}', '{$pos}', '{$transfer}', '{$discount}', '{$bank}', '{$pos_medium}', '{$client_id}', '{$amount}', '{$balance}', '{$total_payment}','{$client_name}','{$status}','{$user_iid}')";
        $result = mysqli_query($db_connect, $query);
		
        // Ledger insertion
        if ($result) {
            header("location:dashboard.php?page=pages/preview&invoice=$invoice&bal=$balance&cash_tendered=$total_payment&client_name=$client_name&status=$supplied_status&pay_mode=$payment_status");
        } else {
            die(mysqli_error($db_connect));
            echo "Unable to insert";
        }
		}

		}

    }else{
        // client_id is not empty and balance is > 0
        // Insert query
		if($supplied_status == 'NOT SUPPLIED'){
		$status = 'NOT SUPPLIED';
        $query = "INSERT INTO sales (prod_id, invoice, cashier, date, cash, pos, transfer, discount, bank, pos_medium, client_id, amount, balance, total_payment, client_name, status, user_id) VALUES ('{$prod_id}', '{$invoice}', '{$cashier}', '{$date}', '{$cash}', '{$pos}', '{$transfer}', '{$discount}', '{$bank}', '{$pos_medium}', '{$client_id}', '{$amount}', '{$balance}', '{$total_payment}','{$client_name}','{$status}','{$user_iid}')";
        $result = mysqli_query($db_connect, $query);
        // Ledger insertion
        if ($result) {
            header("location:dashboard.php?page=pages/preview_not_supllied&invoice=$invoice&bal=$balance&cash_tendered=$total_payment&client_name=$client_name&status=$supplied_status&pay_mode=$payment_status");
        } else {
            die(mysqli_error($db_connect));
            echo "Unable to insert";
        }
			
		}else{
		$status = 'SUPPLIED';
        $query = "INSERT INTO sales (prod_id, invoice, cashier, date, cash, pos, transfer, discount, bank, pos_medium, client_id, amount, balance, total_payment, client_name, status, user_id) VALUES ('{$prod_id}', '{$invoice}', '{$cashier}', '{$date}', '{$cash}', '{$pos}', '{$transfer}', '{$discount}', '{$bank}', '{$pos_medium}', '{$client_id}', '{$amount}', '{$balance}', '{$total_payment}','{$client_name}','{$status}','{$user_iid}')";
        $result = mysqli_query($db_connect, $query);
			
        // Ledger insertion
        $new_amount = $amount - $discount;
        $description = "Cost of Goods purchased";
        $query1 = "INSERT INTO client_ledger (client_id, invoice, description, debit, credit, date, user_id) VALUES ('{$client_id}','{$invoice}','{$description}','{$new_amount}','{$total_payment}','{$date}','{$user_iid}')";
        $result1 = mysqli_query($db_connect, $query1);
		
        // Ledger insertion
        if ($result) {
            header("location:dashboard.php?page=pages/preview&invoice=$invoice&bal=$balance&cash_tendered=$total_payment&client_name=$client_name&status=$supplied_status&pay_mode=$payment_status");
        } else {
            die(mysqli_error($db_connect));
            echo "Unable to insert";
        }
		}
	}


		}
?>
