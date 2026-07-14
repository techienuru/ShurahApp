
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');

		$lastList_sql3 = "SELECT SUM(a.amount) as total_daily_expense FROM expence_table a WHERE a.date = '{$date}'";
		$user_query3 = mysqli_query($db_connect, $lastList_sql3);
		$userList_rs3 = mysqli_fetch_assoc($user_query3);
		$total_daily_expense = $userList_rs3['total_daily_expense'];

    ?>
        <div class="team_section layout_padding">
            <div class="container">
                <?php if (!empty($_GET['success'])): ?>
                    <div class="row">
                        <div class="col-12 alert alert-primary text-center" style="margin-top: 20px;">
                            <h4><?php echo $_GET['success']; ?></h4>
                        </div>
                    </div>
                <?php elseif (!empty($_GET['error'])): ?>
                    <div class="row">
                        <div class="col-12 alert alert-danger text-center" style="margin-top: 20px;">
                            <?php echo $_GET['error']; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Rest of the code -->
        </div>
			<div class="col-3">
				<div class="form-group">
					<b><label>Total Daily Expenses :</label></b>
					<input class="form-control" type="text" name="total_expenses" value="<?php echo "₦ ". number_format($total_daily_expense,2); ?>" >
				</div>
			</div>
<br>
    <div class="team_section layout_padding" style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Expense</h1>
        <p class="what_text_1"> </p>
          <div class="col-12" style="width: 100%;">
            <table id="contact-detail" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>SN</th>
                <th>Date</th>
                <th>Expense ID</th>
                <th>Expense Name</th>
                <th>Description</th>
                <th>Amount</th>
                <th>User Name</th>
                <th>Reversal</th>
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
        "ajax": "pages/view_expense_server.php"
    } );
} );
</script>
</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>