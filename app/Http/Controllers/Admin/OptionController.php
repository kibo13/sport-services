<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Repositories\Payment\PaymentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::all();

        return view('admin.pages.options.form', compact('options'));
    }

    public function update(Request $request, Option $option, PaymentRepositoryInterface $paymentRepository): RedirectResponse
    {
        $section = $request->input('section');
        $value = $request->input('value');

        if ($section === 'payments' && $value) {
            $maxId = $paymentRepository->getMaxPaymentId();

            if ($maxId >= $value) {
                return redirect()
                    ->route('options.index')
                    ->with('warning', 'Пожалуйста, укажите число выше ' . $maxId);
            }

            $paymentRepository->setAutoIncrementValue($value);
            $option->update(['value' => $value]);
        }

        return redirect()
            ->route('options.index')
            ->with('success', __('_record.updated'));
    }
}
