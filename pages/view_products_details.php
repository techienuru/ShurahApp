
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];
    ?>
    <div class="team_section layout_padding">
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
    <div class="team_section layout_padding"  style="margin-top: -100px">
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
                    $divider = $lastList_rs['divider'];
                    $pcs = $lastList_rs['pcs'];
                    $qty_left = $lastList_rs['qty_left'];
                    $cost_price = $lastList_rs['cost_price'];
                    $selling_price = $lastList_rs['selling_price'];
                    $date = $lastList_rs['date'];
                ?>
                <form action="index.php?page=pages/update_products&id=<?php echo $id; ?>" method="post">
                    <div class="row">
						<div class="col-6">
                           <div class="form-group">
                                <b><label>Product ID :</label></b>
                                <?php echo $prod_id ; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Product Code :</label></b>
                                <?php echo $prod_code ; ?>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Product Name :</label></b>
                                <?php echo $prod_name; ?>
                            </div> 
                        </div>  
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Category :</label></b>
                            <?php echo $category_name; ?>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Quantity :</label></b>
                                <?php echo number_format($qty_left,0). " pcs left" ; ?>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Carton Quantity. :</label></b>
                                <?php echo number_format($divider,0)." per Carton" ; ?>
                            </div> 
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Quantity Left :</label></b>
                                <?php echo number_format($qty_left,0). " pcs left" ; ?>
                            </div> 
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Cost Prize. :</label></b>
                                <?php echo "₦ ". number_format($cost_price,0) ; ?>
                            </div> 
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Selling Prize. :</label></b>
                                <?php echo "₦ ". number_format($selling_price,0) ; ?>
                            </div> 
                        </div> 
                        <!--<div class="col-6">
                            <div class="form-group">
                                <b><label>Expiration:</label></b>
                                <?php echo $expiration ; ?>
                            </div> 
                        </div>-->
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Created On:</label></b>
                                <?php echo $date ; ?>
                            </div> 
                        </div> 
                    </div>               
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <a href="dashboard.php?page=pages/view_products" class="btn btn-info">Back</a>
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

</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>