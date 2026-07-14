
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];

    ?>
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">Expense Sub Head</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Expense Sub Head Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT * FROM expence_sub_head WHERE expence_code='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $expence_code = $lastList_rs['expence_code'];
                    $category_name = $lastList_rs['expence_name'];

                ?>
                <form action="dashboard.php?page=pages/update_expense_sub_head&id=<?php echo $id; ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Expence Code :</label></b>
                                <input class="form-control" type="text" name="expence_code" value="<?php echo $expence_code ; ?>" readonly required>
                            </div>
                        </div>                       
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Expence Name :</label></b>
                                <input class="form-control" type="text" name="expence_name" value="<?php echo $category_name; ?>"  required>
                            </div>
                        </div>               
                    </div>
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <a href="dashboard.php?page=pages/view_expense_sub_head" class="btn btn-info">Back</a>
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