<br>
<br>

<?php
    $user_iid = $_SESSION['user_id'] ;
?>
<?php
        $expence_id = trim(mysqli_real_escape_string($db_connect, $_POST['expence_id']));
        $expence_code = trim(mysqli_real_escape_string($db_connect, $_POST['expence_code']));
        $description = trim(mysqli_real_escape_string($db_connect,  strtoupper($_POST['description'])));  
        $amount = trim(mysqli_real_escape_string($db_connect, $_POST['amount']));
        $date = trim(mysqli_real_escape_string($db_connect, $_POST['date']));
        $user = $user_iid;  
        $prod_query = "SELECT * FROM expence_table WHERE expence_id='{$expence_id}'";
        $prod_set = mysqli_query($db_connect, $prod_query);
        confirm_query($prod_set);
        if(mysqli_num_rows($prod_set) != 0) {
            ?>
            <center>
                <div class="row" style="margin-left: -1%; margin-top: -55px;">
                    <div class="col-md-12">
                        <div class="col-md-4 alert alert-danger">Error! Client already exists!</div>
                        <?php
                            $error = "Error! Expense already exists";
                            header("Location:dashboard.php?page=pages/add_expense&error={$error}");                
                        ?>
                    </div>
                </div>
            </center>           
            <?php 
        }else{
            $query = "INSERT INTO expence_table(expence_id, expence_code, description, amount, user_id, date) VALUES ('{$expence_id}','{$expence_code}','{$description}','{$amount}','{$user}','{$date}')";
        $result = mysqli_query($db_connect, $query);
            if($result){
                ?> 
                <div class="text-center" style="margin-left: 30%; margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="col-md-7 alert alert-primary"><b>Success!</b> Client created.</div>
                        <?php
                            $sucess = "Expense created.";
                            header("Location:dashboard.php?page=pages/add_expense&success={$sucess}");            
                        ?>
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="index.php?page=pages/add_expense" class="btn btn-primary">Continue</a>
                </div>
                <?php
            }else{
                ?> 
                <div class="text-center" style="margin-left: 30%; margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="col-md-7 alert alert-danger"><b>Error!</b> Client not created.</div>
                        <?php
                            $error = "Expense not created";
                            header("Location:dashboard.php?page=pages/add_expense&error={$error}");                
                        ?>
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="index.php?page=pages/add_expense" class="btn btn-primary">Back</a>
                </div>

                <?php
            }
        }
?>