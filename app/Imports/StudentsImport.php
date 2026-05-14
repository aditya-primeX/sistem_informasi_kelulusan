<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $subjects = Subject::all();
        $subjectMap = [];
        foreach ($subjects as $subject) {
            $subjectMap[Str::slug($subject->name, '_')] = $subject->id;
        }

        foreach ($rows as $row) {
            
            if (!isset($row['nis']) || empty($row['nis'])) {
                continue;
            }

            // Find key for name, date of birth and status
            // Depending on how Excel slugifies "Tanggal Lahir (Thn-bln-tgl)"
            $nameKey = 'nama';
            $nisKey = 'nis';
            $dobKey = 'tanggal_lahir_thn_bln_tgl';
            $statusKey = 'status_lulustidak_lulus';
            
            // Create or update student
            $student = Student::updateOrCreate(
                ['nis' => $row[$nisKey]],
                [
                    'name' => $row[$nameKey],
                    'date_of_birth' => $this->transformDate($row[$dobKey] ?? null),
                    'graduation_status' => $this->transformStatus($row[$statusKey] ?? 'Tidak Lulus'),
                ]
            );

            // Handle subject scores
            foreach ($subjectMap as $slug => $subjectId) {
                if (isset($row[$slug]) && $row[$slug] !== null && $row[$slug] !== '') {
                    Grade::updateOrCreate(
                        [
                            'student_id' => $student->id,
                            'subject_id' => $subjectId,
                        ],
                        ['score' => (int) $row[$slug]]
                    );
                }
            }
        }
    }

    private function transformDate($value)
    {
        if (empty($value)) return null;
        
        try {
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
            }
            
            return date('Y-m-d', strtotime($value));
        } catch (\Exception $e) {
            return null;
        }
    }

    private function transformStatus($value)
    {
        
        if (Str::contains(strtolower($value), 'tidak')) {
            return 'Tidak Lulus';
        }
        if (Str::contains(strtolower($value), 'lulus')) {
            return 'Lulus';
        }
        return 'Tidak Lulus';
    }
}
