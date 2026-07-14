<?php 
    ob_start();

    $current_time = time();
    $time_string = date("YmdHis", $current_time);
    include("functions/form_functions.php");
    $date22 = date("d-m-Y");
    $date1 = date("Ymd");
    $user = $_SESSION['admin'];
    $user_iid = $_SESSION['user_id'];
    $id = $_GET['invoice'];
    $rnd =  createthree();
	$supply_status = $_GET['status'];
	$payment_status = $_GET['pay_mode'];
	//$attendant = $_GET['attendant'];
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
		var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
		disp_setting+="scrollbars=yes,width=800, height=400, left=10, top=25"; 
		var content_vlue = document.getElementById("content").innerHTML; 

		var docprint=window.open("","",disp_setting); 
		docprint.document.open(); 
		docprint.document.write('</head><body onLoad="self.print()" style="width: 150px; font-size: 13px; font-family: arial;">');
		docprint.document.write('<div style="margin-top: 5%;">');
		docprint.document.write('<div style="width: 90%; text-align: center;">'); // Center the content
		docprint.document.write(content_vlue); 
		docprint.document.close(); 
		docprint.focus();  
	}
</script>
    <?php
        $rnd = date('YmdHms');
        $time = date('H:i:s',$current_time);
        $date = date('Y-m-d');
        $invoice=$_GET['invoice'];
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

if(empty($_GET['client_id'])){
    $client = $_GET['client_name'];
}else{
    $client_id = $_GET['client_id'];
    $sql = "SELECT * FROM clients WHERE client_id=".$client_id;
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $client = $userList_rs['name'];
}

    ?>
<br>
<div style="margin-left: -85px;" >
   <a class = "btn btn-primary" href="javascript:Clickheretoprint()" style="font-size:15px";>Print</a> | <a class = "btn btn-primary" href="dashboard.php?page=pages/process_payment" style="font-size:15px";>Back</a>     
</div>
<div class="container" style="margin-top: 15px;">
	<br>
    <div class="content" id="content">
	<div class="row" style="margin: 0 auto; padding: 10px; width: 375px; font-weight: normal;">
		<div style="width: 100%;">
			<div>				
				<div style="display: flex; justify-right: center;">
					<img src="images/logo.png" alt="Logo">
                </div>
				<div style="display: flex; justify-content: center;">
					<h2 style="border-bottom: 2px solid;"><strong>Sales Receipt</strong></h2>
                </div>
						<p style="text-align: center; font-size: 14px; margin-top: 2px;">
							<b>Address:</b> <?php echo $address1 ; ?><br />
							<b>Contact 1:</b> <?php echo $phone_no1 ; ?><br>
							<b>Contact 2:</b> <?php echo $phone_no2 ; ?><br>
							<b>Email :</b> <?php echo $email ; ?><br>
						</p>
				</div>
				<div style="display: flex; justify-content: center;">
						<table cellspacing="0" style="font-family: arial; font-size: 12px;text-align:center;" width="100%">
					<thead>
						<tr>
							<th style="text-align: left" colspan="2"><strong>Date: <?php echo " ". $date22 ; ?></strong></th>
							<th style="text-align: left" colspan="2" >Reciept No: <?php echo $invoice;?></th>
                            
						</tr>
					</thead>
					<tbody>
						<tr>
							
							<td style="text-align: left" colspan='2'>Payment Type: <strong><?php echo " ". $payment_status ;?></strong></td>
							<td style="text-align: left" colspan='2'>Client Name: <strong><?php echo $client ;?></strong></td>
						</tr>
						<tr>
                            <td style="text-align: left" colspan='2'>Printed On : <strong><?php echo " ". $date; ?></strong></td>
						</tr>
                        
					</tbody>
						</table>
                </div>
			</div>
        <!--<div class="clearfix"></div>-->
		<br>
    <div style="width: 375px; float: center; height: 250px; margin-top:-10px">
			<div style="width: 100%">
				<table  cellspacing="0" style="font-family: arial; font-size: 16px;text-align:left;" width="100%">
					<thead>
						<tr>
							<th style="text-align: left" colspan="3"><strong>Products</strong></th>
							<th style="text-align: left" ><strong>Qty</strong></th>
							<th style="text-align: left" ><strong>Price</strong></th>
							<th style="text-align: left" ><strong>Total</strong></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$id=$_GET['invoice'];
                        $query = mysqli_query($db_connect,"SELECT * FROM sales_order WHERE invoice='{$invoice}'");
                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);
		                        echo "<tr>";
                                echo "<td   colspan='3'>{$name}</td>";
                                echo "<td >";
								echo $qty ;
								echo "</td>";
                                echo "<td >";?>
                            <?php
                            $ppp=$row['price'];
                                echo "₦". formatMoney($ppp);
                            ?><?php
                                echo "</td>";
                                echo "<td >";?>
                            <?php
                            $dfdf=$row['amount'];
                                echo "₦". formatMoney($dfdf);
                            ?><?php
                            echo "</td>";
                        }
                        ?>
                        <tr>
				        <td colspan="5">Grand Total:</td>
							<td colspan="4">
				    <?php
				    $sdsd=$_GET['invoice'];
                    $query = mysqli_query($db_connect,"SELECT sum(amount) as sum_total FROM sales_order WHERE invoice='{$invoice}'");
                                
                    while($row = mysqli_fetch_array($query)){
                    extract($row);?>
                      <?php
                      $fnfn=$row['sum_total'];
                    echo "₦". number_format($fnfn);
                    }
								?>
							</td>
						</tr>
							<tr>
								<td colspan="5">Amount Paid:</td>
								<td colspan="2">
				        <?php
				        $sdsd=$_GET['invoice'];
                        $query = mysqli_query($db_connect,"SELECT sum(total_payment) as sum_total FROM sales WHERE invoice='{$invoice}'");
                                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);?>
                      <?php
                        $fvfg=$row['sum_total'];
                        echo "₦". number_format($fvfg);
                        }
				        ?>
				        </td>
							</tr>
                    <?php
                        $sql = "SELECT * FROM sales WHERE invoice='{$invoice}'";
                        $user_query = mysqli_query($db_connect, $sql);
                        $userList_rs = mysqli_fetch_assoc($user_query);
                        if(empty($userList_rs['balance'])){
                            
                        }else{?>
                    <tr>
                        <td colspan="5"><strong style="font-size: 16px; color: ₦222222;">Balance :</strong></td>
				        <td colspan="2"><strong style="font-size: 16px; color: ₦222222;">
                            <?php
				        $sdsd=$_GET['invoice'];
                        $query = mysqli_query($db_connect,"SELECT sum(balance) as total_balance FROM sales WHERE invoice='{$invoice}'");
                                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);?>
                      <?php
                        $fmfg=$row['total_balance'];
                        echo "₦ ". formatMoney($fmfg, true);
                        }}
				        ?>
				        </strong></td>
                    </tr>  
				        <?php
                        $sql = "SELECT * FROM sales WHERE invoice='{$invoice}'";
                        $user_query = mysqli_query($db_connect, $sql);
                        $userList_rs = mysqli_fetch_assoc($user_query);
                        if(empty($userList_rs['discount'])){
                            
                        }else{?>
                    <tr>
                        <td colspan="5"><strong style="font-size: 16px; color: ₦222222;">Discount :</strong></td>
				        <td colspan="2"><strong style="font-size: 16px; color: ₦222222;">
                            <?php
				        $sdsd=$_GET['invoice'];
                        $query = mysqli_query($db_connect,"SELECT sum(discount) as total_discount FROM sales WHERE invoice='{$invoice}'");
                                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);?>
                      <?php
                        $fmfg=$row['total_discount'];
                        echo "₦ ". formatMoney($fmfg, true);
                        }}
						?>

					</tbody>
				</table>
					<!--<div style="margin-left: -21px;">
						<p style="text-align: center; font-size: 10px; margin-top: 5px;">
							<strong>*** Ensure the stock-keeper signs this reciept when you have comfirm the completeness of your goods . The company will not entertain any incomplete goods complain afterwards. ***</strong><br>
						</p>
                    </div>-->
				<div style="flex:1">
						<p style="text-align: center; font-size: 2px; margin-top: 5px;">
							<strong>*** <em style='font-size: 12px;'>Thanks for your patronage and please call again.</em> ***</strong><br>
						</p>
                    </div>
				<br>
				<!--<div style="flex:1">
					<b style='font-size: 16px; border-top: 2px dotted; text-align: left'>Cashier's Signature </b>
					<b style='font-size: 16px; border-top: 2px dotted; margin-left:180px; text-align: center'>Customer Signature </b>
					<b style='font-size: 16px; border-top: 2px dotted; margin-left:180px; text-align: right'>Stock-Keeper Signature </b>
				</div>-->
                <div style="flex:1; margin-top: -15px;" >
                    <b style='font-size: 12px;'>Prepared by :<em> <?php echo strtoupper($user) ; ?></em></b>
				</div>
            			<div style="text-align: left; margin-top: -5px;display: inline; ">
                             
                       </div>
			</div>
