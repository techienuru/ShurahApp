<?php require_once('includes/sessions.php') ; ?>
<?php include_once('includes/db_connect.php'); ?>
<?php include_once('functions/functions.php'); ?>
<?php 
      $error = "";

// Start form processing on the form div for the alert to appear on the form
    
    if(isset($_POST['submit'])){  // if form as been submitted.
        //$errors = array();
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = hash('sha512',$password);
     
            // Check Database to see if username and the hashed_password exist there.
            $query = "SELECT * ";
            $query .= "FROM users ";
            $query .= "WHERE username = '$username' ";
            $query .= "AND hashed_password = '$hashed_password' ";
            $query .= "LIMIT 1";
            $user_set = mysqli_query($db_connect, $query);
            if(mysqli_num_rows($user_set) == 1) {
                 // username and password authenticated
                 // and only 1 match.
                 $found_user = mysqli_fetch_array($user_set);
            // maintain state of the found user on all pages of the application
                $_SESSION['timestamp'] = time();
                //$_SESSION['logged_in'] = $logged_in;
                $_SESSION['user_id'] = $found_user['user_id'];
                $_SESSION['admin'] = $found_user['username'];
                $_SESSION['branch_iid'] = $found_user['branch_id'];
                $_SESSION['role'] = $found_user['role'];
                $error = ''; 
                //redirect_to("dashboard.php");
                if($found_user['status'] == 'New User' ){
                header("Location:change_password.php?page=change_password&error={$error}&success={$success}&username={$username}");
                }else if($found_user['status'] == 'Existing User' && $found_user['isActive'] == 1){
                    if($found_user['role'] == 'admin'){
                       redirect_to("dashboard.php");  
                    }elseif($found_user['role'] != 'admin'){
                        header("Location:dashboard.php");
                    }
                    
                }else{
                        $error = "User has not been activated. Contact Administrator";
                        header("Location:login.php?&error={$error}");
                }

            } else {// username/password combo was not found in the database   
                $error = "Error! Username/Password combination incorrect.";
                header("Location:login.php?&error={$error}");
                
?>

    <?php 

            }            
    } else{
        $username = "";
        $password = "";
    }
?>