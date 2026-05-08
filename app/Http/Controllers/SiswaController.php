<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    public function index()
    {
        if (session()->has('siswa_id')) {
            return redirect()->route('siswa.status');
        }
        return view('siswa.index');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nis' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);

        $student = Student::where('name', $request->name)
            ->where('nis', $request->nis)
            ->where('date_of_birth', $request->date_of_birth)
            ->first();

        if ($student) {
            session(['siswa_id' => $student->id]);
            return redirect()->route('siswa.status');
        }

        return back()->withErrors(['error' => 'Data tidak ditemukan. Silakan periksa kembali Nama, NIS, dan Tanggal Lahir Anda.'])->withInput();
    }

    public function status()
    {
        $studentId = session('siswa_id');
        if (!$studentId) {
            return redirect()->route('siswa.index');
        }

        $student = Student::with('grades')->findOrFail($studentId);
        return view('siswa.status', compact('student'));
    }

    public function downloadTranscript()
    {
        $studentId = session('siswa_id');
        if (!$studentId) {
            return redirect()->route('siswa.index');
        }

        $student = Student::with('grades')->findOrFail($studentId);
        
        $pdf = Pdf::loadView('siswa.transcript_pdf', compact('student'));
        return $pdf->download('Transkrip_Nilai_' . $student->nis . '.pdf');
    }

    public function logout()
    {
        session()->forget('siswa_id');
        return redirect()->route('siswa.index');
    }
}
