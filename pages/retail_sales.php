
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
		$branch_id =  $_SESSION['branch_iid'];
         if(isset($_POST['submit'])){
            $_SESSION['client_id'] = $_POST['client_id'];		 
        }
		$client_id = $_SESSION['client_id']; 
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
        <h1 class="what_taital">Retail Sales</h1>
        <p class="what_text_1"> </p>

        <div class="col-12">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Sales Details</b></h3>
                <hr>
                <form action="dashboard.php?page=pages/incoming&invoice=<?php echo $_GET['invoice']; ?>" method="post">
                <div class="row">
                <input type="hidden" name="invoice" class = "form-control" value="<?php echo $client_id; ?>" />
                <div class="form-group">
                <label style="margin-left:30px;">Select Product :</label>
                <select class="form-control" style="margin-left:24px; width:350px;display:inline;background-color:₦e8eaed" id="product" name="product" required>
                <option>Select Products</option>
                <?php
                $prodList_sql = "SELECT * FROM product ORDER BY product.prod_name ASC";
                $prodList_query = mysqli_query($db_connect, $prodList_sql);
                $prodList_rs = mysqli_fetch_assoc($prodList_query);
                //$_SESSION['prod_code'] = $prodList_rs['prod_code'];
					if(empty($prodList_rs)){
						echo "No record found";
					}else{
                    do { ?>
                    <option value="<?php echo $prodList_rs['prod_code']; ?>"
                    <?php if(!$prodList_rs['qty_left'] == 0){
                      echo 'Out of Stock'; 
                    }?>disabled>
                    <?php echo $prodList_rs['prod_code']; ?>
                    <?php echo $prodList_rs['prod_name']; ?>
                    - <?php echo "Qty Remaining= ".number_format($prodList_rs['qty_left']); ?>
                    - <?php echo "₦".$prodList_rs['selling_price']; ?>
                    </option>
                    <?php } while ($prodList_rs = mysqli_fetch_assoc($prodList_query));						
					}
                    ?>
                </select>
            <input type="text"  name="barcode" placeholder="Scan barcode" class = "form-control" autofocus style="width:350px; height: 28px; margin-top: 16px; padding-bottom: 6px; margin-left: 16px;display:inline; background-color:₦e8eaed;" />
            <input type="number"  name="qty" value="1" min = "1" class = "form-control"  autocomplete="off" style="width: 100px; height: 28px; margin-top: 16px; padding-bottom: 6px; margin-left: 16px;display:inline; background-color:₦e8eaed;" />
            <br>
            <br>     
            <label style="margin-left:30px;">Discount</label>
            <input type="text" name="discount" value="0" class = "form-control"  autocomplete="off" style="width: 100px; padding-top: 6px; padding-bottom: 6px; height: 28px; margin-left: 40px; display:inline; background-color:₦e8eaed" /> 
                    
            <br>
            <br>
            <button class="btn btn-success btn-block btn-large" style="width:153px; margin-top:8px;margin-left:20px;" id="submit" type="submit" name="submit">Add Product</button>
            </div>   
                </div>
                </form>
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="margin-left:5px;">
              <thead>
                <tr>
                  <th> Invioce</th>
                  <th> Product code </th>
                  <th> Name </th>
                  <th> Amount </th>
                  <th> Qty </th>
                  <th> Category </th>
                  <th> Price </th>
                  <th> Discount </th> 
                  <th> Total Amount </th>
                  <th> Delete </th>
                </tr>
              </thead>
              <tbody>

                <?php
                $invoice = trim(mysqli_prep($_GET['invoice']));
                $id=$_GET['invoice'];
                $query = mysqli_query($db_connect,"SELECT * FROM sales_order WHERE invoice='{$invoice}'");
                
                  
                while($row = mysqli_fetch_array($query)){
                extract($row);
		        echo "<tr>";
                echo "<td>{$invoice}</td>";
                echo "<td>{$prod_code}</td>";
                echo "<td>{$name}</td>";
                echo "<td>";
				echo "₦ ". number_format($amount);
				echo "</td>";
                echo "<td>";
                 if($row['qty'] > 1){
                        echo $qty." pcs(s)";
                }else{
                        echo $qty." pcs";  
                }
                echo "</td>";
                echo "<td>{$category}</td>";
                echo "<td>";?>
                      <?php
                      $ppp=$row['price'];
                      echo "₦ ". formatMoney($ppp, true);
                      ?><?php
                echo "</td>";
                echo "<td>";?>
                      <?php
                      $ccc=$row['discount'];
                echo "₦ ". formatMoney($ccc, true);
                      ?><?php
                echo "</td>";
                echo "<td>";?>
                      <?php
                      $dfdf=$row['amount'];
                echo "₦ ". formatMoney($dfdf, true);
                      ?><?php
                echo "</td>";
                echo "<td>";
                ?> 
                <a class='btn btn-xs btn-danger' href='dashboard.php?page=pages/delete_product_sales&id=<?php echo $row['transaction_id'];?>&invoice=<?php echo $_GET['invoice'];?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['prod_code'] ;?>' style="margin-top:2px;">Del</a>
                <?php
                echo "</td>";
                echo "</tr>";              
                }
                ?>
                <tr>
                  <td colspan="8"><strong style="font-size: 12px; color: ₦222222;">Total:</strong></td>
                  <td colspan="3"><strong style="font-size: 12px; color: ₦222222;">
                    <?php
                    $invoice = trim(mysqli_prep($_GET['invoice']));
                    $id=$_GET['invoice'];
                    $query = mysqli_query($db_connect,"SELECT sum(amount) as sum_total FROM sales_order WHERE invoice='{$invoice}'");
                    
                    while($row = mysqli_fetch_array($query)){
                    extract($row);?>
                      <?php
                      $fgfg=$row['sum_total'];
                    echo "₦ ". formatMoney($fgfg, true);
                    }
                    ?>
                  </strong></td>
                </tr>

              </tbody>
            </table><br>
				<?php
					$sql = "SELECT * FROM sales_order WHERE invoice='{$invoice}'";
					$user_query = mysqli_query($db_connect, $sql);
					$userList_rs = mysqli_fetch_assoc($user_query);
				if(empty($userList_rs)){
					echo "<a rel='facebox' style='margin-left:0px; pointer-events:none; cursor:pointer;' class = 'btn btn-primary' href='dashboard.php?page=pages/checkout&invoice=<?php echo $_GET[invoice]?>&total=<?php echo $fgfg ?>&cashier=<?php echo $user?>&prod_id=<?php echo $_GET[prod_id]; ?>&p_amount=<?php echo $fgfg?>' >Check Out</a>";
				}else{?>
				
					<a rel='facebox' style='margin-left:0px;' class = 'btn btn-primary' href='dashboard.php?page=pages/checkout&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $fgfg ?>&cashier=<?php echo $user?>&prod_id=<?php echo $_GET['prod_id']; ?>&p_amount=<?php echo $fgfg?>' >Check Out</a>
				<?php
				}
				?>
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
    $('#product').select2();
    
    $('#but_read').click(function(){
    var username=$('#product option:selected').text();
    var userid = $('#product').val();
        
    //$('₦result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script>
$(document).ready(function(){
    $('#client').select2();
    
    $('#but_read').click(function(){
    var username=$('#client option:selected').text();
    var userid = $('#client').val();
        
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