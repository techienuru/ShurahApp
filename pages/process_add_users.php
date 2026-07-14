<br>
<br>
<?php
ob_start();
include_once('includes/db_connect.php');
        $user_iid = $_SESSION['user_id'];

        $user_id = trim(mysqli_real_escape_string($db_connect,$_POST['user_id']));
        $fullname = trim(mysqli_real_escape_string($db_connect, strtoupper($_POST['fullname'])));        
        $username = trim(mysqli_real_escape_string($db_connect,$_POST['username']));       
        $password = trim(mysqli_real_escape_string($db_connect,$_POST['password']));
        $confirm_password = trim(mysqli_real_escape_string($db_connect,$_POST['confirm_password'])); 
        $phone = trim(mysqli_real_escape_string($db_connect,$_POST['phone'])); 
        $status = trim(mysqli_real_escape_string($db_connect,$_POST['status']));
        $isActive = trim(mysqli_real_escape_string($db_connect,$_POST['activation_id']));
        $role = trim(mysqli_real_escape_string($db_connect,$_POST['role']));
        $date = trim(mysqli_real_escape_string($db_connect,$_POST['date']));
		$authorization = "1111";
        if($password == $confirm_password){
        $hashed_password = hash('sha512',$confirm_password);
        
          
        $prod_query = "SELECT * FROM users WHERE user_id='{$user_id}'";
        $prod_set = mysqli_query($db_connect, $prod_query);
        confirm_query($prod_set);
        if(mysqli_num_rows($prod_set) != 0) {
            ?>
            <center>
                <div class="row" style="margin-left: -1%; margin-top: -55px;">
                    <div class="col-md-12">
                        <div class="col-md-4 alert alert-danger">Error! User already exists!</div>
                        <?php
                            $error = "Error! User already exists!";
                            header("Location:dashboard.php?&pages=pages/add_users&error={$error}");                
                        ?>
                    </div>
                </div>
            </center>           
            <?php 
        }else{
             // Using prepared statement for both cases
            $query = "INSERT INTO users (user_id, fullname, username, hashed_password, phone, status, isActive, role, date, authorization) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db_connect->prepare($query);

            if ($stmt) {
                $stmt->bind_param("ssssssssss", $user_id, $fullname, $username, $hashed_password, $phone, $status, $isActive, $role, $date, $authorization);
                $stmt->execute();
                $stmt->close();
                mysqli_close($db_connect);
                $sucess = "User successully created.";
                header("Location:dashboard.php?&page=pages/view_users&success={$sucess}");
            } else {
                $error = "Unable to create User";
                header("Location:dashboard.php?&page=pages/view_users&error={$error}"); 
            }           
        }
            }
?>