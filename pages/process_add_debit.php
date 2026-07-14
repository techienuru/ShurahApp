<br>
<br>

<?php
    include_once('../includes/sessions.php');
    include_once('../includes/db_connect.php');
    include_once('../functions/functions.php');

?>
<?php
if(isset($_POST['submit'])){
        //credit leg
        $user_iid = $_SESSION['user_id'];
        $cashier = $_SESSION['admin'];

        $expence_code = 20240826165621;
        $current_time = time();
        $time_string = date("YmdHis", $current_time);
        $expence_id = $time_string;
        $client_id = trim(mysqli_real_escape_string($db_connect,$_POST['client_id'])); 
        $amount = trim(mysqli_real_escape_string($db_connect,$_POST['amount'])); 
        $description = trim(mysqli_real_escape_string($db_connect,strtoupper($_POST['description']))); 
        $booked_on = date('Y-m-d');
        $credit = "0";
        $debit = $amount;
        $invoice = trim(mysqli_real_escape_string($db_connect,$_POST['invoice']));
        $amount = trim(mysqli_real_escape_string($db_connect,$_POST['amount']));
        $client_name = trim(mysqli_real_escape_string($db_connect,strtoupper($_POST['client_name']))); 
        $total_payment =  0;
        $prod_id = "OSTN";
        // debit leg
		$sql = "SELECT SUM(debit) as total_debit, SUM(credit) as total_credit, SUM(credit - debit) as balance FROM client_ledger WHERE client_id=".$client_id;
		$user_query = mysqli_query($db_connect, $sql);
		$userList_rs = mysqli_fetch_assoc($user_query);
		$total_debit = $userList_rs['total_debit'];
		$total_credit = $userList_rs['total_credit'];
		$balance = $userList_rs['balance'];
		echo $balance;
		if($balance < $amount){
			$error = "Insufficient Balance";
            header("Location:../dashboard.php?page=pages/add_make_withdrawal&error={$error}");
		}else{
		$query = "INSERT INTO client_ledger (client_id, invoice, description, debit, credit, date, user_id) VALUES ('{$client_id}','{$invoice}','{$description}','{$debit}','{$credit}','{$booked_on}','{$user_iid}')";
        $result = mysqli_query($db_connect, $query);
            
        $query1 = "INSERT INTO expence_table (expence_id, expence_code, description, amount, user_id, date) VALUES ('{$expence_id}','{$expence_code}','{$description}','{$amount}','{$user_iid}','{$booked_on}')";
        $result1 = mysqli_query($db_connect, $query1);
    
        // Insert query
            if($result && $result1){
                ?> 
                <div class="text-center" style="margin-left: 20%; margin-top: 10px;">
                    <div class="col-md-12">
                        <?php 
                            echo "<div class='alert alert-success'>Client successully updated.</div>";
                            $sucess = "Success! Transaction posted successfully";
                            header("Location:../dashboard.php?page=pages/add_make_withdrawal&success={$sucess}");
                        ?>                        
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="credit_transaction.php" class="btn btn-primary">Continue</a>
                </div>
                <?php
            }else{
                ?> 
                <div class="text-center" style="margin-left: 30%; margin-top: 10px;">
                    <div class="col-md-12">
                        <?php
                            echo "<div class='alert alert-danger'>Unable to update Client.</div>";
                            $error = "Transaction not posted";
                            header("Location:../dashboard.php?page=pages/add_make_withdrawal&error={$error}");               
                            ?>
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="credit_transaction.php" class="btn btn-primary">Back</a>
                </div>

                <?php
            }
		}
}
  
?>