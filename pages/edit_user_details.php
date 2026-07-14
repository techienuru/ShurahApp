
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];
        $user_iid = $_SESSION['user_id'] ;
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
    <div class="team_section layout_padding" style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">View Staff</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Staff Details</b></h3>
                <hr>
                <?php
					$lastList_sql = "SELECT a.user_id, a.fullname, a.username, a.phone, a.status, a.role, a.isActive, a.date, a.authorization FROM users a WHERE a.user_id =".$id ;
					$lastList_query = mysqli_query($db_connect, $lastList_sql);
					$lastList_rs = mysqli_fetch_assoc($lastList_query);
					$user_id = $lastList_rs['user_id'];
					$fullname = $lastList_rs['fullname'];
					$username = $lastList_rs['username'];
					$phone = $lastList_rs['phone'];
					$status = $lastList_rs['status'];
					$role = $lastList_rs['role'];
					$isActive = $lastList_rs['isActive'];
					$date = $lastList_rs['date'];
                
                    $sql = "SELECT * FROM users WHERE user_id=".$user_iid;
                    $user_query = mysqli_query($db_connect, $sql);
                    $userList_rs = mysqli_fetch_assoc($user_query);
                    $role_confirm = $userList_rs['role'];
                    
              
                ?>
                <form action="dashboard.php?page=pages/update_user&id=<?php echo $id; ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>User ID :</label></b>
                                <input class="form-control" type="text" name="staff_id" value="<?php echo $user_id ; ?>" readonly required>
                            </div>
                        </div>                       
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>User Name :</label></b>
                                <input class="form-control" type="text" name="username" value="<?php echo $username; ?>"  required >
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>User Fullname  :</label></b>
                                <input class="form-control" type="text" name="fullname" value="<?php echo $fullname ; ?>">
                            </div>
                        </div>                         
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Phone Number :</label></b>
                                <input class="form-control" type="text" name="phone" value="<?php echo $phone ; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Status :</label></b>
                                <input class="form-control" type="text" name="status_id" value="<?php echo $status ; ?>" readonly required>
                            </div>
                        </div>
                        <?php
                        if($role_confirm == "admin"){?>
                       <div class="col-6">
                            <div class="form-group">
                                <b><label>Role : </label></b>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="<?php echo $role; ?>"><?php echo strtoupper($role) ; ?></option>
                                    <option value="admin">Administrator</option>
                                    <option value="manager">Manager</option>
                                    <option value="cashier">Cashier</option>
                                    <option value="stock">Stock</option>
                                </select>
                            </div> 
                        </div>
                        <?php }else{ ?>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Role :</label></b>
                                <input class="form-control" type="text" name="role" value="<?php echo $role ; ?>" readonly required>
                            </div>
                        </div>   
                        <?php }
                        ?>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Activation : </label></b>
                                <select class="form-control" id="activation" name="activation" required>
                                    <option value="<?php if($isActive == 1){ echo "Active";}else{ echo "Inactive";}  ?>"><?php if($isActive == 1){ echo "Active";}else{ echo "Inactive";}  ?></option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>  
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <a href="dashboard.php?page=pages/view_users" class="btn btn-info">Back</a>
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
</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>
<script>
$(document).ready(function(){
    $('#role1').select2();
    
    $('#but_read').click(function(){
    var username=$('#role1 option:selected').text();
    var userid = $('#role1').val();
        
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