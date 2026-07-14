    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];
    ?>
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">View Staff</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Staff Details</b></h3>
                <hr>
                <?php
                $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
                    $lastList_sql = "SELECT  a.user_id, a.fullname, a.username, a.phone, a.status, a.role, a.isActive, a.date FROM users a WHERE a.user_id =".$id ;
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

                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>User ID :</label></b>
                               <?php echo $user_id ; ?>
                            </div>
                        </div>                      
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>User Name :</label></b>
                               <?php echo $username ; ?>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>User Fullname  :</label></b>
                               <?php echo $fullname ; ?>
                            </div>
                        </div>                         
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Phone Number :</label></b>
                               <?php echo $phone ; ?>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Status :</label></b>
                               <?php echo $status ; ?>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Role :</label></b>
                            <?php echo $role; ?> 
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Activation Status :</label></b>
                               <?php 
                               if($isActive == 1){
                                 echo "Active";  
                               }else{
                                 echo "Inactive";  
                               }
                               ?>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Created On :</label></b>
                               <?php echo $date ; ?>
                            </div>
                        </div>
                    </div>
                     <hr>
                    <br>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <?php
                                echo "<a href='#' onclick='confirmDelete({$id});'  class='btn btn-xs btn-danger'>Delete Record</a>";
                                ?>
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
// confirm record deletion
function confirmDelete( id ){
    if(confirm('Are you sure you want to delete this record?')){
                //if user click OK execute the delete action
        window.location.href = 'dashboard.php?page=pages/delete_user_process&id=' + id;
    } 
}
</script>