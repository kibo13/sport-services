<?php

namespace App\Http\Controllers\Admin;


use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Timetable;
use App\Models\TimetableOption;
use App\Repositories\Group\GroupRepositoryInterface;
use App\Repositories\Timetable\TimetableOptionRepositoryInterface;
use App\Repositories\Timetable\TimetableRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        // Получение роли авторизованного пользователя
        $authorizedUserRole = auth()->user()->role_id;

        // Роли, имеющие полные разрешения
        $rolesHaveFullPermissions = [Role::OWNER,Role::METHODIST];

        // Проверка, имеет ли авторизованный пользователь полные разрешения
        $hasFullPermissions = in_array($authorizedUserRole, $rolesHaveFullPermissions);

        // Получение всех активностей через репозиторий "ActivityRepository"
        $activities = Activity::all();

        // Возвращение представления 'admin.pages.timetable.index' с передачей переменных
        return view('admin.pages.timetable.index', [
            'hasFullPermissions' => $hasFullPermissions,
            'activities' => $activities,
        ]);
    }

    public function replaceTrainer(Request $request): RedirectResponse
    {
        $lesson = Timetable::query()->find($request['timetable_id']);
        $lesson->update([
            'is_replace' => $request['trainer_id'],
            'trainer_id' => $request['trainer_id'],
            'note' => $request['note'],
        ]);

        return redirect()
            ->route('timetable.index')
            ->with('success', __('_record.updated'));
    }

    public function generate(
        Request $request,
        GroupRepositoryInterface $groupRepository,
        TimetableRepositoryInterface $timetableRepository,
        TimetableOptionRepositoryInterface $timetableOptionRepository
    )
    {
        // Извлечение значения 'month' из запроса
        $requestDate = $request->input('month');

        // Разделение даты по дефису и получение года и месяца
        $requestYear = explode('-', $requestDate)[0];
        $requestMonth = explode('-', $requestDate)[1];

        // Подсчет количества дней в указанном месяце и году
        $numberDaysInMonth = count_days_in_month($requestMonth, $requestYear);

        // Получение идентификаторов групп из репозитория групп
        $groupIds = $groupRepository->getAll()->pluck('id')->toArray();

        // Получение общего количества занятий для указанных групп
        $totalLessons = $timetableOptionRepository->getTotalLessonsForGroups($groupIds);

        // Получение количества занятий по группе и дате
        $lessonsByGroupAndDate = $timetableRepository->getLessonsByGroupAndDate($groupIds, $requestMonth, $requestYear);

        if ($totalLessons == $lessonsByGroupAndDate)
        {
            $monthName = $this->getMonthName($requestMonth);
            $message = "Расписание за месяц $monthName уже сформировано";

            return redirect()
                ->route('timetable.index')
                -with('success', $message);
        }

        $monthByDayOfWeek = $this->fillMonthByDayOfWeek($requestYear, $requestMonth, $numberDaysInMonth);
        $this->generateTimetable($monthByDayOfWeek);

        return redirect()
            ->route('timetable.index')
            ->with('success', 'Расписание готово');
    }

    /**
     * Получает название месяца по его номеру.
     *
     * @param int $monthNumber Номер месяца
     * @return string Возвращает название месяца
     */
    private function getMonthName(int $monthNumber): string
    {
        // Получаем конфигурацию месяцев из файла config/dates.php
        $months = config('dates.months');

        // Индекс месяца в массиве
        $monthId = array_search($monthNumber, array_column($months, 'id'));

        // Индекс предыдущего месяца с учетом границ массива
        $previousMonthIndex = ($monthId - 1) >= 0 ? ($monthId - 1) : count($months) - 1;

        // Полное имя предыдущего месяца
        return mb_strtolower($months[$previousMonthIndex]['full_name']);
    }

    /**
     * Получает название месяца по его номеру.
     *
     * @param $year
     * @param $month
     * @param $numberDaysInMonth
     * @return array[]
     */
    private function fillMonthByDayOfWeek($year, $month, $numberDaysInMonth): array
    {
        // Создание массива $monthByDayOfWeek, где каждый элемент соответствует дню недели
        // Инициализация пустых массивов для каждого дня недели
        $monthByDayOfWeek = [
            0 => [], // SUNDAY
            1 => [], // MONDAY
            2 => [], // TUESDAY
            3 => [], // WEDNESDAY
            4 => [], // THURSDAY
            5 => [], // FRIDAY
            6 => [], // SATURDAY
        ];

        // Цикл для заполнения массива $monthByDayOfWeek значениями дат месяца для каждого дня недели
        for ($day = 1; $day <= $numberDaysInMonth; $day++) {
            // Максимальное количество дат в каждом дне недели
            $limit = 4;

            // Формирование даты в формате ГГГГ-ММ-ДД
            $date = $year . '-' . $month . '-' . $day;

            // Получение номера дня недели для текущей даты
            $numberDayOfWeek = date('w', strtotime($date));

            // Проверка, что количество дат для текущего дня недели не превышает лимит
            if (count($monthByDayOfWeek[$numberDayOfWeek]) < $limit) {
                // Добавление текущей даты в массив для соответствующего дня недели
                array_push($monthByDayOfWeek[$numberDayOfWeek], $date);
            }
        }

        // Возвращение заполненного массива $monthByDayOfWeek
        return $monthByDayOfWeek;
    }


    /**
     * Генерирует расписание на основе массива дат по дням недели.
     *
     * @param array $monthByDayOfWeek Массив дат по дням недели
     */
    private function generateTimetable(array $monthByDayOfWeek)
    {
        // Получение всех вариантов расписания
        $timetableOptions = TimetableOption::all();

        // Перебор всех вариантов расписания
        foreach ($timetableOptions as $timetableOption) {
            // Перебор дат в массиве $monthByDayOfWeek для соответствующего дня недели в варианте расписания
            foreach ($monthByDayOfWeek[$timetableOption->day_of_week] as $date) {
                // Генерация занятий в соответствии с продолжительностью варианта расписания
                for ($lesson = 1; $lesson <= $timetableOption->duration; $lesson++) {
                    // Вычисление времени начала и окончания занятия на основе времени начала варианта расписания
                    $start = $date . ' ' . $this->addMinutesToTime($timetableOption->start, 60 * ($lesson - 1));
                    $end = $date . ' ' . $this->addMinutesToTime($timetableOption->start, 60 + 60 * ($lesson - 1));

                    // Генерация уникального кода для занятия на основе группы, даты и времени начала
                    $code = $this->generateCodeField($timetableOption->group_id, $date, $this->addMinutesToTime($timetableOption->start, 60 * ($lesson - 1)));

                    // Проверка, что занятие с таким кодом не существует в базе данных
                    if (! Timetable::query()->where('code', $code)->exists()) {
                        // Создание нового занятия в таблице расписания
                        Timetable::query()->create([
                            'code' => $code,
                            'activity_id' => $timetableOption->group->activity_id,
                            'group_id' => $timetableOption->group_id,
                            'trainer_id' => $timetableOption->group->trainer_id,
                            'start' => $start,
                            'end' => $end,
                            'is_replace' => $timetableOption->group->trainer_id,
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Добавляет указанное количество минут к заданному времени.
     *
     * @param string $time Время в формате "часы:минуты"
     * @param int $minutes Количество минут для добавления
     * @return string Возвращает время, увеличенное на указанное количество минут
     */
    private function addMinutesToTime(string $time, int $minutes): string
    {
        // Преобразуем время в секунды с помощью функции strtotime
        $timeInSeconds = strtotime($time);

        // Количество минут преобразуем в секунды
        $minutesToAdd = $minutes * 60;

        // Суммируем время в секундах с количеством минут в секундах,
        // чтобы получить итоговое время в секундах
        $resultTimeInSeconds = $timeInSeconds + $minutesToAdd;

        // Преобразуем время в секундах обратно в формат "часы:минуты" с помощью функции date
        // Возвращаем результат в виде времени, увеличенного на указанное количество минут
        return date('H:i', $resultTimeInSeconds);
    }

    /**
     * Генерирует код поля на основе группы, даты и времени.
     *
     * @param string $group Группа
     * @param string $date Дата в формате "год-месяц-день"
     * @param string $time Время в формате "часы:минуты"
     * @return string Возвращает сгенерированный код поля
     */
    private function generateCodeField(string $group, string $date, string $time): string
    {
        // Удаление двоеточий из времени
        $formattedTime = str_replace(':', '', $time);

        // Разделение даты на составляющие
        $formattedDate = explode('-', $date);

        // Извлечение года из даты
        $year = $formattedDate[0];

        // Извлечение месяца из даты и добавление ведущего нуля, если месяц состоит из одной цифры
        $month = str_pad($formattedDate[1], 2, '0', STR_PAD_LEFT);

        // Извлечение дня из даты и добавление ведущего нуля, если день состоит из одной цифры
        $day = str_pad($formattedDate[2], 2, '0', STR_PAD_LEFT);

        // Формирование и возврат строки, состоящей из группы, года, месяца, дня и времени
        return $group . $year . $month . $day . $formattedTime;
    }
}
