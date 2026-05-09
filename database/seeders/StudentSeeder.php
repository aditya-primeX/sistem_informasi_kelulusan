<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Subject;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectNames = [
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Matematika',
            'IPA',
            'IPS',
            'Pendidikan Agama',
            'PKn'
        ];

        $subjects = [];
        foreach ($subjectNames as $name) {
            $subjects[] = Subject::create(['name' => $name]);
        }

        $students = [
            [
                'name' => 'Budi Santoso',
                'nis' => '12345001',
                'date_of_birth' => '2008-05-15',
                'graduation_status' => 'Lulus',
            ],
            [
                'name' => 'Siti Aminah',
                'nis' => '12345002',
                'date_of_birth' => '2008-08-20',
                'graduation_status' => 'Lulus',
            ],
            [
                'name' => 'Agus Setiawan',
                'nis' => '12345003',
                'date_of_birth' => '2008-03-10',
                'graduation_status' => 'Tidak Lulus',
            ],
            [
                'name' => 'Dewi Lestari',
                'nis' => '12345004',
                'date_of_birth' => '2008-11-05',
                'graduation_status' => 'Lulus',
            ],
            [
                'name' => 'Eko Prasetyo',
                'nis' => '12345005',
                'date_of_birth' => '2008-01-25',
                'graduation_status' => 'Lulus',
            ],
        ];

        foreach ($students as $studentData) {
            $student = Student::create($studentData);

            foreach ($subjects as $subject) {
                Grade::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'score' => rand(70, 95),
                ]);
            }
        }
    }
}
