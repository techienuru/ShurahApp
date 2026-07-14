<?php
include_once('includes/sessions.php');
require 'vendor/autoload.php';
include_once('includes/db_connect.php');

$user_iid = $_SESSION['user_id'];
$rnd = createsix();
$valid_ext = array("xls", "xlsx");
$upload_dir = "uploads/";
$date = Date("Y-m-d");
$str = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        if (empty($_FILES['upload_file']['name'])) {
            $error = "Please select a file";
            header("Location:dashboard.php?page=pages/excel_upload&error={$error}");
            exit();
        }

        $file_name = $_FILES['upload_file']['name'];
        $tmp_name = $_FILES['upload_file']['tmp_name'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($ext, $valid_ext)) {
            $new_file = time() . "-" . basename($file_name);

            try {
                move_uploaded_file($tmp_name, $upload_dir . $new_file);

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($upload_dir . $new_file);
                $worksheet = $spreadsheet->getActiveSheet();
                $data = $worksheet->toArray();
                unset($data[0]); // Remove header row

                $db_connect->begin_transaction();

                // Fetch existing product IDs
                $existingProducts = [];
                $result = $db_connect->query("SELECT prod_id, prod_name FROM product");
                while ($row = $result->fetch_assoc()) {
                    $existingProducts[$row['prod_id']] = $row['prod_name'];
                }

                // Prepare SQL statements
                $insertProductSQL = "INSERT INTO product (prod_id, prod_code, category_id, prod_name, depart_id, divider, pcs, qty_left, cost_price, selling_price, expiration, date, re_stock ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $insertLogSQL = "INSERT INTO product_movement_log (update_product_id, prod_id, prod_code, name, qty_in, qty_out, category, expiration, description, status, user_id, date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $updateProductSQL = "UPDATE product SET prod_code = ?, category_id = ?, prod_name = ?, pcs = ?, qty_left = ?, divider = ?, cost_price = ?, selling_price = ?, expiration = ?, date = ? WHERE prod_id = ?";
                $insertProductExpirySQL = "INSERT INTO product_expiry (prod_id, batch_id, prod_code, expiration_date, quantity, discount_percentage) VALUES (?,?,?,?,?,?)";
                $insertInvoiceSQL = "INSERT INTO invoice (invoice) VALUES (?)";

                $stmtInsertProduct = $db_connect->prepare($insertProductSQL);
                $stmtInsertLog = $db_connect->prepare($insertLogSQL);
                $stmtUpdateProduct = $db_connect->prepare($updateProductSQL);
                $insertProductExpirySQL = $db_connect->prepare($insertProductExpirySQL);    
                $insertInvoiceSQL = $db_connect->prepare($insertInvoiceSQL);    
                // Ensure cleanNumber function is defined only once
                if (!function_exists('cleanNumber')) {
                    function cleanNumber($str) {
                        // Remove commas first
                        $str = str_replace(',', '', $str);
                        // Split at the dot and return the whole number part
                        $parts = explode('.', $str);
                        return $parts[0]; // Return the part before the decimal
                    }
                }
                foreach ($data as $row) {
                    $prod_id = $row[0];
                    $prod_code = $row[1];
                    $category_id = $row[2];
                    $prod_name = $row[3];
                    $depart_id = $row[4];
                    $divider = $row[5];
                    $pcs = $row[6];
                    $cost_price = cleanNumber($row[7]); // Use cleanNumber directly here
                    $selling_price = cleanNumber($row[8]); // Use cleanNumber directly here
                    $expiration = $row[9];
                    $expiration = date('Y-m-d', strtotime($expiration));
                    $re_stock = $row[10];
                    $discount = calculate_discount($expiration);
                    // $date = $row[10];
                    
                    if (array_key_exists($prod_id, $existingProducts) || in_array($prod_name, array_values($existingProducts)))  {
                        // Update existing product
                        $query2 = "SELECT pcs, qty_left FROM product WHERE prod_id = ?";
                        $stmtQty = $db_connect->prepare($query2);
                        $stmtQty->bind_param("s", $prod_id);
                        $stmtQty->execute();
                        $queryResult2 = $stmtQty->get_result()->fetch_assoc();
                        $pcs_left = $queryResult2['pcs'] + $pcs;
                        $qty_left = $queryResult2['qty_left'] + $pcs;

                        $stmtUpdateProduct->bind_param(
                            "sisiiiiisss",
                            $prod_code, $category_id, $prod_name, $pcs_left, $qty_left, $divider,
                            $cost_price, $selling_price, $expiration, $date, $prod_id
                        );
                        $stmtUpdateProduct->execute();
                    } else {
                        // Insert new product
                        $prod_id = createsix();
                        $prod_code = $prod_id;
                        $qty_left = $pcs;
                        $stmtInsertProduct->bind_param(
                            "iiisiiiiddssi",
                            $prod_id, $prod_code, $category_id, $prod_name,	$depart_id,	$divider, $pcs,  $qty_left, $cost_price, $selling_price, $expiration, $date, $re_stock
                        );
                        $stmtInsertProduct->execute();
                    }

                    // Insert into product movement log
                    $description = "stock in";
                    $status = "pending";
                    $qty_out = 0;

                    $stmtInsertLog->bind_param(
                        "iissiiisssis",
                        $rnd, $prod_id, $prod_code, $prod_name, $pcs, $qty_out, $category_id,
                        $expiration, $description, $status, $user_iid, $date
                    );
                    $stmtInsertLog->execute();

                    // Insert into product expiry table
                    $batch_number = createsix();
                    $insertProductExpirySQL->bind_param("iissid", $prod_id, $batch_number, $prod_code, $expiration, $pcs, $discount);
                    $insertProductExpirySQL->execute();

                    // Insert into invoice table
                    $insertInvoiceSQL->bind_param("s", $prod_id);
                    $insertInvoiceSQL->execute();
                }

                // Process data into update_product_order
                $sourceQuery1 = "SELECT * FROM product_movement_log WHERE update_product_id = ? AND status = 'pending'";
                $stmtSource = $db_connect->prepare($sourceQuery1);
                $stmtSource->bind_param("s", $rnd);
                $stmtSource->execute();
                $sourceResult1 = $stmtSource->get_result();

                while ($row = $sourceResult1->fetch_assoc()) {
                    $destQuery1 = "INSERT INTO update_product_order (update_product_id, prod_code, name, qty_in, qty_out, category, description, status, user_id, expiration, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmtDest = $db_connect->prepare($destQuery1);
                    $status = "processed";
                    $description = "stock in";
                    $stmtDest->bind_param(
                        "sssssssssss",
                        $rnd, $row['prod_code'], $row['name'], $row['qty_in'], $qty_out,
                        $row['category'], $description, $status, $user_iid, $row['expiration'], $row['date']
                    );
                    $stmtDest->execute();
                }

                // Update movement log status
                $status = "processed";
                $sqlUpdateLog = "UPDATE product_movement_log SET status = ? WHERE update_product_id = ? AND status = 'pending'";
                $stmtUpdateLog = $db_connect->prepare($sqlUpdateLog);
                $stmtUpdateLog->bind_param("ss", $status, $rnd);
                $stmtUpdateLog->execute();

                // Insert into update_product
                $description1 = "Bulk Update";
                $query = "INSERT INTO update_product (update_product_id, description, date, user_id) VALUES (?, ?, ?, ?)";
                $stmtUpdateProductLog = $db_connect->prepare($query);
                $stmtUpdateProductLog->bind_param("ssss", $rnd, $description1, $date, $user_iid);
                $stmtUpdateProductLog->execute();

                $db_connect->commit();
                $success = "File uploaded successfully with Ref. No.".$rnd;
                header("Location:dashboard.php?page=pages/excel_upload&success={$success}");
                exit();
            } catch (Exception $ex) {
                $db_connect->rollback();
                $error = $ex->getMessage();
                header("Location:dashboard.php?page=pages/excel_upload&error={$error}");
                exit();
            }
        } else {
            $error = "Invalid file type. Only Excel files are allowed.";
            header("Location:dashboard.php?page=pages/excel_upload&error={$error}");
            exit();
        }
    }
}
?>
