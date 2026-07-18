<?php include_once('includes/db_connect.php'); ?>
<?php
include_once('functions/functions.php');
$user = $_SESSION['admin'];
$id = $_GET['id'];

$lastList_sql4 = "SELECT a.update_product_id, a.description, a.date, b.username FROM update_product a LEFT JOIN users b ON a.user_id = b.user_id WHERE a.update_product_id ='{$id}'";
$lastList_query4 = mysqli_query($db_connect, $lastList_sql4);
$lastList_rs = mysqli_fetch_assoc($lastList_query4);
if (empty($lastList_rs)) {
} else {
    $description = $lastList_rs['description'];
    $date = $lastList_rs['date'];
    $username = $lastList_rs['username'];
}

$value_sql = "SELECT a.update_product_id, a.prod_code, a.name, a.qty_in, b.divider, c.category_name, a.date, b.cost_price, SUM(a.qty_in * b.cost_price) AS CP_Value, SUM(a.qty_in * b.selling_price) AS SP_Value FROM update_product_order a LEFT JOIN product b ON a.prod_code = b.prod_code left join category c on c.category_id =  a.category WHERE update_product_id ='{$id}'";
$value_query4 = mysqli_query($db_connect, $value_sql);
$value_rs = mysqli_fetch_assoc($value_query4);
$sum_cp_value = $value_rs['CP_Value'] ?? 0;
$sum_sp_value = $value_rs['SP_Value'] ?? 0;

?>
<div class="team_section layout_padding" style="margin-top: -100px">
    <div class="">
        <h1 class="what_taital">Update Product List</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>

            <div class="box">
                <!--<hr>
    <div class="row">
    <div class="col-5">
        <div class="form-group">
            <b><label>Client Name</label></b>
            <label><?php echo $client_name; ?></label>
         </div>
    </div>       
    </div>    
    <div class="row" >
    <div class="col-5">
        <div class="form-group">
            <b><label>Location</label></b>
            <label><?php echo $location; ?></label>
         </div>
    </div> 
    <div class="col-3">
        <div class="form-group">
            <b><label>Truck Number</label></b>
            <label><?php echo $truck_number; ?></label>
         </div>
    </div>
     <div class="col-3">
        <div class="form-group">
            <b><label>Prepared by</label></b>
            <label><?php echo strtoupper($username); ?></label>
         </div>
    </div>               
    </div>
    <hr>-->
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center">Update Product ID: <?php echo " " . $id; ?></h2>
                        <h3 class="text-center">Total Cost Value <?php echo " " . "₦ " . number_format($sum_cp_value); ?></h3>
                        <h3 class="text-center">Total Selling Value <?php echo " " . "₦ " . number_format($sum_sp_value); ?></h3>
                        <hr>
                        <table class="table table striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Product Code</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Cost Value</th>
                                    <th>Selling Value</th>
                                </tr>
                            </thead>
                            <?php
                            $update_id = $_GET['id'];
                            $query = mysqli_query($db_connect, "SELECT a.update_product_id, a.prod_code, a.name, a.qty_in, b.divider, c.category_name, a.date, b.cost_price, (a.qty_in * b.cost_price) AS CP_Value, (a.qty_in * b.selling_price) AS SP_Value FROM update_product_order a LEFT JOIN product b ON a.prod_code = b.prod_code left join category c on c.category_id =  a.category WHERE update_product_id='{$update_id}'");

                            while ($row = mysqli_fetch_array($query)) {
                                extract($row);
                                echo "<tr>";
                                echo "<td style='font-size: 12px;'  colspan='0'>{$date}</td>";
                                echo "<td style='font-size: 12px;'  colspan='0'>{$prod_code}</td>";
                                echo "<td style='font-size: 12px;'  colspan='0'>{$name}</td>";
                                echo "<td style='font-size: 12px;'  colspan='0'>{$category_name}</td>";
                                echo "<td style='font-size: 12px;'>";
                                $ctn = intdiv($qty_in, $divider);
                                // $pcs = $qty_in % $divider;
                                // echo $ctn." ctn ". $pcs." pcs ";
                                echo $ctn . " pcs ";
                                echo "</td>";
                                echo "<td style='font-size: 12px;'  colspan='0'>";
                                echo "₦ " . number_format($CP_Value);
                                echo "</td>";
                                echo "<td style='font-size: 12px;'  colspan='0'>";
                                echo "₦ " . number_format($SP_Value);
                                echo "</td>";
                            }
                            ?>
                            <thead>
                                <tr>
                                    <th>Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <?php
                                        echo " " . "₦ " . number_format($sum_cp_value);
                                        ?>
                                    </th>
                                    <th>
                                        <?php
                                        echo " " . "₦ " . number_format($sum_sp_value);
                                        ?>
                                    </th>
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
                                <a class="btn btn-warning" style="width: 100px;" href="dashboard.php?page=pages/view_update_product_list">Back</a>
                                <a class="btn btn-primary" style="width: 200px;" href="generate_bulk_update_report_pdf.php?update_id=<?php echo $update_id; ?>">Generate PDF Report</a>
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