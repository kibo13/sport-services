<?php


namespace App\Services\Receipt;


use App\Models\Payment;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReceiptService
{
    public static function generate(Payment $payment)
    {
        $html = view('layouts.receipt', compact('payment'))->render();

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('receipt.pdf', ['Attachment' => false]);
    }
}
