
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = createthree();
        $date = date('Y-m-d');

        $get_client = mysqli_query($db_connect,"SELECT * FROM clients ORDER BY name ASC") or die(mysqli_error($db_connect));
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
    <div class="team_section layout_padding"  style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Payment History</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Payment Details</b></h3>
                <hr>
                <form action="" method="post">
                    <div class="row">
                        <input class="form-control" type="hidden" name="category_id" value="<?php echo $rnd ; ?> " readonly required>
                        <div class="col-4">
                            <div class="form-group">
                                <b><label>Client ID :</label></b>
                                <select class="form-control" name="client_id" id="category_id" required>
                                    <option value="">--- Select Client ID ---</option>
                                    <?php while($row = mysqli_fetch_assoc($get_client)): ?>
                                        <option value="<?php echo $row['client_id']; ?>"><?php echo $row['client_id']; ?> - <?php echo $row['name']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <b><label>Start Date :</label></b>
                                <input class="form-control" type="date" name="state_date" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <b><label>End Date :</label></b>
                                <input class="form-control" type="date" name="end_date" >
                            </div>
                        </div>                
                    </div>
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Get Details</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
      </div>
<div>
<?php
        $client_id = "";
        if(isset($_POST['submit']) && empty($_POST['start_date']) && empty($_POST['end_date'])){
        $client_id =  $_POST['client_id'];
            
        $query=mysqli_query($db_connect,"SELECT a.client_id, a.name, a.gender, a.phone FROM clients a WHERE a.client_id ={$client_id} ") or die(mysqli_error($db_connect));
        $account_rs = mysqli_fetch_assoc($query);    
        $client_iid = $account_rs['client_id'];
        $name = $account_rs['name'];
        
        if(!empty($account_rs)){
        $query1=mysqli_query($db_connect,"SELECT s.date, s.client_id, s.invoice, s.description, s.debit, s.credit, @b := @b + s.credit - s.debit AS balance, SUM(s.debit) AS total_debit,SUM(s.credit) AS total_credit FROM(SELECT @b := 0.0) AS dummy CROSS JOIN client_ledger AS s WHERE s.client_id ={$client_id} ORDER BY ref_id ASC") or die(mysqli_error($db_connect));
        $account_rs1 = mysqli_fetch_assoc($query1);    
        $total_debit = $account_rs1['total_debit'];
        $total_credit = $account_rs1['total_credit'];
        $balance = $total_credit - $total_debit;
        header("Location: dashboard.php?page=pages/transaction_history_savings_details&name={$name}&debit={$total_debit}&credit={$total_credit}&balance={$balance}&client_id={$client_id}");
        }
        
        }else{
            if(isset($_POST['submit'])){
            $client_id =  $_POST['client_id'];
            $start_date = date("Y-m-d", strtotime($_POST['state_date']));
            $end_date = date("Y-m-d", strtotime($_POST['end_date']));
            $query=mysqli_query($db_connect,"SELECT a.client_id, a.name, a.gender, a.phone FROM clients a WHERE a.client_id ={$client_id} ") or die(mysqli_error($db_connect));
            $account_rs = mysqli_fetch_assoc($query);    
            $client_iid = $account_rs['client_id'];
            $name = $account_rs['name'];
            
            $query1=mysqli_query($db_connect,"SELECT s.date, s.client_id, s.invoice, s.description, s.debit, s.credit, @b := @b + s.credit - s.debit AS balance, SUM(s.debit) AS total_debit,SUM(s.credit) AS total_credit FROM(SELECT @b := 0.0) AS dummy CROSS JOIN client_ledger AS s WHERE s.client_id ={$client_id} AND date between '$start_date' AND '$end_date' ORDER BY ref_id ASC") or die(mysqli_error($db_connect));
            $account_rs1 = mysqli_fetch_assoc($query1);    
            $total_debit = $account_rs1['total_debit'];
            $total_credit = $account_rs1['total_credit'];
            $balance = $total_credit - $total_debit;
            header("Location: dashboard.php?page=pages/transaction_history_savings_details2&name={$name}&debit={$total_debit}&credit={$total_credit}&balance={$balance}&start={$start_date}&end={$end_date}&client_id={$client_id}");
            //header("Location: dashboard.php?page=pages/transaction_history_savings_details2&name={$name}&debit={$total_debit}&credit={$total_credit}&balance={$balance}&client_id={$client_id}");
        }
        }



?>
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