<?php
include("includes/db_connect.php"); 
$user_iid = $_SESSION['user_id'] ;

    $sql = "SELECT * FROM users WHERE user_id=".$user_iid;
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $role = $userList_rs['role'];
    echo $role; 
?>
 <div class="container">
    <div class="box">
     <div class="col-6">
        <?php 
         if($userList_rs['role'] == 'admin'){
            $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
               $delcat_sql = "DELETE FROM product WHERE prod_id ={$id}";
               $delcat_query = mysqli_query($db_connect, $delcat_sql);
                if($delcat_query){
                    echo "<div class='alert alert-success'>Success! Product deleted.</div>";
                    //header("location:index.php?page=pages/view_agents");
                    $sucess = "Product successully deleted.";
                    header("Location:dashboard.php?page=pages/view_products&success={$sucess}");
                }else{
                    echo "<div class='alert alert-danger'>Unable to delete Product.</div>";
                    $error = "Unable to delete Product";
                    header("Location:dashboard.php?page=pages/view_products&error={$error}"); 
                        //header("location:index.php?page=pages/view_agents");
                } 

         }else{
            echo "<div class='alert alert-danger'>You are not authorised to delete this record!!!.</div>";
            echo "<div class='alert alert-danger'>Nothing to update</div>";
            $error = "You are not authorised to delete this record!!!.";
            header("Location:dashboard.php?page=pages/view_products&error={$error}");
         }
         ?>
     </div>
        <div class="text-right">
            <div class="form-group">
                <div class="text-right">
                    <a href="index.php?page=pages/view_products" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
     </div>
    </div>   
</body>
</html>