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
                    $lastList_sql = "SELECT * FROM product LEFT JOIN category ON product.category_id = category.category_id WHERE prod_id ='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $prod_id = $lastList_rs['prod_id'];
                    $prod_name = $lastList_rs['prod_name'];
                    $prod_code = $lastList_rs['prod_code'];
                    $category_name = $lastList_rs['category_name'];
                    $divider = $lastList_rs['divider'];
                    $pcs = $lastList_rs['pcs'];
                    $qty_left = $lastList_rs['qty_left'];
                    $selling_price = $lastList_rs['selling_price'];
                    $expiration = $lastList_rs['expiration'];
                    $date = $lastList_rs['date'];
                
                    if(isset($_POST['submit'])){
                    $prod_name = $_POST['prod_name'];
                    $prod_code = $_POST['prod_code'];
                    $category_id = $_POST['category_id'];
                    $cart_qty = $_POST['cart_qty'];
                    $pcs_qty = $_POST['pcs_qty'];
                    $selling_price = $_POST['selling_price'];
                    //$qty = $_POST['qty'];
                    $newqty = $_POST['newqty'];
                    $expiration = $_POST['expiration'];

                if($lastList_rs['prod_code'] != $_POST['prod_code']||$lastList_rs['prod_name'] != $_POST['prod_name']||$lastList_rs['category_id'] != $_POST['category_id']|| $lastList_rs['divider'] != $_POST['cart_qty']|| $lastList_rs['qty_left'] != $_POST['newqty']|| $lastList_rs['expiration'] != $_POST['expiration']){
                    $new_prod_name = mysqli_real_escape_string($db_connect, $_POST['prod_name']);
                    $new_prod_code = mysqli_real_escape_string($db_connect, $_POST['prod_code']);
                    $new_category_id = mysqli_real_escape_string($db_connect, $_POST['category_id']);
                    $new_cart_qty = mysqli_real_escape_string($db_connect, $_POST['cart_qty']);
                    $new_expiration = mysqli_real_escape_string($db_connect, $_POST['expiration']);
                    $new_pcs = $qty_left + $newqty;
                    $new_qty_left = $new_pcs;
                $update_sql = "UPDATE product SET prod_code= '{$new_prod_code }',category_id='{$new_category_id}',prod_name='{$new_prod_name}',divider='{$new_cart_qty}',pcs='{$new_pcs}',qty_left='{$new_qty_left}', expiration='{$new_expiration}' WHERE product.prod_id='{$id}'";
                $update_query = mysqli_query($db_connect,$update_sql);
                if($update_query){
                    echo "<div class='alert alert-success'>Product successully updated.</div>";
                    $sucess = $new_prod_name." Product successully updated.";
                    header("Location:dashboard.php?page=pages/view_products&success={$sucess}");
                }else{
                    die(mysqli_error($db_connect));
                    $error = "Unable to update Product";
                    header("Location:dashboard.php?page=pages/view_products&error={$error}");              
                    }   
                }else{
                    echo "<div class='alert alert-danger'>Nothing to update</div>";
                    $error = "Nothing to update";
                    header("Location:dashboard.php?page=pages/view_products&error={$error}"); 
                }  
            }
       
            ?>
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
