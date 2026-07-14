<?php
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
</head>
    <body>
        <div class="container">
            <div class="box">
            <?php
                $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

                $lastList_sql = "SELECT * FROM expence_sub_head WHERE expence_code='{$id}'";
                $lastList_query = mysqli_query($db_connect, $lastList_sql);
                $lastList_rs = mysqli_fetch_assoc($lastList_query);
                $expence_code = $lastList_rs['expence_code'];
                $category_name = $lastList_rs['expence_name'];
                
                if(isset($_POST['submit'])){
                $expence_code = $_POST['expence_code'];
                $expence_name = $_POST['expence_name'];
                if($lastList_rs['expence_name'] != $_POST['expence_name']){
                    $new_expence_name = mysqli_real_escape_string($db_connect, $_POST['expence_name']);
                $update_sql = "UPDATE expence_sub_head SET expence_name='{$new_expence_name}' WHERE expence_code='{$id}'";
                $update_query = mysqli_query($db_connect,$update_sql);

                if($update_query){
                    echo "<div class='alert alert-success'>Product successully updated.</div>";
                    $sucess = "Sub Head successully updated.";
                    header("Location:dashboard.php?page=pages/view_expense_sub_head&success={$sucess}");
                }else{
                    die(mysqli_error($db_connect));
                    $error = "Unable to update Sub Head";
                    header("Location:dashboard.php?page=pages/view_expense_sub_head&error={$error}");              
                    }   
                }else{
                    echo "<div class='alert alert-danger'>Nothing to update</div>";
                    $error = "Nothing to update";
                    header("Location:dashboard.php?page=pages/view_expense_sub_head&error={$error}"); 
                }  
            }
       
            ?>
                    <div class="text-right">
                        <a href="dashboard.php?page=pages/view_expense_sub_head" class="btn btn-info">Back</a>
                    </div>
            </div>
        </div>
    </body>
</html>

<script>
// confirm record deletion
function delete_user(id, group_id ){    
    var answer = confirm('Are you sure you want to delete this client?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'index.php?page=pages/delete_update_groups&client_id=' + id + '&group_id=' + group_id;
    } 
}
</script>
<?php 
?>
