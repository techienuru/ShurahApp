<?php
    include_once('dashboard.php?page=includes/sessions.php');
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

                $lastList_sql = "SELECT * FROM category WHERE category_id='{$id}'";
                $lastList_query = mysqli_query($db_connect, $lastList_sql);
                $lastList_rs = mysqli_fetch_assoc($lastList_query);
                $category_id = $lastList_rs['category_id'];
                $category_name = $lastList_rs['category_name'];
                $status_name = $lastList_rs['status'];
                
                if(isset($_POST['submit'])){
                $category_id = $_POST['category_id'];
                $category_name = $_POST['category_name'];
                $status_name = $_POST['status'];
                if($lastList_rs['category_name'] != $_POST['category_name']|| $lastList_rs['status'] != $_POST['status_name']){
                    $new_category_name = mysqli_real_escape_string($db_connect, $_POST['category_name']);
                    $new_status_name = mysqli_real_escape_string($db_connect, $_POST['status']);
                $update_sql = "UPDATE category SET category_name='{$new_category_name}', status='{$new_status_name}' WHERE category.category_id='{$id}'";
                $update_query = mysqli_query($db_connect,$update_sql);

                if($update_query){
                    echo "<div class='alert alert-success'>Product successully updated.</div>";
                    $sucess = "Client successully updated.";
                    header("Location:dashboard.php?page=pages/view_category&success={$sucess}");
                }else{
                    die(mysqli_error($db_connect));
                    $error = "Unable to update Client";
                    header("Location:dashboard.php?page=pages/view_category&error={$error}");              
                    }   
                }else{
                    echo "<div class='alert alert-danger'>Nothing to update</div>";
                    $error = "Nothing to update";
                    header("Location:dashboard.php?page=pages/view_category&error={$error}"); 
                }  
            }
       
            ?>
                    <div class="text-right">
                        <a href="dashboard.php?page=pages/view_category" class="btn btn-info">Back</a>
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
