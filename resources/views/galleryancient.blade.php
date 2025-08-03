<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AURA 2025 - Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/gallery.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @include('layouts.navbar')


</head>
<body>
    <div class="gallery-container">
        <!-- Gallery Grid -->
        <div class="gallery-grid">
            <!-- Top Row - 2 Images -->
            <div class="gallery-item gallery-frame">
                <img src="{{ asset('asset/gallery/gambar1.jpg') }}" alt="Gallery Item 1" class="gallery-image">
            </div>
            <div class="gallery-item gallery-frame">
                <img src="{{ asset('asset/gallery/gambar2.jpg') }}" alt="Gallery Item 2" class="gallery-image">
            </div>
            
            <!-- Middle Row - 3 Images -->
            <div class="gallery-item gallery-frame gallery-portrait">
                <img src="{{ asset('asset/gallery/gambar3.jpg') }}" alt="Gallery Item 3" class="gallery-image">
            </div>
            <div class="gallery-item gallery-frame gallery-portrait">
                <img src="{{ asset('asset/gallery/gambar4.jpg') }}" alt="Gallery Item 4" class="gallery-image">
            </div>
            <div class="gallery-item gallery-frame">
                <img src="{{ asset('asset/gallery/gambar5.jpg') }}" alt="Gallery Item 5" class="gallery-image">
            </div>
        </div>

        <!-- Highlight Section -->
        <div class="highlight-section">
            <button class="nav-arrow nav-arrow-left" id="prevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="highlight-frame gallery-frame">
                <img src="{{ asset('asset/gallery/gambar6.jpg') }}" alt="Highlight Image" class="gallery-image" id="highlightImage">
            </div>
            
            <button class="nav-arrow nav-arrow-right" id="nextBtn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Dots Indicator -->
        <div class="dots-container">
            <span class="dot active" data-slide="0"></span>
            <span class="dot" data-slide="1"></span>
            <span class="dot" data-slide="2"></span>
            <span class="dot" data-slide="3"></span>
        </div>
    </div>

    <script>
        const highlightImages = [
        '{{ asset("asset/gallery/gambar7.jpg") }}',
        '{{ asset("asset/gallery/gambar8.jpg") }}',
        '{{ asset("asset/gallery/gambar9.jpg") }}',
        '{{ asset("asset/gallery/gambar10.jpg") }}'
    ];

    let currentSlide = 0;
        const highlightImage = document.getElementById('highlightImage');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dots = document.querySelectorAll('.dot');

        function updateSlide(index) {
            currentSlide = index;
            highlightImage.src = highlightImages[currentSlide];
            
            // Update dots
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentSlide);
            });
        }

        prevBtn.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + highlightImages.length) % highlightImages.length;
            updateSlide(currentSlide);
        });

        nextBtn.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % highlightImages.length;
            updateSlide(currentSlide);
        });

        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                updateSlide(index);
            });
        });

        // Auto slide (optional)
        setInterval(() => {
            currentSlide = (currentSlide + 1) % highlightImages.length;
            updateSlide(currentSlide);
        }, 5000);
</script>
</body>

@include('layouts.footer')
</html>


