
    <!--header section end -->
    <!--team section start -->
    <?php
        //$rnd = date('YmdHms');
        $rnd = createsix();
        $date = date('Y-m-d');
        $cat_id = $_GET['cat_id'];
		$lastList_sql = "SELECT a.category_name FROM category a  WHERE a.category_id =".$cat_id ;
		$lastList_query = mysqli_query($db_connect, $lastList_sql);
		$lastList_rs = mysqli_fetch_assoc($lastList_query);
		if(empty($lastList_rs)){

		}else{
			$category_name = $lastList_rs['category_name'];
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
    <div class="team_section layout_padding" style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Add NEW Product</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Product Details</b></h3>
                <hr>
                <form action="dashboard.php?page=pages/process_add_product_others&prod_id=<?php echo $rnd; ?>" method="post">
                    <div class="row">
                        <input class="form-control" type="hidden" name="category_id" value="<?php echo $cat_id ; ?>" >
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Date :</label></b>
                                <input class="form-control" type="text" id="date" name="date" value="<?php echo $date ; ?>" readonly>
                            </div> 
                        </div> 
                        <div class="col-3">
                           <div class="form-group">
                                <b><label>Product ID :</label></b> 
                                <input class="form-control" type="text" name="prod_id" value="<?php echo $rnd ;?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Product Code :</label></b>
                                <input class="form-control" type="text" name="prod_code" value="<?php echo $rnd ; ?>" required>
                            </div> 
                        </div>
						<div class="col-3">
                            <div class="form-group">
                                <b><label>Category :</label></b>
                                <input class="form-control" type="text" name="categoty_name" value="<?php echo $category_name ;  ?>" readonly required>
                            </div> 
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Product Name :</label></b>
                                <input class="form-control" type="text" name="prod_name" placeholder="Enter Product Name"  required>
                            </div> 
                        </div>
<!--
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Default Number :</label></b>
                                <input class="form-control" type="text" id="ctn_num" name="ctn_num" onkeyup="multi_m2()" value="1" required /> 
                                <span id="QtyperctnErrorMessage" style="color:red;"></span>
                            </div>
                        </div>  
-->
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Quantity :</label></b>
                                <input class="form-control" type="text" id="qty" name="qty" onkeyup="multi()" placeholder="Enter quantity" required />
                                <span id="qtyErrorMessage" style="color:red;"></span>
                            </div> 
                        </div> 
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Divider :</label></b>
                                <input class="form-control" type="text" id="divider" name="divider" onkeyup="multi()" placeholder="Enter qty in a carton" required />
                                <span id="qtyErrorMessage" style="color:red;"></span>
                            </div> 
                        </div> 
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Cost Price :</label></b>
                                <input class="form-control" type="text" id="cost_price" name="cost_price" placeholder="Enter cost price" onkeyup="multi_selling()" required>
                                <span id="selling_priceErrorMessage" style="color:red;"></span>
                            </div> 
                        </div>
						<div class="col-3">
                            <div class="form-group">
                                <b><label>Selling Price :</label></b>
                                <input class="form-control" type="text" id="selling_price" name="selling_price" placeholder="Enter selling price" onkeyup="multi_selling()" required>
                                <span id="selling_priceErrorMessage" style="color:red;"></span>
                            </div> 
                        </div>
						<div class="col-3">
                            <div class="form-group">
                                <b><label>Expiration :</label></b>
                                <input class="form-control" type="date" id="expiry_date" name="expiry_date" placeholder="Enter Expiry Date">
                            </div> 
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Pcs. :</label></b>
                                <input class="form-control" type="text" id="pcs" name="pcs" placeholder="Total quantity" readonly />
                            </div> 
                        </div>  
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>Price per carton :</label></b>
                                <input class="form-control" type="text" id="ctn_price" name="ctn_price" placeholder="Enter selling price" readonly required>
                            </div> 
                        </div>
                    </div>
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <button type="reset" id="reset" name="reset" class="btn btn-warning" onclick="reloadPage();">Reset</button>
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Save</button>
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
    .dim{
        display:flex;
    }
</style>
<script>
document.getElementById('qty').oninput = function(event){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/\D/g, '');
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element 
    var errorMessageElement = document.getElementById('qtyErrorMessage');
    
    // Check if the input value is empty or non-numeric
    if (numericValue === '' || isNaN(numericValue)){
        errorMessageElement.textContent = "Only numbers are allowed.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
<script>
document.getElementById('selling_price').oninput = function(event){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/\D/g, '');
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element 
    var errorMessageElement = document.getElementById('selling_priceErrorMessage');
    
    // Check if the input value is empty or non-numeric
    if (numericValue === '' || isNaN(numericValue)){
        errorMessageElement.textContent = "Only numbers are allowed.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
<script>
document.getElementById('ctn_num').oninput = function(event){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/\D/g, '');
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element 
    var errorMessageElement = document.getElementById('QtyperctnErrorMessage');
    
    // Check if the input value is empty or non-numeric
    if (numericValue === '' || isNaN(numericValue)){
        errorMessageElement.textContent = "Only numbers are allowed.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
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
        var qty_per_cnt = document.getElementById('divider').value;
        var qty = document.getElementById('qty').value;
        var result = parseInt(qty) * parseInt(qty_per_cnt);
        if(!isNaN(result)){
            document.getElementById('pcs').value = result;
        }
    }
</script>
<script type="text/javascript">
    function multi_selling(){
        var qty_per_cnt = document.getElementById('divider').value;
        var selling_price = document.getElementById('selling_price').value;
        var result = parseInt(qty_per_cnt) * parseInt(selling_price);
        if(!isNaN(result)){
            document.getElementById('ctn_price').value = result;
        }
    }
</script>
<script type="text/javascript">
    function multi_m2(){
        var qty_per_cnt = document.getElementById('divider').value;
        var dim1 = document.getElementById('dim1').value;
        var dim2 = document.getElementById('dim2').value;
        var qty = document.getElementById('qty').value;
        var qty = document.getElementById('qty').value;
        var result = parseInt(qty_per_cnt) * (parseInt(dim1)/100) * (parseInt(dim2)/100);
        if(!isNaN(result)){
            document.getElementById('m2').value = result;
        }
    }
</script>