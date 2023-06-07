<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Service\ServiceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Activity;
use App\Models\Card;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Service;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Services\Pdf\PdfService;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function index(PaymentRepositoryInterface $paymentRepository)
    {
        $payments = Payment::query()->orderByDesc('paid_at')->get();

        return view('admin.pages.payments.index', [
            'payments' => $payments,
            'totalAmount' => $paymentRepository->getTotalAmount(),
            'previousMonthAmount' => $paymentRepository->getPreviousMonthAmount(),
            'currentMonthAmount' => $paymentRepository->getCurrentMonthAmount()
        ]);
    }

    public function create(ClientRepositoryInterface $clientRepository)
    {
        $activities = Activity::all();
        $types = ServiceType::NAMES;
        $categories = Category::all();
        $services = Service::all();
        $clients = $clientRepository->getAll();

        return view('admin.pages.payments.form', [
            'activities' => $activities,
            'types' => $types,
            'categories' => $categories,
            'services' => $services,
            'clients' => $clients
        ]);
    }

    public function store(CreatePaymentRequest $request): RedirectResponse
    {
        $payment = Payment::query()->create($request->all());
        $serviceTypeId = $payment->service->type_id;
        $serviceTypes = [ServiceType::PASS, ServiceType::GROUP];

        if (in_array($serviceTypeId, $serviceTypes)) {
            Card::query()->create([
                'client_id'   => $payment->client_id,
                'activity_id' => $payment->activity_id,
                'service_id'  => $payment->service_id,
                'payment_id'  => $payment->id,
            ]);
        }

        return redirect()
            ->route('payments.index')
            ->with('success', __('_record.added'));
    }

    public function generateReceipt(Payment $payment)
    {
        $html = view('layouts.receipt', compact('payment'))->render();

        return PdfService::generate($html, 'receipt');
    }
}
