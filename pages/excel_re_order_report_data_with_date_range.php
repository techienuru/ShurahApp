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

$sql_query = "SELECT a.prod_id AS PRODUCT_ID, a.prod_code AS PRODUCT_CODE, a.prod_name AS PRODUCT_NAME, b.category_name AS CATEGORY, a.qty_left AS QUANTITY_LEFT FROM product a LEFT JOIN category b ON a.category_id = b.category_id WHERE b.category_name IS NOT NULL AND a.qty_left < 20";
$resultset = mysqli_query($db_connect, $sql_query) or die("database error:". mysqli_error($db_connect));
$data_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$data_records[] = $rows;
}
}
//export
if(isset($_POST["generate"])) {	
	$filename = $company_name."_stock_re-order_report_".date('Y-m-d') . ".xls";			
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
