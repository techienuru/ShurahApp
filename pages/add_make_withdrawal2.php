<div>
<?php
        $client_id = "";
        if(isset($_POST['submit'])){
        $client_id =  $_POST['client_id'];
        $invoice =  $_POST['invoice'];
        $start_date = date("Y-m-d", strtotime($_POST['state_date']));
        $end_date = date("Y-m-d", strtotime($_POST['end_date']));
            
        $query=mysqli_query($db_connect,"SELECT a.client_id, a.name, a.gender, a.phone FROM clients a WHERE a.client_id ={$client_id} ") or die(mysqli_error($db_connect));
        $account_rs = mysqli_fetch_assoc($query);    
        $client_iid = $account_rs['client_id'];
        $name = $account_rs['name'];
            
        $sql = "SELECT SUM(credit) as credit, SUM(debit) as debit FROM client_ledger  WHERE client_id={$client_id} ORDER BY ref_id ASC";
        $bal_query = mysqli_query($db_connect, $sql);
        $balList_rs = mysqli_fetch_assoc($bal_query);
        $total_credit = $balList_rs['credit']; 
        $total_debit = $balList_rs['debit']; 
        $balance = $total_credit - $total_debit ; 
        header("Location: dashboard.php?page=pages/add_withdrawal_details&name={$name}&debit={$total_debit}&credit={$total_credit}&balance={$balance}&client_id={$client_id}&invoice={$invoice}");
        
        }else{
            if(isset($_POST['submit'])){
            $client_id =  $_POST['client_id'];
            $query=mysqli_query($db_connect,"SELECT a.client_id, a.name, a.gender, a.phone FROM clients a WHERE a.client_id ={$client_id} ") or die(mysqli_error($db_connect));
            $account_rs = mysqli_fetch_assoc($query);    
            $client_iid = $account_rs['client_id'];
            $name = $account_rs['name'];
            
            $query1=mysqli_query($db_connect,"SELECT s.date, s.client_id, s.invoice, s.description, s.debit, s.credit, @b := @b + s.credit - s.debit AS balance, SUM(s.debit) AS total_debit,SUM(s.credit) AS total_credit FROM(SELECT @b := 0.0) AS dummy CROSS JOIN client_ledger AS s WHERE s.client_id ={$client_id} ORDER BY ref_id ASC") or die(mysqli_error($db_connect));
            $account_rs1 = mysqli_fetch_assoc($query1);    
            $total_debit = $account_rs1['total_debit'];
            $total_credit = $account_rs1['total_credit'];
            $balance = $total_credit - $total_debit;
            header("Location: dashboard.php?page=pages/transaction_history_savings_details2&name={$name}&debit={$total_debit}&credit={$total_credit}&balance={$balance}&client_id={$client_id}&invoice={$invoice}");
        }
        }



?>
</div>