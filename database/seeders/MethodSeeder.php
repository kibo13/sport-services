<?php

namespace Database\Seeders;


use App\Models\Method;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Указываем путь к файлу 'methods.xlsx',
        // расположенному в папке 'import' в публичной директории проекта
        $filePath = public_path('import/methods.xlsx');

        // Загружаем файл 'methods.xlsx' с помощью IOFactory
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

            $this->updateOrCreateMethod($row);
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
     * Обновляет или создает запись о методике в базе данных.
     *
     * @param array $rowData Данные строки с информацией о методике
     * @return void
     */
    private function updateOrCreateMethod(array $rowData): void
    {
        Method::query()->updateOrCreate([
            'activity_id' => $rowData[1],
            'number' => trim($rowData[2]),
            'note' => trim($rowData[3]),
        ]);
    }
}
