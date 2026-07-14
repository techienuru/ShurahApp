<?php
    include("../includes/db_connect.php");
    $status = 'New User';
    $user_iid = $_SESSION['user_id'] ;

    $sql = "SELECT * FROM users WHERE user_id=".$user_iid;
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $role = $userList_rs['role'];
    echo $role; 
?>
<?php
if(isset($_POST['submit'])) { // Form has been submitted.
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if($role != 'admin'){
            if($password == $confirm_password){
                $status = 'Existing User'; 
                $hashed_password = hash('sha512',$password);
                $update_sql = "UPDATE users SET hashed_password='{$hashed_password}', status='{$status}' WHERE username='{$username}'";
                $update_query = mysqli_query($db_connect,$update_sql);
                if($update_query){
                    $success = "Password successully reset. You can sign in now.";
                    $error = '';
                header("Location:dashboard.php?page=pages/reset_password&success={$success}");
                    //echo "<div class='alert alert-success'>Password successully updated.</div>";
                }else{
                    die(mysqli_error($db_connect));
                    //echo "<div class='alert alert-danger'>Unable to update User.</div>";
                }
            }else{
                $error = "Password Mismatched.";
                header("Location:dashboard.php?page=pages/reset_password&&error={$error}");
            }
        }else{
            if($password == $confirm_password){
                $status = 'New User';
                $hashed_password = hash('sha512',$password);
                $update_sql = "UPDATE users SET hashed_password='{$hashed_password}', status='{$status}' WHERE username='{$username}'";
                $update_query = mysqli_query($db_connect,$update_sql);
                if($update_query){
                    $success = "Password successully reset. You can sign in now.";
                    $error = '';
                header("Location:dashboard.php?page=pages/reset_password&success={$success}");
                    //echo "<div class='alert alert-success'>Password successully updated.</div>";
                }else{
                    die(mysqli_error($db_connect));
                    //echo "<div class='alert alert-danger'>Unable to update User.</div>";
                }
            }else{
                $error = "Password Mismatched.";
                header("Location:dashboard.php?page=pages/reset_password&&error={$error}");
            }
        }   
}
?>