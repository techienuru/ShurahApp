<?php 

    $prodList_sql = "SELECT COUNT(a.prod_id) AS prod_id, a.prod_code, b.category_name, a.prod_name, a.qty_left FROM product a LEFT JOIN category b ON a.category_id = b.category_id WHERE b.category_name IS NOT NULL AND a.qty_left < 200";
    $prodList_query = mysqli_query($db_connect, $prodList_sql);
    $prodList_rs = mysqli_fetch_assoc($prodList_query);
    $_SESSION['prod_id'] = $prodList_rs['prod_id'];
    $total = $_SESSION['prod_id'];

    $date = date("Y-m-d");
    $date1 = date("Ymd");
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

        <div class="col-12">
            <h1 class="text-center"><b> </b></h1>
            <div class="">
                <!--<h3 class="text-center"><b>Product Details</b></h3>-->
    <h3 class="text-center"><font color="green" style="font:bold 28px; 'Aleo';">[ <?php echo $_SESSION['prod_id'];?> ] Product needs re-stock.</font></h3>
                <br>
        <p style="text-align: center; color: blue; margin-top: -25px">Restock level is set at 20 pieces of the affected product</p>
        <center>
        <div class="col-12">
            <br>
            <table id="contact-detail" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>SN</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Number in Carton</th>
                    <th>Quantity Remaining</th>
                    </tr>
                </thead>
            </table>
            </div>    
        </center>
<script>
$(document).ready(function() {
    $('#contact-detail').dataTable({
		"scrollX": true,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
        "ajax": "pages/view_re_order_level_list_server.php"
    } );
} );
</script>
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