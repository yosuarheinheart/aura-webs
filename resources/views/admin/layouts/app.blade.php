<link rel="icon" href="{{ asset('asset/logoaura2025.png') }}">
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8f9fa;
    }

    /* Sidebar Styles */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 280px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding-top: 1.5rem;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        z-index: 1050;
        overflow-y: auto;
    }

    .sidebar.sidebar-hidden {
        transform: translateX(-100%);
    }

    .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.85);
        padding: 12px 20px;
        font-weight: 500;
        border-radius: 10px;
        margin: 4px 12px;
        transition: all 0.3s ease-in-out;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        transform: translateX(5px);
    }

    .sidebar .nav-link i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }

    .sidebar .text-center h4 {
        font-weight: 600;
    }

    .sidebar .text-white-50 {
        font-size: 0.85rem;
    }

    .btn-link.nav-link {
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
        transition: all 0.2s;
        border: none;
        text-decoration: none;
    }

    .btn-link.nav-link:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.15);
    }

    /* Mobile Navigation */
    .mobile-nav {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        z-index: 1040;
        padding: 0 1rem;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .hamburger-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        padding: 0.5rem;
        border-radius: 5px;
        transition: background-color 0.2s;
    }

    .hamburger-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .mobile-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
    }

    /* Overlay for mobile sidebar */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1049;
    }

    .sidebar-overlay.show {
        display: block;
    }

    /* Main content */
    .main-content {
        margin-left: 280px;
        background-color: #f8f9fa;
        min-height: 100vh;
        padding: 1rem;
        transition: margin-left 0.3s ease-in-out;
    }

    .main-content.sidebar-collapsed {
        margin-left: 0;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }

    .badge {
        font-size: 0.75em;
        padding: 6px 12px;
        border-radius: 20px;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
        background-color: #f8f9fa;
    }

    .btn-action {
        padding: 4px 8px;
        font-size: 12px;
        margin: 2px;
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 1rem;
    }

    /* Responsive Styles */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .mobile-nav {
            display: flex;
        }

        .main-content {
            margin-left: 0;
            padding-top: 80px;
        }

        .main-content.sidebar-collapsed {
            margin-left: 0;
        }
    }

    @media (max-width: 575.98px) {
        .sidebar {
            width: 100%;
        }

        .main-content {
            padding: 0.75rem;
            padding-top: 80px;
        }

        .card {
            margin-bottom: 1rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .btn-action {
            padding: 2px 6px;
            font-size: 11px;
        }
    }

    /* Close button for mobile sidebar */
    .sidebar-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.5rem;
        padding: 0.25rem;
        border-radius: 3px;
        display: none;
        transition: color 0.2s;
    }

    .sidebar-close:hover {
        color: white;
    }

    @media (max-width: 991.98px) {
        .sidebar-close {
            display: block;
        }
    }
</style>

    @stack('styles')
</head>
<body>
    <!-- Mobile Navigation -->
    <nav class="mobile-nav">
        <button class="hamburger-btn" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="mobile-title">Admin Panel</h1>
        <div></div>
    </nav>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <button class="sidebar-close" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="position-sticky pt-3">
            <div class="text-center mb-4">
                <h4 class="text-white">Admin Panel</h4>
                <small class="text-white-50">{{ Auth::guard('admin')->user()->name }}</small>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.artopia.*') ? 'active' : '' }}" 
                       href="{{ route('admin.artopia.index') }}">
                        <i class="fas fa-palette"></i>
                        Artopia
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.ancient.*') ? 'active' : '' }}" 
                       href="{{ route('admin.ancient.index') }}">
                        <i class="fas fa-graduation-cap"></i>
                        Ancient Academy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.email.*') ? 'active' : '' }}" 
                       href="{{ route('admin.email-templates.index') }}">
                        <i class="fas fa-envelope"></i>
                        Email Management
                    </a>
                </li>
                <li class="nav-item mt-3 pt-3 border-top border-white-50">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start w-100">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main content -->
    <main class="main-content" id="mainContent">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const mainContent = document.getElementById('mainContent');

            // Toggle sidebar for mobile
            function toggleSidebar() {
                if (window.innerWidth <= 991.98) {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                    document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
                }
            }

            // Close sidebar
            function closeSidebar() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            // Event listeners
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (sidebarClose) {
                sidebarClose.addEventListener('click', closeSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebar);
            }

            // Close sidebar when clicking on nav links on mobile
            const navLinks = sidebar.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 991.98) {
                        closeSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 991.98) {
                    closeSidebar();
                    sidebar.classList.remove('sidebar-hidden');
                    mainContent.classList.remove('sidebar-collapsed');
                }
            });

            // Handle escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.classList.contains('show')) {
                    closeSidebar();
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>