<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Transkrip Nilai - {{ $student->name }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.5; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0; font-size: 12px; }
        
        .student-info { margin-bottom: 30px; }
        .student-info table { width: 100%; }
        .student-info td { padding: 3px 0; vertical-align: top; }
        .label { width: 150px; font-weight: bold; }
        .separator { width: 10px; }
        
        .transcript-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .transcript-table th, .transcript-table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .transcript-table th { background-color: #f2f2f2; font-weight: bold; text-align: center; }
        .transcript-table .center { text-align: center; }
        
        .status-box { 
            margin-top: 20px; 
            padding: 15px; 
            border: 2px solid #000; 
            text-align: center; 
            font-size: 14px; 
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-lulus { background-color: #e6fffa; }
        .status-tidak-lulus { background-color: #fff5f5; }
        
        .footer { margin-top: 50px; }
        .footer table { width: 100%; }
        .signature-box { width: 250px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sistem Informasi Kelulusan Sekolah</h1>
        <p>Alamat Sekolah: Jl. Pendidikan No. 123, Kota Pendidikan</p>
        <p>Telp: (021) 1234567 | Website: www.sekolahkita.sch.id</p>
    </div>

    <div class="student-info">
        <h2 style="font-size: 14px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">DATA PESERTA DIDIK</h2>
        <table>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="separator">:</td>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Induk Siswa</td>
                <td class="separator">:</td>
                <td>{{ $student->nis }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Lahir</td>
                <td class="separator">:</td>
                <td>{{ date('d F Y', strtotime($student->date_of_birth)) }}</td>
            </tr>
        </table>
    </div>

    <h2 style="font-size: 14px;">TRANSKRIP NILAI SEMENTARA</h2>
    <table class="transcript-table">
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Mata Pelajaran</th>
                <th width="100">Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($student->grades as $index => $grade)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td>{{ $grade->subject->name }}</td>
                <td class="center">{{ $grade->score }}</td>
            </tr>
            @php $total += $grade->score; @endphp
            @empty
            <tr>
                <td colspan="3" class="center">Data nilai tidak tersedia.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background-color: #f9f9f9; font-weight: bold;">
                <td colspan="2" style="text-align: right;">RATA-RATA NILAI</td>
                <td class="center">
                    @if(count($student->grades) > 0)
                        {{ number_format($total / count($student->grades), 2) }}
                    @else
                        0
                    @endif
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="status-box {{ $student->graduation_status == 'Lulus' ? 'status-lulus' : 'status-tidak-lulus' }}">
        STATUS KELULUSAN: {{ $student->graduation_status }}
    </div>

    <div class="footer">
        <table>
            <tr>
                <td></td>
                <td class="signature-box">
                    <p>Kota Pendidikan, {{ date('d F Y') }}</p>
                    <p>Kepala Sekolah,</p>
                    <div style="height: 80px;"></div>
                    <p><strong>( ________________________ )</strong></p>
                    <p>NIP. ............................</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
