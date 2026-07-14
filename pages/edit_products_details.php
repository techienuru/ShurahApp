    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];

    ?>
    <div class="team_section layout_padding" style="margin-top: -400px">
        <div class="container2">
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
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">View Product</h1>
        <p class="what_text_1"> </p>
        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Product Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT * FROM product LEFT JOIN category ON product.category_id = category.category_id WHERE prod_id ='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $prod_id = $lastList_rs['prod_id'];
                    $prod_name = $lastList_rs['prod_name'];
                    $prod_code = $lastList_rs['prod_code'];
                    $category_name = $lastList_rs['category_name'];
                    $category_id = $lastList_rs['category_id'];
                    $divider = $lastList_rs['divider'];
                    $pcs = $lastList_rs['pcs'];
                    $qty_left = $lastList_rs['qty_left'];
                    $selling_price = $lastList_rs['selling_price'];
                    $cost_price = $lastList_rs['cost_price'];
                    $date = $lastList_rs['date'];
                    $expiration = $lastList_rs['expiration'];
                ?>
                <form action="dashboard.php?page=pages/update_products&id=<?php echo $id; ?>" method="post">
                    <div class="row"> 
						<div class="col-6">
                           <div class="form-group">
                                <b><label>Product ID :</label></b>
                                <input class="form-control" type="text" name="prod_id" value="<?php echo $prod_id ; ?> " readonly required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Product Code :</label></b>
                                <input class="form-control" type="text" name="prod_code" value="<?php echo $prod_code ; ?>" required>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Product Name :</label></b>
                                <input class="form-control" type="text" name="prod_name" value="<?php echo $prod_name; ?>" required>
                            </div> 
                        </div>   
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Category :<?php echo $category_name; ?></label></b>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                    <?php
                                        $userist_sql = "SELECT * FROM category ORDER BY category_name";
                                        $userList_query = mysqli_query($db_connect, $userist_sql);
                                        $userList_rs = mysqli_fetch_assoc($userList_query);
									if(empty($userList_rs)){
										echo "No record found";
									}else{
                                    do { ?>
                                        <option value="<?php echo $userList_rs['category_id'];?>"><?php echo $userList_rs['category_name']; ?></option>
                                    <?php } while($userList_rs = mysqli_fetch_assoc($userList_query));				
									}
                                        ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Quantity :</label></b>
                                <input class="form-control" type="text" id="qty" name="qty" onkeyup="multi()" value="0" placeholder="Enter Quantity" readonly />
                            </div> 
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Qty per carton. :</label></b>
                                <input class="form-control" type="text" id="cart_qty" name="cart_qty" onkeyup="multi()" value="<?php echo $divider ; ?>" />
                            </div> 
                        </div> 
						<div class="col-3">
                            <div class="form-group">
                                <b><label>New Quantity :</label></b>
                                <input class="form-control" type="text" id="newqty" name="newqty" onkeyup="multi()" value="0" placeholder="Enter Quantity" readonly />
                            </div> 
                        </div>	                       
						<!--<div class="col-3">
                            <div class="form-group">
                                <b><label>Pcs :</label></b>
                                <input class="form-control" type="text" id="pcs_qty" name="pcs_qty" onkeyup="multi()" value="0" />
                            </div> 
                        </div>--> 
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Quantity Left :</label></b>
                                <input class="form-control" type="text" id="pcs" name="pcs" value="<?php echo $qty_left ; ?>" readonly/>
                            </div> 
                        </div> 
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Selling Prize. :</label></b>
                                <input class="form-control" type="text" id="selling_price" name="selling_price" value="<?php echo $selling_price ; ?>" readonly required>
                            </div> 
                        </div> 
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Expiration Date. :</label></b>
                                <input class="form-control" type="date" id="expiration" name="expiration" value="<?php echo $expiration ; ?>">
                            </div> 
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Date :</label></b>
                                <input class="form-control" type="text" id="date" name="date" value="<?php echo $date ; ?>" readonly>
                            </div> 
                        </div> 
                    </div>               
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <a href="dashboard.php?page=pages/view_products" class="btn btn-info">Back</a>
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
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
            document.getElementById('newqty').value = result;
        }
    }
</script>