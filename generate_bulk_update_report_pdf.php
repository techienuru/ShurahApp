<?php
// Start output buffering
ob_start();

// Include connection file 
include "includes/db_connect.php"; 
include_once('includes/sessions.php');
include_once('pdf185/fpdf.php');

// Retrieve session variables
$update_id = $_GET['update_id']; // Assuming 'update_id' is passed via POST

class PDF extends FPDF
{
    // Page header 
    function Header()
    {
        $logo_width = 70; // Width of the logo
        $page_width = $this->GetPageWidth();
        
        // Calculate the X position to center the logo
        $logo_x = ($page_width - $logo_width) / 2;
        
        // Add logo
        $this->Image('images/shurah_logo121.png', $logo_x, 10, $logo_width);
        
        // Line break
        $this->Ln(20); // Increase space after logo
        
        // Set font for title
        $this->SetFont('Arial','B',16);
        
        // Center the title
        $title = 'Bulk Update Report';
        $title_width = $this->GetStringWidth($title);
        $title_x = ($page_width - $title_width) / 2;
        $this->SetX($title_x);
        $this->Cell($title_width, 10, $title, 0, 1, 'C');
        
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

// Query to fetch product update data
$update_product_query = "
SELECT a.update_product_id, a.prod_code, a.name, a.qty_in, 
       b.divider, c.category_name, a.date, b.cost_price, 
       (a.qty_in * b.cost_price) AS cp_Value, 
       (a.qty_in * b.selling_price) AS sp_Value 
FROM update_product_order a 
LEFT JOIN product b ON a.prod_code = b.prod_code 
LEFT JOIN category c ON c.category_id = a.category 
WHERE update_product_id = '{$update_id}'";
$update_product_result = mysqli_query($db_connect, $update_product_query) or die("database error: ". mysqli_error($db_connect));

$pdf = new PDF('L'); // Landscape orientation
$pdf->AddPage();
// Define number of pages
$pdf->AliasNbPages(); 

// Add title for product details
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10, "Product Update Report for ID: $update_id", 0, 1, '');

// Add a summary section in tabular format
$pdf->Ln(2); // Space before summary
$pdf->SetFont('Arial','B',12);

// Header for the product update table, centered
$pdf->Cell(30,10,'Date',1,0,'');
$pdf->Cell(30,10,'Product Code',1,0,'');
$pdf->Cell(100,10,'Product Name',1,0,'');
$pdf->Cell(30,10,'Quantity',1,0,'C');
$pdf->Cell(45,10,'Cost Value',1,0,'R');
$pdf->Cell(45,10,'Selling Value',1,1,'R');

// Set font for data
$pdf->SetFont('Arial','',12);

// Initialize total value accumulator
$total_cp_value = 0;
$total_sp_value = 0;

$naira_symbol = '# '; // Naira symbol

// Display product update data
while($row = mysqli_fetch_assoc($update_product_result)) {
    $pdf->Cell(30,10,$row['date'],1,0,'');
    $pdf->Cell(30,10,$row['prod_code'],1,0,'');
    $pdf->Cell(100,10,$row['name'],1,0,'');
    $pdf->Cell(30,10,$row['qty_in'],1,0,'C');
    $pdf->Cell(45,10,$naira_symbol . number_format($row['cp_Value'], 2),1,0,'R');
    $pdf->Cell(45,10,$naira_symbol . number_format($row['sp_Value'], 2),1,1,'R');
    
    // Accumulate total value
    $total_cp_value += $row['cp_Value'];
    $total_sp_value += $row['sp_Value'];
}

// Add some space before the summary of totals
$pdf->Ln(5); 

// Add the totals section, centered
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Summary of Total Value', 0, 1, 'C');

// Totals table, centered
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,'Total Cost Value',1,0,'');
$pdf->Cell(90,10,$naira_symbol . number_format($total_cp_value, 2),1,1,'R');
$pdf->Cell(190,10,'Total Selling Value',1,0,'');
$pdf->Cell(90,10,$naira_symbol . number_format($total_sp_value, 2),1,1,'R');

// Output PDF
$pdf->Output();
exit;

// End output buffering and clean buffer
ob_end_clean();
?>
