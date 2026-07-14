<?php 
$user_iid = $_SESSION['user_id'] ;
//$branch_id = $_SESSION['branch_iid'] ;
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    $sql = "SELECT * FROM users WHERE user_id=".$user_iid;
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $role = $userList_rs['role'];


	$lastList_sql = "SELECT a.date, a.expence_id, c.expence_name, a.description, a.amount, b.username FROM expence_table a LEFT JOIN users b ON a.user_id = b.user_id LEFT JOIN expence_sub_head c ON c.expence_code = a.expence_code  WHERE a.expence_id =".$id ;
	$lastList_query = mysqli_query($db_connect, $lastList_sql);
	$lastList_rs = mysqli_fetch_assoc($lastList_query);
	$date = $lastList_rs['date'];
	$expence_id = $lastList_rs['expence_id'];
	$expence_name = $lastList_rs['expence_name'];
	$amount = $lastList_rs['amount'];
	$username = $lastList_rs['username'];
	$rev_reason = isset($_GET['reversal_reason']) ? $_GET['reversal_reason'] : null; 
	$date = date('Y-m-d');
echo $rev_reason;
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
			$query = "INSERT INTO expense_table_reversal ( expense_id, expense_name, rev_reason, rev_amount, date, user_id) VALUES ('{$expence_id}','{$expence_name}','{$rev_reason}','{$amount}','{$date}','{$user_iid}')";
			$result = mysqli_query($db_connect, $query);
			 
               $delcat_sql = "DELETE FROM expence_table WHERE expence_id =".$id ;
               $delcat_query = mysqli_query($db_connect, $delcat_sql); 
			 echo $delcat_sql;
                if($delcat_query && $result){
                    echo "<div class='alert alert-success'>Success! Product deleted.</div>";
                    //header("location:index.php?page=pages/view_agents");
                    $sucess = "Transaction successully reversed.";
                    header("Location:dashboard.php?&page=pages/view_expense&success={$sucess}");
                }else{
                    echo "<div class='alert alert-danger'>Unable to delete Product.</div>";
                    $error = "Unable to reverse transaction";
                    header("Location:dashboard.php?&page=pages/view_expense&error={$error}"); 
                } 

         }else{
            echo "<div class='alert alert-danger'>Nothing to reverse</div>";
            $error = "You are not authorised to delete this record!!!.";
            header("Location:dashboard.php?&page=pages/view_expense&error={$error}");
         }
         ?>
     </div>
        <div class="text-right">
            <div class="form-group">
                <div class="text-right">
                    <a href="dashboard.php?&page=pages/view_expense" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
     </div>
    </div>   
</body>
</html>