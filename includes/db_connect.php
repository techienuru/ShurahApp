<?php
require("constants.php");                      
// 1. Create a database connection and 2. Select Database to use
$db_connect = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
if(!$db_connect) {
    die("Database connection failed: " . mysqli_connect_error());
}   
?>