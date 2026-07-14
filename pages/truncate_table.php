<br>
<br>

<?php
    include_once('includes/sessions.php');
    include_once('includes/db_connect.php');

$keepTable = ["users", "company_details", "category", "bank", "pos", "expence_sub_head", "status"]; // Specify the name of the table you want to keep


// Check the db_connectection
if ($db_connect->error) {
    die("db_connect failed: " . $db_connect->error);
}

// Get the list of tables in the database
$tables = $db_connect->query("SHOW TABLES");

if ($tables) {
    while ($row = $tables->fetch_row()) {
        $table = $row[0];
        if (!in_array($table, $keepTable)) {
            // Truncate (empty) the table if it's not in the list of tables to keep
            $truncateQuery = "TRUNCATE TABLE $table";
            if ($db_connect->query($truncateQuery) === TRUE) {
                echo "Table $table has been truncated.<br>";
            } else {
                echo "Error truncating table $table: " . $db_connect->error . "<br>";
            }
        }
    }
    $tables->close();
}

// Close the database connection
$db_connect->close();

?>