<?php
    //Update product table with values from the sales_order table.
$sql = "UPDATE product JOIN sales_order ON product.prod_code = sales_order.prod_code SET product.qty_left = product.qty_left - sales_order.qty WHERE sales_order.prod_code = product.prod_code AND sales_order.invoice ='{$_GET['invoice']}' AND sales_order.status = 'pending'";
$update_query = mysqli_query($db_connect,$sql);

if($update_query){
// Retrieve data from source table for destination branch id
$sourceQuery1 = "SELECT * FROM sales_order WHERE invoice='{$_GET['invoice']}' AND sales_order.status ='pending'";
$sourceResult1 = mysqli_query($db_connect, $sourceQuery1);
// Process and populate data into destination table
if ($sourceResult1) {
	while ($row = mysqli_fetch_assoc($sourceResult1)) {
		// Modify/process data if needed

		// Insert into movement table for source branch
		$qty_in = 0;
		$description = 'product sales';
		$status = 'processed';
		$expiration = 'default';
        $invoice = $_GET['invoice'];
		$destQuery1 = "INSERT INTO product_movement_log (update_product_id, prod_code, name, qty_in, qty_out, category, expiration, description, status, user_id, date) VALUES ('".$invoice."','".$row['prod_code']."','".$row['name']."','".$qty_in."','".$row['qty']."','".$row['category']."','".$expiration."','".$description."','".$status."','".$user_iid."','".$row['date']."')";
		mysqli_query($db_connect, $destQuery1);
	}
	mysqli_free_result($sourceResult1);
}
$status = 'processed';
$sql = "UPDATE sales_order SET status ='{$status}' WHERE invoice ='{$_GET['invoice']}' AND sales_order.status ='pending'";
$update_query = mysqli_query($db_connect,$sql);
if($update_query){
    
}
    
}
       
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
    $('#category_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#category_id option:selected').text();
    var userid = $('#category_id').val();
        
    //$('₦result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script>
$(document).ready(function(){
    $('#supp_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#supp_id option:selected').text();
    var userid = $('#supp_id').val();
        
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