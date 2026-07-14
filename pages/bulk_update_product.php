
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
         if(isset($_POST['submit'])){
            $_SESSION['client_id'] = $_POST['client_id'];
        } 
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
        <h1 class="what_taital">Update Products Quantity</h1>
        <p class="what_text_1"> </p>

        <div class="col-12">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Product Details</b></h3>
                <hr>
                <form action="dashboard.php?page=pages/bulk_update_incoming" method="post">
                <div class="row">
                <input type="hidden" name="update_id" class = "form-control" value="<?php echo $_GET['update_id']; ?>" />
                <div class="form-group">
                <label style="margin-left:30px;">Select Product :</label>
                <input type="text"  name="barcode" placeholder="Scan barcode" class = "form-control" autofocus style="width:350px; height: 28px; margin-top: 16px; padding-bottom: 6px; margin-left: 16px;display:inline; background-color:₦e8eaed;" />
                <select class="form-control" style="margin-left:34px; width:400px;background-color:#e8eaed" id="product" name="prod_code" required>
                <option>Select Products</option>
                <?php
                $prodList_sql = "SELECT * FROM product ORDER BY product.prod_name ASC";
                $prodList_query = mysqli_query($db_connect, $prodList_sql);
                $prodList_rs = mysqli_fetch_assoc($prodList_query);
					if(empty($prodList_rs)){
						echo "<option value='' disabled>No record found</option>";
					}else{
                    do { ?>
                    <option value="<?php echo $prodList_rs['prod_code']; ?>"
                    <?php if(!$prodList_rs['qty_left'] == 0){
                      echo 'Out of Stock'; 
                    }?>enabled>
                    <?php echo $prodList_rs['prod_name']; ?>
                    <?php echo "(₦" .$prodList_rs['selling_price'] . ")" ; ?>
                    <?php echo "Qty Rem= ".number_format($prodList_rs['qty_left']); ?>
                    <?php echo "DOF = ".$prodList_rs['expiration']; ?>
                    </option>
                    <?php } while ($prodList_rs = mysqli_fetch_assoc($prodList_query));						
					}
                    ?>
                </select>
            <!--<input type="number"  name="qty" value="1" min = "1" class = "form-control"  autocomplete="off" style="width: 100px; height: 28px; margin-top: 16px; padding-bottom: 6px; margin-left: 16px;display:inline; background-color:#e8eaed;" />-->
            <br>
            <br>
            <label style="margin-left:20px;">Number of Cartons</label>
            <input type="text" value="0" name="no_cartons" class = "form-control" placeholder="Number of cartons only"  autocomplete="off" style="width: 180px; padding-top: 6px; padding-bottom: 6px; height: 28px; margin-left: 5px; display:inline; background-color:#e8eaed" />
                    
            <label style="margin-left:30px;">Pcs</label>
            <input type="text" value="0" name="pcs" class = "form-control" placeholder="Number of pcs only"  autocomplete="off" style="width: 180px; padding-top: 6px; padding-bottom: 6px; height: 28px; margin-left: 0px; display:inline; background-color:#e8eaed" />
                                        
			<label style="margin-left:30px;">Expiration</label>
            <input class="form-control" type="date" id="expiration" name="expiration" placeholder="Enter Expiry Date" style="width: 210px; padding-top: 6px; height: 28px; margin-left: 680px; margin-top: -28px; background-color:#e8eaed">                 
            <br>
            <button class="btn btn-success btn-block btn-large" style="width:153px; margin-top:8px;margin-left:20px;" id="submit" type="submit" name="submit">Add Product</button>
            </div>   
                </div>
                </form>
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="margin-left:5px;">
              <thead>
                <tr>
                  <th> Date</th>
                  <th> Update ID</th>
                  <th> Product code </th>
                  <th> Name </th>
                  <th> Qty </th>
                  <th> Category </th>
                  <th> Expiration </th>
                  <th> Delete </th>
                </tr>
              </thead>
              <tbody>

                <?php
                $id=$_GET['update_id'];
                $query = mysqli_query($db_connect,"SELECT * FROM update_product_order WHERE update_product_id='{$id}'");
                
                  
                while($row = mysqli_fetch_array($query)){
                extract($row);
		        echo "<tr>";
				echo "<td>{$date}</td>";					
                echo "<td>{$update_product_id}</td>";
                echo "<td>{$prod_code}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$qty_in}</td>";
                /*echo "<td>";
                 if($row['qty'] > 1){
                        echo $qty." pcs(s)";
                }else{
                        echo $qty." pcs";  
                }
                echo "</td>";*/
                echo "<td>{$category}</td>";
                echo "<td>";
				if(empty($expiration)){
					echo " N/A";
				}else{
					echo $expiration;
				}
				echo "</td>";
				echo "<td>";
                ?>
                <a class='btn btn-xs btn-danger' href='dashboard.php?page=pages/bulk_delete_update_product&id=<?php echo $ref_id ; ?>&bulk_update_id=<?php echo $_GET['update_id'];?>&qty=<?php echo $row['qty_in'];?>&code=<?php echo $row['prod_code'] ;?>' style="margin-top:2px;">Del</a>
                <?php
                echo "</td>";
                echo "</tr>";

                
                }
                ?>
              </tbody>
            </table><br>
				<a id="transferLink" style="margin-left:0px;" class="btn btn-primary" href="dashboard.php?page=pages/bulk_update_product_save&update_id=<?php echo $_GET['update_id']?>&cashier=<?php echo $user?>&prod_id=<?php echo $_GET['prod_id']; ?>">Update</a>
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
        
    //$('#result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script>
$(document).ready(function(){
    $('#client').select2();
    
    $('#but_read').click(function(){
    var username=$('#client option:selected').text();
    var userid = $('#client').val();
        
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
<script>
function disableTransferLink() {
    var table = document.getElementById('dataTables-example'); // Get the table by ID
    var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr'); // Get all table rows

    var transferLink = document.getElementById('transferLink'); // Get the Transfer link by ID

    var hasDate = false; // Initialize a flag to check if any date is found

    // Loop through all rows and check for a date
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td'); // Get all cells in the current row
        var dateCell = cells[0]; // Assuming the date cell is in the 1st column

        // Check if the cell contains a date
        if (dateCell && dateCell.textContent.trim() !== '') {
            hasDate = true;
            break; // Exit the loop if a date is found
        }
    }

    // Disable the Transfer link if no date is found, or enable it if a date is found
    if (!hasDate) {
        transferLink.classList.add('disabled'); // You may need to define a CSS class to style disabled links
        transferLink.href = 'javascript:void(0);'; // Remove the link's href
    } else {
        transferLink.classList.remove('disabled');
        transferLink.href = 'dashboard.php?page=pages/bulk_update_product_save&update_id=<?php echo $_GET['update_id']?>&cashier=<?php echo $user?>&prod_id=<?php echo $_GET['prod_id']; ?>';
    }
}

// Call the function when the page loads
window.onload = disableTransferLink;
</script>

