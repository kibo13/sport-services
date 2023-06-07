<?php


namespace App\Services\Pdf;


use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    public static function generate($html, string $fileName)
    {
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream($fileName . '.pdf', ['Attachment' => false]);
    }
}
