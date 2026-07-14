<?php
// Start output buffering
ob_start();

// Include connection file 
include "includes/db_connect.php"; 
include_once('includes/sessions.php');
include_once('pdf185/fpdf.php');

// Retrieve form data and session variables
$user_id = $_SESSION['user_id'];
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
        $title = 'Trial Balance Report';
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

// Query to get sales data and calculate sums
$sales_query = "
    SELECT SUM(cash) as cash, SUM(pos) AS pos, SUM(transfer) as transfer 
    FROM sales 
    WHERE date BETWEEN '$start_date' AND '$end_date' AND user_id = '$user_id'";
$sales_result = mysqli_query($db_connect, $sales_query) or die("database error:". mysqli_error($db_connect));

// Calculate sums
$sum_cash = 0;
$sum_pos = 0;
$sum_transfer = 0;

if ($row = mysqli_fetch_assoc($sales_result)) {
    $sum_cash = $row['cash'];
    $sum_pos = $row['pos'];
    $sum_transfer = $row['transfer'];
    $total_transaction = $sum_cash + $sum_pos + $sum_transfer;
}

// Query to get daily expenses
$expenses_query = "
    SELECT SUM(amount) as total_daily_expense 
    FROM expence_table 
    WHERE date BETWEEN '$start_date' AND '$end_date'";
$expenses_result = mysqli_query($db_connect, $expenses_query) or die("database error:". mysqli_error($db_connect));

// Calculate total expenses
$sum_total_daily_expense = 0;

if ($row = mysqli_fetch_assoc($expenses_result)) {
    $sum_total_daily_expense = $row['total_daily_expense'];
}

// Calculate balance
$balance = $sum_cash - $sum_total_daily_expense;

$pdf = new PDF('L'); // Landscape orientation
$pdf->AddPage();
// Define number of pages
$pdf->AliasNbPages(); 

// Add date range line
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10, "Report from Start Date: $start_date to $end_date", 0, 1, 'L');

// Add a summary section in tabular format
$pdf->Ln(10); // Space before summary
$pdf->SetFont('Arial','B',12);

// Header for the summary table
$pdf->Cell(100,10,'Description',1);
$pdf->Cell(0,10,'Amount',1,1,'R');

// Set font for data
$pdf->SetFont('Arial','',12);

// Display sums with Naira symbol
$naira_symbol = '# '; // Naira symbol

$pdf->Cell(100,10,'Total Cash',1);
$pdf->Cell(0,10,$naira_symbol . number_format($sum_cash, 2),1,1,'R');
$pdf->Cell(100,10,'Total POS',1);
$pdf->Cell(0,10,$naira_symbol . number_format($sum_pos, 2),1,1,'R');
$pdf->Cell(100,10,'Total Transfer',1);
$pdf->Cell(0,10,$naira_symbol . number_format($sum_transfer, 2),1,1,'R');
$pdf->Cell(100,10,'Total Transaction',1);
$pdf->Cell(0,10,$naira_symbol . number_format($total_transaction, 2),1,1,'R');
$pdf->Cell(100,10,'Available Cash',1);
$pdf->Cell(0,10,$naira_symbol . number_format($balance, 2),1,1,'R');
$pdf->Cell(100,10,'Expenses',1);
$pdf->Cell(0,10,$naira_symbol . number_format($sum_total_daily_expense, 2),1,1,'R');

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
    <title>Report</title>
    <link rel="icon" href="images/shurah_super_stores.ico" type="image/png">
    <!-- Include any other meta tags or CSS files here -->
</head>
<body>
</body>
</html>
