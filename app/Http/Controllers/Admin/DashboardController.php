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
        
        return view('dashboard', compact('totalStudents', 'totalLulus', 'totalTidakLulus'));
    }
}
