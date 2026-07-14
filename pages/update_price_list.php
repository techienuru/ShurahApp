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
                    $lastList_sql = "SELECT a.prod_id, a.prod_name, a.cost_price, b.category_name, a.ctn_num, a.selling_price FROM product a LEFT JOIN category b ON a.category_id = b.category_id WHERE prod_id='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $prod_code = $lastList_rs['prod_id'];
                    $prod_name = $lastList_rs['prod_name'];
                    $category_name = $lastList_rs['category_name'];
                    $cost_price = $lastList_rs['cost_price'];
                    $price_piece = $lastList_rs['selling_price'];
                
                if(isset($_POST['submit'])){
                $selling_price = $_POST['selling_price'];
                $cost_price = $_POST['cost_price'];
                if($lastList_rs['selling_price'] != $_POST['selling_price']|| $lastList_rs['cost_price'] != $_POST['cost_price']){
                    $new_selling_price = mysqli_real_escape_string($db_connect, $_POST['selling_price']);
                    $new_cost_price = mysqli_real_escape_string($db_connect, $_POST['cost_price']);
                $update_sql = "UPDATE product SET cost_price='{$new_cost_price}', selling_price='{$new_selling_price}' WHERE product.prod_name='{$prod_name}'";
                $update_query = mysqli_query($db_connect,$update_sql);

                if($update_query){
                    echo "<div class='alert alert-success'>Product successully updated.</div>";
                    $sucess = "Price successully updated.";
                    header("Location:dashboard.php?page=pages/view_price_list&success={$sucess}");
                }else{
                    die(mysqli_error($db_connect));
                    $error = "Unable to update Price";
                    header("Location:dashboard.php?page=pages/view_price_list&error={$error}");              
                    }   
                }else{
                    echo "<div class='alert alert-danger'>Nothing to update</div>";
                    $error = "Nothing to update";
                    header("Location:dashboard.php?page=pages/view_price_list&error={$error}"); 
                }  
            }
       
            ?>
                    <div class="text-right">
                        <a href="dashboard.php?page=pages/view_price_list.php" class="btn btn-info">Back</a>
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
