@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    /* Variabel Warna untuk kemudahan kustomisasi */
    :root {
        --purple-dark: #8C2766;
        --purple-main: #92317B;
        --purple-light: #B163B7;
        --peach-main: #D19EA6;
        --peach-light: #DDB4A0;
        --text-white: #ffffff;
        --text-dark: #333;
        --card-bg: #ffffff;
        --border-light: #eef2f7;
    }

    /* Styling Kartu Utama yang Lebih Modern */
    .card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background-color: var(--card-bg);
        border-bottom: 1px solid var(--border-light);
        padding: 1.25rem;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
    }

    .card-title {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0;
    }
    
    .card-title i {
        color: var(--purple-main);
    }

    /* Penyempurnaan Small Box dengan Gradien */
    .small-box {
        border-radius: 0.75rem;
        color: var(--text-white) !important;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
        border: none;
        min-height: 120px;
        display: flex;
        align-items: center;
    }
    
    .small-box:hover {
        transform: scale(1.03);
    }

    .small-box .inner {
        padding: 1.5rem;
        flex: 1;
        z-index: 2;
        position: relative;
    }
    
    .small-box h3 {
        font-weight: 700;
        font-size: 2.2rem;
        color: var(--text-white);
        margin-bottom: 0.5rem;
    }

    .small-box p {
        font-size: 0.9rem;
        opacity: 0.9;
        color: var(--text-white);
        margin-bottom: 0;
    }

    .small-box .icon {
        position: absolute;
        font-size: 4rem;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        opacity: 0.15;
        transition: all 0.3s ease;
    }
    
    .small-box:hover .icon {
        transform: translateY(-50%) scale(1.1);
        opacity: 0.25;
    }

    /* Definisi Gradien Warna */
    .bg-gradient-purple-1 { background: linear-gradient(135deg, #a34c9b, #8c2766) !important; }
    .bg-gradient-purple-2 { background: linear-gradient(135deg, #b163b7, #92317b) !important; }
    .bg-gradient-peach-1 { background: linear-gradient(135deg, #ddb4a0, #d19ea6) !important; }
    .bg-gradient-info { background: linear-gradient(135deg, #56b4d3, #3c8dbc) !important; }
    .bg-gradient-success { background: linear-gradient(135deg, #28a745, #218838) !important; }
    .bg-gradient-warning { background: linear-gradient(135deg, #ffc107, #e0a800) !important; }
    .bg-gradient-danger { background: linear-gradient(135deg, #dc3545, #c82333) !important; }

    /* Tombol yang Lebih Stylish */
    .btn-primary {
        background-color: var(--purple-main);
        border-color: var(--purple-main);
        box-shadow: 0 2px 6px rgba(146, 49, 123, 0.4);
    }
    .btn-primary:hover {
        background-color: var(--purple-dark);
        border-color: var(--purple-dark);
    }

    /* Styling Tab Modern untuk Aktivitas Terbaru */
    .nav-tabs {
        border-bottom: 2px solid var(--border-light);
    }
    
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .nav-tabs .nav-link:hover {
        color: var(--purple-main);
    }

    .nav-tabs .nav-link.active {
        background-color: transparent;
        color: var(--purple-main);
        border-bottom-color: var(--purple-main);
    }

    /* Styling List Aktivitas Terbaru */
    .recent-activity-list li {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-light);
    }
    .recent-activity-list li:last-child {
        border-bottom: none;
    }
    .activity-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: var(--text-white);
        margin-right: 15px;
        font-size: 1.1rem;
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 350px;
        width: 100%;
    }

    /* Responsive Improvements */
    @media (max-width: 1199.98px) {
        .card-header {
            padding: 1rem;
        }
        
        .small-box .inner {
            padding: 1.25rem;
        }
        
        .small-box h3 {
            font-size: 2rem;
        }
        
        .small-box .icon {
            font-size: 3.5rem;
        }
    }

    @media (max-width: 991.98px) {
        .chart-container {
            height: 300px;
        }
        
        .small-box {
            min-height: 100px;
        }
        
        .small-box .inner {
            padding: 1rem;
        }
        
        .small-box h3 {
            font-size: 1.8rem;
        }
        
        .small-box p {
            font-size: 0.85rem;
        }
        
        .small-box .icon {
            font-size: 3rem;
            right: 10px;
        }
    }

    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .card-header .btn {
            align-self: stretch;
        }
        
        .small-box {
            min-height: 90px;
            margin-bottom: 1rem;
        }
        
        .small-box .inner {
            padding: 0.75rem;
        }
        
        .small-box h3 {
            font-size: 1.6rem;
            margin-bottom: 0.25rem;
        }
        
        .small-box p {
            font-size: 0.8rem;
        }
        
        .small-box .icon {
            font-size: 2.5rem;
            right: 8px;
        }
        
        .chart-container {
            height: 250px;
        }
        
        .recent-activity-list li {
            padding: 0.75rem 0;
        }
        
        .activity-icon {
            width: 32px;
            height: 32px;
            margin-right: 12px;
            font-size: 1rem;
        }
    }

    @media (max-width: 575.98px) {
        .card {
            margin-bottom: 1rem;
        }
        
        .card-header {
            padding: 0.5rem;
        }
        
        .card-body {
            padding: 0.75rem;
        }
        
        .small-box {
            min-height: 80px;
        }
        
        .small-box .inner {
            padding: 0.5rem;
        }
        
        .small-box h3 {
            font-size: 1.4rem;
        }
        
        .small-box p {
            font-size: 0.75rem;
        }
        
        .small-box .icon {
            font-size: 2rem;
        }
        
        .chart-container {
            height: 200px;
        }
        
        .nav-tabs .nav-link {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .recent-activity-list li {
            padding: 0.5rem 0;
            font-size: 0.875rem;
        }
        
        .activity-icon {
            width: 28px;
            height: 28px;
            font-size: 0.9rem;
        }
    }

    /* Dashboard header responsive */
    .dashboard-header {
        margin-bottom: 1.5rem;
    }
    
    .dashboard-header h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0;
    }

    @media (max-width: 767.98px) {
        .dashboard-header {
            margin-bottom: 1rem;
        }
        
        .dashboard-header h1 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 575.98px) {
        .dashboard-header h1 {
            font-size: 1.25rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="dashboard-header">
        <h1>Dashboard Overview</h1>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card">
                <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <h3 class="card-title mb-2 mb-sm-0">
                        <i class="fas fa-palette me-2"></i>Artopia Program
                    </h3>
                    <a href="{{ route('admin.artopia.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-1"></i> View Details
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="small-box bg-gradient-purple-2">
                                <div class="inner">
                                    <h3>{{ $artopiaStats['total'] }}</h3>
                                    <p>Total Applications</p>
                                </div>
                                <div class="icon"><i class="fas fa-users"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <h3>{{ $artopiaStats['pending'] }}</h3>
                                    <p>Pending Review</p>
                                </div>
                                <div class="icon"><i class="fas fa-clock"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="small-box bg-gradient-success">
                                <div class="inner">
                                    <h3>{{ $artopiaStats['accepted'] }}</h3>
                                    <p>Accepted</p>
                                </div>
                                <div class="icon"><i class="fas fa-check"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3>{{ $artopiaStats['rejected'] }}</h3>
                                    <p>Rejected</p>
                                </div>
                                <div class="icon"><i class="fas fa-times"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card">
                <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <h3 class="card-title mb-2 mb-sm-0">
                        <i class="fas fa-landmark me-2"></i>Ancient Program
                    </h3>
                    <a href="{{ route('admin.ancient.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-1"></i> View Details
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="small-box bg-gradient-purple-2">
                                <div class="inner">
                                    <h3>{{ $ancientStats['total'] }}</h3>
                                    <p>Total Applications</p>
                                </div>
                                <div class="icon"><i class="fas fa-users"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <h3>{{ $ancientStats['pending'] }}</h3>
                                    <p>Pending Review</p>
                                </div>
                                <div class="icon"><i class="fas fa-clock"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="small-box bg-gradient-success">
                                <div class="inner">
                                    <h3>{{ $ancientStats['accepted'] }}</h3>
                                    <p>Accepted</p>
                                </div>
                                <div class="icon"><i class="fas fa-check"></i></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3>{{ $ancientStats['rejected'] }}</h3>
                                    <p>Rejected</p>
                                </div>
                                <div class="icon"><i class="fas fa-times"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-8 col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-line me-2"></i>Registration Trends (Last 7 Days)</h3>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="registrationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-history me-2"></i>Recent Activities</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-tabs px-3" id="recentTabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#artopia-recent">Artopia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#ancient-recent">Ancient</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="artopia-recent">
                            <ul class="list-unstyled mb-0 px-3 recent-activity-list">
                                @forelse($recentArtopia as $item)
                                <li>
                                    <div class="activity-icon bg-gradient-purple-2"><i class="fas fa-user-plus"></i></div>
                                    <div class="media-body">
                                        <div class="d-flex flex-column">
                                            <strong>{{ $item->nama_lengkap }}</strong>
                                            <span class="text-muted small">registered for {{ $item->nama_booth }}</span>
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i>{{ $item->timestamp?->diffForHumans() ?? '-' }}
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li class="text-center p-4 text-muted">No recent activities for Artopia.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="ancient-recent">
                            <ul class="list-unstyled mb-0 px-3 recent-activity-list">
                                @forelse($recentAncient as $item)
                                <li>
                                    <div class="activity-icon bg-gradient-peach-1"><i class="fas fa-user-plus"></i></div>
                                    <div class="media-body">
                                        <div class="d-flex flex-column">
                                            <strong>{{ $item->nama_lengkap }}</strong>
                                            <span class="text-muted small">registered for {{ $item->lokasi_pilihan }}</span>
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i>{{ $item->timestamp?->diffForHumans() ?? '-' }}
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li class="text-center p-4 text-muted">No recent activities for Ancient.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Memastikan chart ada sebelum dieksekusi
    const chartCanvas = document.getElementById('registrationChart');
    if (chartCanvas) {
        const ctx = chartCanvas.getContext('2d');
        const chartData = @json($chartData);

        const dates = chartData.map(item => item.date);
        const artopiaData = chartData.map(item => item.artopia);
        const ancientData = chartData.map(item => item.ancient);

        // Function to check if screen is mobile
        function isMobile() {
            return window.innerWidth <= 767.98;
        }

        // Chart configuration with responsive options
        const chartConfig = {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Artopia',
                    data: artopiaData,
                    borderColor: '#92317B',
                    backgroundColor: 'rgba(146, 49, 123, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#92317B',
                    pointBorderColor: '#fff',
                    pointHoverRadius: isMobile() ? 5 : 7,
                    pointHoverBorderWidth: 2,
                    pointRadius: isMobile() ? 3 : 4,
                }, {
                    label: 'Ancient',
                    data: ancientData,
                    borderColor: '#DDB4A0',
                    backgroundColor: 'rgba(221, 180, 160, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#DDB4A0',
                    pointBorderColor: '#fff',
                    pointHoverRadius: isMobile() ? 5 : 7,
                    pointHoverBorderWidth: 2,
                    pointRadius: isMobile() ? 3 : 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#6c757d',
                            font: {
                                size: isMobile() ? 10 : 12
                            }
                        },
                        grid: {
                            color: '#eef2f7'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6c757d',
                            font: {
                                size: isMobile() ? 10 : 12
                            },
                            maxRotation: isMobile() ? 45 : 0
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: isMobile() ? 12 : 14
                            },
                            color: '#6c757d',
                            padding: isMobile() ? 15 : 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#333',
                        titleFont: { size: isMobile() ? 14 : 16 },
                        bodyFont: { size: isMobile() ? 12 : 14 },
                        padding: isMobile() ? 8 : 12,
                        cornerRadius: 6,
                        boxPadding: 4,
                    }
                }
            }
        };

        const chart = new Chart(ctx, chartConfig);

        // Handle window resize for chart responsiveness
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                // Update chart options based on screen size
                const mobile = isMobile();
                
                chart.options.scales.x.ticks.font.size = mobile ? 10 : 12;
                chart.options.scales.y.ticks.font.size = mobile ? 10 : 12;
                chart.options.scales.x.ticks.maxRotation = mobile ? 45 : 0;
                chart.options.plugins.legend.labels.font.size = mobile ? 12 : 14;
                chart.options.plugins.legend.labels.padding = mobile ? 15 : 20;
                chart.options.plugins.tooltip.titleFont.size = mobile ? 14 : 16;
                chart.options.plugins.tooltip.bodyFont.size = mobile ? 12 : 14;
                chart.options.plugins.tooltip.padding = mobile ? 8 : 12;
                
                // Update point styles
                chart.data.datasets.forEach(dataset => {
                    dataset.pointRadius = mobile ? 3 : 4;
                    dataset.pointHoverRadius = mobile ? 5 : 7;
                });
                
                chart.update('resize');
            }, 300);
        });
    }
});
</script>
@endpush