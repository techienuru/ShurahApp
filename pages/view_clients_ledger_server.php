<?php
 
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
    a.client_id,
    b.name,
    b.phone,
    b.gender,
    SUM(a.debit) AS total_debit,
    SUM(a.credit) AS total_credit,
    (SUM(a.credit) - SUM(a.debit)) AS balance
    FROM client_ledger a
    LEFT JOIN clients b ON a.client_id = b.client_id
    GROUP BY a.client_id
) temp
EOT;
 
// Table's primary key
$primaryKey = 'client_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'client_id', 'dt' => 0 ),
    array( 'db' => 'client_id', 'dt' => 1 ),
    array( 'db' => 'name',  'dt' => 2 ),
    array( 'db' => 'gender',  'dt' => 3 ),                   
    array( 'db' => 'phone',  'dt' => 4 ), 
    array( 
        'db' => 'total_debit',  
        'dt' => 5,
        'formatter' => function($total_debit) {
            return '₦ ' . number_format($total_debit, 2);
        }
    ), 
    array( 
        'db' => 'total_credit',  
        'dt' => 6,
        'formatter' => function($total_credit) {
            return '₦ ' . number_format($total_credit, 2);
        }
    ),  
    array( 
        'db' => 'balance',  
        'dt' => 7,
        'formatter' => function($balance) {
            return '₦ ' . number_format($balance, 2);
        }
    ),                                                    
    array( 
        'db' => 'balance',
        'dt' => 8,
        'formatter' => function($d, $row){           
            $viewlink = '<a class="btn btn-xs btn-info m-r-1em" style="font-size: 12px;" href="dashboard.php?page=pages/transaction_history_savings_details&client_id='.$row['client_id'].'&name='.$row['name'].'&debit='.$row['total_debit'].'&credit='.$row['total_credit'].'&balance='.$row['balance'].'">View</a>';            
            return  '' .$viewlink. '';
        }), 
	array( 
        'db' => 'balance',
        'dt' => 9,
        'formatter' => function($d, $row){           
            $viewlink = '<a class="btn btn-xs btn-info m-r-1em" style="font-size: 12px;" href="dashboard.php?page=pages/add_credit_details&client_id='.$row['client_id'].'&name='.$row['name'].'&debit='.$row['total_debit'].'&credit='.$row['total_credit'].'&balance='.$row['balance'].'">Payment</a>';            
            return  '' .$viewlink. '';
        }), 
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