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
    a.prod_code,
    a.prod_name,
    b.category_name,
    a.pcs,
    a.qty_left,
    a.divider,
    a.qty_left DIV a.divider AS 'cartons_left', 
    a.qty_left MOD a.divider AS 'pieces_left',
    ((a.qty_left / a.pcs) * 100) AS 'percentage'
    FROM product a
    LEFT JOIN category b ON a.category_id = b.category_id
) temp
EOT;
 
// Table's primary key
$primaryKey = 'prod_code';
 
// Array of database columns which should be read and sent back to DataTables.
$columns = array(
    array( 'db' => 'prod_code', 'dt' => 0 ),
    array( 'db' => 'prod_code', 'dt' => 1 ),
    array( 'db' => 'prod_name', 'dt' => 2 ),
    array( 'db' => 'category_name', 'dt' => 3 ),
    array( 
        'db' => 'qty_left',  
        'dt' => 4,
        'formatter' => function($d) {
            return number_format($d) . ' pcs';
        }
    ),
    array( 
        'db' => 'cartons_left',  
        'dt' => 5,
        'formatter' => function($d) {
            return number_format($d) . ' pcs';
        }
    ),
    // array( 
    //     'db' => 'pieces_left',  
    //     'dt' => 6,
    //     'formatter' => function($d) {
    //         return number_format($d) . ' pieces';
    //     }
    // ),
    array( 
        'db' => 'percentage',  
        'dt' => 6,
        'formatter' => function($d) {
            return number_format($d, 2) . '%';
        }
    ),
	array( 
        'db' => 'percentage',
        'dt' => 7,
        'formatter' => function($d, $row){           
            $viewlink = '<a class="btn btn-xs btn-info m-r-1em" style="font-size: 12px;" href="dashboard.php?page=pages/view_stock_movement_details&prod_code='.$row['prod_code'].'">View</a>';            
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