<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Group\GroupRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.pages.reports.index');
    }

    public function clients(UserRepositoryInterface $userRepository, ClientRepositoryInterface $clientRepository): BinaryFileResponse
    {
        $currentNow = Carbon::now()->addHours(6);
        $currentYear = $currentNow->format('Y');
        $currentDay = $currentNow->format('d.m.Y');
        $director = $userRepository->getDirector();
        $filename = "Отчет по клиентам на $currentDay года.docx";
        $clients = $clientRepository->getClientsWithActivities();
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
        $table->addCell()->addText('Вид услуги', $fontText);

        foreach ($clients as $index => $client) {
            $table->addRow();
            $table->addCell()->addText(++$index);
            $table->addCell()->addText($client->full_name);
            $table->addCell()->addText($client->age);
            $table->addCell()->addText(format_phone_number_for_display($client->phone));
            $table->addCell()->addText($client->address);
            $table->addCell()->addText($client->activity);
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

    public function groups(UserRepositoryInterface $userRepository, GroupRepositoryInterface $groupRepository, ClientRepositoryInterface $clientRepository): BinaryFileResponse
    {
        $currentNow = Carbon::now()->addHours(6);
        $currentYear = $currentNow->format('Y');
        $currentDay = $currentNow->format('d.m.Y');
        $director = $userRepository->getDirector();
        $filename = "Отчет по группам на $currentDay года.docx";
        $groups = $groupRepository->getAll();
        $totalClientsCount = $clientRepository->getTotalClientPlaceCount();
        $word = new TemplateProcessor('templates/groups.docx');
        $table = new Table(['borderColor' => '000000', 'borderSize' => 6]);
        $fontText = ['bold' => true];

        $table->addRow();
        $table->addCell()->addText('№ <w:br/>п/п', $fontText);
        $table->addCell()->addText('Группа', $fontText);
        $table->addCell()->addText('Кол-во человек <w:br/>в группе', $fontText);
        $table->addCell()->addText('Кол-во занятий <w:br/>в неделю', $fontText);
        $table->addCell()->addText('Вид занятия', $fontText);

        foreach ($groups as $index => $group) {
            $table->addRow();
            $table->addCell()->addText(++$index);
            $table->addCell()->addText($group->name);
            $table->addCell()->addText($group->getBusyPlaces->count());
            $table->addCell()->addText($group->workload / 4);
            $table->addCell()->addText($group->activity->name);
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

    public function payments(Request $request, UserRepositoryInterface $userRepository, PaymentRepositoryInterface $paymentRepository): BinaryFileResponse
    {
        $from = $request->input('from');
        $till = $request->input('till');
        $currentNow = Carbon::now()->addHours(6);
        $currentYear = $currentNow->format('Y');
        $director = $userRepository->getDirector();
        $filename = 'Отчет по финансам с ' . format_date_for_display($from) . 'г. по ' . format_date_for_display($till) . 'г.docx';
        $payments = $paymentRepository->getAll($from, $till);
        $amount = $paymentRepository->getTotalAmount($from, $till);
        $word = new TemplateProcessor('templates/payments.docx');

        $table    = new Table(['borderColor' => '000000', 'borderSize' => 6]);
        $fontText = ['bold' => true];

        $table->addRow();
        $table->addCell()->addText('№ <w:br/>п/п', $fontText);
        $table->addCell()->addText('Активность', $fontText);
        $table->addCell()->addText('Услуга', $fontText);
        $table->addCell()->addText('Дата', $fontText);
        $table->addCell()->addText('Номер <w:br/>карточки', $fontText);
        $table->addCell()->addText('Сумма, <w:br/>руб.', $fontText);

        foreach ($payments as $index => $payment) {
            $table->addRow();
            $table->addCell()->addText(++$index);
            $table->addCell()->addText($payment->activity->name);
            $table->addCell()->addText($payment->service->name);
            $table->addCell()->addText(format_date_for_display($payment->paid_at));
            $table->addCell()->addText($payment->card ? $payment->card->id : '');
            $table->addCell()->addText($payment->amount);
        }

        $word->setValues([
            'director' => $director->short_name,
            'current_year' => $currentYear,
            'from' => format_date_for_display($from),
            'till' => format_date_for_display($till),
            'amount' => "$amount руб.",
        ]);

        $word->setComplexBlock('table', $table);
        $word->saveAs($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function events(Request $request, UserRepositoryInterface $userRepository, EventRepositoryInterface $eventRepository): BinaryFileResponse
    {
        $from = $request->input('from');
        $till = $request->input('till');
        $currentNow = Carbon::now()->addHours(6);
        $currentYear = $currentNow->format('Y');
        $director = $userRepository->getDirector();
        $filename = 'Отчет по соревнованиям с ' . format_date_for_display($from) . 'г. по ' . format_date_for_display($till) . 'г.docx';
        $events = $eventRepository->getAll($from, $till);
        $totalEventsCount = $eventRepository->getTotalEventsCount($from, $till);
        $word = new TemplateProcessor('templates/events.docx');

        $table    = new Table(['borderColor' => '000000', 'borderSize' => 6]);
        $fontText = ['bold' => true];

        $table->addRow();
        $table->addCell()->addText('№ <w:br/>п/п', $fontText);
        $table->addCell()->addText('Вид <w:br/>соревнований', $fontText);
        $table->addCell()->addText('Название', $fontText);
        $table->addCell()->addText('Дата', $fontText);
        $table->addCell()->addText('Время', $fontText);
        $table->addCell()->addText('Ф.И.О. <w:br/>инструктора', $fontText);
        $table->addCell()->addText('Место <w:br/>соревнований', $fontText);

        foreach ($events as $index => $event) {
            $table->addRow();
            $table->addCell()->addText(++$index);
            $table->addCell()->addText($event->activity->name);
            $table->addCell()->addText($event->title);
            $table->addCell()->addText(format_date_for_display($event->start));
            $table->addCell()->addText($event->init);
            $table->addCell()->addText($event->trainer->full_name);
            $table->addCell()->addText($event->place);
        }

        $word->setValues([
            'director' => $director->short_name,
            'current_year' => $currentYear,
            'from' => format_date_for_display($from),
            'till' => format_date_for_display($till),
            'total_events' => $totalEventsCount,
        ]);

        $word->setComplexBlock('table', $table);
        $word->saveAs($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function results(Request $request, UserRepositoryInterface $userRepository, EventRepositoryInterface $eventRepository): BinaryFileResponse
    {
        $from = $request->input('from');
        $till = $request->input('till');
        $currentNow = Carbon::now()->addHours(6);
        $currentYear = $currentNow->format('Y');
        $director = $userRepository->getDirector();
        $filename = 'Отчет по результативности участников соревнований с ' . format_date_for_display($from) . 'г. по ' . format_date_for_display($till) . 'г.docx';
        $events = $eventRepository->getAll($from, $till);
        $totalEventsCount = $eventRepository->getTotalEventsCount($from, $till);
        $word = new TemplateProcessor('templates/results.docx');

        $table = new Table(['borderColor' => '000000', 'borderSize' => 6]);
        $fontText = ['bold' => true];

        $table->addRow();
        $table->addCell()->addText('Событие', $fontText);
        $table->addCell()->addText('Вид соревнования', $fontText);
        $table->addCell()->addText('Дата', $fontText);
        $table->addCell()->addText('Победители', $fontText);

        foreach ($events as $event) {
            $table->addRow();
            $table->addCell()->addText($event->title);
            $table->addCell()->addText($event->activity->name);
            $table->addCell()->addText(format_date_for_display($event->start));

            $winners = '';

            foreach ($event->results as $result) {
                $position = $result->position;
                $champion = $result->client->short_name;
                $winners .= "{$position} место: {$champion} <w:br/>";
            }

            $table->addCell()->addText($winners);
        }

        $word->setValues([
            'director' => $director->short_name,
            'current_year' => $currentYear,
            'from' => format_date_for_display($from),
            'till' => format_date_for_display($till),
            'total_events' => $totalEventsCount,
        ]);

        $word->setComplexBlock('table', $table);
        $word->saveAs($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
