<?php include_once('includes/db_connect.php'); ?>
<?php
include_once('functions/functions.php');
$user = $_SESSION['admin'];
$debit = $_GET['debit'];
$credit = $_GET['credit'];
$balance = $_GET['balance'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
?>
<div class="team_section layout_padding" style="margin-top: -50px">
    <div class="">
        <h1 class="what_taital">Invoice History</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>

            <div class="box">
                <!-- <hr> -->
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
                            if ($debit = 0) { ?>
                                <label><?php echo 'NIL '; ?></label>

                            <?php } else { ?>
                                <label><?php echo "₦ " . number_format($debit, 2); ?></label>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <b><label>Total Credit</label></b>
                            <?php
                            if ($credit = 0) { ?>
                                <label><?php echo 'NIL '; ?></label>

                            <?php } else { ?>
                                <label><?php echo "₦ " . number_format($credit, 2); ?></label>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <b><label>Balance</label></b>
                            <?php
                            if ($balance = 0) { ?>
                                <label><?php echo 'NIL '; ?></label>

                            <?php } else { ?>
                                <label><?php echo "₦ " . number_format(abs($balance)); ?></label>
                            <?php }
                            ?>
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
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <?php
                            $client_id = $_GET['client_id'];

                            $query = mysqli_query($db_connect, "SELECT so.invoice,so.name, SUM(COALESCE(so.qty, 0)) AS qty, MAX(so.price) AS price, MAX(so.discount) AS discount, SUM(COALESCE(so.amount, 0)) AS amount FROM sales_order so WHERE so.invoice IN (SELECT cl.invoice FROM client_ledger cl WHERE cl.client_id = '$client_id' AND cl.date BETWEEN '$start_date' AND '$end_date') GROUP BY so.name ORDER BY so.category,so.name ASC");
                            while ($row = mysqli_fetch_array($query)) {
                                extract($row);
                                echo "<tbody>";
                                echo    "<tr>";
                                echo    "<td>{$date}</td>";
                                echo    "<td>{$invoice}</td>";
                                echo    "<td>{$name}</td>";
                                echo    "<td>{$qty}</td>"; ?>
                                <td><?php echo "₦ " . number_format($price, 2); ?></td>
                                <td><?php echo "₦ " . number_format($discount, 2); ?></td>
                                <td><?php echo "₦ " . number_format($amount, 2); ?></td>
                            <?php
                                echo    "</tr>";
                                echo    "</tbody>";
                            }
                            ?>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Amount</th>
                                </tr>
                                <tr style='font-weight:bold; background:#f5f5f5;'>
                                    <?php
                                    echo "<td colspan='6' align='right'>Total</td>";
                                    echo "
                                <td>₦ " . number_format($totalAmount, 2) . "</td>
                                ";
                                    ?>
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