    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];
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
    <div class="team_section layout_padding" style="margin-top: -100px;">
      <div class="">
        <h1 class="what_taital">View Category</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Category Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT category.category_id, category.category_name, status.status_name FROM category LEFT JOIN status ON category.status = status.status WHERE category.category_id='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $category_id = $lastList_rs['category_id'];
                    $category_name = $lastList_rs['category_name'];
                    $status_name = $lastList_rs['status_name'];

                ?>
                <form action="dashboard.php?page=pages/update_category&id=<?php echo $id; ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Category ID :</label></b>
                                <input class="form-control" type="text" name="category_id" value="<?php echo $category_id ; ?>" readonly required>
                            </div>
                        </div>                       
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Category Name :</label></b>
                                <input class="form-control" type="text" name="category_name" value="<?php echo $category_name; ?>"  required>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Status Name  :</label></b>
                                <input class="form-control" type="text" name="status_name" value="<?php echo $status_name ; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Status :</label></b>
                                <select class="form-control" id="status" name="status" required>
                                    <option value=" ">Please Select</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>                
                    </div>
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <a href="dashboard.php?page=pages/view_category" class="btn btn-info">Back</a>
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