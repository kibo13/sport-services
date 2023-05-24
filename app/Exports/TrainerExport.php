<?php

namespace App\Exports;


use App\Enums\Role;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TrainerExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    use Exportable;

    private $iteration = 0;

    public function collection()
    {
        return User::query()
                ->where('role_id', Role::INSTRUCTOR)
                ->get();
    }

    public function map($row): array
    {
        $this->iteration++;

        return [
            $this->iteration,
            $row->surname,
            $row->name,
            $row->patronymic,
            format_date_for_display($row->birthday),
            $row->age,
            format_phone_number_for_display($row->phone),
            $row->email,
            $row->address,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Фамилия',
            'Имя',
            'Отчество',
            'Дата рождения',
            'Возраст',
            'Телефон',
            'E-mail',
            'Адрес',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
