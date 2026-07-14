    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $user_iid = $_SESSION['user_id'] ;

        $sql = "SELECT * FROM users WHERE user_id=".$user_iid;
        $user_query = mysqli_query($db_connect, $sql);
        $userList_rs = mysqli_fetch_assoc($user_query);
        $role = $userList_rs['role'];
        $username = $userList_rs['username'];
        //echo $role; 
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
    <div class="team_section layout_padding" style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Reset Password</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>User Details</b></h3>
                <hr>
        <form action="dashboard.php?page=pages/create_change_reset_password" method="post">
            <h6 class="mb-2 text-primary">Reset Password</h6>
            <div class="row">
                <div class="col-6">
                   <div class="form-group">
                        <label>User Name:</label>
                        <?php
                            if($role != 'admin'){?>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?php echo $username ; ?>" readonly>
                            <?php } else { ?>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="">
                            <?php } 
                        ?>
                    </div>
                </div> 
                <div class="col-6">
                   <div class="form-group">
                        <!--<label>User Name:</label>-->
                        <input type="hidden" class="form-control" name="username1" id="username1" placeholder="Enter username" value="">
                    </div>
                </div>                
                <div class="col-6">
                   <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>   
                </div>
                <div class="col-6">
                   <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" name="confirm_password" id="password" placeholder="Confirm Password">
                    </div>   
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-info" id="save" name="submit" style="color: white;" >Change Password</button>
                </div>
            </div>
    
        </form>
            </div>
<?php
      if (!empty($_GET['success'])){
          include("sign_in.php");
      }else{
          //
      }     
?>
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