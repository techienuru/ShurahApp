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
    a.prod_id,
    b.category_name,
    a.prod_code,
    a.prod_name,
    (a.qty_left / a.divider ) AS qty_left,
    a.divider,
    a.date
    FROM product a 
    LEFT JOIN category b ON a.category_id = b.category_id
) temp
EOT;
 
// Table's primary key
$primaryKey = 'prod_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'prod_id', 'dt' => 0 ),
    array( 'db' => 'prod_id', 'dt' => 1 ),
    array( 'db' => 'category_name',  'dt' => 2),
    array( 'db' => 'prod_code',  'dt' => 3 ),    
    array( 'db' => 'prod_name',  'dt' => 4 ),      
    array( 
        'db' => 'qty_left',  
        'dt' => 5,
        'formatter' => function($qty_left) {
            return number_format($qty_left);
        }
    ),         
    array( 
        'db' => 'date',
        'dt' => 6,
        'formatter' => function($d, $row){           
            $viewlink = '<a class="btn btn-xs btn-info m-r-1em" style="font-size: 12px;" href="dashboard.php?page=pages/view_products_details&id='.$row['prod_id'].'">View</a>';            
            return  '' .$viewlink. '';
        }),    
    array( 
        'db' => 'date',
        'dt' => 7,
        'formatter' => function($d, $row){
            $editlink = '<a class="btn btn-xs btn-warning m-r-1em" style="font-size: 12px;" href="dashboard.php?page=pages/edit_products_details&id='.$row['prod_id'].'">Edit</a>';            
            return  '' .$editlink. '';
        }),
    array( 
        'db' => 'date',
        'dt' => 8,
        'formatter' => function($d, $row){           
            $deletelink = '<a class="btn btn-xs btn-danger m-r-1em" style="font-size: 12px;" href="dashboard.php?page=pages/delete_products&id='.$row['prod_id'].'">Delete</a>';
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