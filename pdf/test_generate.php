<?php
require_once "generate_pdf.php";

generatePDF(
    "Budi",
    "1234567890",
    "Tes diagnosis",
    date("Y-m-d"),
    __DIR__ . "/files/test.pdf"
);

echo "PDF dibuat";
