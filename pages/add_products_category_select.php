
    <!--header section end -->
    <!--team section start -->
    <?php
        //$rnd = date('YmdHms');
        $rnd = createsix();
        $date = date('Y-m-d');

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
        <h1 class="what_taital">Add Product</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Product Details</b></h3>
                <hr>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Category :</label></b>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="">Please Select</option>
                                    <?php
                                        $userist_sql = "SELECT * FROM category";
                                        $userList_query = mysqli_query($db_connect, $userist_sql);
                                        $userList_rs = mysqli_fetch_assoc($userList_query);
                                    if(empty($userList_rs)){?>
                                        <option value=""><?php echo "No record found"; ?></option><?php
                                    }else{
                                        do { ?>
                                        <option value="<?php echo $userList_rs['category_id'];?>"><?php echo $userList_rs['category_name']; ?></option>
                                    <?php } while($userList_rs = mysqli_fetch_assoc($userList_query));
                                    }
                                        ?>
                                </select>
                            </div> 
                        </div>
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </div>
                    </div>
                </form>
                    <?php
                    if(isset($_POST['submit'])){
						    $cat_id = $_POST['category_id'];
                            header("Location:dashboard.php?page=pages/add_products_others&cat_id={$cat_id}");
						
                        /*if($_POST['category_id'] == 8297){
                            $cat_id = $_POST['category_id'];
                            header("Location:dashboard.php?page=pages/add_products&cat_id={$cat_id}");
                        }else{
                            $cat_id = $_POST['category_id'];
                            header("Location:dashboard.php?page=pages/add_products_others&cat_id={$cat_id}"); 
                        }*/
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
    .dim{
        display:flex;
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
        var qty_per_cnt = document.getElementById('qty_per_cnt').value;
        var qty = document.getElementById('qty').value;
        var result = parseInt(qty) * parseInt(qty_per_cnt);
        if(!isNaN(result)){
            document.getElementById('pcs').value = result;
        }
    }
</script>
<script type="text/javascript">
    function multi_selling(){
        var qty_per_cnt = document.getElementById('qty_per_cnt').value;
        var square_meter_price = document.getElementById('square_meter_price').value;
        var dim1 = document.getElementById('dim1').value;
        var dim2 = document.getElementById('dim2').value;
        var m2 = document.getElementById('m2').value;
        var result = (parseInt(dim1)/100) * (parseInt(dim2)/100) * parseInt(square_meter_price);
        var result1 = (parseInt(dim1)/100) * (parseInt(dim2)/100) * parseInt(qty_per_cnt) *parseInt(square_meter_price) ;
        if(!isNaN(result)){
            document.getElementById('selling_price').value = result;
            document.getElementById('price_ctn').value = result1;
        }
    }
</script>
<script type="text/javascript">
    function multi_m2(){
        var qty_per_cnt = document.getElementById('qty_per_cnt').value;
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