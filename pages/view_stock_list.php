<?php 
    ob_start();
    $prodList_sql = "SELECT COUNT(prod_code) AS total_count FROM product";
    $prodList_query = mysqli_query($db_connect, $prodList_sql);
    $prodList_rs = mysqli_fetch_assoc($prodList_query);
    $_SESSION['total_count'] = $prodList_rs['total_count'];
    $total = $_SESSION['total_count'];
    $date = date("Y-m-d");
    $date1 = date("Ymd");
    $current_time = time();
    $time_string = date("YmdHis", $current_time);
    confirm_logged_in();
    auto_logout();
    if(!isset($_SESSION['admin'])){
        header('location:login.php');
    }
?> 
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');

    ?>
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">Stock List</h1>
        <p class="what_text_1"> </p>

        <div class="row">
            <h1 class="text-center"><b> </b></h1>
            <div class="col-12">
                <!--<h3 class="text-center"><b>Product Details</b></h3>-->
    <h3 class="text-center">Total number of Products : <font color="green" style="font:bold 28px; 'Aleo';">[ <?php echo $_SESSION['total_count'];?> ]</font></h3>
        <br>
        <center>
            <div class="">
            <br>
            <table id="contact-detail" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>SN</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Total Quantity</th>
                    <th>Cartons Remaining</th>
                    <!-- <th>Pieces Remaining</th> -->
                    <th>% </th>
                    <th>Details</th>
                    </tr>
                </thead>
            </table>
            </div>    
        </center>
            </div>
        </div>
        </div>
      </div>
<script>
$(document).ready(function() {
    $('#contact-detail').dataTable({
		"scrollX": true,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
        "ajax": "pages/view_stock_list_server.php"
    } );
} );
</script>


    <!--team section end -->
    <!--footer section start -->
    <?php 
        //include('footer.php');
    ?>
    <!--footer section end -->
    <!-- Javascript files-->
    <script src="../js/bootstrap.bundle.min.js"></script>

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