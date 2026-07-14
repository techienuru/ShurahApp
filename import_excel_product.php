<div class="container">
<?php

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

include("includes/db_connect.php");
require_once ('Spout/Autoloader/autoload.php');
$date = date ('Y-m-d H:i:s');
if(!empty($_FILES['excelfile']['name']))
{
    // Get File extension eg. 'xlsx' to check file is excel sheet
    $pathinfo = pathinfo($_FILES['excelfile']['name']);

    // check file has extension xlsx, xls and also check
    // file is not empty
    if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls')
        && $_FILES['excelfile']['size'] > 0 )
    {
        $file = $_FILES['excelfile']['tmp_name'];

        // Read excel file by using ReadFactory object.
        $reader = ReaderFactory::create(Type::XLSX);

        // Open file
        $reader->open($file);
        $count = 0;

        // Number of sheet in excel file
        foreach ($reader->getSheetIterator() as $sheet)
        {

            // Number of Rows in Excel sheet
            foreach ($sheet->getRowIterator() as $row)
            {

                // It reads data after header. In the my excel sheet,
                // header is in the first row.
                if ($count > 0) {

                    // Data of excel sheet
                    $prod_id = $row[0];
                    $prod_code = $row[1];
                    $category_id = $row[2];
                    $prod_name = $row[3];
                    $description = $row[4];
                    $ctn_num = $row[5];
                    $pcs = $row[6];
                    $qty_left = $row[7];
                    $supp_id = $row[8];
                    $cost_price = $row[9];
                    $comp_price = $row[10];
                    $date = $row[11];
                    
                    //Here, You can insert data into database.
                    // Assuming $date is a DateTime object
                    $date_string = $date->format('Y-m-d H:i:s');

                    //Here, You can insert data into database.
                    $qry = "INSERT INTO product (prod_id, prod_code, category_id, prod_name, description, ctn_num, pcs, qty_left, supp_id, cost_price, comp_price, date) VALUES ('{$prod_id}','{$prod_code}','{$category_id}','{$prod_name}','{$description}','{$ctn_num}','{$pcs}','{$qty_left}','{$supp_id}','{$cost_price}','{$comp_price}','{$date_string}')";
                    $res = mysqli_query($db_connect,$qry);

                    
                }
                $count++;
                
            }
        }
        if($res)
        {
            echo "Your file Uploaded Successfull";
        }
        else
        {
            echo "Your file Uploaded Failed";
            die(mysqli_error($db_connect));
        }

        // Close excel file
        $reader->close();
    }
    else
    {
        echo "Please Choose only Excel file";
    }
}
else
{
    echo "File is Empty"."<br>";
    echo "Please Choose Excel file";
}

?>
</div>
