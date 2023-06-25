<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\TimetableOption;
use App\Repositories\Timetable\TimetableOptionRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TimetableOptionController extends Controller
{
    /**
     * Проверяет, перекрывается ли время нового занятия с уже существующими занятиями в опции расписания.
     *
     * @param TimetableOption $option Опция расписания
     * @param string $start Время начала нового занятия
     * @param int $duration Продолжительность нового занятия в часах
     * @return bool Возвращает true, если время перекрывается, в противном случае возвращает false
     */
    private function isTimeOverlap(TimetableOption $option, string $start, int $duration): bool
    {
        // Получаем минимальное и максимальное время занятия для опции
        $minTime = date('H:i', strtotime($option->start));
        $maxTime = date('H:i', strtotime('+' . ($option->duration - 1) . ' hour', strtotime($option->start)));

        // Проверяем, не перекрывается ли время нового занятия с уже существующими занятиями
        for ($lesson = 1; $lesson <= $duration; $lesson++) {
            $lessonTime = date('H:i', strtotime('+' . ($lesson - 1) . ' hour', strtotime($start)));

            if ($lessonTime >= $minTime && $lessonTime <= $maxTime) {
                return true;
            }
        }

        return false;
    }

    /**
     * Рассчитывает общее количество часов для группы в зависимости от действия (создание или обновление).
     *
     * @param Request $request
     * @param Group $group
     * @param int $existHoursByGroup
     * @return int
     */
    private function calculateTotalHours(Request $request, Group $group, int $existHoursByGroup): int
    {
        switch ($request['action']) {
            case 'create':
                // Рассчитываем общее количество часов для группы при создании
                return $existHoursByGroup + $request['duration'];

            case 'update':
                // Получаем предыдущую продолжительность занятия
                $oldDuration = $group->options->where('day_of_week', $request['day_of_week'])->first()->duration;

                // Рассчитываем общее количество часов для группы при обновлении
                return $existHoursByGroup - $oldDuration + $request['duration'];
        }

        return 0;
    }

    /**
     * Проверяет, превышает ли общее количество часов ограничение для группы.
     *
     * @param int $totalHoursByGroup
     * @param int $limitHoursByGroup
     * @return bool
     */
    private function exceedsLimit(int $totalHoursByGroup, int $limitHoursByGroup): bool
    {
        return $totalHoursByGroup > $limitHoursByGroup;
    }

    /**
     * Обновляет или создает запись опции расписания.
     *
     * @param Request $request
     * @param Group $group
     * @return void
     */
    private function updateOrCreateTimetableOption(Request $request, Group $group): void
    {
        TimetableOption::query()->updateOrCreate([
            'group_id' => $request['group_id'],
            'day_of_week' => $request['day_of_week']
        ], $request->all());
    }

    public function updateOrCreate(Request $request, TimetableOptionRepositoryInterface $timetableOptionRepository)
    {
        // Получаем группу и связанные опции
        $group = Group::with('options')->find($request['group_id']);

        // Рассчитываем ограничение часов для группы
        $limitHoursByGroup = $group->workload / 4;

        // Получаем существующее количество часов для группы
        $existHoursByGroup = $group->getTotalHours();

        // Получаем опцию расписания для указанного дня и группы
        $option = $timetableOptionRepository->getTimetableOptionByDayAndGroup($group->id, $request['day_of_week']);

        if ($option) {
            if ($this->isTimeOverlap($option, $request['start'], $request['duration'])) {
                return redirect()
                    ->back()
                    ->with('warning', __('_dialog.time_busy'));
            }
        }

        // Рассчитываем общее количество часов для группы
        $totalHoursByGroup = $this->calculateTotalHours($request, $group, $existHoursByGroup);

        // Проверяем, не превышает ли общее количество часов ограничение для группы
        if ($this->exceedsLimit($totalHoursByGroup, $limitHoursByGroup)) {
            return redirect()
                ->back()
                ->with('warning', __('_dialog.limit_week'));
        }

        // Обновляем или создаем запись опции расписания
        $this->updateOrCreateTimetableOption($request, $group);

        return redirect()->back();
    }

    public function destroy(TimetableOption $timetableOption): RedirectResponse
    {
        $timetableOption->delete();

        return redirect()
            ->back()
            ->with('success', __('_record.deleted'));
    }
}
