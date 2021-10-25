<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
class Pdf
{
    function createPDF($html, $filename='', $download=FALSE, $paper='A4', $orientation='portrait'){
        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/pdf/'.$filename.'.pdf', $output);
    }
}
