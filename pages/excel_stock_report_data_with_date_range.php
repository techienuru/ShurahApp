<?php
/* Database connection start */
include_once('../includes/db_connect.php');

//sql for address
$company_details_sql = "SELECT * FROM company_details";
$company_details_query = mysqli_query($db_connect, $company_details_sql);
$company_details_List_rs = mysqli_fetch_assoc($company_details_query);
$company_name = $company_details_List_rs['company_name'];
if(isset($_POST["generate"])) {	

$sql_query = "SELECT a.prod_name as NAME, b.category_name as 'CATEGORY NAME',a.selling_price AS 'SELLING PRICE', a.qty_left AS 'QUANTITY LEFT', a.divider AS DIVIDER, a.qty_left DIV a.divider AS 'CARTONS LEFT', a.qty_left MOD divider AS 'PIECES LEFT' FROM product a LEFT JOIN category b ON a.category_id = b.category_id  WHERE a.date BETWEEN'".date('Y-m-d', strtotime($_POST['date1']))."' AND '".date('Y-m-d', strtotime($_POST['date2']))."'ORDER BY b.category_name,a.prod_name";
$resultset = mysqli_query($db_connect, $sql_query) or die("database error:". mysqli_error($db_connect));
$data_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$data_records[] = $rows;
}
}
//export
if(isset($_POST["generate"])) {	
	$filename = $company_name."_stock_report_".date('Y-m-d') . ".xls";			
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
