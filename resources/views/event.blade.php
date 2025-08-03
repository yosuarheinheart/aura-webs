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
    <link href="{{ asset('css/event.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @include('layouts.navbar')


</head>
<body>
    <div class="floating-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

    <div class="event-container">
        
        <!-- Stage Background -->
        <div class="stage-background"></div>
        
        <!-- Spotlight Effect -->
        <div class="spotlight"></div>
        
        <!-- Curtains -->
        <div class="curtain curtain-left"></div>
        <div class="curtain curtain-right"></div>
        
                
        <div class="logo-container">
            <!-- Left Leaf -->
            <div class="leafL">
                <img src="{{ asset('asset/event/leafL.png') }}" alt="Left Leaf" class="leaf-image">
            </div>
            
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('asset/logoaura.png') }}" alt="AURA 2025 Logo" class="logo-image">
            </div>
            
            <!-- Right Leaf -->
            <div class="leafR">
                <img src="{{ asset('asset/event/leafR.png') }}" alt="Right Leaf" class="leaf-image">
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="content-area">
            <div class="container">
                <div class="row">
                    <!-- Event Card 1 - Ancient Academy -->
                    <div class="col-md-6">
                        <a href="{{ route('galleryancient.view') }}" class="card-link">
                            <div class="event-card ancient-academy">
                                    <h3 class="event-title">Ancient Academy</h3>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Event Card 2 - Artopia -->
                    <div class="col-md-6">
                        <div class="event-card artopia">
                            <h3 class="event-title">Artopia</h3>
                            
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Event Card 3 - Garden of Honors -->
                    <div class="col-md-12">
                        <div class="event-card garden-honors">
                            <h3 class="event-title">Garden of Honors</h3>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

</body>

@include('layouts.footer')
</html>


