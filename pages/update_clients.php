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
                    $lastList_sql = "SELECT a.client_id, a.name, a.address, a.gender, a.phone, a.phone2, a.date FROM clients a  WHERE client_id ='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $client_id = $lastList_rs['client_id'];
                    $name = $lastList_rs['name'];
                    $address = $lastList_rs['address'];
                    $gender = $lastList_rs['gender'];
                    $phone = $lastList_rs['phone'];
                    $phone2 = $lastList_rs['phone2'];
                    $date = $lastList_rs['date'];
                
                    if(isset($_POST['submit'])){
                    $client_name = $_POST['client_name'];
                    $phone = $_POST['phone'];
                    $gender = $_POST['gender'];
                    $phone2 = $_POST['phone2'];
                    $address = $_POST['address'];


                
                if($lastList_rs['client_name'] != $_POST['client_name']|| $lastList_rs['phone'] != $_POST['phone']|| $lastList_rs['phone2'] != $_POST['phone2']|| $lastList_rs['gender'] != $_POST['gender']|| $lastList_rs['address'] != $_POST['address']){
                    $new_client_name = mysqli_real_escape_string($db_connect, strtoupper($_POST['client_name']));
                    $new_phone = mysqli_real_escape_string($db_connect, $_POST['phone']);
                    $new_phone2 = mysqli_real_escape_string($db_connect, $_POST['phone2']);
                    $new_gender = mysqli_real_escape_string($db_connect, strtoupper($_POST['gender']));
                    $new_address= mysqli_real_escape_string($db_connect, strtoupper($_POST['address']));
                $update_sql = "UPDATE clients  SET name='{$new_client_name}',address='{$new_address}',gender='{$new_gender}',phone='{$new_phone}',phone2='{$new_phone2}' WHERE client_id='{$id}'";
                $update_query = mysqli_query($db_connect,$update_sql);

                if($update_query){
                    echo "<div class='alert alert-success'>Product successully updated.</div>";
                    $sucess = "Client successully updated.";
                    header("Location:dashboard.php?page=pages/view_clients&success={$sucess}");
                }else{
                    die(mysqli_error($db_connect));
                    $error = "Unable to update Client";
                    header("Location:dashboard.php?page=pages/view_clients&error={$error}");              
                    }   
                }else{
                    echo "<div class='alert alert-danger'>Nothing to update</div>";
                    $error = "Nothing to update";
                    header("Location:dashboard.php?page=pages/view_clients&error={$error}"); 
                }  
            }
       
            ?>
                    <div class="text-right">
                        <a href="../pages/view_clients.php" class="btn btn-info">Back</a>
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
