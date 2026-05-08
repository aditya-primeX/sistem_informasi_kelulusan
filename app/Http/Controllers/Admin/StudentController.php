<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Grade;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis',
            'date_of_birth' => 'required|date',
            'graduation_status' => 'required|in:Lulus,Tidak Lulus',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'date_of_birth' => 'required|date',
            'graduation_status' => 'required|in:Lulus,Tidak Lulus',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }

    // Grade management
    public function grades(Student $student)
    {
        return view('admin.students.grades', compact('student'));
    }

    public function updateGrades(Request $request, Student $student)
    {
        $request->validate([
            'grades.*.subject_name' => 'required|string',
            'grades.*.score' => 'required|integer|min:0|max:100',
        ]);

        $student->grades()->delete();
        if ($request->has('grades')) {
            foreach ($request->get('grades') as $gradeData) {
                $student->grades()->create($gradeData);
            }
        }

        return back()->with('success', 'Nilai siswa berhasil diperbarui.');
    }
}
