<?php
require_once('G:/xampp/htdocs/Blog/vendor/tecnickcom/tcpdf/tcpdf.php');
require_once 'G:/xampp/htdocs/Blog/vendor/autoload.php';

require 'G:/xampp/htdocs/Blog/Blog/config.php';

$pdo = config::getConnexion(); // Get PDO instance from config class

$sql = 'SELECT * FROM blog';
$statement = $pdo->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('blog List');
$pdf->SetSubject('blog List');

// Add a page
$pdf->AddPage();

// Output table header
$pdf->SetFont('helvetica', 'B', 12);

$pdf->Cell(70, 7, 'titre', 1);
$pdf->Cell(70, 7, 'description', 1);
$pdf->Cell(50, 7, 'date', 1);
$pdf->Ln();

// Output table data
$pdf->SetFont('helvetica', '', 10);
foreach ($people as $person) {
    
    $pdf->Cell(70, 7, $person->titre, 1);
    $pdf->Cell(70, 7, $person->description, 1);
    $pdf->Cell(50, 7, $person->date, 1);
    $pdf->Ln();
}

// Close and output PDF document
$pdf->Output('blog.pdf', 'D');
?>








?>