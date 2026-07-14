<?php 
    ob_start();

    $current_time = time();
    $time_string = date("YmdHis", $current_time);
    include("functions/form_functions.php");
    $date22 = date("d-m-Y");
    $date1 = date("Ymd");
    $user = $_SESSION['admin'];
    $id = $_POST['invoice'];
    $rnd =  createthree();
	//$supply_status = $_GET['status'];
	//$payment_status = $_GET['pay_mode'];
//echo $cust_id;
$date = date("Y-m-d H:i:s");
//echo $cust_name;

    auto_logout();
    if(!isset($_SESSION['admin'])){
        header('location:login.php');
    }
?>
<script language="javascript">
	function Clickheretoprint()
	{ 
		var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
		disp_setting += "scrollbars=yes,width=980, height=400, left=100, top=50";
		var content_value = document.getElementById("content").innerHTML; 

		var docprint = window.open("", "", disp_setting);
		docprint.document.open(); 
		docprint.document.write('</head><body onLoad="self.print()" style="width: 100%; font-size: 14px; font-family: arial;">');     docprint.document.write('<div style="margin-top: 5%;">');     
		docprint.document.write('<div style="width: 100%; text-align: center;">'); // Center the content
		docprint.document.write(content_value); 
		docprint.document.write('</div>');
		docprint.document.close(); 
		docprint.focus(); 
	}
</script>
    <?php
        $rnd = date('YmdHms');
        $time = date('H:i:s',$current_time);
        $date = date('Y-m-d');
$invoice=$_POST['invoice'];
$query = "SELECT * FROM sales WHERE invoice='{$invoice}'";
        $prev_set = mysqli_query($db_connect, $query);
        $prevList_rs = mysqli_fetch_assoc($prev_set);
while($row = mysqli_fetch_assoc($prev_set)){
    extract($row);
	$invoice=$row['invoice'];
	$date=$row['date'];
	//$cash=$row['due_date'];
	$cashier=$row['cashier'];
	$am=$row['amount'];

}
    $sql = "SELECT * FROM sales WHERE invoice='$id'";
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $client = $userList_rs['client_name'];
    $date333 = $userList_rs['date'];

		//sql for address
		$company_details_sql = "SELECT * FROM company_details";
		$company_details_query = mysqli_query($db_connect, $company_details_sql);
		$company_details_List_rs = mysqli_fetch_assoc($company_details_query);
		$company_name = $company_details_List_rs['company_name'];
		$motto = $company_details_List_rs['motto'];
		$address1 = $company_details_List_rs['address1'];
		$address2 = $company_details_List_rs['address2'];
		$phone_no1 = $company_details_List_rs['phone_no1'];
		$phone_no2 = $company_details_List_rs['phone_no2'];
		$email = $company_details_List_rs['email'];
		$website = $company_details_List_rs['website'];
    ?>
<div style="margin-left: 30px; margin-top: 30px;" >
   <a class = "btn btn-primary" href="javascript:Clickheretoprint()" style="font-size:15px";>Print</a> | <a class = "btn btn-primary" href="dashboard.php?page=pages/add_credit_sales_invoice" style="font-size:15px";>Back</a>     
