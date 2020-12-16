<?php
require_once(__DIR__ . "/../../plugins/dompdf-0.8.6/autoload.inc.php");
require_once(__DIR__ . "/ImportUtil.php");
Dompdf\Autoloader::register();
ImportUtil::importPhpModules();

use Dompdf\Dompdf;

/**
 * Class to generate pdf documents. This class uses the Dompdf library to create
 * the PDF files
 */
class PdfUtil {
    
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
