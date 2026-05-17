@extends('layouts.admin')

@section('title', 'Dashboard UPT SMPN 3 Tanjung Emas')
@section('page_title', 'Ringkasan Sistem Informasi Kelulusan UPT SMPN 3 Tanjung Emas')

@push('styles')
<style>
    .hover-translate {
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    .hover-translate:hover {
        transform: translateY(-3px);
        background-color: #fff !important;
        border-color: #3a81e9;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    .small-box {
        position: relative;
        overflow: hidden;
    }
    .small-box .icon {
        position: absolute;
        top: 0;
        right: 10px;
        z-index: 0;
        font-size: 70px;
        transition: transform 0.3s linear;
    }
    .small-box:hover .icon {
        transform: scale(1.1);
    }
</style>
@endpush

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box bg-primary shadow-sm border-0 text-white">
            <div class="inner p-4 position-relative" style="z-index: 5;">
                <h3>{{ $totalStudents }}</h3>
                <p class="fs-5">Total Siswa Terdaftar</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-user-graduate opacity-25"></i>
            </div>
            <a href="{{ route('students.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box bg-success shadow-sm border-0 text-white">
            <div class="inner p-4 position-relative" style="z-index: 5;">
                <h3>{{ $totalLulus }}</h3>
                <p class="fs-5">Siswa Dinyatakan Lulus</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-certificate opacity-25"></i>
            </div>
            <a href="{{ route('students.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box bg-danger shadow-sm border-0 text-white">
            <div class="inner p-4 position-relative" style="z-index: 5;">
                <h3>{{ $totalTidakLulus }}</h3>
                <p class="fs-5">Siswa Tidak Lulus</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-circle-xmark opacity-25"></i>
            </div>
            <a href="{{ route('students.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="card-title fw-bold">
                    <i class="fa-solid fa-chart-bar me-2 text-primary"></i>
                    Rata-rata Nilai per Mata Pelajaran
                </h3>
            </div>
            <div class="card-body">
                <div id="subject-scores-chart" style="min-height: 350px;"></div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="card-title fw-bold">
                    <i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>
                    Siswa Terbaru
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Nama</th>
                                <th>NIS</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentStudents as $student)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                            <i class="fa-solid fa-user text-secondary"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $student->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $student->nis }}</td>
                                <td>
                                    <span class="badge {{ $student->graduation_status == 'Lulus' ? 'bg-success' : 'bg-danger' }} rounded-pill px-3">
                                        {{ $student->graduation_status }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('students.grades', $student->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fa-solid fa-eye me-1"></i> Nilai
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 text-center pb-4">
                <a href="{{ route('students.index') }}" class="text-decoration-none fw-bold">Lihat Semua Siswa <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="card-title fw-bold">
                    <i class="fa-solid fa-chart-pie me-2 text-primary"></i>
                    Persentase Kelulusan
                </h3>
            </div>
            <div class="card-body">
                <div id="graduation-pie-chart" style="min-height: 300px;"></div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="card-title fw-bold">
                    <i class="fa-solid fa-bolt me-2 text-warning"></i>
                    Aksi Cepat
                </h3>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="{{ route('students.create') }}" class="btn btn-light text-start p-3 shadow-sm hover-translate">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 text-primary">
                                <i class="fa-solid fa-user-plus fa-lg"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Tambah Siswa Baru</div>
                                <small class="text-muted">Daftarkan siswa baru ke sistem</small>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('subjects.index') }}" class="btn btn-light text-start p-3 shadow-sm hover-translate">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3 text-success">
                                <i class="fa-solid fa-book-open fa-lg"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Kelola Mata Pelajaran</div>
                                <small class="text-muted">Atur data master mata pelajaran</small>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('students.index') }}" class="btn btn-light text-start p-3 shadow-sm hover-translate">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 p-2 rounded-3 me-3 text-info">
                                <i class="fa-solid fa-clipboard-list fa-lg"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Daftar Siswa</div>
                                <small class="text-muted">Kelola data dan nilai kelulusan</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bar Chart - Average Scores
        const subjectStats = @json($subjectStats);
        const categories = subjectStats.map(s => s.name);
        const averages = subjectStats.map(s => s.avg);

        const barOptions = {
            series: [{
                name: 'Rata-rata Nilai',
                data: averages
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            colors: ['#3a81e9', '#34d399', '#fbbf24', '#f87171', '#818cf8', '#fb7185', '#2dd4bf'],
            dataLabels: { enabled: false },
            legend: { show: false },
            xaxis: {
                categories: categories,
                labels: {
                    style: { fontSize: '12px' }
                }
            },
            yaxis: {
                max: 100,
                labels: {
                    style: { fontSize: '12px' }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) { return val + " / 100" }
                }
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        };

        const barChart = new ApexCharts(document.querySelector("#subject-scores-chart"), barOptions);
        barChart.render();

        // Pie Chart - Graduation Status
        const pieOptions = {
            series: [{{ $totalLulus }}, {{ $totalTidakLulus }}],
            labels: ['Lulus', 'Tidak Lulus'],
            chart: {
                type: 'donut',
                height: 350,
            },
            colors: ['#10b981', '#ef4444'],
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val.toFixed(1) + "%"
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total Siswa',
                                formatter: function (w) {
                                    return {{ $totalStudents }}
                                }
                            }
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: { width: 200 },
                    legend: { position: 'bottom' }
                }
            }]
        };

        const pieChart = new ApexCharts(document.querySelector("#graduation-pie-chart"), pieOptions);
        pieChart.render();
    });
</script>
@endpush
