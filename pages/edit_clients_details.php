
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];

    ?>
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">View Client</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Client Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT a.client_id, a.name, a.address, a.gender, a.phone, a.phone2, a.date FROM clients a WHERE client_id ='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $client_id = $lastList_rs['client_id'];
                    $name = $lastList_rs['name'];
                    $address = $lastList_rs['address'];
                    $gender = $lastList_rs['gender'];
                    $phone = $lastList_rs['phone'];
                    $phone2 = $lastList_rs['phone2'];
                    $date = $lastList_rs['date'];

                ?>
                <form action="dashboard.php?page=pages/update_clients&id=<?php echo $id; ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Client ID :</label></b>
                                <input class="form-control" type="text" name="client_id" value="<?php echo $client_id ; ?> " readonly required>
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Client Name :</label></b>
                                <input class="form-control" type="text" name="client_name" value="<?php echo $name ; ?>" required>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Address :</label></b>
                                <input class="form-control" type="text" name="address" value="<?php echo $address ; ?> " placeholder="Enter Client Address" required>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Gender :</label></b>
                                <input class="form-control" type="text" name="gender" value="<?php echo $gender ; ?> " placeholder="Enter Client Name" required>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Phone Number :</label></b>
                                <input class="form-control" type="text" name="phone" value="<?php echo $phone ; ?> " placeholder="Enter Client Phone number" required>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Alternative Phone Number :</label></b>
                                <input class="form-control" type="text" name="phone2" value="<?php echo $phone2 ; ?> " placeholder="Enter Client Phone number">
                            </div> 
                        </div>  
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Date :</label></b>
                                <input class="form-control" type="text" id="date" name="date" value="<?php echo $date ; ?>" readonly>
                            </div> 
                        </div> 
                    </div>              
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <a href="dashboard.php?page=pages/view_clients" class="btn btn-info">Back</a>
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