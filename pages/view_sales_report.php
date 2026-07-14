<?php
    ob_start();
    $user = $_SESSION['admin'];
    $user_iid = $_SESSION['user_id'];

    	$date = date('Y-m-d');
        $lastList_sql = "SELECT SUM(cash) as cash, SUM(pos) AS pos, SUM(transfer) as transfer 
        FROM sales WHERE date ='{$date}' AND user_id='{$user_iid}'";
        $lastList_query = mysqli_query($db_connect, $lastList_sql);
        $lastList_rs = mysqli_fetch_assoc($lastList_query);
        $total_cash = $lastList_rs['cash'];
        $total_pos = $lastList_rs['pos'];
        $total_transfer = $lastList_rs['transfer'];

        $total_transaction = $total_cash + $total_pos + $total_transfer;
?>
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');

    ?>
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">Daily Sales Report</h1>
        <p class="what_text_1"> </p>
            <form action="index.php?page=pages/export_excel" method="POST">
            <div class="row" style="margin-left:1px;">
                <div class="col-2">
                    <b><label>Total Cash :</label></b>
                    <input class="form-control text-right" type="text" name="cash" value="₦ <?php echo formatMoney($total_cash); ?>" readonly>        
                </div>
                <div class="col-2">
                    <b><label>Total POS :</label></b>
                    <input class="form-control text-right" type="text" name="pos" value="₦ <?php echo formatMoney($total_pos); ?>" readonly>        
                </div>            
                <div class="col-2">
                    <b><label>Total Transfer :</label></b>
                    <input class="form-control text-right" type="text" name="transfer" value="₦ <?php echo formatMoney($total_transfer); ?>" readonly>        
                </div>            
                <div class="col-2">
                    <b><label>Total Transaction :</label></b>
                    <input class="form-control text-right" type="text" name="total_transaction" value="₦ <?php echo formatMoney($total_transaction); ?>" readonly>        
                </div>   
				<!--<div class="col-2">
                    <b><label>Total Expense :</label></b>
                    <input class="form-control text-right" type="text" name="total_transaction" value="₦ <?php echo formatMoney($total_transaction); ?>" readonly>        
                </div> -->
                <div class="col-2">
                    <b><label>Cashier :</label></b>
                    <input class="form-control text-left" type="text" name="username" value=" <?php echo ucfirst($user); ?>" readonly>   
                </div>
                </div>
            </form>
          <br>
          <br>
          <div class="col-12" style="width: 100%;">
            <table id="contact-detail" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>SN</th>
                <th>Date</th>
                <th>Invoice</th>
                <th>Cash</th>
                <th>POS</th>
                <th>Transfer</th>
                <th>Bank</th>
                <th>POS Medium</th>
                <th>Balance</th>
                <th>Total</th>
                <th>Client Name</th>
                <th>View</th>
                </tr>
            </thead>
            </table>
          </div>
        </div>
      </div>

    <!--team section end -->
    <!--footer section start -->
    <?php 
        //include('footer.php');
    ?>
    <!--footer section end -->
    <!-- Javascript files-->
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
<script>
$(document).ready(function() {
    $('#contact-detail').dataTable({
		"scrollX": true,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
        "ajax": "pages/view_sales_report_server.php"
    } );
} );
</script>
</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>