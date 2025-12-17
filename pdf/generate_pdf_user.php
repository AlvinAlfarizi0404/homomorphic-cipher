<?php
require "fpdf.php";

function generateUserPDF($nama,$nik,$diagnosis,$tanggal){
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial","",12);

    $pdf->Cell(0,10,"REKAM MEDIS PASIEN",0,1);
    $pdf->Cell(0,10,"Nama: $nama",0,1);
    $pdf->Cell(0,10,"NIK: $nik",0,1);
    $pdf->MultiCell(0,10,"Diagnosis: $diagnosis");
    $pdf->Cell(0,10,"Tanggal: $tanggal",0,1);

    $file = "pasien_$nik.pdf";
    $pdf->Output("D",$file);
}
