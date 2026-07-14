<?php
$date = date('Y-m-d');
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
    a.expence_id,
    c.expence_name,
    a.description,
    a.amount,
    b.username
    FROM expence_table a 
    LEFT JOIN users b ON a.user_id = b.user_id
    LEFT JOIN expence_sub_head c ON c.expence_code = a.expence_code
	WHERE a.date = '{$date}'
) temp
EOT;
 
// Table's primary key
$primaryKey = 'expence_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'date', 'dt' => 0 ),
    array( 'db' => 'date', 'dt' => 1 ),
    array( 'db' => 'expence_id',  'dt' => 2 ),
    array( 'db' => 'expence_name',  'dt' => 3 ),
    array( 'db' => 'description',  'dt' => 4 ),
    array( 
            'db' => 'amount',  
            'dt' => 5,
            'formatter' => function($amount) {
                return '₦ ' . number_format($amount, 2);
            }
        ),
    array( 
            'db' => 'username',  
            'dt' => 6,
            'formatter' => function($username) {
                return strtoupper($username);
            }
        ),
    array( 
        'db' => 'username',
        'dt' => 7,
        'formatter' => function($d, $row){           
            $deletelink = '<a class="btn btn-xs btn-danger m-r-1em" style="font-size: 12px;" style="margin-top: 1px;" href="dashboard.php?page=pages/expense_rev_details&id='.$row['expence_id'].'">Reverse Transaction</a>';
            return  ''. $deletelink . '';
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