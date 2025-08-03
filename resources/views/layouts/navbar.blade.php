<link rel="icon" href="{{ asset('asset/logoaura2025.png') }}">
<title>AURA UMN - @yield('title', 'AURA UMN 2025')</title>
<nav class="main-navbar">
    <div class="nav-container">
        <div class="nav-content">
            
            {{-- Navbar Brand --}}
            <meta name="description" content="@yield ('description', 'AURA (Artistic Unity & Reflection in Action) is an annual program initiated by the Visual Communication Design Students Association (HMDKV) at UMN. AURA 2025 is a platform that presents student expression, creativity, and identities through various art and design-based activities.')">
            <meta name="keywords" content="@yield ('keywords', 'AURA, UMN, AURA UMN, AURA 2025, HMDKV UMN')">
            
            {{-- Logo/Brand --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home.view') }}">
                <img src="{{ asset('asset/logoaura2025.png') }}" alt="AURA 2025" class="brand-logo">
                <h1 class="brand-title" style="font-family:'Rafaella'">Aura Umn</h1>
            </a>
            
            {{-- Desktop Menu --}}
            <div id="desktop-menu" class="desktop-menu">
                
                {{-- Home --}}
                <a href="{{ route('home.view') }}" class="nav-link">
                    Home
                </a>

                {{-- Events Dropdown --}}
                <div class="dropdown" data-dropdown="events" style="">
                    <button type="button" class="nav-link dropdown-button"> 
                        Events
                        <i class="bi bi-chevron-down dropdown-arrow "></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('ancient.view') }}"  class="dropdown-item">
                            Ancient Academy
                        </a>
                        <a href="{{ route('artopia.view') }}" class="dropdown-item">
                            Artopia
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalGarden" class="dropdown-item">
                            Garden of Honors
                        </a>
                    </div>
                </div>

                {{-- Gallery Dropdown --}}  
                <div class="dropdown" data-dropdown="gallery">
                    <button type="button" class="nav-link dropdown-button" aria-disabled="true">
                        Gallery
                        <i class="bi bi-chevron-down dropdown-arrow "></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalDivisi" class="dropdown-item " aria-disabled="true">
                            Division
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalEvent" class="dropdown-item " aria-disabled="true">
                            Event
                        </a>
                    </div>
                </div>
                <a href="{{ route('home.view') }}#faq" class="nav-link">
                    FAQ
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="mobile-menu-btn">
                <i class="bi bi-list"></i>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="mobile-menu">
            
            {{-- Mobile Home --}}
            <a href="{{ route('home.view') }}" class="mobile-nav-link">
                Home
            </a>

            {{-- Mobile Events --}}
            <div class="mobile-dropdown">
                <a href="#" class="mobile-dropdown-toggle">
                    Events
                    <i class="bi bi-chevron-down mobile-chevron"></i>
                </a>
                <div class="mobile-dropdown-menu">
                    <a href="{{ route('ancient.view') }}"  class="mobile-dropdown-item">
                        Ancient Academy
                    </a>
                    <a href="{{ route('artopia.view') }}" class="mobile-dropdown-item">
                        Artopia
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalGarden" class="mobile-dropdown-item">
                        Garden of Honors
                    </a>
                </div>
            </div>

            {{-- Mobile Gallery --}}
            <div class="mobile-dropdown">
                <a href="#" class="mobile-dropdown-toggle">
                    Gallery
                    <i class="bi bi-chevron-down mobile-chevron"></i>
                </a>
                <div class="mobile-dropdown-menu">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalDivisi" class="mobile-dropdown-item">
                        Division
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalEvent" class="mobile-dropdown-item">
                        Event
                    </a>
                </div>
            </div>
            <a href="{{ route('home.view') }}#faq" class="mobile-nav-link">
                FAQ
            </a>
        </div>
    </div>

    
</nav>

<body>
<!-- Notifikasi Modal -->


<!-- Modal untuk Registrasi Event Ancient -->

