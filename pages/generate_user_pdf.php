<?php
// Start output buffering
ob_start();
// Include connection file 
include "includes/db_connect.php"; 
include_once('pdf185/fpdf.php');
include_once('includes/db_connect.php');
include_once('pdf185/fpdf.php');

class PDF extends FPDF
{
    // Page header 
    function Header()
    {
        // Logo
        $this->Image('images/shurah_logo121.png',10,10,150);
        $this->SetFont('Arial','B',16);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(80,10,'Users List',1,0,'C');
        // Line break
        $this->Ln(20);
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

$display_heading = array('user_id'=>'ID', 'fullname'=> 'Name', 'phone'=> 'Phone No.','status'=> 'Status');
$result = mysqli_query($db_connect, "SELECT user_id, fullname, phone, status FROM users") or die("database error:". mysqli_error($db_connect));
$header = mysqli_query($db_connect, "SHOW columns FROM users WHERE field != 'ref_id' AND field != 'username' AND field != 'hashed_password' AND field != 'isActive' AND field != 'role' AND field != 'date' AND field != 'authorization'");

$pdf = new PDF();
// Header
$pdf->AddPage();
// Footer page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',16); 

foreach($header as $heading) {
    $pdf->Cell(48,10,$display_heading[$heading['Field']],1);
}

foreach($result as $row) {
    $pdf->SetFont('Arial','',10); 
    $pdf->Ln(); 
    foreach($row as $column) {
        $pdf->Cell(48,10,$column,1);
    }
}

$pdf->Output();
exit;// Ensure script stops after generating the PDF

// End output buffering and clean buffer
ob_end_clean();
?>


