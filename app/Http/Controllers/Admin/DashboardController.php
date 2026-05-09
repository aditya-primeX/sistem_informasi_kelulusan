<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalLulus = Student::where('graduation_status', 'Lulus')->count();
        $totalTidakLulus = Student::where('graduation_status', 'Tidak Lulus')->count();
        
        // Data untuk Chart (Rata-rata nilai per mata pelajaran)
        $subjects = \App\Models\Subject::with(['grades' => function($query) {
            $query->select('subject_id', 'score');
        }])->get();

        $subjectStats = $subjects->map(function($subject) {
            return [
                'name' => $subject->name,
                'avg' => round($subject->grades->avg('score'), 1) ?: 0
            ];
        });

        $recentStudents = Student::latest()->take(5)->get();
        
        return view('dashboard', compact(
            'totalStudents', 
            'totalLulus', 
            'totalTidakLulus', 
            'subjectStats',
            'recentStudents'
        ));
    }
}
