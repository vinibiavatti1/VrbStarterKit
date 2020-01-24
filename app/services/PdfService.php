<?php
require_once(__DIR__ . "/../../plugins/dompdf-0.8.3/src/Autoloader.php");
require_once(__DIR__ . "/../services/ImportService.php");
Dompdf\Autoloader::register();
ImportService::importPhpModules();

use Dompdf\Dompdf;

/**
 * Service to generate pdf documents. This service uses the Dompdf plugin.
 */
class PdfService {
    
    /**
     * Generate PDF 
     * @param string $html
     * @param string $size
     * @param string $orientation
     */
    public static function generatePdf($html, $size = "A4", $orientation = "portrait") {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($size, $orientation);
        $dompdf->render();
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
    }
    
}
