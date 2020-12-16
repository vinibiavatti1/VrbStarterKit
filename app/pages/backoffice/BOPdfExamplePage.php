<?php
require_once(__DIR__ . "/../../utils/ImportUtil.php");
ImportUtil::importPhpModules();

$html = "<b style='font-family: sans-serif'>Hello World!</b>";

PdfUtil::generatePdf($html);