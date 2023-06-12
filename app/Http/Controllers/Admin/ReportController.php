<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.pages.reports.index');
    }

    public function clients(UserRepositoryInterface $userRepository, ClientRepositoryInterface $clientRepository)
    {
        $currentNow = Carbon::now()->addHours(6);
        $currentYear = $currentNow->format('Y');
        $currentDay = $currentNow->format('d.m.Y');
        $director = $userRepository->getDirector();
        $filename = "Отчет по клиентам на $currentDay года.docx";
        $clients = $clientRepository->getAll();
        $totalClientsCount = $clientRepository->getTotalClientsCount();
        $word = new TemplateProcessor('templates/clients.docx');

        $table    = new Table(['borderColor' => '000000', 'borderSize' => 6]);
        $fontText = ['bold' => true];

        $table->addRow();
        $table->addCell()->addText('№ <w:br/>п/п', $fontText);
        $table->addCell()->addText('ФИО клиента', $fontText);
        $table->addCell()->addText('Возраст', $fontText);
        $table->addCell()->addText('Телефон', $fontText);
        $table->addCell()->addText('Адрес', $fontText);

        foreach ($clients as $index => $client) {
            $table->addRow();
            $table->addCell()->addText(++$index);
            $table->addCell()->addText($client->full_name);
            $table->addCell()->addText($client->age);
            $table->addCell()->addText(format_phone_number_for_display($client->phone));
            $table->addCell()->addText($client->address);
        }

        $word->setValues([
            'director' => $director->short_name,
            'current_year' => $currentYear,
            'total_clients' => "$totalClientsCount чел.",
        ]);

        $word->setComplexBlock('table', $table);
        $word->saveAs($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