</div>
<div class="container" style="margin-top: 15px;">
	<br>
    <div class="content" id="content">
	<div class="row" style="margin: 0 20px; padding:16px; width:900px; height:800px; font-weight: normal;">
		<div style="width: 100%;">
			<div>
				<div class="main_logo" style="display: flex;">
                    <div class="logo">
                        <img src="images/logo1.png" alt="Logo">
						<h4 style="color:blue;"><b><?php echo $company_name; ?></b></h4>
                    </div> 
					<div class="logo" style="margin-left:2px; flex:1">
						<p style="text-align: left; font-size: 14px; margin-top: 2px;">
							<strong>Head Office:</strong><?php echo " ".$address1; ?><br>
							<strong>Branch Office:</strong><?php echo " ". $address2; ?><br>
							<strong>Telephone:</strong><?php echo " ". $phone_no1. ", ".$phone_no2; ?><br>
							<strong>Email:</strong><?php echo " ". $email; ?><br>
						</p>
                    </div>
					<div class="logo" style="margin-left:2px; flex:1; width: 300px;">
						<table border="1" cellpadding="2" cellspacing="0" style="font-family: arial; font-size: 16px;text-align:left;" width="100%">
					<thead>
						<tr>
							<th style="font-size: 12px; text-align: left" colspan="2"><strong>Date: <?php echo " ". $date333 ; ?></strong></th>
							<th style="font-size: 12px; text-align: left" colspan="2" >Reciept No: <?php echo " "." ". $invoice;?></th>
						</tr>
					</thead>
						</table>
                    </div>
				</div>
				<div style="display: flex; justify-content: center;">
					<strong>*** <em style='font-size: 13px; color:#FF6600; margin-top; -50px;'><?php echo $motto; ?></em> ***</strong><br>
                </div>
				<div style="display: flex; justify-content: center;">
					<h1 style="border-bottom: 1px solid;"><strong>Invoice</strong></h1>
                </div>
				</div>
			</div>
        <div class="clearfix"></div>
    <div style="width: 100%; float: center; height: 578px;">
			<div style="width: 100%">
				<table border="1" cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 16px;text-align:left;" width="100%">
					<thead>
						<tr>
							<th style="font-size: 16px; text-align: left" colspan="3"><strong>Description Of Goods</strong></th>
							<th style="font-size: 16px; text-align: left" ><strong>Quantity</strong></th>
							<th style="font-size: 16px; text-align: left" ><strong>Price</strong></th>
							<th style="font-size: 16px; text-align: left" ><strong>Total</strong></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$id=$_POST['invoice'];
                        $query = mysqli_query($db_connect,"SELECT * FROM sales_order WHERE invoice='{$id}'");
                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);
		                        echo "<tr>";
                                echo "<td style='font-size: 16px;'  colspan='3'>{$name}</td>";
                                echo "<td style='font-size: 16px;'>{$qty}</td>";
                                echo "<td style='font-size: 16px;'>";?>
                            <?php
                            $ppp=$row['price'];
                                echo "₦ ". formatMoney($ppp, true);
                            ?><?php
                                echo "</td>";
                                echo "<td style='font-size: 16px;'>";?>
                            <?php
                            $dfdf=$row['amount'];
                                echo "₦ ". formatMoney($dfdf, true);
                            ?><?php
                            echo "</td>";
                        }
                        ?>
                        <tr>
				        <td colspan="5"><strong style="font-size: 16px; color: ₦222222;">Grand Total:</strong></td>
							<td colspan="4"><strong style="font-size: 16px; color: ₦222222;">
				    <?php
				    $sdsd=$_POST['invoice'];
                    $query = mysqli_query($db_connect,"SELECT sum(amount) as sum_total FROM sales_order WHERE invoice='{$id}'");
                                
                    while($row = mysqli_fetch_array($query)){
                    extract($row);?>
                      <?php
                      $fnfn=$row['sum_total'];
                    echo "₦ ". formatMoney($fnfn, true);
                    }
								?>
							</strong></td>
						</tr>
							<tr>
								<td colspan="5"><strong style="font-size: 16px; color: ₦222222;">Amount Paid:</strong></td>
								<td colspan="2"><strong style="font-size: 16px; color: ₦222222;">
				        <?php
				        $sdsd=$_POST['invoice'];
                        $query = mysqli_query($db_connect,"SELECT sum(total_payment) as sum_total FROM sales WHERE invoice='{$id}'");
                                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);?>
                      <?php
                        $fvfg=$row['sum_total'];
                        echo "₦ ". formatMoney($fvfg, true);
                        }
				        ?>
				        </strong></td>
							</tr>
                    <tr>
                        <td colspan="5"><strong style="font-size: 16px; color: ₦222222;">Balance :</strong></td>
				        <td colspan="2"><strong style="font-size: 16px; color: ₦222222;">
                            <?php
				        $sdsd=$_POST['invoice'];
                        $query = mysqli_query($db_connect,"SELECT sum(balance) as total_balance FROM sales WHERE invoice='{$id}'");
                                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);?>
                      <?php
                        $fmfg=$row['total_balance'];
                        echo "₦ ". formatMoney($fmfg, true);
                        }
				        ?>
				        </strong></td>
                    </tr>
                                                <tr>
                        <td colspan="5"><strong style="font-size: 16px; color: ₦222222;">Discount :</strong></td>
				        <td colspan="2"><strong style="font-size: 16px; color: ₦222222;">
                            <?php
				        $sdsd=$_POST['invoice'];
                        $query = mysqli_query($db_connect,"SELECT sum(discount) as total_discount FROM sales WHERE invoice='{$id}'");
                                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);?>
                      <?php
                        $fmfg=$row['total_discount'];
                        echo "₦ ". formatMoney($fmfg, true);
                        }
				        ?>
				        </strong></td>
                    </tr>
								<?php
						?>
						<tr>

                            <?php
								/*if($pt=='credit'){
									echo $cash;
								}*/
								/*if($pt=='cash'){
									//echo formatMoney($amount, true);
								}*/
								?>
						</tr>

					</tbody>
				</table>
					<div style="flex:1">
						<p style="text-align: center; font-size: 10px; margin-top: 5px;">
							<strong>*** Recieved the above goods in good condition. No refund of money after payment ***</strong><br>
						</p>
                    </div>
				<div style="flex:1">
						<p style="text-align: center; font-size: 10px; margin-top: 5px;">
							<strong>*** <em style='font-size: 16px;'>Thanks for your patronage, Pls call again.</em> ***</strong><br>
						</p>
                    </div>
				<br>
				<br>
				<br>
				<div style="flex:1">
					<b style='font-size: 16px; border-top: 2px dotted; text-align: left'>Customer Signature</b>
					<b style='font-size: 16px; border-top: 2px dotted; margin-left:420px; text-align: center'>FOR: SOLARCAM TECHNOLOGY</b>
				</div>
				<br>
				<br>
            			<div style="text-align: left; margin-top: 13px;display: inline; ">
                            <b style='font-size: 16px;'>Prepared by :<em> <?php echo strtoupper($user) ; ?></em></b> 
                       </div>
			</div>

