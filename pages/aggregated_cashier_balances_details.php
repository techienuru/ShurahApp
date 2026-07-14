<?php include_once('includes/db_connect.php'); ?>
<?php 
include_once('functions/functions.php'); 
$user = $_SESSION['admin'];
$user_id = $_GET['user_id'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

$prodList_sql = "SELECT * FROM users WHERE user_id='{$user_id}'";
$prodList_query = mysqli_query($db_connect, $prodList_sql);
$prodList_rs = mysqli_fetch_assoc($prodList_query);
$username = $prodList_rs['username'];

$details_sql = "SELECT  SUM(a.cash) AS CASH, SUM(a.POS) AS POS, SUM(a.transfer) AS TRANSFER FROM sales a LEFT JOIN users b ON a.user_id = b.user_id WHERE a.user_id='$user_id' AND a.date BETWEEN '$start_date' AND '$end_date'";
$details_query = mysqli_query($db_connect, $details_sql);
$details_rs = mysqli_fetch_assoc($details_query);
$cash = $details_rs['CASH'];
$pos = $details_rs['POS'];
$transfer = $details_rs['TRANSFER'];
?>
<div class="team_section layout_padding"  style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Aggregated Cashier Balances</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>

<div class="box">
    <div class="row">
     <div class="col-3">
        <div class="form-group">
            <b><label>Cashier Name :</label></b>
            <label><?php echo strtoupper($username) ; ?></label>
         </div> 
    </div>        
    </div>    
    <div class="row" >
    <div class="col-5">
         <div class="form-group">
            <b><label>Total Cash</label></b>
            <label><?php echo "₦ ". number_format($cash,2) ; ?></label>
         </div>
    </div> 
    <div class="col-3">
        <div class="form-group">
            <b><label>Total POS</label></b>
            <label><?php echo "₦ ". number_format($pos,2) ; ?></label>
         </div>
    </div>
     <div class="col-3">
        <div class="form-group">
            <b><label>Transfer :</label></b>
            <label><?php echo "₦ ". number_format($transfer,2) ; ?></label>
         </div> 
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
                        <th>Invoice</th>
                        <th>Username</th>
                        <th>Total Cash</th>
                        <th>Total POS</th>
                        <th>Total Transfer</th>
                    </tr>
                    </thead>
                    <?php
    $query=mysqli_query($db_connect, "SELECT a.date, a.invoice, b.username, a.cash, a.POS, a.transfer, a.total_payment FROM sales a LEFT JOIN users b ON a.user_id = b.user_id WHERE a.user_id='$user_id' AND a.date BETWEEN '$start_date' AND '$end_date'");      
     while($row = mysqli_fetch_array($query)){
         extract($row);
                    echo "<tbody>";
                    echo    "<tr>";
                    echo    "<td>{$date}</td>";
                    echo    "<td>{$invoice}</td>";
                    echo    "<td>";
                    echo strtoupper($username);
                    echo    "</td>";?>
                    <td><?php echo "₦ ". number_format($cash,2); ?></td>
                    <td><?php echo "₦ ". number_format($POS,2); ?></td>
                    <td><?php echo "₦ ". number_format($transfer,2); ?></td>
                    <?php
                    echo    "</tr>";
                    echo    "</tbody>";
     }
              
                    ?>
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Invoice</th>
                        <th>Username</th>
                        <th>Total Cash</th>
                        <th>Total POS</th>
                        <th>Total Transfer</th>
                    </tr>
                    </thead>
                </table> 
                <div class="text-right">
                <strong>USER : <?php echo strtoupper($user) ; ?></strong>
            </div>
        </div>
            <div>
                <div class="col-5">
                    <div class="form-group">
                        <a class="btn btn-warning" style="width: 100px;" href="dashboard.php?page=pages/aggregated_cashier_balances_process&start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date; ?>">Back</a>
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