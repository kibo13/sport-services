<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Group;
use App\Models\Option;
use App\Models\TimetableOption;
use App\Repositories\Payment\PaymentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        // Получаем конфигурацию дней из файла config/dates.php
        $days = config('dates.days');

        // Получаем конфигурацию часов из файла config/dates.php
        $hours = config('dates.hours');

        // Получаем настройки платежей
        $options = Option::all();

        // Получаем настройки расписания
        $timetableOptions = TimetableOption::all();

        // Получение всех активностей
        $activities = Activity::all();

        // Получение всех групп
        $groups = Group::query()->orderBy('activity_id')->get();

        return view('admin.pages.options.form', [
            'days' => $days,
            'hours' => $hours,
            'options' => $options,
            'timetableOptions' => $timetableOptions,
            'activities' => $activities,
            'groups' => $groups,
        ]);
    }

    public function update(Request $request, Option $option, PaymentRepositoryInterface $paymentRepository): RedirectResponse
    {
        // Получаем значение поля 'section' из запроса
        $section = $request->input('section');

        // Получаем значение поля 'value' из запроса
        $value = $request->input('value');

        if ($section === 'payments' && $value) {
            // Получаем максимальный идентификатор платежа из репозитория
            $maxId = $paymentRepository->getMaxPaymentId();

            // Возвращаем редирект с предупреждением, если значение 'value'
            // меньше или равно максимальному идентификатору платежа
            if ($maxId >= $value) {
                return redirect()
                    ->route('options.index')
                    ->with('warning', 'Пожалуйста, укажите число выше ' . $maxId);
            }

            // Устанавливаем значение автоинкремента идентификатора платежа в репозитории
            $paymentRepository->setAutoIncrementValue($value);

            // Обновляем значение опции с ключом 'value' на указанное значение
            $option->update(['value' => $value]);
        }

        // Возвращаем редирект с успешным сообщением об обновлении записи
        return redirect()
            ->route('options.index')
            ->with('success', __('_record.updated'));
    }
}
