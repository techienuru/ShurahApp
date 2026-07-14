<?php
$id = $_GET['id'];
?>

        <div class="container">
            <div class="box">
            <?php
                $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
				$lastList_sql = "SELECT a.user_id, a.fullname, a.username, a.phone, a.status, a.role, a.isActive, a.date, a.authorization FROM users a  WHERE a.user_id =".$id ;
				$lastList_query = mysqli_query($db_connect, $lastList_sql);
				$lastList_rs = mysqli_fetch_assoc($lastList_query);
				$user_id = $lastList_rs['user_id'];
				$fullname = $lastList_rs['fullname'];
				$username = $lastList_rs['username'];
				$phone = $lastList_rs['phone'];
				$status = $lastList_rs['status'];
				$role = $lastList_rs['role'];
				$isActive = $lastList_rs['isActive'];
				$date = $lastList_rs['date'];
				$authorization = $lastList_rs['authorization'];
                
                if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $fullname = $_POST['fullname'];
                $phone = $_POST['phone'];
                $role = $_POST['role'];
                $isActive = $_POST['activation'];

                if($lastList_rs['username'] != $_POST['username']|| $lastList_rs['fullname'] != $_POST['fullname']|| $lastList_rs['phone'] != $_POST['phone'] || $lastList_rs['isActive'] != $_POST['isActive']|| $lastList_rs['authorization'] != $_POST['authorization']|| $lastList_rs['role'] != $_POST['role']){
                $new_username = mysqli_real_escape_string($db_connect, $_POST['username']);
                $new_fullname = mysqli_real_escape_string($db_connect, $_POST['fullname']);
                $new_phone = mysqli_real_escape_string($db_connect, $_POST['phone']);
                $new_isActive = mysqli_real_escape_string($db_connect, $_POST['activation']);
                $new_authorization = $authorization;
                $new_role = mysqli_real_escape_string($db_connect, $_POST['role']);

                $update_sql = "UPDATE users SET fullname='{$new_fullname}', username='{$new_username}', phone='{$new_phone}',isActive='{$new_isActive}',role='{$new_role}', authorization='{$new_authorization}' WHERE user_id=".$_GET['id'];
                $update_query = mysqli_query($db_connect,$update_sql);
                if($update_query){
                    echo "<div class='alert alert-success'>Product successully updated.</div>";
                    $sucess = "User successully updated.";
                    header("Location:dashboard.php?page=pages/view_users&success={$sucess}");
                }else{
                    die(mysqli_error($db_connect));
                    $error = "Unable to update User";
                    header("Location:dashboard.php?page=pages/view_users&error={$error}");              
                    }   
                }else{
                    echo "<div class='alert alert-danger'>Nothing to update</div>";
                    $error = "Nothing to update";
                    header("Location:dashboard.php?page=pages/view_users&error={$error}"); 
                }  
            }
       
            ?>
                    <div class="text-right">
                        <a href="dashboard.php?page=pages/view_users" class="btn btn-info">Back</a>
                    </div>
            </div>
        </div>

<?php 
?>
