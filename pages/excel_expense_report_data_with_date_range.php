<?php
/* Database connection start */
/*$servername = "localhost";
$username = "root";
$password = "1234567890";
$dbname = "nice_tiles";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}*/
include_once('../includes/db_connect.php');

//sql for address
$company_details_sql = "SELECT * FROM company_details";
$company_details_query = mysqli_query($db_connect, $company_details_sql);
$company_details_List_rs = mysqli_fetch_assoc($company_details_query);
$company_name = $company_details_List_rs['company_name'];
if(isset($_POST["generate"])) {	

$sql_query = "SELECT a.date AS DATE, a.expence_id AS EXPENSE_ID, c.expence_name AS EXPENSE_NAME, a.description AS DESCRIPTION, a.amount AS AMOUNT, b.username AS USERNAME FROM expence_table a LEFT JOIN users b ON a.user_id = b.user_id LEFT JOIN expence_sub_head c ON c.expence_code = a.expence_code WHERE c.expence_name IS NOT NULL AND a.date BETWEEN '".date('Y-m-d', strtotime($_POST['date1']))."' AND '".date('Y-m-d', strtotime($_POST['date2']))."'";
$resultset = mysqli_query($db_connect, $sql_query) or die("database error:". mysqli_error($db_connect));
$data_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$data_records[] = $rows;
}
}
//export
if(isset($_POST["generate"])) {	
	$filename = $company_name."_expenses_report_".date('Y-m-d') . ".xls";			
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename\"");	
	$is_coloumn = false;
	if(!empty($data_records)) {
	  foreach($data_records as $value) {
		if(!$is_coloumn) {		 
		  echo implode("\t", array_keys($value)) . "\n";
		  $is_coloumn = true;
		}
		echo implode("\t", array_values($value)) . "\n";
	  }
	}
	exit;  
}
?>