<div class="modal fade" id="modalAncient" tabindex="-1" aria-labelledby="modalAncientLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 1.5vw;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAncient">Halaman Belum Tersedia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Saat ini, registrasi Ancient Academy belum dibuka. Silahkan kembali lagi nanti.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-modal" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk Guidebook Event Ancient -->

<div class="modal fade" id="modalAncient" tabindex="-1" aria-labelledby="modalAncientLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 1.5vw;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAncient">Halaman Belum Tersedia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Saat ini, Guidebook Ancient Academy belum tersedia. Silahkan kembali lagi nanti.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-modal" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk Event -->

<div class="modal fade" id="modalEvent" tabindex="-1" aria-labelledby="modalEventLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 1.5vw;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEventLabel">Halaman Belum Tersedia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Halaman Event saat ini belum tersedia. Silahkan kembali lagi nanti.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-modal" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk Divisi -->
<div class="modal fade" id="modalDivisi" tabindex="-1" aria-labelledby="modalDivisiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 1.5vw;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDivisiLabel">Halaman Belum Tersedia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Halaman Divisi saat ini belum tersedia. Silahkan kembali lagi nanti.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-modal" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk Garden -->

<div class="modal fade" id="modalGarden" tabindex="-1" aria-labelledby="modalGardenLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 1.5vw;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalGardenLabel">Halaman Belum Tersedia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Halaman Garden of Honors saat ini belum tersedia. Silahkan kembali lagi nanti.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-modal" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>



</body>

    
<style>
/* Bootstrap Icons CDN */
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css");

