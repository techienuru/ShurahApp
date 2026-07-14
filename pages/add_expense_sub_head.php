
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $current_time = time();
        $time_string = date("YmdHis", $current_time);

    ?>
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">Add Expense</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Expense Details</b></h3>
                <hr>
                <form action="dashboard.php?page=pages/process_add_expense_sub_head&expence_code=<?php echo $time_string.$rnd; ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Expense Code :</label></b>
                                <input class="form-control" type="text" name="expence_code" value="<?php echo $time_string ; ?> " readonly required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Expense Name :</label></b>
                                <input class="form-control" type="text" name="expence_name" value="" required>
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