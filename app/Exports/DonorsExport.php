<?php

namespace App\Exports;

use App\Models\Donor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DonorsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Donor::with('response')->orderBy('created_at', 'ASC')->get();
    }

    public function headings(): array
    {
        return[
            '#',
            'name',
            'phone',
            'age',
            'weight',
            'type',
            'email',
            'status',
            'Appointment',

        ];
    }

    public function map($item): array
    {
        return[
            $item->id,
            $item->name,
            $item->phone,
            $item->age,
            $item->weight,
            $item->type,
            $item->email,
            $item->response ? $item->response['status'] : '-',
            is_null($item->response) ? '-' : $item->response['date'],
        ];

    }
}
