<br>
<br>

<?php

        $expence_code = trim(mysqli_real_escape_string($db_connect, $_POST['expence_code']));
        $expence_name = trim(mysqli_real_escape_string($db_connect,  strtoupper($_POST['expence_name']))); 
        $prod_query = "SELECT * FROM expence_sub_head WHERE expence_code='{$expence_code}'";
        $prod_set = mysqli_query($db_connect, $prod_query);
        confirm_query($prod_set);
        if(mysqli_num_rows($prod_set) != 0) {
            ?>
            <center>
                <div class="row" style="margin-left: -1%; margin-top: -55px;">
                    <div class="col-md-12">
                        <div class="col-md-4 alert alert-danger">Error! Client already exists!</div>
                        <?php
                            $error = "Error! Expence Sub Head already exists!";
                            header("Location:dashboard.php?page=pages/view_expense_sub_head&error={$error}");                
                        ?>
                    </div>
                </div>
            </center>           
            <?php 
        }else{
            $query = "INSERT INTO expence_sub_head (expence_code, expence_name) VALUES ('{$expence_code}','{$expence_name}')";
            $result = mysqli_query($db_connect, $query);
            if($result){
                ?> 
                <div class="text-center" style="margin-left: 30%; margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="col-md-7 alert alert-primary"><b>Success!</b> Client created.</div>
                        <?php
                            $sucess = "Expence Sub Head created.";
                            header("Location:dashboard.php?page=pages/view_expense_sub_head&success={$sucess}");            
                        ?>
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="index.php?page=pages/view_expense_sub_head" class="btn btn-primary">Continue</a>
                </div>
                <?php
            }else{
                ?> 
                <div class="text-center" style="margin-left: 30%; margin-top: 10px;">
                    <div class="col-md-12">
                        <div class="col-md-7 alert alert-danger"><b>Error!</b> Client not created.</div>
                        <?php
                            $error = "Expence Sub Head not created";
                            header("Location:dashboard.php?page=pages/view_expense_sub_head&error={$error}");                
                        ?>
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="index.php?page=pages/view_expense_sub_head" class="btn btn-primary">Back</a>
                </div>

                <?php
            }
        }
?>