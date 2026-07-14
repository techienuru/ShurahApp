<br>
<br>
<?php
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');
?>
<?php
        $category_id = trim(mysqli_real_escape_string($db_connect,$_POST['category_id'])); 
        $category_name = trim(mysqli_real_escape_string($db_connect, strtoupper($_POST['category_name']))); 
        $status = trim(mysqli_real_escape_string($db_connect,$_POST['status'])); 
          
        $prod_query = "SELECT * FROM category WHERE category_id='{$category_id}'";
        $prod_set = mysqli_query($db_connect, $prod_query);
        confirm_query($prod_set);
        if(mysqli_num_rows($prod_set) != 0) {
            $error = "Error! Client already exists";
            header("Location:dashboard.php?page=pages/add_category&error={$error}");                
        }else{
            
            // Using prepared statement for both cases
            $query = "INSERT INTO category (category_id, category_name, status) VALUES (?, ?, ?)";
            $stmt = $db_connect->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sss", $category_id, $category_name, $status);
                $stmt->execute();
                $stmt->close();
                mysqli_close($db_connect);
                
                $sucess = $category_name." Category successully created.";
                header("Location:dashboard.php?page=pages/add_category&success={$sucess}"); 
            }else{
                mysqli_close($db_connect);
                $error = "Unable to create ".$category_name." Category";
                header("Location:dashboard.php?page=pages/add_category&error={$error}");   
            }
        }
?>