<?php include_once('includes/db_connect.php'); ?>
<?php 
include_once('functions/functions.php'); 
$user = $_SESSION['admin'];
$prod_code = $_GET['prod_code'];
//$branch_id = $_GET['branch_id'];
/*$debit = $_GET['debit'];
$credit = $_GET['credit'];
$balance = $_GET['balance'];*/
$userist_sql = "SELECT b.prod_name, a.prod_code, SUM(a.qty_in) AS stock_in, SUM(a.qty_out) AS stock_out, (SUM(a.qty_out) / SUM(a.qty_in) * 100) AS percentage FROM product_movement_log a LEFT JOIN product b ON a.prod_code = b.prod_code WHERE a.prod_code='$prod_code'";
$userList_query = mysqli_query($db_connect, $userist_sql);
$userList_rs = mysqli_fetch_assoc($userList_query);
$prod_name = $userList_rs['prod_name'];
?>
<div class="team_section layout_padding"  style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Stock Movement History</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>

<div class="box">
    <hr>
    <div class="row">
    <div class="col-5">
        <div class="form-group">
            <b><label>Product Name</label></b>
            <label><?php echo $prod_name ; ?></label>
         </div>
    </div>       
    </div>    
    <div class="row" >
    <!--<div class="col-5">
        <div class="form-group">
            <b><label>Total Stock In</label></b>
            <label><?php echo number_format($stock_in) ; ?></label>
         </div>
    </div> 
    <div class="col-3">
        <div class="form-group">
            <b><label>Total Stock Out</label></b>
            <label><?php echo number_format($stock_out) ; ?></label>
         </div>
    </div>
     <div class="col-3">
        <div class="form-group">
            <b><label>Balance</label></b>
            <label><?php echo "₦ ". number_format(abs($balance)) ; ?></label>
         </div>
    </div>-->              
    </div>
    <hr>
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">Movement History</h3>
                <hr>
                <table class="table table striped table-bordered">
                    <thead>
                    <tr>
                        <th>Movement ID</th>
                        <th>Product Code</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                        <th>Qty Left</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <?php
	$prod_code = $_GET['prod_code'];
    $query=mysqli_query($db_connect, "SELECT s.update_product_id, s.prod_code, s.qty_in, s.qty_out, s.description, s.date, @b := @b + s.qty_in - s.qty_out AS balance FROM(SELECT @b := 0.0) AS dummy CROSS JOIN product_movement_log AS s WHERE s.prod_code ='$prod_code'");      
     while($row = mysqli_fetch_array($query)){
         extract($row);
                    echo "<tbody>";
                    echo    "<tr>";
                    echo    "<td>{$update_product_id}</td>";
                    echo    "<td>{$prod_code}</td>";
                    echo    "<td>{$qty_in}</td>";
                    echo    "<td>";
                    echo $qty_out ;
                    echo "</td>";
                    echo    "<td>{$balance}</td>";
                    echo    "<td>{$description}</td>";
                    echo    "<td>{$date}</td>";
                    echo    "</tr>";
                    echo    "</tbody>";
     				}
                    ?>
                    <thead>
                    <tr>
                        <th>Movement ID</th>
                        <th>Product Code</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                        <th>Qty Left</th>
                        <th>Description</th>
                        <th>Date</th>
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
                        <a class="btn btn-warning" style="width: 100px;" href="dashboard.php?page=pages/view_stock_list">Back</a>
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