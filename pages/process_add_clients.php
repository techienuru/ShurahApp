<?php
ob_start();
include_once('includes/db_connect.php');

$client_id = trim(mysqli_real_escape_string($db_connect, $_POST['client_id']));
$name = trim(mysqli_real_escape_string($db_connect, strtoupper($_POST['name'])));        
$address = trim(mysqli_real_escape_string($db_connect,  strtoupper($_POST['address'])));
$gender = trim(mysqli_real_escape_string($db_connect, $_POST['gender']));
$phone = trim(mysqli_real_escape_string($db_connect, $_POST['phone']));
$phone1 = trim(mysqli_real_escape_string($db_connect, $_POST['phone1']));
$date = trim(mysqli_real_escape_string($db_connect, $_POST['date']));


$prod_query = "SELECT * FROM clients WHERE client_id = '{$client_id}'";
$prod_set = mysqli_query($db_connect, $prod_query);
confirm_query($prod_set);

if(mysqli_num_rows($prod_set) != 0) {
    $error = "Error! Client already exists";
    header("Location:dashboard.php?page=pages/add_clients&error={$error}");
    exit();
} else {

    // Client Insertion
    $query = "INSERT INTO clients (client_id, name, address, gender, phone, phone2, date) VALUES ('{$client_id}','{$name}','{$address}','{$gender}','{$phone}','{$phone1}','{$date}')";
    $result = mysqli_query($db_connect, $query);
    mysqli_close($db_connect);
    if($result){
        $success = "Client successfully created.";
        header("Location:dashboard.php?page=pages/add_clients&success={$success}");
        exit();
    } else {
        $error = "Unable to create Client";
        header("Location:dashboard.php?page=pages/add_clients&error={$error}");
        exit();
    }
}
?>
