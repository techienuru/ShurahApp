
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
		$client_id = $_SESSION['client_id']; 
    ?>
    <div class="team_section layout_padding" style="margin-top: -400px">
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
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">Checkout</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Payment Details</b></h3>
                <hr>

                <form action="dashboard.php?page=pages/savesales&p_amount=<?php echo $_GET['p_amount']; ?>&invoice=<?php echo $_GET['invoice']; ?>&prod_id=<?php echo $_GET['prod_id']; ?>" method="post">
                    <div class="row">
                        <input type="hidden" name="date" value="<?php echo date("m/d/Y"); ?>" />
                        <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
                        <input type="hidden" name="total" value="<?php echo $_GET['total']; ?>" />
                        <input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />
                        <input type="hidden" name="p_amount" value="<?php echo $_GET['p_amount']; ?>" />
                        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>" />
                        <div class="col-6">
						<?php 
							if(empty($_SESSION['client_id'])){?>
								<div class="form-group">
									<b><label>Client Name :</label></b>
									<input class="form-control" type="text" name="client_name" value="" placeholder="" id="client_id" onkeyup="multi()" required />
									<input type="radio" name="supplied_status" value="SUPPLIED" checked required> SUPPLIED 
<!--									<input type="radio" name="supplied_status" value="NOT SUPPLIED" required> NOT SUPPLIED-->
								</div>			
							<?php
							}else{
								$prodList_sql = "SELECT * FROM clients WHERE client_id='{$client_id}'";
								$prodList_query = mysqli_query($db_connect, $prodList_sql);
								$prodList_rs = mysqli_fetch_assoc($prodList_query);
								$client_name = $prodList_rs['name'];
							?>
                            <div class="form-group">
                                <b><label>Client Name :</label></b>
                                <input class="form-control" type="text" name="client_name" value="<?php echo $client_name; ?>" placeholder="" id="client_id" onkeyup="multi()" required />
								<input type="radio" name="supplied_status" value="SUPPLIED" checked required> SUPPLIED 
<!--								<input type="radio" name="supplied_status" value="NOT SUPPLIED" required> NOT SUPPLIED-->
                            </div>						
							
							<?php
							}
							?>	
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Invoice :</label></b>
                                <input class="form-control" type="text" name="invoice" value="<?php echo $_GET['invoice'];?>" placeholder="" id="invoice" onkeyup="multi()" readonly />
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Total :</label></b>
                                <input class="form-control" type="text" name="total" value="<?php echo $_GET['total'];?>" placeholder="" id="total" onkeyup="multi1()" readonly />
                            </div>
                        </div>
                        <div class="col-2">
                           <div class="form-group">
                                <b><label>Cash :</label></b>
                                <input class="form-control" type="text" name="cash" value="0" placeholder="Cash" id="cash" onkeyup="multi1()"/>
                            </div>
                        </div>
                        <div class="col-2">
                           <div class="form-group">
                                <b><label>POS :</label></b>
                                <input class="form-control" type="text" name="pos" value="0" placeholder="POS" id="pos" onkeyup="multi1()"/>
                            </div>
                        </div> 
                        <div class="col-2">
                           <div class="form-group">
                                <b><label>Transfer :</label></b>
                                <input class="form-control" type="text" name="transfer" value="0" placeholder="Transfer" id="transfer" onkeyup="multi1()"/>
                            </div>
                        </div>
                        <div class="col-3">
                           <div class="form-group">
                                <b><label>Discount :</label></b>
                                <input class="form-control" type="text" name="discount" value="0" placeholder="Enter Discount" id="discount" onkeyup="multi1()"/>
                            </div>
                        </div>
                        <div class="col-3">
                           <div class="form-group">
                                <b><label>Balance :</label></b>
                                <input class="form-control" type="number" min="0" name="balance" value="<?php echo $_GET['total'];?>" placeholder="Balance" id="balance" onkeyup="multi()"/>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>POS Medium :</label></b>
                                <select class="form-control" id="pos_medium" name="pos_medium">
                                    <option value="">Select POS </option>
                                    <?php
                                        $userist_sql = "SELECT * FROM pos ORDER BY pos_name ASC";
                                        $userList_query = mysqli_query($db_connect, $userist_sql);
                                        $userList_rs = mysqli_fetch_assoc($userList_query);
                                    do { ?>
                                        <option value="<?php echo $userList_rs['pos_name'];?>"><?php echo $userList_rs['pos_name']; ?></option>
                                    <?php } while($userList_rs = mysqli_fetch_assoc($userList_query));
                                        ?>
                                </select>
                            </div> 
                        </div> 
						<div class="col-3">
                            <div class="form-group">
                                <b><label>Bank :</label></b>
                                <select class="form-control" id="bank" name="bank">
                                    <option value="">Select Bank</option>
                                    <?php
                                        $userist_sql = "SELECT * FROM bank ORDER BY bank_name ASC";
                                        $userList_query = mysqli_query($db_connect, $userist_sql);
                                        $userList_rs = mysqli_fetch_assoc($userList_query);
                                    do { ?>
                                        <option value="<?php echo $userList_rs['bank_name'];?>"><?php echo $userList_rs['bank_name']; ?></option>
                                    <?php } while($userList_rs = mysqli_fetch_assoc($userList_query));
                                        ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" name="hold" value=""  id="hold" placeholder="" style="width: 268px; margin-bottom: 15px;margin-left:12px;" />
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" name="spe_discount" value="0" id="spe_discount" placeholder="Special Discount" style="width: 268px; margin-bottom: 15px;margin-left:12px;" />
                            </div> 
                        </div> 
                    </div>
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary" style="width: 200px;">Save</button>
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
<script type="text/javascript">
    function multi1(){
        var total = document.getElementById('total').value;
        var cash = document.getElementById('cash').value;
        var pos = document.getElementById('pos').value;
        var transfer = document.getElementById('transfer').value;
        var discount = document.getElementById('discount').value;
        var result = parseInt(total) - parseInt(cash) - parseInt(pos) - parseInt(transfer) - parseInt(discount) ;
        if(!isNaN(result)){
            document.getElementById('balance').value = result;
        }
    }

</script>