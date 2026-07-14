
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = createthree();
        $date = date('Y-m-d');

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
        <h1 class="what_taital">Make Withdrawal</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
<?php 
    $user = $_SESSION['admin'];
    $debit = $_GET['debit'];
    $credit = $_GET['credit'];
    $balance = $_GET['balance'];
    $client_id = $_GET['client_id'];
    $invoice = $_GET['invoice'];
    $name = $_GET['name'];
    $date = date('Y-m-d');
    $user_iid = $_SESSION['user_id'];
?>
<div class="box">
        <h3 class="text-center"><b>Account Details</b></h3>
        <hr>
        <form action="pages/process_add_debit.php" method="post">
            <div class="row">
                <div class="col-3">
                   <div class="form-group">
                        <b><label>Invoice :</label></b>
                        <input class="form-control" type="text" name="invoice" value="<?php echo $invoice ; ?> " readonly>
                    </div>
                </div>
                <div class="col-3">
                   <div class="form-group">
                        <b><label>Client ID :</label></b>
                        <input class="form-control" type="text" name="client_id" value="<?php echo $client_id ; ?> " readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <b><label>Account Name :</label></b>
                        <input class="form-control" type="text" name="client_name" value="<?php echo $name;?>" readonly required>
                    </div> 
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <b><label>Amount :</label></b>
                        <input class="form-control" type="text" name="amount" value="<?php echo @$_POST['amount'];?>" required>
                        <hr style="margin-top: 3px;">
                    </div>
                </div> 
                <div class="col-6">
                    <div class="form-group">
                        <b><label>Description :</label></b>
                        <input class="form-control" type="text" name="description" placeholder="Enter narration" required>
                        <hr style="margin-top: 3px;">
                    </div>
                </div> 
                <div class="col-3">
                    <div class="form-group">
                        <b><label>Transaction Date :</label></b>
                        <input class="form-control" type="date" name="date" value="<?php echo $date;?>" required>
                    </div>             
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <b><label>Balance :</label></b>
                        <input class="form-control" type="text" name="balance" value="<?php echo number_format($balance,2);?>" readonly>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Make Withdrawal">
                </div>
            </div>
        </form>
    </div>
        </div>
        </div>
      </div>