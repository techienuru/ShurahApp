<?php 
    ob_start();

    $current_time = time();
    $time_string = date("YmdHis", $current_time);
    include("functions/form_functions.php");
    $date22 = date("d-m-Y");
    $date1 = date("Ymd");
    $user = $_SESSION['admin'];
	$user_idy = $_SESSION['user_id'];
    $update_id = $_GET['update_id'];
    $rnd =  createthree();
	$date = date("Y-m-d H:i:s");
        // Generate a unique receipt number
        $minRange = 100000;
        $maxRange = 999999;
        $receiptNumber = generateUniqueReceiptNumber($minRange, $maxRange, $previousReceiptNumbers);


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
		docprint.document.write('<div style="width: 100%; text-align: left;">'); // Center the content
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

		/*$userist_sql = "SELECT * FROM branch_to_branch_transfer WHERE transfer_id='{$id}'";
		$userList_query = mysqli_query($db_connect, $userist_sql);
		$userList_rs = mysqli_fetch_assoc($userList_query);
		$transfer_id = $userList_rs['transfer_id'];
		$request_date = $userList_rs['request_date'];
		$src_branch_id = $userList_rs['branch_id'];
		$dstn_branch_id = $userList_rs['destination_id'];

		$srcList_sql = "SELECT * FROM branch WHERE branch_id='{$src_branch_id}'";
		$srcList_query = mysqli_query($db_connect, $srcList_sql);
		$srcList_rs = mysqli_fetch_assoc($srcList_query);
		$src_branch_name = $srcList_rs['branch_name'];

		$dstnList_sql = "SELECT * FROM branch WHERE branch_id='{$dstn_branch_id}'";
		$dstnList_query = mysqli_query($db_connect, $dstnList_sql);
		$dstnList_rs = mysqli_fetch_assoc($dstnList_query);
		$dstn_branch_name = $dstnList_rs['branch_name'];*/

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
<div style="margin-left: 85px; margin-top: 30px;" >
   <a class = "btn btn-primary" href="javascript:Clickheretoprint()" style="font-size:15px;";>Print</a> | <a class = "btn btn-primary" href="dashboard.php?page=pages/bulk_update_product_pricelist&update_id=<?php echo $receiptNumber; ?>&prod_id=" style="font-size:15px";>Back</a>     
</div>
<div class="container" style="margin-top: 15px;">
	<br>
	<br>
	<br>
    <div class="content" id="content">
	<div class="row" style="margin: 0 50px; padding:16px; width:1050px; height:800px; font-weight: normal;">
		<div style="width: 100%;">
			<div>
				<div class="main_logo" style="display: flex;">
                    <div class="logo">
                        <img src="images/logo.png" alt="Logo">
