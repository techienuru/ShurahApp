<?php
// Start output buffering
ob_start();
// Include connection file 
include "includes/db_connect.php"; 
include_once('includes/sessions.php');
include_once('pdf185/fpdf.php');

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
        $title = 'Top Selling Product Report';
        $title_width = $this->GetStringWidth($title);
        $title_x = ($this->GetPageWidth() - $title_width) / 2;
        $this->SetX($title_x);
        $this->Cell($title_width, 10, $title, 0, 1, 'C');
        
        // Set font for cashier's name
        $this->SetFont('Arial','I',12);
        
        // Center the cashier's name
        $cashier_text = 'Cashier: ' . strtoupper($cashier);
        $cashier_width = $this->GetStringWidth($cashier_text);
        $cashier_x = ($this->GetPageWidth() - $cashier_width) / 2;
        $this->SetX($cashier_x);
        $this->Cell($cashier_width, 10, $cashier_text, 0, 1, 'C');
        
        // Line break
        $this->Ln(5);

        // Add image watermark
        $this->Image('images/shurah_super_stores_watermark.png', 45, 50, 120, 0, 'PNG', '', 'F'); // Adjust position and size as needed
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

// Query to get sales data
$query = "
    SELECT a.name AS 'Product Name', SUM(a.qty) AS totalQuantitySold 
    FROM sales_order a 
    WHERE a.status = 'processed' AND a.date BETWEEN '$start_date' AND '$end_date' 
    GROUP BY a.prod_code 
    ORDER BY totalQuantitySold DESC";
$result = mysqli_query($db_connect, $query) or die("Database error: " . mysqli_error($db_connect));

// Initialize PDF
$pdf = new PDF();
$pdf->AddPage(); // Portrait orientation
$pdf->AliasNbPages(); 

// Add date range line
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10, "Report from Start Date: $start_date to $end_date", 0, 1, 'L');

// Column headers and their widths
$headers = array('Product Name', 'Total Quantity Sold');
$column_widths = array(120, 60); // Adjust these widths as needed

// Calculate the total width of the table
$total_table_width = array_sum($column_widths);

// Calculate X position to center the table
$center_x = ($pdf->GetPageWidth() - $total_table_width) / 2;
$pdf->SetX($center_x);

// Set font for headers
$pdf->SetFont('Arial','B',10);

// Add headers
foreach($headers as $i => $heading) {
    $pdf->Cell($column_widths[$i], 10, $heading, 1, 0, 'C');
}
$pdf->Ln();

// Set font for data
$pdf->SetFont('Arial','',10);

// Add data rows
while($row = mysqli_fetch_assoc($result)) {
    $pdf->SetX($center_x); // Ensure rows are aligned with the table header
    $pdf->Cell($column_widths[0], 10, $row['Product Name'], 1);
    $pdf->Cell($column_widths[1], 10, $row['totalQuantitySold'], 1, 1, 'C'); // Center text
}

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
    <title>Top Selling Product Report</title>
    <link rel="icon" href="images/shurah_super_stores.ico" type="image/png">
</head>
<body>
</body>
</html>
