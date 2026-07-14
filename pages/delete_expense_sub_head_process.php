<?php
$user_iid = $_SESSION['user_id'] ;

    $sql = "SELECT * FROM users WHERE user_id=".$user_iid;
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $role = $userList_rs['role'];
    echo $role; 
?>
<br>
<br>
<!DOCTYPE html>
<html>
    <head>  
    </head>
<body>

 <div class="container">
    <div class="box">
     <div class="col-6">
        <?php 
         if($userList_rs['role'] == 'admin'){
            $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
               $delcat_sql = "DELETE FROM expence_sub_head WHERE expence_code ={$id}";
               $delcat_query = mysqli_query($db_connect, $delcat_sql);
                if($delcat_query){
                    echo "<div class='alert alert-success'>Success! Product deleted.</div>";
                    //header("location:index.php?page=pages/view_agents");
                    $sucess = "Expense sub head successully deleted.";
                    header("Location:dashboard.php?page=pages/view_expense_sub_head&success={$sucess}");
                }else{
                    echo "<div class='alert alert-danger'>Unable to delete Product.</div>";
                    $error = "Unable to delete Expense sub head";
                    header("Location:dashboard.php?page=pages/view_expense_sub_head&error={$error}"); 
                        //header("location:index.php?page=pages/view_agents");
                } 

         }else{
            echo "<div class='alert alert-danger'>You are not authorised to delete this record!!!.</div>";
            echo "<div class='alert alert-danger'>Nothing to update</div>";
            $error = "You are not authorised to delete this record!!!.";
            header("Location:dashboard.php?page=pages/view_expense_sub_head&error={$error}");
         }
         ?>
     </div>
        <div class="text-right">
            <div class="form-group">
                <div class="text-right">
                    <a href="dashboard.php?page=pages/view_expense_sub_head" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
     </div>
    </div>   
</body>
</html>