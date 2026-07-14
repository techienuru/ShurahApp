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
        $title = 'Stock Report';
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
        $this->Image('images/shurah_super_stores_watermark.png', 50, 50, 120, 0, 'PNG', '', 'F'); // Adjust position and size as needed
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

// Display heading for table with custom column widths
$display_heading = array(
    'ITEMS' => array('Product Name', 60),
    'UNIT PRICE' => array('Unit Price', 25),
    'COST PRICE' => array('Cost Price', 25),
    'OPENING STOCK' => array('Opening Stock', 28),
    'TOTAL' => array('Total', 15),
    'DIVIDER' => array('Divider', 15),
    'CARTONS LEFT' => array('Carton left', 25),
    'PIECES LEFT' => array('Pieces left', 25),
    'COST PRICE VALUE' => array('Cost Price value', 30),
    'VALUE' => array('Value', 15),
    'DATE' => array('Date', 20)
);

// Query to get sales data
$query = "
SELECT a.prod_name as ITEMS, a.selling_price AS 'UNIT PRICE', a.cost_price AS 'COST PRICE', a.qty_left AS 'OPENING STOCK', a.qty_left AS 'TOTAL', a.divider AS DIVIDER, a.qty_left DIV a.divider AS 'CARTONS LEFT', a.qty_left MOD divider AS 'PIECES LEFT',(a.cost_price * a.qty_left) AS 'COST PRICE VALUE', (a.selling_price * a.qty_left) AS 'VALUE', a.date AS DATE FROM product a LEFT JOIN category b ON a.category_id = b.category_id
    WHERE a.date BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($db_connect, $query) or die("database error:". mysqli_error($db_connect));

// Initialize PDF
$pdf = new PDF('L');
$pdf->AddPage();
// Define number of pages
$pdf->AliasNbPages(); 

// Add date range line
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10, "Report from Start Date: $start_date to $end_date", 0, 1, 'L');

// Set font for headers
$pdf->SetFont('Arial','B',9);

// Add headers with fixed column widths
foreach($display_heading as $heading) {
    $pdf->Cell($heading[1], 9, $heading[0], 1);
}
$pdf->Ln();

// Initialize variables for total calculations
$total_value = 0;
$total_cost_price_value = 0;

// Set font for data
$pdf->SetFont('Arial','',8);

// Add data rows with fixed column widths
while($row = mysqli_fetch_assoc($result)) {
    $total_value += $row['VALUE'];
    $total_cost_price_value += $row['COST PRICE VALUE'];

    foreach($display_heading as $key => $heading) {
        $pdf->Cell($heading[1], 8, $row[$key], 1);
    }
    $pdf->Ln();
}

// Draw a line before the summary table
$pdf->Ln(5); // Space before summary table
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0, 10, 'Summary', 0, 1, 'L'); // Summary title

// Summary table
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 8, 'Summary', 1, 0, 'C');
$pdf->Cell(60, 8, 'Total Cost Price Value', 1, 0, 'C');
$pdf->Cell(60, 8, 'Total Selling Value', 1, 1, 'C');

// Data for summary table
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 8, 'Totals', 1, 0, 'C');
$pdf->Cell(60, 8, number_format($total_cost_price_value, 2), 1, 0, 'C');
$pdf->Cell(60, 8, number_format($total_value, 2), 1, 1, 'C');

// Add date range line
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10, "Report from Start Date: $start_date to $end_date", 0, 1, 'L');

// Output PDF
$pdf->Output();
exit;

// End output buffering and clean buffer
ob_end_clean();
?>
