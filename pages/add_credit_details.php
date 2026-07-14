
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
        <h1 class="what_taital">Make Payment</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
<?php 
    $user = $_SESSION['admin'];
    $debit = $_GET['debit'];
    $credit = $_GET['credit'];
    $balance = $_GET['balance'];
    $client_id = $_GET['client_id'];
	if(empty($_GET['invoice'])){
		// Generate a unique receipt number
        $minRange = 100000;
        $maxRange = 999999;
        $receiptNumber = generateUniqueReceiptNumber($minRange, $maxRange, $previousReceiptNumbers);
		$invoice = $receiptNumber;
	}else{
		$invoice = $_GET['invoice'];
	}
    $name = $_GET['name'];
    $date = date('Y-m-d');
    $user_iid = $_SESSION['user_id'];
?>
<div class="box">
        <h3 class="text-center"><b>Account Details</b></h3>
        <hr>
        <form action="pages/process_add_credit.php" method="post">
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
                <div class="col-2">
                    <div class="form-group">
                        <b><label>Cash :</label></b>
                        <input class="form-control" type="text" name="cash" value="0" required>
                        <hr style="margin-top: 3px;">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <b><label>POS :</label></b>
                        <input class="form-control" type="text" name="pos" value="0" required>
                        <hr style="margin-top: 3px;">
                    </div>
                </div>                
                <div class="col-2">
                    <div class="form-group">
                        <b><label>Transfer :</label></b>
                        <input class="form-control" type="text" name="transfer" value="0" required>
                        <hr style="margin-top: 3px;">
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
                        <b><label>Reference Number :</label></b>
                        <select class="form-control" id="ref" name="ref">
                            <option value="">Reference Number</option>
                            <?php
                                $userist_sql = "SELECT invoice, DEBIT AS total_debit, CREDIT AS total_credit, (DEBIT - CREDIT) AS total_balance FROM client_ledger WHERE client_id = {$client_id}";
                                $userList_query = mysqli_query($db_connect, $userist_sql);
                                $userList_rs = mysqli_fetch_assoc($userList_query);
                            do { ?>
                                <option value="<?php echo $userList_rs['invoice'];?>"><?php echo $userList_rs['invoice']; ?>
                                    <?php
                                // to remove the negative balances from the options
                                        if($userList_rs['total_balance'] < 0){
                                            
                                        }else{
                                           echo "₦ " .$userList_rs['total_balance']; 
                                        }
                                    ?>
                            </option>
                            <?php } while($userList_rs = mysqli_fetch_assoc($userList_query));
                                ?>
                        </select>
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
                        <input class="form-control" type="text" name="balance" value="<?php echo number_format($balance);?>" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <b><label>Description :</label></b>
                        <input class="form-control" type="text" name="description" placeholder="Enter narration" required>
                        <hr style="margin-top: 3px;">
                    </div>
                </div> 
            </div>
            <div class="text-right">
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Make Payment">
                </div>
            </div>
        </form>
    </div>
        </div>
        </div>
      </div>