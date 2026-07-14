 <!--header section start -->
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('Hms');
        $date = date('Y-m-d');
	$role = $_SESSION['role'];

    ?>
    <div class="team_section layout_padding">
      <div class="" style="margin-top: -100px;">
        <h1 class="what_taital">Add User</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>User Details</b></h3>
                <hr>
                <form action="dashboard.php?page=pages/process_add_users&user_id=<?php echo "20".$rnd ; ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>User ID :</label></b>
                               <?php // $time_string ; 
                               ?>
                                <input class="form-control" type="text" name="user_id" readonly value="<?php echo "20".$rnd ; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Fullname :</label></b>
                                <input class="form-control" type="text" name="fullname" placeholder="Enter Fullname" required>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Username :</label></b>
                                <input class="form-control" type="text" name="username" placeholder="Enter Username" required>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Password :</label></b>
                                <input class="form-control" type="password" name="password" placeholder="Enter Password"  required>
                            </div> 
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Confirm Password :</label></b>
                                <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Phone Number :</label></b>
                                <input class="form-control" type="text" name="phone" placeholder="Enter Phone" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Activation :</label></b>
                                <select class="form-control" id="activation_id" name="activation_id" readonly>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Status :</label></b>
                                <select class="form-control" id="status" name="status" readonly>
                                    <option value="New User">New User</option>
                                </select>
                            </div>
                        </div>
		<?php
			if($role == "admin"){?>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Role:</label></b>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">--Select--</option>
                                    <option value="admin">Administrator</option>
                                    <option value="manager">Manager</option>
                                    <option value="cashier">Cashier</option>
                                    <option value="stock">Stock</option>
                                </select>
                            </div> 
                        </div>
			<?php }else{?> 
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Role:</label></b>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">--Select--</option>
                                    <option value="cashier">Cashier</option>
                                    <option value="stock">Stock</option>
                                </select>
                            </div> 
                        </div>
		<?php }

		?> 

                        <div class="col-6">
                            <div class="form-group">
                                <!--<b><label>Date :</label></b>-->
                                <input class="form-control" type="hidden" id="date" name="date" value="<?php echo $date ; ?>" readonly>
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

</body>
</html>
<style>
    .form-control{
        border: 1px dotted;
        
    }
</style>
<script>
$(document).ready(function(){
    $('#role_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#role_id option:selected').text();
    var userid = $('#role_id').val();
        
    //$('#result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script>
$(document).ready(function(){
    $('#class_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#class_id option:selected').text();
    var userid = $('#class_id').val();
        
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