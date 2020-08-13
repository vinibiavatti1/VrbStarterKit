<?php
require_once(__DIR__ . "/../services/ImportService.php");
ImportService::importPhpModules();

$html = "<b style='font-family: sans-serif'>Hello World!</b>";

PdfService::generatePdf($html);