<?php

namespace Database\Seeders;


use App\Models\TimetableOption;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimetableOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Указываем путь к файлу 'timetable_options.xlsx',
        // расположенному в папке 'import' в публичной директории проекта
        $filePath = public_path('import/timetable_options.xlsx');

        // Загружаем файл 'timetable_options.xlsx' с помощью IOFactory
        // и получаем активный лист (текущий лист) в качестве объекта
        $sheet = $this->loadSpreadsheet($filePath)->getActiveSheet();

        // Преобразуем данные текущего листа в массив,
        // где каждая строка представлена массивом значений ячеек
        $rows = $this->sheetToArray($sheet);

        // Пропустить первую строку с заголовками колонок
        $skippedFirstRow = false;

        foreach ($rows as $row) {
            // Пропускаем первую строку
            if (!$skippedFirstRow) {
                $skippedFirstRow = true;
                continue;
            }

            $this->updateOrCreateTimetableOption($row);
        }
    }

    /**
     * Загружает файл электронной таблицы с помощью IOFactory.
     *
     * @param string $filePath Путь к файлу
     * @return Spreadsheet Объект электронной таблицы
     */
    private function loadSpreadsheet(string $filePath): Spreadsheet
    {
        return IOFactory::load($filePath);
    }

    /**
     * Преобразует данные листа в массив.
     *
     * @param Worksheet $sheet Лист электронной таблицы
     * @return array Массив данных листа
     */
    private function sheetToArray(Worksheet $sheet): array
    {
        return $sheet->toArray();
    }

    /**
     * Обновляет или создает запись настроек расписания в базе данных.
     *
     * @param array $rowData Данные строки с информацией о настройки расписания
     * @return void
     */
    private function updateOrCreateTimetableOption(array $rowData): void
    {
        TimetableOption::query()->updateOrCreate([
            'group_id' => $rowData[1],
            'day_of_week' => $rowData[2],
            'start' => $rowData[3],
            'duration' => $rowData[4],
        ]);
    }
}
