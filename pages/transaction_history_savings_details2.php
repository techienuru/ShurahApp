<?php include_once('includes/db_connect.php'); ?>
<?php
include_once('functions/functions.php');
$user = $_SESSION['admin'];
$debit = $_GET['debit'];
$credit = $_GET['credit'];
$balance = $_GET['balance'];
$client_id = $_GET['client_id'];
$start_date = $_GET['start'];
$end_date = $_GET['end'];

$userist_sql = "SELECT SUM(debit) AS total_debit, SUM(credit) AS total_credit, (SUM(debit) - SUM(credit)) AS total_balance FROM client_ledger WHERE date BETWEEN '$start_date' AND '$end_date' AND client_id = {$client_id}";
$userList_query = mysqli_query($db_connect, $userist_sql);
$userList_rs = mysqli_fetch_assoc($userList_query);
$total_debit = $userList_rs['total_debit'];
$total_credit = $userList_rs['total_credit'];
$total_balance = $userList_rs['total_balance'];

?>
<div class="team_section layout_padding" style="margin-top: -100px">
    <div class="">
        <h1 class="what_taital">Payment History</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>

            <div class="box">
                <hr>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <b><label>Client Name</label></b>
                            <label><?php echo $_GET['name']; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <b><label>Total Debit</label></b>
                            <?php
                            if ($total_debit == 0) {
                                echo " Nil";
                            } else {
                                echo "₦ " . number_format($total_debit, 2);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <b><label>Total Credit</label></b>
                            <?php
                            if ($total_credit == 0) {
                                echo " Nil";
                            } else {
                                echo "₦ " . number_format($total_credit, 2);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <b><label>Balance</label></b>
                            <?php
                            if ($total_balance == 0) {
                                echo " Nil";
                            } else {
                                echo "₦ " . number_format($total_balance, 2);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">Payment Transaction History</h3>
                        <hr>
                        <table class="table table striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Client ID</th>
                                    <th>Invoice</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <?php
                            //$client_id = $_GET['client_id'];
                            $query = mysqli_query($db_connect, "SELECT s.date, s.client_id, s.invoice, s.description, s.debit, s.credit, @b := @b + s.credit - s.debit AS balance FROM(SELECT @b := 0.0) AS dummy CROSS JOIN client_ledger AS s WHERE s.client_id ={$client_id} AND s.date BETWEEN '$start_date' AND '$end_date' ORDER BY ref_id ASC");
                            while ($row = mysqli_fetch_array($query)) {
                                extract($row);
                                echo "<tbody>";
                                echo    "<tr>";
                                echo    "<td>{$date}</td>";
                                echo    "<td>{$client_id}</td>";
                                echo    "<td>{$invoice}</td>";
                                echo    "<td>{$description}</td>"; ?>
                                <td><?php echo "₦ " . number_format($debit, 2); ?></td>
                                <td><?php echo "₦ " . number_format($credit, 2); ?></td>
                                <td><?php echo "₦ " . number_format($balance, 2); ?></td>
                            <?php
                                echo    "</tr>";
                                echo    "</tbody>";
                            }
                            ?>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Client ID</th>
                                    <th>Invoice</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="text-right">
                            <strong>USER : <?php echo strtoupper($user); ?></strong>
                        </div>
                    </div>
                    <div>
                        <div class="col-5">
                            <div class="form-group">
                                <a class="btn btn-warning" style="width: 100px;" href="dashboard.php?page=pages/view_clients_ledger">Back</a>
                                <a class="btn btn-info" style="width: 100px;" href="dashboard.php?page=pages/transaction_invoice_details&client_id=<?php echo $_GET['client_id']; ?>&debit=<?php echo $_GET['debit']; ?>&credit=<?php echo $_GET['credit']; ?>&balance=<?php echo $_GET['balance']; ?>&name=<?php echo $_GET['name']; ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>">Details</a>
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