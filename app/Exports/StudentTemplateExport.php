<?php

namespace App\Exports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentTemplateExport implements WithHeadings, ShouldAutoSize
{
    /**
     * @return array
     */
    public function headings(): array
    {
        $subjects = Subject::pluck('name')->toArray();

        return array_merge([
            'Nama',
            'NIS',
            'Tanggal Lahir (Thn-bln-tgl)',
            'Status (Lulus/Tidak Lulus)',
        ], $subjects);
    }
}
