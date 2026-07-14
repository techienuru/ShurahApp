<?php
//include("includes/db_connect.php");
$user_iid = $_SESSION['user_id'] ;
$iid = $_GET['id']; 
    $sql = "SELECT * FROM users WHERE user_id=".$user_iid;
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $role = $userList_rs['role'];


?>

 <div class="container">
    <div class="box">
     <div class="col-6">
        <?php 
			$sql1 = "SELECT a.client_id, b.name, b.phone, b.gender, SUM(a.debit) AS total_debit, SUM(a.credit) AS total_credit, (SUM(a.credit) - SUM(a.debit)) AS balance FROM client_ledger a LEFT JOIN clients b ON a.client_id = b.client_id WHERE a.client_id =".$iid;
			$user_query1 = mysqli_query($db_connect, $sql1);
			$userList_rs1 = mysqli_fetch_assoc($user_query1);
			$balance = $userList_rs1['balance'];
			if($balance < 0){
				$error = "Client has balance";
				header("Location:dashboard.php?page=pages/view_clients&error={$error}");
			}else{
				 if($userList_rs['role'] == 'admin'){
					$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
					   $delcat_sql = "DELETE FROM clients WHERE client_id ='{$id}'";
					   $delcat_query = mysqli_query($db_connect, $delcat_sql);
					 echo $delcat_sql; 
						if($delcat_query){
							echo "<div class='alert alert-success'>Success! Product deleted.</div>";
							header("location:index.php?page=pages/view_agents");
							$sucess = "Client successully deleted.";
							header("Location:dashboard.php?page=pages/view_clients&success={$sucess}");
						}else{
							echo "<div class='alert alert-danger'>Unable to delete Product.</div>";
							$error = "Unable to delete Client";
							header("Location:dashboard.php?page=pages/view_clients&error={$error}"); 
						} 
				 }else{
					echo "<div class='alert alert-danger'>You are not authorised to delete this record!!!.</div>";
					echo "<div class='alert alert-danger'>Nothing to update</div>";
					$error = "You are not authorised to delete this record!!!.";
					header("Location:dashboard.php?page=pages/view_clients&error={$error}");
				 }
			}
         ?>
     </div>
        <div class="text-right">
            <div class="form-group">
                <div class="text-right">
                    <a href="index.php?page=pages/view_clients" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
     </div>
    </div>   
</body>
</html>