/* Main Navbar Styles */
.main-navbar {
    background: linear-gradient(to bottom, #2e0066, #6c2c74);
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    position: sticky;
    top: 0;
    z-index: 1050;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 70px;
}

/* Brand Styles */
.nav-brand {
    display: flex;
    align-items: center;
}

.brand-logo {
    width: 45px;
    height: 45px;
    object-fit: contain;
    margin-right: 15px;
}

.brand-title {
    color: #ffffff;
    font-size: 20px;
    font-weight: bold;
    margin: 0;
}

/* Desktop Menu Styles */
.desktop-menu {
    display: flex;
    align-items: center;
    gap: 30px;
    font-family:'Altone Trial'
}

.nav-link {
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    padding: 10px 15px;
    border-radius: 8px;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 5px;
    background: transparent;
    border: none;
    cursor: pointer;
}

.nav-link:hover {
    color: white;
    background: rgba(255,255,255,0.1);
    transform: translateY(-1px);
}

/* Dropdown Styles */
.dropdown {
    position: relative;
    display: inline-block;
      
}

.dropdown-arrow {
    font-size: 12px;
    transition: transform 0.3s ease;
    margin-left: 5px;
}

.dropdown-menu {
    position: absolute; 
    top: calc(100% + 10px);
    left: 0;
    background: linear-gradient(to bottom, #2e0066, #4c1d5f);
    min-width: 200px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    border-radius: 12px;
    padding: 15px 0;
    border: 1px solid rgba(255,255,255,0.1);
    z-index: 99999;
    
    /* Initially hidden */
    opacity: 0;
    visibility: hidden;
    transform: translateY(-15px);
    transition: all 0.3s ease;
}

.dropdown-item {
    display: block;
    color: white;
    text-decoration: none;
    padding: 12px 20px;
    font-size: 14px;
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 2px 10px;
    width: auto;

}

.dropdown-item:hover {
    color: white;
    background: rgba(255,255,255,0.15);
    transform: translateX(5px);
}

/* Show dropdown when active */
.dropdown.show .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown.show .dropdown-arrow {
    transform: rotate(180deg);
}

/* Hover effect for desktop */
.dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown:hover .dropdown-arrow {
    transform: rotate(180deg);
}

/* Mobile Menu Button */
.mobile-menu-btn {
    display: none;
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    padding: 5px;
}

/* Mobile Menu Styles */
.mobile-menu {
    display: none;
    padding: 20px 0;
    border-top: 1px solid rgba(255,255,255,0.1);
}

.mobile-nav-link {
    display: block;
    color: white;
    text-decoration: none;
    padding: 15px 0;
    font-size: 16px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.mobile-dropdown {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.mobile-dropdown-toggle {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    text-decoration: none;
    padding: 15px 0;
    font-size: 16px;
}

.mobile-chevron {
    font-size: 12px;
    transition: transform 0.3s;
}

.mobile-dropdown-menu {
    display: none;
    padding-left: 20px;
    background: rgba(255,255,255,0.05);
}

.mobile-dropdown-item {
    display: block;
    color: white;
    text-decoration: none;
    padding: 12px 0;
    font-size: 14px;
    opacity: 0.9;
}

/* Active/Current Page Styling */
.nav-link.active {
    background: rgba(252, 211, 77, 0.2);
    color: #FCD34D;
}
.modal-title{
    color: #000;
    font-family: "altone";
    font-weight: bold;
}
.modal-header{
    border-bottom: 1px solid #9F5A31;
}
.modal-body{
    color: #000;
    font-family: "Altone Trial";
}
.modal-footer{
    border-top: 1px solid #9F5A31;

}
.modal-content{
    background-color: #FFEFD5;
    border: 3px solid #9F5A31;
}


.btn-modal{
    background: #9F5A31;
    color: #fff;
    border: none;
    padding: 0.5vh 0vw; /* Use vh/vw for padding */
    border-radius: 1.5vh; /* Use vh for border-radius */
    font-size: 1rem; /* Use vw for font size */
    width: 100%;
    font-family: "altone";
    transition: all 0.3s ease;

}

.btn-modal:hover{
    transform: translateY(-0.2vh);
    transition: all 0.3s ease;
    opacity: 0.8;    
}

/* Responsive Styles */
@media (max-width: 768px) {
    .desktop-menu {
        display: none;
    }
    
    .mobile-menu-btn {
        display: block;
    }
    
    .nav-content {
        height: 60px;
    }
    
    .brand-title {
        font-size: 18px;
    }
    
    .brand-logo {
        width: 35px;
        height: 35px;
        margin-right: 10px;
    }
}

@media (max-width: 480px) {
    .nav-container {
        padding: 0 15px;
    }
    
    .brand-title {
        font-size: 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggles = document.querySelectorAll('.dropdown-button');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            const dropdown = this.closest('.dropdown');
            if (!dropdown) return;

            // Tutup dropdown lain
            document.querySelectorAll('.dropdown').forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('show');
                    const menu = d.querySelector('.dropdown-menu');
                    if (menu) menu.classList.remove('show');
                }
            });

            dropdown.classList.toggle('show');
            const menu = dropdown.querySelector('.dropdown-menu');
            if (menu) menu.classList.toggle('show');
        });
    });

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) menu.classList.remove('show');
            });
        }
    });

    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const icon = this.querySelector('i');
            
            if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
                mobileMenu.style.display = 'block';
                icon.className = 'bi bi-x';
            } else {
                mobileMenu.style.display = 'none';
                icon.className = 'bi bi-list';
            }
        });
    }

    // Mobile Dropdown Toggle
    document.querySelectorAll('.mobile-dropdown-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const menu = this.nextElementSibling;
            const chevron = this.querySelector('.mobile-chevron');
            
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
                chevron.style.transform = 'rotate(180deg)';
            } else {
                menu.style.display = 'none';
                chevron.style.transform = 'rotate(0deg)';
            }
        });
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        const nav = document.querySelector('.main-navbar');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileBtn = document.getElementById('mobile-menu-btn');
        
        if (mobileMenu && mobileBtn && !nav.contains(e.target) && mobileMenu.style.display === 'block') {
            mobileMenu.style.display = 'none';
            mobileBtn.querySelector('i').className = 'bi bi-list';
        }
    });
});
</script>