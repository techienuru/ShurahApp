<?php
// Start output buffering
ob_start();

// Include connection files
include "includes/db_connect.php"; 
include_once('includes/sessions.php');
include_once('pdf185/fpdf.php');

// Variables
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
        global $cashier, $start_date, $end_date;

        // Logo
        $logo_width = 70;
        $page_width = $this->GetPageWidth();
        $logo_x = ($page_width - $logo_width) / 2;
        $this->Image('images/shurah_logo121.png', $logo_x, 10, $logo_width);

        $this->Ln(18);
        // Title
        $this->SetFont('Arial', 'B', 16);
        $title = 'Discount Report';
        $this->Cell(0, 10, $title, 0, 1, 'C');

        // Report Date Range
        $this->SetFont('Arial', 'I', 12);
        $date_range = "Report from Start Date: $start_date to $end_date";
        $this->Cell(0, 10, $date_range, 0, 1, 'C');

        // Cashier
        $cashier_text = 'Cashier: ' . strtoupper($cashier);
        $this->Cell(0, 10, $cashier_text, 0, 1, 'C');

        // Watermark
        $this->Image('images/shurah_super_stores_watermark.png', 90, 50, 120, 0, 'PNG');

        // Table Headers
        $this->Ln(-5);
        $this->SetFont('Arial', 'B', 10);
        $headers = ['Invoice', 'Cashier', 'Discount', 'Total Amount', 'Date'];
        $column_width = 28;

        // Center headers
        $table_x_position = ($this->GetPageWidth() - (count($headers) * $column_width)) / 2;
        $this->SetX($table_x_position);

        foreach ($headers as $header) {
            $this->Cell($column_width, 10, $header, 1, 0, 'C');
        }
        $this->Ln();
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Initialize PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

// Fetch sales data
$query = "
    SELECT a.invoice, a.cashier, a.discount, a.total_payment, a.date 
    FROM sales a 
    WHERE a.discount > 0 AND date BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($db_connect, $query) or die("Database error: " . mysqli_error($db_connect));

// Column width and font settings
$column_width = 28;
$pdf->SetFont('Arial', '', 10);

// Define total table width and center table
$total_table_width = 5 * $column_width; // 5 columns
$table_x_position = ($pdf->GetPageWidth() - $total_table_width) / 2;

// Output data rows
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->SetX($table_x_position); // Center the table
    $pdf->Cell($column_width, 10, $row['invoice'], 1, 0, 'C');
    $pdf->Cell($column_width, 10, $row['cashier'], 1, 0, 'C');
    $pdf->Cell($column_width, 10, '# ' . number_format($row['discount'], 2), 1, 0, 'R');
    $pdf->Cell($column_width, 10, '# ' . number_format($row['total_payment'], 2), 1, 0, 'R');
    $pdf->Cell($column_width, 10, $row['date'], 1, 1, 'C');
}

// Add summary in table format
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, "Summary of Discounts by Cashier", 0, 1, 'C');

$summary_name_width = 100;
$summary_amount_width = 40;
$total_summary_width = $summary_name_width + $summary_amount_width;
$summary_x_position = ($pdf->GetPageWidth() - $total_summary_width) / 2;

$pdf->SetX($summary_x_position);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($summary_name_width, 10, 'Name', 1, 0, 'C');
$pdf->Cell($summary_amount_width, 10, 'Amount', 1, 1, 'C');

$summary_query = "
    SELECT cashier, SUM(discount) AS total_discount 
    FROM sales 
    WHERE date BETWEEN '$start_date' AND '$end_date' 
    GROUP BY cashier";
$summary_result = mysqli_query($db_connect, $summary_query) or die("Database error: " . mysqli_error($db_connect));

$pdf->SetFont('Arial', '', 10);
while ($summary = mysqli_fetch_assoc($summary_result)) {
    $pdf->SetX($summary_x_position);
    $pdf->Cell($summary_name_width, 10, $summary['cashier'], 1, 0, 'L');
    $pdf->Cell($summary_amount_width, 10, '# ' . number_format($summary['total_discount'], 2), 1, 1, 'R');
}

// Output PDF
$pdf->Output();
exit;

// End output buffering and clean buffer
ob_end_clean();
?>