<?php
    //Update product table with values from the sales_order table.
/*$sql = "UPDATE product JOIN sales_order ON product.prod_code = sales_order.prod_code SET product.qty_left = product.qty_left - sales_order.qty_purchased WHERE sales_order.prod_code = product.prod_code AND sales_order.invoice ='{$_GET['invoice']}'";
$update_query = mysqli_query($db_connect,$sql);

    //Delete all data in sales_order table relating to the invoice.
$del_sql = "DELETE FROM sales_order WHERE invoice ='$id'";
$del_query = mysqli_query($db_connect, $del_sql);*/
   
/*$debit_description = "Cost of Goods purchased";
$credit = $_SESSION['cash_tendered'];
$credit_description = "Payment for Goods purchased";

        if($_GET['bal'] == 0){
        //For debit leg.
            //$debit = $fgfg;
            $credit1 = 0;
            $debit1 = 0;
            $balance = 0;
        $query_legder_debit = "INSERT INTO customer_ledger (cust_id, date, invoice, description, debit, credit, balance ) VALUES ('$cust_id','{$date}','{$invoice}','{$debit_description}','{$debit}','{$credit1}','{$balance}')";
        $result_query_legder_debit = mysqli_query($db_connect, $query_legder_debit);  
        }else{
            $debit = $_GET['bal'];
            $credit1 = 0;
            $debit1 = 0;
            $balance = 0;
        $query_legder_debit = "INSERT INTO customer_ledger (cust_id, date, invoice, description, debit, credit, balance ) VALUES ('$cust_id','{$date}','{$invoice}','{$debit_description}','{$debit}','{$credit1}','{$balance}')";
        $result_query_legder_debit = mysqli_query($db_connect, $query_legder_debit);  
        }
    
        //For credit leg.
        $query_legder_credit = "INSERT INTO customer_ledger (cust_id, date, invoice, description, debit, credit, balance) VALUES ('$cust_id','{$date}','{$invoice}','{$credit_description}','{$debit1}','{$credit}','{$balance}')";
        $result_query_legder_credit = mysqli_query($db_connect, $query_legder_credit);*/
        
?>      

		</div>
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
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/dist/js/jquery-3.6.0.min.js"></script>
    <script src="js/dist/js/select2.min.js"></script>

</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>
<script>
$(document).ready(function(){
    $('₦category_id').select2();
    
    $('₦but_read').click(function(){
    var username=$('₦category_id option:selected').text();
    var userid = $('₦category_id').val();
        
    //$('₦result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script>
$(document).ready(function(){
    $('₦supp_id').select2();
    
    $('₦but_read').click(function(){
    var username=$('₦supp_id option:selected').text();
    var userid = $('₦supp_id').val();
        
    //$('₦result').html("id:" + userid + ",name:" +username);
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
