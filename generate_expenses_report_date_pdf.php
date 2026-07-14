<?php
// Start output buffering
ob_start();

// Include connection file 
include "includes/db_connect.php"; 
include_once('includes/sessions.php');
include_once('pdf185/fpdf.php');

// Retrieve form data and session variables
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
        $title = 'Expenses Report';
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

// Display heading for table
$display_heading = array(
    'date'=>'Date', 
    'expence_id'=>'Expenses ID', 
    'expence_name'=>'Expenses Name', 
    'description'=>'Description', 
    'amount'=>'Amount', 
    'username'=>'Initiator Name'
);

// Define individual column widths
$column_widths = array(
    'date' => 25,
    'expence_id' => 35,
    'expence_name' => 50,
    'description' => 100,
    'amount' => 25,
    'username' => 46
);

// Query to get sales data
$query = "
    SELECT a.date, a.expence_id, c.expence_name, a.description, a.amount, b.username 
    FROM expence_table a 
    LEFT JOIN users b ON a.user_id = b.user_id 
    LEFT JOIN expence_sub_head c ON c.expence_code = a.expence_code 
    WHERE c.expence_name IS NOT NULL 
    AND a.date BETWEEN '$start_date' AND '$end_date' ORDER BY a.date ASC";
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
$pdf->SetFont('Arial','B',8);

// Add headers with individual column widths
foreach($display_heading as $column => $heading) {
    $pdf->Cell($column_widths[$column], 10, $heading, 1);
}
$pdf->Ln();

// Set font for data
$pdf->SetFont('Arial','',8);

// Add data rows with individual column widths
while($row = mysqli_fetch_assoc($result)) {
    foreach($display_heading as $column => $heading) {
        $pdf->Cell($column_widths[$column], 8, $row[$column], 1);
    }
    $pdf->Ln();
}

// Output PDF
$pdf->Output();
exit;

// End output buffering and clean buffer
ob_end_clean();
?>
