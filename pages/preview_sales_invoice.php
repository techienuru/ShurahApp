<?php 
    ob_start();

    $current_time = time();
    $time_string = date("YmdHis", $current_time);
    include("functions/form_functions.php");
    $date = date("d-m-Y");
    $date1 = date("Ymd");
    $user = $_SESSION['admin'];
    $invoice = $_GET['invoice'];
    $rnd =  createthree();
	$date22 = date("d-m-Y");
    /*if(empty($_GET['status']))
    {
       $supply_status = "SUPPLIED"; 
    }else{
       $supply_status = "NOT SUPPLIED";
    }*/

//echo $cust_id;
$date = date("Y-m-d H:i:s");
//echo $cust_name;
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

    $lastList_sql = "SELECT * FROM sales WHERE invoice='{$invoice}'";
    $lastList_query = mysqli_query($db_connect, $lastList_sql);
    $lastList_rs = mysqli_fetch_assoc($lastList_query);
    //$attendant = $lastList_rs['attendant'];

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
        //$date = date('Y-m-d');
    $invoice = $_GET['invoice'];
	$lastList_sql = "SELECT * FROM sales_order LEFT JOIN sales ON sales_order.invoice = sales.invoice WHERE sales_order.invoice ='{$invoice}'";
	$lastList_query = mysqli_query($db_connect, $lastList_sql);
	$lastList_rs = mysqli_fetch_assoc($lastList_query);

	// Checking and handling potential null values
	$prod_id = isset($lastList_rs['prod_code']) ? $lastList_rs['prod_code'] : "N/A";
	$date = isset($lastList_rs['date']) ? $lastList_rs['date'] : "N/A";
	$cashier = isset($lastList_rs['cashier']) ? $lastList_rs['cashier'] : "N/A";
	$amount = isset($lastList_rs['amount']) ? $lastList_rs['amount'] : "N/A";
	$client_name = isset($lastList_rs['client_name']) ? $lastList_rs['client_name'] : "N/A";

    ?>
<br>
<a class = "btn btn-primary" href="dashboard.php?page=pages/view_sales_report" style="font-size:15px";>Back</a> 
            <!--<div style="margin-left: -85px;" >
               <a class = "btn btn-primary" href="javascript:Clickheretoprint()" style="font-size:15px";>Print</a> | <a class = "btn btn-primary" href="dashboard.php?page=pages/view_reciept" style="font-size:15px";>Back</a>     
            </div>-->
<div class="container">
    <div class="content" id="content">
	<div class="row" style="margin: 0 auto; padding: 10px; width: 365px; font-weight: normal;">
		<div style="width: 100%;">
			<div> 
					
				<div style="display: flex; justify-content: left;">
					<img src="images/logo.png" alt="Logo">
                </div>
				<div style="display: flex; justify-content: center;">
					<h2 style="border-bottom: 2px solid;"><strong>Sales Receipt</strong></h2>
                </div>
						<p style="text-align: center; font-size: 16px; margin-top: 2px;">
							<b>Address:</b> <?php echo $address1 ; ?><br />
							<b>Contact 1:</b> <?php echo $phone_no1 ; ?><br>
							<b>Contact 2:</b> <?php echo $phone_no2 ; ?><br>
							<b>Email :</b> <?php echo $email ; ?><br>
						</p>
				<div style="display: flex; justify-content: center;">
						<table cellspacing="0" style="font-family: arial; font-size: 13px;text-align:left;" width="100%">
					<thead>
						<tr>
							<th style="text-align: left" colspan="2"><strong>Date: <?php echo " ". $date22 ; ?></strong></th>
							<th style="text-align: left" colspan="2" >Reciept No: <?php echo " "." ". $invoice;?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align: left" colspan='2'>Client Name: <strong><?php echo $client_name ;?></strong></td>
							<!--<td style="text-align: left" colspan='2'>Attendant: <strong><?php echo " ". $attendant ;?></strong></td>-->
							
						</tr>
						<tr>
							<td style="text-align: left">Printed On : <strong><?php echo " ". $date; ?></strong></td>
						</tr>
					</tbody>
						</table>
					</div>
				</div>
			</div>
        <div class="clearfix"></div>
    <div style="width: 375px; float: center; height: 250px;">
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
                    <tr>
                        <td colspan="5">Balance :</td>
				        <td colspan="2">
                            <?php
				        $sdsd=$_GET['invoice'];
                        $query = mysqli_query($db_connect,"SELECT sum(balance) as total_balance FROM sales WHERE invoice='{$invoice}'");
                                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);?>
                      <?php
                        $fmfg=$row['total_balance'];
                        echo "₦". number_format($fmfg);
                        }
				        ?>
				       </td>
                    </tr>
                                                <tr>
                        <td colspan="5">Discount :</td>
				        <td colspan="2">
                            <?php
				        $sdsd=$_GET['invoice'];
                        $query = mysqli_query($db_connect,"SELECT sum(discount) as total_discount FROM sales WHERE invoice='{$invoice}'");
                                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);?>
                      <?php
                        $fmfg=$row['total_discount'];
                        echo "₦". number_format($fmfg);
                        }
				        ?>
				        </td>
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
						<p style="text-align: center; font-size: 2px; margin-top: 5px;">
							<strong>*** <em style='font-size: 12px;'>Thanks for your patronage and please call again.</em> ***</strong><br>
						</p>
                    </div>
				<br>
            			<div style="text-align: left; margin-top: -5px;display: inline; ">
                            <b style='font-size: 12px;'>Prepared by :<em> <?php echo strtoupper($user) ; ?></em></b> 
                       </div>

			</div>
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