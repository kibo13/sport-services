<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Service\ServiceActivity;
use App\Enums\Service\ServiceCategory;
use App\Enums\Service\ServiceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Payment;
use App\Models\Service;
use App\Repositories\Client\ClientRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();

        return view('admin.pages.payments.index', compact('payments'));
    }

    public function create(ClientRepositoryInterface $clientRepository)
    {
        $activities = ServiceActivity::NAMES;
        $types = ServiceType::NAMES;
        $categories = ServiceCategory::NAMES;
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
        Payment::query()->create($request->all());

        return redirect()
            ->route('payments.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.pages.payments.form', compact('payment'));
    }

    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $payment->update($request->all());

        return redirect()
            ->route('payments.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Payment $payment): RedirectResponse
    {
        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with('success', __('_record.deleted'));
    }
}
