<?php
// Start output buffering
ob_start();
// Include connection file 
include "includes/db_connect.php"; 
include_once('includes/sessions.php');
include_once('pdf185/fpdf.php');

$user_id = $_SESSION['user_id'];
$date = date('Y-m-d');
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$cashier = $_SESSION['admin']; // Retrieve the cashier's name from the session

class PDF extends FPDF
{
    // Page header 
    function Header()
    {
        global $cashier; // Access the global cashier's name
        
        $logo_width = 70; // Width of the logo
        $page_width = $this->GetPageWidth();
        
        // Calculate the X position to center the logo
        $logo_x = ($page_width - $logo_width) / 2;
        
        // Add logo
        $this->Image('images/shurah_logo121.png', $logo_x, 10, $logo_width);
        
        // Line break
        $this->Ln(18); // Increase space after logo
        
        // Set font for title
        $this->SetFont('Arial','B',16);
        
        // Center the title
        $title = 'Sales Report';
        $title_width = $this->GetStringWidth($title);
        $title_x = ($page_width - $title_width) / 2;
        $this->SetX($title_x);
        $this->Cell($title_width, 10, $title, 0, 1, 'C');
        
        // Set font for cashier's name
        $this->SetFont('Arial','I',12);
        
        // Center the cashier's name
        $cashier_text = 'Cashier: ' . strtoupper($cashier);
        $cashier_width = $this->GetStringWidth($cashier_text);
        $cashier_x = ($page_width - $cashier_width) / 2;
        $this->SetX($cashier_x);
        $this->Cell($cashier_width, 10, $cashier_text, 0, 1, 'C');
        
        // Line break
        $this->Ln(5);

        // Add image watermark
        $this->Image('images/shurah_super_stores_watermark.png', 90, 50, 120, 0, 'PNG', '', 'F'); // Adjust position and size as needed
    }

    // Page footer 
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$display_heading = array('date'=>'Date','invoice'=> 'Invoice','cash'=> 'Cash','pos'=> 'POS','transfer'=> 'Transfer','bank'=> 'Bank','pos_medium'=> 'POS Medium','total_payment'=> 'Total','balance'=> 'Balance','client_name'=> 'Client Name');

// Query to get sales data and calculate sums
$query = "
    SELECT date, invoice, cash, pos, transfer, bank, pos_medium, total_payment, balance, client_name
    FROM sales
    WHERE date BETWEEN '$start_date' AND '$end_date' ";
$result = mysqli_query($db_connect, $query) or die("database error:". mysqli_error($db_connect));

// Calculate sums
$sum_cash = 0;
$sum_pos = 0;
$sum_transfer = 0;
$total_transaction = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $sum_cash += $row['cash'];
    $sum_pos += $row['pos'];
    $sum_transfer += $row['transfer'];
    $total_transaction = $sum_cash + $sum_pos +$sum_transfer;
}

$pdf = new PDF('L');
// Add a page
$pdf->AddPage();
// Define number of pages
$pdf->AliasNbPages(); 

// Add date range line
$pdf->SetFont('Arial','i',12);
$pdf->Cell(0,10, "Report from Start Date: $start_date to $end_date", 0, 1, 'L');
// Column widths
$column_width = 28;

// Set font for headers
$pdf->SetFont('Arial','B',10);

// Add headers
foreach($display_heading as $heading) {
    $pdf->Cell($column_width,10,$heading,1);
}
$pdf->Ln();

// Set font for data
$pdf->SetFont('Arial','',10);

// Add data rows
mysqli_data_seek($result, 0); // Reset result pointer to the beginning
while($row = mysqli_fetch_assoc($result)) {
    foreach($row as $column) {
        $pdf->Cell($column_width,10,$column,1);
    }
    $pdf->Ln();
}

// Add a summary section
$pdf->Ln(10); // Space before summary
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Daily Sales Summary: ',0,1,'L');
$pdf->SetFont('Arial','B',12);

// Display sums with Naira symbol
$naira_symbol = '# '; // Naira symbol
$pdf->Cell(100,10,'Total Cash:',0);
$pdf->Cell(0,10,$naira_symbol . number_format($sum_cash, 2),0,1,'R');
$pdf->Cell(100,10,'Total POS:',0);
$pdf->Cell(0,10,$naira_symbol . number_format($sum_pos, 2),0,1,'R');
$pdf->Cell(100,10,'Total Transfer:',0);
$pdf->Cell(0,10,$naira_symbol . number_format($sum_transfer, 2),0,1,'R');
$pdf->Cell(100,10,'Total Transaction:',0);
$pdf->Cell(0,10,$naira_symbol . number_format($total_transaction, 2),0,1,'R');

// Output PDF
$pdf->Output();
exit;

// End output buffering and clean buffer
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="icon" href="images/shurah_super_stores.ico" type="image/png">
    <!-- Include any other meta tags or CSS files here -->
</head>
<body>
</body>
</html>
