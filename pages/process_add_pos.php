<br>
<br>

<?php
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
?>
<?php
        $pos_id = trim(mysqli_real_escape_string($db_connect,$_POST['pos_id'])); 
        $pos_name = trim(mysqli_real_escape_string($db_connect, strtoupper($_POST['pos_name']))); 
          
        $prod_query = "SELECT * FROM pos WHERE pos_id='{$bank_id}'";
        $prod_set = mysqli_query($db_connect, $prod_query);
        confirm_query($prod_set);
        if(mysqli_num_rows($prod_set) != 0) {
            ?>
            <center>
                <div class="row" style="margin-left: -1%; margin-top: -55px;">
                    <div class="col-md-12">
                        <?php
                            $error = "Error! POS already exists";
                            header("Location:dashboard.php?page=pages/view_Bank&error={$error}");                
                        ?>
                    </div>
                </div>
            </center>           
            <?php 
        }else{
            $query = "INSERT INTO pos (pos_id, pos_name ) VALUES ('{$pos_id}','{$pos_name}')";
            $result = mysqli_query($db_connect, $query);
            if($result){
                ?> 
                <div class="text-center" style="margin-left: 30%; margin-top: 10px;">
                    <div class="col-md-12">
                        <?php
                            $sucess = "POS successully created.";
                            header("Location:dashboard.php?page=pages/add_pos&success={$sucess}");            
                        ?>
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="index.php?page=pages/add_pos" class="btn btn-primary">Continue</a>
                </div>
                <?php
            }else{
                ?> 
                <div class="text-center" style="margin-left: 30%; margin-top: 10px;">
                    <div class="col-md-12">
                        <?php
                            $error = "Unable to create POS";
                            header("Location:dashboard.php?page=pages/add_pos&error={$error}");                
                        ?>
                    </div>                  
                </div>
                <div class="text-center">
                    <a href="index.php?page=pages/add_pos" class="btn btn-primary">Back</a>
                </div>

                <?php
            }
        }
?>