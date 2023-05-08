<?php 

require('fpdf/fpdf.php'); // Include FPDF library

include '../Controller/reservationR.php';
$reservationR = new reservationR();
$list = $reservationR->listreservation();

// Create new PDF document
$pdf = new FPDF();
$pdf->AddPage();

$title = 'Liste des articles';

// set font for the title
$pdf->SetFont('helvetica', 'B', 16);

// print the title on the page
$pdf->Cell(0, 10, $title, 0, 1, 'C');

// Set font and font size
$pdf->SetFont('Arial','B',12);


    $pdf->Cell(50,10,"nom",1,0);
    $pdf->Cell(30,10,"prenom",1,0);
    $pdf->Cell(30,10,"nomfilm",1,0);
    $pdf->Cell(80,10,"datefilm",1,0);
    $pdf->Ln();
// Loop through the data and add it to the PDF document
foreach ($list as $row ) {    
    $pdf->Cell(50,10,$row['nom'],1,0);
    $pdf->Cell(30,10,$row['prenom'],1,0);
    $pdf->Cell(30,10,$row['nomfilm'],1,0);
    $pdf->Cell(80,10,$row['datefilm'],1,0);
    $pdf->Ln();
}

// Output PDF file
$pdf->Output('articles.pdf', 'D');
?>