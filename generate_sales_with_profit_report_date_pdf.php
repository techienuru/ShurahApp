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
        $title = 'Sales and Profit Report';
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
    SELECT s.date, p.prod_id, p.prod_name, p.cost_price, p.selling_price, 
           (p.selling_price - p.cost_price) AS Profit, SUM(s.qty) AS TotalQtySold, 
           SUM(s.amount) AS TotalSales, 
           SUM(s.qty * (p.selling_price - p.cost_price)) AS TotalProfit 
    FROM sales_order s 
    INNER JOIN product p ON s.prod_code = p.prod_code 
    WHERE s.date BETWEEN '$start_date' AND '$end_date' 
    GROUP BY p.prod_id";
$result = mysqli_query($db_connect, $query) or die("Database error: " . mysqli_error($db_connect));

// Initialize PDF
$pdf = new PDF('L');
$pdf->AddPage(); // Portrait orientation
$pdf->AliasNbPages(); 

// Add date range line
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10, "Report from Start Date: $start_date to $end_date", 0, 1, 'L');

// Column headers and their widths
$headers = array('Date', 'Product ID', 'Product Name', 'Cost Price', 'Selling Price', 'Profit per Product', 'Total Qty. Sold', 'Total Sales', 'Total Profit');
$column_widths = array(25, 20, 60, 20, 25, 35, 30, 30, 30); // Adjust these widths as needed

// Set font for headers
$pdf->SetFont('Arial','B',10);

// Add headers
foreach($headers as $i => $heading) {
    $pdf->Cell($column_widths[$i], 10, $heading, 1, 0, 'C');
}
$pdf->Ln();

// Set font for data
$pdf->SetFont('Arial','',10);

// Initialize totals
$total_sales = 0;
$total_profit = 0;

// Add data rows
while($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell($column_widths[0], 10, $row['date'], 1);
    $pdf->Cell($column_widths[1], 10, $row['prod_id'], 1);
    $pdf->Cell($column_widths[2], 10, $row['prod_name'], 1);
    $pdf->Cell($column_widths[3], 10, "# ".number_format($row['cost_price'], 2), 1, 0, 'R');
    $pdf->Cell($column_widths[4], 10, "# ".number_format($row['selling_price'], 2), 1, 0, 'R');
    $pdf->Cell($column_widths[5], 10, "# ".number_format($row['Profit'], 2), 1, 0, 'R');
    $pdf->Cell($column_widths[6], 10, $row['TotalQtySold'], 1, 0, 'C');
    $pdf->Cell($column_widths[7], 10, "# ".number_format($row['TotalSales'], 2), 1, 0, 'R');
    $pdf->Cell($column_widths[8], 10, "# ".number_format($row['TotalProfit'], 2), 1, 1, 'R'); // New line at the end of the row

    // Accumulate totals
    $total_sales += $row['TotalSales'];
    $total_profit += $row['TotalProfit'];
}

// Add summary row
$pdf->Ln(10); // Line break before the summary
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(array_sum($column_widths) - $column_widths[7] - $column_widths[8], 10, 'Total', 0, 0, 'R');
$pdf->Cell($column_widths[7], 10, number_format($total_sales, 2), 1, 0, 'R');
$pdf->Cell($column_widths[8], 10, number_format($total_profit, 2), 1, 1, 'R');

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
    <title>Out Of Stock Report</title>
    <link rel="icon" href="images/shurah_super_stores.ico" type="image/png">
</head>
<body>
</body>
</html>
