<?php
include_once('../includes/sessions.php');
$date = date('Y-m-d'); 
$user_iid = $_SESSION['user_id'];
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = <<<EOT
(
SELECT
    a.date,
    a.invoice,
    a.cash,
    a.pos,
    a.transfer,
    a.bank,
    a.pos_medium,
    a.total_payment,
    a.balance,
    a.client_name
    FROM sales a 
    WHERE a.date = "{$date}" AND a.user_id ="{$user_iid}"
) temp
EOT;
 
// Table's primary key
$primaryKey = 'invoice';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'invoice', 'dt' => 0 ),
    array( 'db' => 'date', 'dt' => 1 ),
    array( 'db' => 'invoice',  'dt' => 2 ),
    array( 
        'db' => 'cash',  
        'dt' => 3,
        'formatter' => function($cash) {
            return '₦ ' . number_format($cash, 2);
        }
    ),
    array( 
        'db' => 'pos',  
        'dt' => 4,
        'formatter' => function($pos) {
            return '₦ ' . number_format($pos, 2);
        }
    ),        
    array( 
        'db' => 'transfer',  
        'dt' => 5,
        'formatter' => function($transfer) {
            return '₦ ' . number_format($transfer, 2);
        }
    ),
    array( 'db' => 'bank','dt' => 6, 'formatter'=> function($d, $row){
        if($d == ""){
            return "NILL";
        }else{
            return $d; 
        }
    }),
    //array( 'db' => 'pos_medium',  'dt' => 8 ),
    array( 'db' => 'pos_medium','dt' => 7, 'formatter'=> function($d, $row){
        if($d == ""){
            return "NILL";
        }else{
            return $d; 
        }
    }),
    array( 
        'db' => 'balance',  
        'dt' => 8,
        'formatter' => function($balance) {
            return '₦ ' . number_format($balance, 2);
        }
    ),
    array( 
        'db' => 'total_payment',  
        'dt' => 9,
        'formatter' => function($total_payment) {
            return '₦ ' . number_format($total_payment, 2);
        }
    ),
    array( 'db' => 'client_name',  'dt' => 10 ), 
    array( 
        'db' => 'total_payment',
        'dt' => 11,
        'formatter' => function($d, $row){           
            $reprintlink = '<a class="btn btn-xs btn-primary m-r-1em" style="font-size: 12px;" style="margin-top: 1px;" href="dashboard.php?page=pages/preview_sales_invoice&invoice='.$row['invoice'].'&cash_tendered='.$row['cash'].'&bal='.$row['balance'].'">View</a>';
            return  ''. $reprintlink . '';
        }
    ),
);
 
// SQL server connection information
/*$sql_details = array(
    'user' => 'root',
    'pass' => '1234567890',
    'db'   => 'nice_tiles',
    'host' => 'localhost'
);*/
 
 include_once('../includes/db_connect_view.php'); 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
/*require( 'ssp.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);*/
require( 'ssp.php' );
$result = SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
$start = $_REQUEST['start'];
$start++;
foreach($result['data'] as & $res){
    $res[0]=(string)$start;
    $start++;
}
echo json_encode($result);