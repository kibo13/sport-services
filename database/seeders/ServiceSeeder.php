<?php

namespace Database\Seeders;


use App\Models\Service;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Указываем путь к файлу 'services.xlsx',
        // расположенному в папке 'import' в публичной директории проекта
        $filePath = public_path('import/services.xlsx');

        // Загружаем файл 'services.xlsx' с помощью IOFactory
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

            $this->updateOrCreateService($row);
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
     * Обновляет или создает запись о сервисе в базе данных.
     *
     * @param array $rowData Данные строки с информацией о сервисе
     * @return void
     */
    private function updateOrCreateService(array $rowData): void
    {
        Service::query()->updateOrCreate([
            'name' => trim($rowData[1]),
            'type_id' => $rowData[2],
            'activity_id' => $rowData[3],
            'category_id' => $rowData[4],
            'unit' => $rowData[5],
            'price' => $rowData[6]
        ]);
    }
}
