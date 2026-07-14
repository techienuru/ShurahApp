
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        // Generate a unique receipt number
        $minRange = 100000;
        $maxRange = 999999;
        $receiptNumber = generateUniqueReceiptNumber($minRange, $maxRange, $previousReceiptNumbers);

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
        <h1 class="what_taital">Retail Sales</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <br>
                <h3 class="text-center"><b></b></h3>
                <hr>
                <form action="dashboard.php?page=pages/retail_sales&invoice=<?php echo $receiptNumber ; ?>&prod_id=" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Select Client :</label></b>
                                <select class="form-control" id="client_id" name="client_id">
                                    <option value="0">Anonymous</option>
                                    <?php
                                        $userist_sql = "SELECT * FROM clients ORDER BY name ASC";
                                        $userList_query = mysqli_query($db_connect, $userist_sql);
                                        $userList_rs = mysqli_fetch_assoc($userList_query);
										if(empty($userList_rs)){
											echo "<option value='' disabled >No record found</option>";
										}else{
                                    do { ?>
                                        <option value="<?php echo $userList_rs['client_id'];?>"><?php echo $userList_rs['name']; ?></option>
                                    <?php } while($userList_rs = mysqli_fetch_assoc($userList_query));					
										}
                                        ?>
                                </select>
                            </div> 
                        </div>
                    </div>
                <a href=""><button class="btn btn-warning btn-block btn-large" style="width:267px; margin-top:8px;margin-left:0px;" type="submit" name="submit"> Goto Payment</button></a>
                </form>
                <!--<a href="dashboard.php?page=pages/add_saved_invoice"><button class="btn btn-success btn-block btn-large" style="width:267px; margin-top:8px;margin-left:0px;" type="submit" name="submit"> Saved Invoice</button></a>-->
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
    $('#client_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#client_id option:selected').text();
    var userid = $('#client_id').val();
        
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