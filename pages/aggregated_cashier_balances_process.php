<?php include_once('includes/db_connect.php'); ?>
<?php 
include_once('functions/functions.php'); 
$user = $_SESSION['admin'];
// $debit = $_GET['debit'];
// $credit = $_GET['credit'];
// $balance = $_GET['balance'];
if(empty($_POST['start_date'])){
  $start_date = $_GET['start_date'];  
  $end_date = $_GET['end_date'];  
}else{
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date']; 
}

?>
<div class="team_section layout_padding"  style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Aggregated Cashier Balances</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>

<div class="box">
    <div class="row">
    <!-- <div class="col-5">
        <div class="form-group">
            <b><label>Client Name</label></b>
            <label><?php echo $_GET['name'] ; ?></label>
         </div>
    </div>       
    </div>    
    <div class="row" >
    <div class="col-5">
         <div class="form-group">
            <b><label>Total Debit</label></b>
            <label><?php echo "₦ ". number_format($debit,2) ; ?></label>
         </div>
    </div> 
    <div class="col-3">
        <div class="form-group">
            <b><label>Total Credit</label></b>
            <label><?php echo "₦ ". number_format($credit,2) ; ?></label>
         </div>
    </div>
     <div class="col-3">
        <div class="form-group">
            <b><label>Balance</label></b>
            <label><?php echo "₦ ". number_format(abs($balance)) ; ?></label>
         </div> -->
    </div>               
    </div>
    <hr>
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">Transaction History</h3>
                <hr>
                <table class="table table striped table-bordered">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Total Cash</th>
                        <th>Total POS</th>
                        <th>Total Transfer</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <?php
    $query=mysqli_query($db_connect, "SELECT a.date AS DATE, a.user_id AS USER_ID, b.username AS USERNAME, SUM(a.cash) as CASH, SUM(a.POS) AS POS, SUM(a.transfer) AS TRANSFERS, SUM(a.total_payment) AS TOTAL_AMOUNT,a.client_id FROM sales a LEFT JOIN users b ON a.user_id = b.user_id WHERE a.date BETWEEN '$start_date' AND '$end_date' GROUP BY a.user_id");      
     while($row = mysqli_fetch_array($query)){
         extract($row);
                    echo "<tbody>";
                    echo    "<tr>";
                    echo    "<td>{$DATE}</td>";
                    echo    "<td>{$USER_ID}</td>";
                    echo    "<td>";
                    echo strtoupper($USERNAME);
                    echo    "</td>";?>
                    <td><?php echo "₦ ". number_format($CASH,2); ?></td>
                    <td><?php echo "₦ ". number_format($POS,2); ?></td>
                    <td><?php echo "₦ ". number_format($TRANSFERS,2); ?></td>
                    <?php
                    echo    "<td><a class='btn btn-success' style='width: 100px;' href='dashboard.php?page=pages/aggregated_cashier_balances_details&user_id={$USER_ID}&start_date={$start_date}&end_date={$end_date}'>Details</a></td>";
                    echo    "</tr>";
                    echo    "</tbody>";
     }
              
                    ?>
                    <thead>
                    <tr>
                    <th>Date</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Total Cash</th>
                        <th>Total POS</th>
                        <th>Total Transfer</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                </table> 
<div class="text-right">
                <strong>Cashier Balances from <?php echo $start_date. " to " . $end_date ; ?></strong>
            </div>
                <div class="text-right">
                <strong>USER : <?php echo strtoupper($user) ; ?></strong>
            </div>
        </div>
            <div>
                <div class="col-5">
                    <div class="form-group">
                        <a class="btn btn-warning" style="width: 100px;" href="dashboard.php?page=pages/aggregated_cashier_balances">Back</a>
                     </div>
                </div> 
            </div>
    </div>
        </div>
        </div>
      </div>
</div>

<br>
<br>