<!--						<h2 style="color:blue;"><b><?php echo $company_name; ?></b></h2>-->
                    </div> 
					<div class="logo" style="margin-left:2px; flex:1">
						<p style="text-align: left; font-size: 14px; margin-top: 2px;">
							<strong>Head Office:</strong><?php echo " ".$address1; ?><br>
							<strong>Branch Office:</strong><?php echo " ". $address2; ?><br>
							<strong>Telephone:</strong><?php echo " ". $phone_no1. ", ".$phone_no2; ?><br>
						</p>
                    </div>
					<div class="logo" style="margin-left:2px; flex:1; width: 400px;">
						<table border="1" cellpadding="2" cellspacing="0" style="font-family: arial; font-size: 16px;text-align:left;" width="100%">
					<thead>
						<tr>
							<th style="font-size: 12px; text-align: left" colspan="2"><strong>Date: <?php echo " ". $date ; ?></strong></th>
							<th style="font-size: 12px; text-align: left" colspan="2" >Update ID: <?php echo " "." ". $update_id ;?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<!--<td style="font-size: 12px; text-align: left" colspan='2'>Source Branch ID: <strong><?php echo $src_branch_id ;?></strong></td>
							<td style="font-size: 12px; text-align: left" colspan='2'>Destination Branch ID: <strong><?php echo " ". $dstn_branch_id ;?></strong></td>
							
						</tr>
					</tbody>
					<tbody>
						<tr>
							<td style="font-size: 12px; text-align: left" colspan='2'>Source Branch: <strong><?php echo $src_branch_name ;?></strong></td>
							<td style="font-size: 12px; text-align: left" colspan='2'>Destination Branch: <strong><?php echo " ". $dstn_branch_name ;?></strong></td>-->
							
						</tr>
					</tbody>
						
						</table>
                    </div>
				</div>
				<div style="display: flex; justify-content: center;">
					<strong>*** <em style='font-size: 16px; color:#FF6600; margin-top; -30px;'><?php echo $motto; ?></em> ***</strong><br>
                </div>
				</div>
			</div>
		<br>
				<div style="display: flex; justify-content: center;">
					<h2 style="border-bottom: 1px solid;"><strong>Update Invoice</strong></h2>
                </div>
        <div class="clearfix"></div>
	<br>
	<br>
    <div style="width: 100%; float: center; height: 578px;">
			<div style="width: 100%">
				<table border="1" cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 16px;text-align:left;" width="100%">
					<thead>
						<tr>
							<th style="font-size: 16px; text-align: left" colspan="3"><strong>Product Code</strong></th>
							<th style="font-size: 16px; text-align: left" colspan="3"><strong>Name</strong></th>
							<th style="font-size: 16px; text-align: left" colspan="3"><strong>Cost Price</strong></th>
							<th style="font-size: 16px; text-align: left" colspan="3"><strong>Selling Price</strong></th>
							<th style="font-size: 16px; text-align: left" colspan="3"><strong>Category</strong></th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $query = mysqli_query($db_connect,"SELECT a.update_product_id, a.prod_code, a.name, a.cost_price, a.selling_price, a.category FROM update_product_price_list_order a LEFT JOIN product b ON a.prod_code = b.prod_code WHERE update_product_id='{$update_id}'");
                
                        while($row = mysqli_fetch_array($query)){
                        extract($row);
		                        echo "<tr>";
                                echo "<td style='font-size: 16px;'  colspan='3'>{$prod_code}</td>";
                                echo "<td style='font-size: 16px;'  colspan='3'>{$name}</td>";
                                echo "<td style='font-size: 16px;'  colspan='3'>{$cost_price}</td>";
                                echo "<td style='font-size: 16px;'  colspan='3'>{$selling_price}</td>";
                                echo "<td style='font-size: 16px;'  colspan='3'>{$category}</td>";
                                echo "<td style='font-size: 16px;'>";
								echo "</td>";
                        }
                        ?>
					</tbody>
				</table>
					<div style="flex:1">
						<p style="text-align: center; font-size: 10px; margin-top: 5px;">
							<!--<strong>*** Ensure the stock-keeper signs this reciept when you have comfirm the completeness of your goods . The company will not entertain any incomplete goods complain afterwards. ***</strong><br>-->
						</p>
                    </div>
				<div style="flex:1">
						<p style="text-align: center; font-size: 10px; margin-top: 5px;">
							<!--<strong>*** <em style='font-size: 16px;'>Thanks for your patronage, Pls call again.</em> ***</strong><br>-->
						</p>
                    </div>
				<br>
				<br>
				<br>
				<!--<div style="flex:1">
					<b style='font-size: 16px; border-top: 2px dotted; text-align: left'>Source Branch: </b>
					<b style='font-size: 16px; border-top: 2px dotted; margin-left:570px; text-align: center'>Destination Branch</b>
				</div>-->
				<br>
            			<div style="text-align: left; margin-top: 13px;display: inline; ">
                            <b style='font-size: 16px;'>Prepared by :<em> <?php echo strtoupper($user) ; ?></em></b> 
                       </div>
			</div>

<?php
    //Update product table with values from the sales_order table.
$sql = "UPDATE product JOIN update_product_price_list_order ON product.prod_code = update_product_price_list_order.prod_code SET product.cost_price = update_product_price_list_order.cost_price, product.selling_price = update_product_price_list_order.selling_price WHERE update_product_price_list_order.prod_code = product.prod_code AND update_product_price_list_order.update_product_id ='{$_GET['update_id']}'";
$update_query = mysqli_query($db_connect,$sql);

// Retrieve data from source table for destination branch id
/*$sourceQuery1 = "SELECT * FROM update_product_order WHERE update_product_id='{$_GET['update_id']}'";
$sourceResult1 = mysqli_query($db_connect, $sourceQuery1);
// Process and populate data into destination table
if ($sourceResult1) {
	while ($row = mysqli_fetch_assoc($sourceResult1)) {
		// Modify/process data if needed

		// Insert into movement table for source branch
		$qty_out = 0;
		$movement_type = 'product update';
		$date1 = date('Y-m-d');
		$destQuery1 = "INSERT INTO product_movement_log (prod_code, qty_in, qty_out, movement_type, user_id, movement_date) VALUES ('" . $row['prod_code'] . "', '" . $row['qty'] . "', '" . $qty_out . "', '" . $movement_type . "','" . $user_idy . "', '" . $date1 . "')";
		mysqli_query($db_connect, $destQuery1);
	}
	mysqli_free_result($sourceResult1);
}*/
        
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
    @media print {
        @page {
            size: A4;
            margin: 0;
        }
        
        body {
            margin: 0;
            padding: 0;
        }

        #content {
            position: relative;
            top: 33%; /* 33% is one-third of the page height */
        }
    }
</style>

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