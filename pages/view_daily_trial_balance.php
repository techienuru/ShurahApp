<?php
    ob_start();
    $user = $_SESSION['admin'];
    $user_iid = $_SESSION['user_id'];

	$date = date('Y-m-d');
	$date1 = date('Y-m-d');
	$date2 = date('Y-m-d');
	$lastList_sql = "SELECT SUM(cash) as cash, SUM(pos) AS pos, SUM(transfer) as transfer 
	FROM sales WHERE date ='{$date}'";
	$lastList_query = mysqli_query($db_connect, $lastList_sql);
	$lastList_rs = mysqli_fetch_assoc($lastList_query);
	$total_cash = $lastList_rs['cash'];
	$total_pos = $lastList_rs['pos'];
	$total_transfer = $lastList_rs['transfer'];
	$total_transaction = $total_cash + $total_pos + $total_transfer;

	$lastList_sql3 = "SELECT SUM(a.amount) as total_daily_expense FROM expence_table a WHERE a.date = '{$date}'";
	$user_query3 = mysqli_query($db_connect, $lastList_sql3);
	$userList_rs3 = mysqli_fetch_assoc($user_query3);
	$total_daily_expense = $userList_rs3['total_daily_expense'];

	$balance = $total_cash - $total_daily_expense;
?>
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = createthree();
        $date = date('Y-m-d');

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
    <div class="team_section layout_padding"  style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital"></h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b>DAILY TRIAL BALANCE</b></h1>
            <div class="container">
                <h3 class="text-center"><b></b></h3>
				<form action="dashboard.php?page=pages/view_daily_trial_balance" method="post">
				<div class="row">
                <div class="col-5">
                    <b><label>Start Date :</label></b>
                    <input class="form-control text-right" type="date" name="date1">        
                </div>
				<div class="col-5">
                    <b><label>End Date :</label></b>
                    <input class="form-control text-right" type="date" name="date2">        
                </div>
				<div class="col-2">
					<div class="form-group">
						<div class="text-right">
							<button type="submit" style="margin-top: 15px" id="submit" name="submit" class="btn btn-primary">Get Details</button>
						</div>
					</div>     
                </div>
				</div>
                <hr>
		
				<?php 
					if(isset($_POST['submit'])){
					$date1 = $_POST['date1'];
					$date2 = $_POST['date2'];
					$lastList_sql = "SELECT SUM(cash) as cash, SUM(pos) AS pos, SUM(transfer) as transfer FROM sales WHERE date BETWEEN '{$date1}' AND '{$date2}'";
					$lastList_query = mysqli_query($db_connect, $lastList_sql);
					$lastList_rs = mysqli_fetch_assoc($lastList_query);
					$total_cash = $lastList_rs['cash'];
					$total_pos = $lastList_rs['pos'];
					$total_transfer = $lastList_rs['transfer'];
					$total_transaction = $total_cash + $total_pos + $total_transfer;

					$lastList_sql3 = "SELECT SUM(a.amount) as total_daily_expense FROM expence_table a WHERE a.date BETWEEN '{$date1}' AND '{$date2}'";
					$user_query3 = mysqli_query($db_connect, $lastList_sql3);
					$userList_rs3 = mysqli_fetch_assoc($user_query3);
					$total_daily_expense = $userList_rs3['total_daily_expense'];

					$balance = $total_cash - $total_daily_expense;
					}
				?>
                
            <div class="row" style="margin-left:1px;">
                <div class="col-3">
                    <b><label>Total Cash :</label></b>
                    <input class="form-control text-right" type="text" name="cash" value="₦ <?php echo formatMoney($total_cash); ?>" readonly>        
                </div>
                <div class="col-3">
                    <b><label>Total POS :</label></b>
                    <input class="form-control text-right" type="text" name="pos" value="₦ <?php echo formatMoney($total_pos); ?>" readonly>        
                </div>            
                <div class="col-3">
                    <b><label>Total Transfer :</label></b>
                    <input class="form-control text-right" type="text" name="transfer" value="₦ <?php echo formatMoney($total_transfer); ?>" readonly>        
                </div>            
                <div class="col-3">
                    <b><label>Total Transaction :</label></b>
                    <input class="form-control text-right" type="text" name="total_transaction" value="₦ <?php echo formatMoney($total_transaction); ?>" readonly>        
                </div>   
				<div class="col-3">
                    <b><label>Total Expense :</label></b>
                    <input class="form-control text-right" type="text" name="total_transaction" value="₦ <?php echo formatMoney($total_daily_expense); ?>" readonly>        
                </div>
				<div class="col-3">
                    <b><label>Balance (Total Cash - Total Expense) :</label></b>
                    <input class="form-control text-right" type="text" name="total_transaction" value="₦ <?php echo formatMoney($balance); ?>" readonly>        
                </div> 
                <div class="col-3">
                    <b><label>Cashier :</label></b>
                    <input class="form-control text-left" type="text" name="username" value=" <?php echo ucfirst($user); ?>" readonly>   
                </div>
                </div>
                     <hr>
					<p>Report from <?php echo " ".$date1 ; ?> to <?php echo $date2 ; ?></p>
                </form>
            </div>
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
    <script src="../js/dist/js/jquery-3.6.0.min.js"></script>
    <script src="../js/dist/js/select2.min.js"></script>

</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>
<script>
$(document).ready(function(){
    $('#category_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#category_id option:selected').text();
    var userid = $('#category_id').val();
        
    //$('#result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script>
$(document).ready(function(){
    $('#supp_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#supp_id option:selected').text();
    var userid = $('#supp_id').val();
        
    //$('#result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script type="text/javascript">
    function multi(){
        var qty = document.getElementById('qty').value;
        var cart_qty = document.getElementById('cart_qty').value;
        var result = parseInt(qty) * parseInt(cart_qty);
        if(!isNaN(result)){
            document.getElementById('pcs').value = result;
        }
    }

</script>