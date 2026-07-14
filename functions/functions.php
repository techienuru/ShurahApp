<?php

function redirect_to($location = NULL){
            if($location != NULL) {
                header("Location:{$location}");
                exit;
            }

}
        function mysqli_prep($value)
        {
            global $db_connect;

            $new_enough_php = function_exists("mysqli_real_escape_string"); // Check if mysqli_real_escape_string function exists

            if ($new_enough_php) {
                // mysqli_real_escape_string can handle escaping without magic quotes
                $value = mysqli_real_escape_string($db_connect, $value);
            } else {
                // If mysqli_real_escape_string doesn't exist (older PHP version), manually add slashes
                $value = addslashes($value);
            }

            return $value;
        }
        function confirm_query($result_set)
        {
            if (!$result_set)
            {
                die("Database query failed: " . mysqli_connect_error());
            }
        }
// Auto logout function the html meta should be set like this (<meta http-equiv="refresh" content="662"/>)//
 function auto_logout(){
     $time = time();
     if(isset($_SESSION['logged_in']) && ($time - $_SESSION['logged_in'] > 1439 )){
         session_destroy();
         session_unset();
         header("Location: index.php");
     }else{
         $_SESSION['logged_in'] = time();
     }
     
 }
function checkPermissions($user_id, $permission_id){
    global $db_connect;
    try{
        $sql = "SELECT 
                COUNT(*) AS total_permissions
                FROM system_permission_to_roles
                LEFT JOIN system_users_to_roles
                ON system_permission_to_roles.role_id = system_users_to_roles.role_id
                WHERE system_users_to_roles.user_id =".$_SESSION['user_id']."
                AND permission_id =".$permission_id;
        
            $permissionlist = mysqli_query($db_connect,$sql);
            $permissionresult = mysqli_fetch_assoc($permissionlist);
                     
             $authorized = '';

             if ($permissionresult['total_permissions'] > 0) {
                 $authorized = "true";
             } else {
                 $authorized = "false";
             }

             return $authorized;
        
    } catch(Exception $e){
        echo $e->getMessage();
    }
}
function createthree(){
    $randomid = mt_rand(1111,9999);
    return $randomid;
}
function showValue($value){
    echo number_format($value,2);
}
function showDate($date){
    //echo date('jS F,Y',strtotime($date));
    echo date('Y-m-d',strtotime($date));
}
function greeting() {
    date_default_timezone_set('Africa/Lagos'); // set your timezone
    $hour = date('G');

    if ($hour < 12) {
        return "Good morning!";
    } elseif ($hour < 18) {
        return "Good afternoon!";
    } else {
        return "Good evening!";
    }
}

function confirmPermission($user_id){
    global $db_connect;
    
    try{
        $sql = "SELECT * FROM users WHERE user_id=".$_SESSION['user_id'];
        $user_query = mysqli_query($db_connect, $sql);
        $userList_rs = mysqli_fetch_assoc($user_query);
        $role = $userList_rs['role'];
        
        $permission = '';
        
        if($userList_rs['role'] == 'admin'){
            $permission = "true";
        } else {
            $permission = "false";
        }
        
        return $permission;
        
    } catch(Exceptio $e){
        echo $e->getMessage();
    }
}
function createsix(){
    $randomid = mt_rand(100000,999999);
    return $randomid;
}
function formatMoney($number, $fractional=false) {
  if ($fractional) {
    $number = sprintf('%.2f', $number);
  }
  while (true) {
    $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
    if ($replaced != $number) {
      $number = $replaced;
    } else {
      break;
    }
  }
  return $number;
}
function resizeImage($sourceFile, $targetFile, $maxWidth, $maxHeight)
{
    list($sourceWidth, $sourceHeight, $sourceType) = getimagesize($sourceFile);
    if (!$sourceWidth || !$sourceHeight) {
        return false;
    }

    switch ($sourceType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourceFile);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourceFile);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourceFile);
            break;
        default:
            return false;
    }

    $ratio = min($maxWidth / $sourceWidth, $maxHeight / $sourceHeight);
    $newWidth = $sourceWidth * $ratio;
    $newHeight = $sourceHeight * $ratio;

    $targetImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);

    switch ($sourceType) {
        case IMAGETYPE_JPEG:
            imagejpeg($targetImage, $targetFile, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($targetImage, $targetFile);
            break;
        case IMAGETYPE_GIF:
            imagegif($targetImage, $targetFile);
            break;
    }

    imagedestroy($sourceImage);
    imagedestroy($targetImage);

    return true;
}
function calculateTiles($area, $tileLength, $tileWidth, $tilesPerCarton){
    $tileArea = $tileLength * $tileWidth;
    $tileNeeded = $area / $tileArea;
    $cartonsNeeded = floor($tileNeeded/$tilesPerCarton);
    $tilesRemaining = $tileNeeded - ($cartonsNeeded * $tilesPerCarton);
    
    // Check if remaining tiles decimal portion is greater than or equal to 0.9 and round up if needed
    $decimalPortion = $tilesRemaining - floor($tilesRemaining);
    if ($decimalPortion >= 0.9) {
        $tilesRemaining = ceil($tilesRemaining);
    } else {
        $tilesRemaining = floor($tilesRemaining);
    }
    return [
        'cartons' => $cartonsNeeded,
        'tiles' => $tilesRemaining,
    ];
}
// Function to generate a unique receipt number
// Establish a database connection
$db_host = "localhost";
$db_user = "root";
$db_password = "1234567890";
$db_name = "shurah";

$db_connect = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the database connection
if ($db_connect->connect_error) {
    die("Connection failed: " . $db_connect->connect_error);
}

// Retrieve previously generated receipt numbers from the database
$sql = "SELECT invoice FROM invoice";
$result = $db_connect->query($sql);

$previousReceiptNumbers = array();

if ($result->num_rows > 0) {
    // Store previously generated receipt numbers in an array
    while ($row = $result->fetch_assoc()) {
        $previousReceiptNumbers[] = $row['invoice'];
    }
}

// Function to generate a unique receipt number
function generateUniqueReceiptNumber($min, $max, $previousNumbers = array()) {
    global $db_connect;
    $receiptNumber = rand($min, $max);
   
    // Check if the generated number already exists in the previous numbers array
    while (in_array($receiptNumber, $previousNumbers)) {
        $receiptNumber = rand($min, $max); // Generate a new number
    }
   
    return $receiptNumber;
}
// Establish a database connection
$db_host = "localhost";
$db_user = "root";
$db_password = "1234567890";
$db_name = "shurah";

$db_connect = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the database connection
if ($db_connect->connect_error) {
    die("Connection failed: " . $db_connect->connect_error);
}

$loggedInUserRole = $_SESSION['role'] ;  // Example: 'admin', 'manager', 'cashier';

function deleteItem($itemId, $itemType, $conn) {
    // Check if the user is an admin
    if ($_SESSION['role'] !== 'admin') {
        die("Unauthorized access. Only admins can delete items.");
    }

    // Map the item type to the corresponding table
    $table = '';
    switch ($itemType) {
        case 'users':
            $table = 'users';
            break;
        case 'product':
            $table = 'product';
            break;
        // Add other cases as needed
    }

    if ($table) {
        // Prepare the SQL DELETE statement
        $stmt = $conn->prepare("DELETE FROM $table WHERE prod_id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $itemId); // "i" denotes an integer parameter
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Item deleted successfully.";
            } else {
                echo "Item not found or could not be deleted.";
            }

            $stmt->close();
        } else {
            echo "Failed to prepare the DELETE statement.";
        }
    } else {
        echo "Invalid item type.";
    }
}


?>