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
	a.update_product_id,
	a.description,
	a.date,
	b.username
	FROM update_product a
	LEFT JOIN users b ON a.user_id = b.user_id
) temp
EOT;
 
// Table's primary key
$primaryKey = 'update_product_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'update_product_id', 'dt' => 0 ),
    array( 'db' => 'date', 'dt' => 1 ),
    array( 'db' => 'update_product_id',  'dt' => 2 ),
    array( 'db' => 'description',  'dt' => 3 ),
    array( 'db' => 'username', 'dt' => 4 ),
    array( 
        'db' => 'username',
        'dt' => 5,
        'formatter' => function($d, $row){           
            $viewlink = '<a class="btn btn-xs btn-info m-r-1em" style="font-size: 12px;" href="dashboard.php?page=pages/view_update_product_list_details&id='.$row['update_product_id'].'">View List</a>';            
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