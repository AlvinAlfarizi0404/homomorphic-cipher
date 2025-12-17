<?php
require_once __DIR__ . "/fpdf/fpdf.php";

function generatePDF($nama, $nik, $diagnosis, $tanggal, $outputPath)
{
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);

    $pdf->Cell(0,10,'REKAM MEDIS PASIEN',0,1,'C');
    $pdf->Ln(5);

    $pdf->Cell(0,10,"Nama      : $nama",0,1);
    $pdf->Cell(0,10,"NIK       : $nik",0,1);
    $pdf->Cell(0,10,"Tanggal   : $tanggal",0,1);
    $pdf->Ln(5);

    $pdf->MultiCell(0,10,"Diagnosis:\n$diagnosis");

    $pdf->Output("F", $outputPath);
}
