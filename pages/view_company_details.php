 <!--header section start -->
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('Hms');
        $date = date('Y-m-d');

		if(!empty($_GET['success'])){
			include('alert.php'); 
		}elseif(!empty($_GET['error'])){
		   include('alert.php'); 
		}
    ?>
    <div class="team_section layout_padding">
      <div class="" style="margin-top: -100px;">
        <h1 class="what_taital">Add Company Details</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Company Details</b></h3>
                <?php
                    $lastList_sql = "SELECT a.ref_id, a.company_name, a.motto, a.address1, a.address2, a.address3, a.address4, a.phone_no1, a.phone_no2, a.email, a.website FROM company_details a";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $ref_id = $lastList_rs['ref_id'];
                    $company_name = $lastList_rs['company_name'];
                    $motto = $lastList_rs['motto'];
                    $address1 = $lastList_rs['address1'];
                    $address2 = $lastList_rs['address2'];
                    $address3 = $lastList_rs['address3'];
                    $address4 = $lastList_rs['address4'];
                    $phone_no1 = $lastList_rs['phone_no1'];
                    $phone_no2 = $lastList_rs['phone_no2'];
                    $email = $lastList_rs['email'];
                    $website = $lastList_rs['website'];
                ?>
                <hr>
                <form action="dashboard.php?page=pages/update_company_details&id=<?php echo $ref_id ; ?>" method="post">
					<div class="row">
					<div class="col-6">
                            <div class="form-group">
                                <b><label>Company Name :</label></b>
                                <input class="form-control" type="text" name="company_name" value="<?php echo $company_name;?>" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Motto :</label></b>
                                <input class="form-control" type="text" name="motto" value="<?php echo $motto;?>" required>
                            </div> 
                        </div>
						<div class="col-6">
                            <div class="form-group">
                                <b><label>Address 1 :</label></b>
                                <input class="form-control" type="text" name="address1" value="<?php echo $address1;?>" required>
                            </div> 
                        </div> 
					    <div class="col-6">
                            <div class="form-group">
                                <b><label>Address 2 :</label></b>
                                <input class="form-control" type="text" name="address2" value="<?php echo $address2;?>" required>
                            </div> 
                        </div> 
					    <div class="col-6">
                            <div class="form-group">
                                <b><label>Address 3 :</label></b>
                                <input class="form-control" type="text" name="address3" value="<?php echo $address3;?>" required>
                            </div> 
                        </div> 
					    <div class="col-6">
                            <div class="form-group">
                                <b><label>Address 4 :</label></b>
                                <input class="form-control" type="text" name="address4" value="<?php echo $address4;?>" required>
                            </div> 
                        </div> 	
						<div class="col-6">
                            <div class="form-group">
                                <b><label>Phone 1 :</label></b>
                                <input class="form-control" type="text" name="phone_no1" value="<?php echo $phone_no1;?>" required>
                            </div> 
                        </div> 
					    <div class="col-6">
                            <div class="form-group">
                                <b><label>Phone 2 :</label></b>
                                <input class="form-control" type="text" name="phone_no2" value="<?php echo $phone_no2;?>" required>
                            </div> 
                        </div>
						<div class="col-6">
                            <div class="form-group">
                                <b><label>E-mail :</label></b>
                                <input class="form-control" type="email" name="email" value="<?php echo $email;?>" required>
                            </div> 
                        </div>
						<div class="col-6">
                            <div class="form-group">
                                <b><label>Website :</label></b>
                                <input class="form-control" type="test" name="website" value="<?php echo $website;?>" required>
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