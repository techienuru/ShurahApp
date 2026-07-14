
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];
    ?>
    <div class="team_section layout_padding" style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">View Price List</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Price Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT a.prod_id, a.prod_name, a.cost_price, b.category_name, a.ctn_num, a.selling_price FROM product a LEFT JOIN category b ON a.category_id = b.category_id WHERE prod_id='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $prod_code = $lastList_rs['prod_id'];
                    $prod_name = $lastList_rs['prod_name'];
                    $category_name = $lastList_rs['category_name'];
                    $dctn_num = $lastList_rs['ctn_num'];
                    $cost_price = $lastList_rs['cost_price'];
                    $selling_price = $lastList_rs['selling_price'];

                ?>
                <form action="dashboard.php?page=pages/update_price_list&id=<?php echo $id; ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Product ID :</label></b>
                                <input class="form-control" type="text" name="prod_code" value="<?php echo $id ; ?>" readonly required>
                            </div>
                        </div>                       
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Product Name :</label></b>
                                <input class="form-control" type="text" name="prod_name" value="<?php echo $prod_name; ?>" readonly  required>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Category  :</label></b>
                                <input class="form-control" type="text" name="category_name" value="<?php echo $category_name ; ?>" readonly >
                            </div>
                        </div> 
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Cost Price  :</label></b>
                                <input class="form-control" type="text" name="cost_price" value="<?php echo $cost_price ; ?>">
                            </div>
                        </div> 
						<div class="col-6">
                           <div class="form-group">
                                <b><label>Selling Price  :</label></b>
                                <input class="form-control" type="text" name="selling_price" value="<?php echo $selling_price ; ?>">
                            </div>
                        </div>                
                    </div>
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <a href="dashboard.php?page=pages/view_price_list" class="btn btn-info">Back</a>
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

</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>