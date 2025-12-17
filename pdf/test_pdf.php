<?php
require_once __DIR__ . "/fpdf/fpdf.php";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'FPDF BERHASIL',0,1);

$pdf->Output();
