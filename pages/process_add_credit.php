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

        $client_id = trim(mysqli_real_escape_string($db_connect,$_POST['client_id'])); 
        $amount = trim(mysqli_real_escape_string($db_connect,$_POST['amount'])); 
        $description = trim(mysqli_real_escape_string($db_connect,strtoupper($_POST['description']))); 
        $booked_on = date('Y-m-d');
        $credit = $amount;
        $debit = "0";
        $invoice = trim(mysqli_real_escape_string($db_connect,$_POST['invoice']));
        $amount = trim(mysqli_real_escape_string($db_connect,$_POST['amount']));
        $cash = trim(mysqli_real_escape_string($db_connect,$_POST['cash']));
        $pos = trim(mysqli_real_escape_string($db_connect,$_POST['pos']));
        $transfer = trim(mysqli_real_escape_string($db_connect,$_POST['transfer']));
        $bank = trim(mysqli_real_escape_string($db_connect,$_POST['bank']));
        $ref = trim(mysqli_real_escape_string($db_connect,$_POST['ref']));
        $client_name = trim(mysqli_real_escape_string($db_connect,strtoupper($_POST['client_name']))); 
        $total_payment =  $cash +  $pos +  $transfer; 
        $description .= " IFO ".$ref. " Invoice";
        $prod_id = "OSTN";
        // debit leg""
        $query = "INSERT INTO client_ledger (client_id, invoice, description, debit, credit, date, user_id) VALUES ('{$client_id}','{$invoice}','{$description}','{$debit}','{$credit}','{$booked_on}','{$user_iid}')";
        $result = mysqli_query($db_connect, $query);

    	echo $query;
        // Insert query
        $query1 = "INSERT INTO sales (prod_id, invoice, cashier, date, cash, pos, transfer, discount, bank, client_id, amount, balance, total_payment, client_name, user_id) VALUES ('{$prod_id}', '{$invoice}', '{$cashier}', '{$booked_on}', '{$cash}', '{$pos}', '{$transfer}', '0', '{$bank}', '{$client_id}', '{$amount}', '0', '{$total_payment}', '{$client_name}','{$user_iid}')";
        $result1 = mysqli_query($db_connect, $query1);
		mysqli_close($db_connect);
            if($result && $result1){
                ?> 
                <div class="text-center" style="margin-left: 20%; margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="col-md-7 alert alert-primary"><b>Success!</b> Account credited.</div>
                        <?php 
                            echo "<div class='alert alert-success'>Client successully updated.</div>";
                            $sucess = "Success! Account credited";
                            header("Location:../dashboard.php?page=pages/add_make_payment&success={$sucess}");
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
                        <div class="col-md-7 alert alert-danger"><b>Error!</b> Account not credited.</div>
                        <?php
                            echo "<div class='alert alert-danger'>Unable to update Client.</div>";
                            $error = "Account not credited";
                            header("Location:../dashboard.php?page=pages/add_make_payment&error={$error}");               
                            ?>
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="credit_transaction.php" class="btn btn-primary">Back</a>
                </div>

                <?php
            }
}
  
?>