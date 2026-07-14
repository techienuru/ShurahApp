<?php
    include("includes/db_connect.php");
$status = 'Existing User';
?>
<?php
if(isset($_POST['submit'])) { // Form has been submitted.
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if($password == $confirm_password){
            $hashed_password = hash('sha512',$password);
            $update_sql = "UPDATE users SET hashed_password='{$hashed_password}', status='{$status}' WHERE username='{$username}'";
            $update_query = mysqli_query($db_connect,$update_sql);
            if($update_query){
                $success = "Password successully Changed.";
                $error = '';
                $username = '';
            header("Location:change_password.php?page=change_password&username={$username}&success={$success}&error={$error}");
                //echo "<div class='alert alert-success'>Password successully updated.</div>";
            }else{
                die(mysqli_error($db_connect));
                //echo "<div class='alert alert-danger'>Unable to update User.</div>";
            }
        }else{
            $error = "Password Mismatched.";
            $success = '';
            header("Location:change_password.php?page=change_password&username={$username}&success={$success}&error={$error}");
        }
        
}
?>