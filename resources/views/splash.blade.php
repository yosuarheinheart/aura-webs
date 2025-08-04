<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/logoaura2025.png') }}">

    {{-- SEO --}}
    @section ('meta_keywords', "AURA UMN, AURA 2025, AURA UMN 2025, HMDKV UMN")
    @section ('meta_description', "AURA UMN 2025 - The official website for AURA UMN, an annual program initiated by the Visual Communication Design Students Association (HMDKV) at UMN.")
    @section("title", "AURA UMN 2025")

    <meta property="og:title" content="@yield ('title', 'AURA UMN 2025')">
    <meta property="og:description" content="@yield ('meta_description', 'AURA UMN 2025 - The official website for AURA UMN, an annual program initiated by the Visual Communication Design Students Association (HMDKV) at UMN.')">
    <meta property="og:image" content="{{ asset('asset/logoaura2025.png') }}">
    <meta property="og:url" content="https://auraumn.com">        

    <meta name = "keywords" content="@yield ('meta_keywords', 'AURA UMN, AURA 2025, AURA UMN 2025, HMDKV UMN')">
    <meta name = "author" content="AURA UMN 2025 Website Division">

    <title>AURA UMN 2025</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        @font-face {
            font-family: 'Altone Trial';
            src: url('../asset/fonts/Altone\ Trial-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Altone Trial Bold';
            src: url('../asset/fonts/Altone\ Trial-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Altone Trial Oblique';
            src: url('../asset/fonts/Altone\ Trial-Oblique.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }

        @font-face {
            font-family: 'Altone Trial Bold Oblique';
            src: url('../asset/fonts/Altone\ Trial-BoldOblique.ttf') format('truetype');
            font-weight: bold;
            font-style: italic;
            font-display: swap;
        }

        @font-face {
            font-family: 'Rafaella';
            src: url('../asset/fonts/fonnts.com-Rafaella-.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Rafaella Shadow';
            src: url('../asset/fonts/fonnts.com-Rafaella-Shadow-Regular.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Rafaella Shadow Bold';
            src: url('../asset/fonts/fonnts.com-Rafaella-Shadow-Bold.otf') format('opentype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        body {
            font-family: 'Rafaella', sans-serif;
            overflow: hidden;
            background: #1a0f2e;
        }

        .splash-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 1;
            z-index: 1;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, 
                rgba(88, 28, 135, 0.4) 0%,
                rgba(124, 58, 237, 0.3) 25%,
                rgba(139, 69, 244, 0.4) 50%,
                rgba(168, 85, 247, 0.3) 75%,
                rgba(196, 117, 255, 0.4) 100%);
            z-index: 2;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .video-overlay.show {
            opacity: 1;
        }

        .logo-container {
            position: relative;
            z-index: 10;
            text-align: center;
            opacity: 0;
            transform: scale(0.3) translateY(100px) rotateX(90deg);
            animation: logoEntrance 2.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            animation-delay: 3s;
        }

        @keyframes logoEntrance {
            0% {
                opacity: 0;
                transform: scale(0.3) translateY(100px) rotateX(90deg);
                filter: blur(20px);
            }
            60% {
                opacity: 0.8;
                transform: scale(1.1) translateY(-20px) rotateX(0deg);
                filter: blur(5px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0) rotateX(0deg);
                filter: blur(0px);
            }
        }

        .aura-logo {
            font-size: clamp(4rem, 12vw, 8rem);
            font-weight: 800;
            background: linear-gradient(135deg, 
                #E879F9 0%,
                #C084FC 20%,
                #A855F7 40%,
                #9333EA 60%,
                #7C3AED 80%,
                #6D28D9 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 40px rgba(168, 85, 247, 0.8);
            letter-spacing: 0.15em;
            margin-bottom: 20px;
            animation: textFloat 4s ease-in-out infinite, textGlow 3s ease-in-out infinite;
            animation-delay: 5.5s, 5.5s;
        }

        @keyframes textFloat {
            0%, 100% { 
                transform: translateY(0px) scale(1);
            }
            50% { 
                transform: translateY(-15px) scale(1.02);
            }
        }

        @keyframes textGlow {
            0%, 100% { 
                filter: drop-shadow(0 0 30px rgba(168, 85, 247, 0.8));
                text-shadow: 0 0 40px rgba(168, 85, 247, 0.8);
            }
            50% { 
                filter: drop-shadow(0 0 50px rgba(196, 117, 255, 1));
                text-shadow: 0 0 60px rgba(196, 117, 255, 1);
            }
        }

        .umn-text {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 600;
            background: linear-gradient(135deg, #F3E8FF, #DDD6FE, #C4B5FD);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(196, 117, 255, 0.6);
            letter-spacing: 0.4em;
            margin-top: 5px;
            animation: fadeInUp 2s ease-out forwards, subtleFloat 3s ease-in-out infinite;
            animation-delay: 6s, 8s;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes subtleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .loading-bar {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            width: 350px;
            height: 3px;
            background: rgba(168, 85, 247, 0.2);
            border-radius: 2px;
            overflow: hidden;
            opacity: 0;
            animation: showLoader 0.5s ease-out forwards;
            animation-delay: 8.5s;
        }

        @keyframes showLoader {
            to { opacity: 1; }
        }

        .loading-progress {
            height: 100%;
            background: linear-gradient(90deg, #E879F9, #C084FC, #A855F7, #7C3AED);
            border-radius: 2px;
            width: 0%;
            animation: loadProgress 2s ease-out forwards;
            animation-delay: 9s;
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.8);
        }

        @keyframes loadProgress {
            to { width: 100%; }
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 5;
            opacity: 0;
            animation: showParticles 1s ease-out forwards;
            animation-delay: 4s;
        }

        @keyframes showParticles {
            to { opacity: 1; }
        }

        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(196, 117, 255, 0.8) 0%, rgba(168, 85, 247, 0.4) 50%, transparent 100%);
            border-radius: 50%;
            pointer-events: none;
        }

        .fade-out {
            animation: fadeOutTransition 1.5s ease-in-out forwards;
        }

        @keyframes fadeOutTransition {
            0% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(1.1);
            }
            100% {
                opacity: 0;
                transform: scale(1.3);
            }
        }

        .skip-button {
            position: absolute;
            top: 30px;
            right: 30px;
            z-index: 15;
            padding: 10px 20px;
            background: rgba(168, 85, 247, 0.2);
            border: 2px solid rgba(196, 117, 255, 0.5);
            color: #E879F9;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            opacity: 0;
            animation: showSkip 0.5s ease-out forwards;
            animation-delay: 2s;
        }

        .skip-button:hover {
            background: rgba(168, 85, 247, 0.4);
            border-color: rgba(196, 117, 255, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(168, 85, 247, 0.3);
        }

        @keyframes showSkip {
            to { opacity: 1; }
        }

        @media (max-width: 768px) {
            .loading-bar {
                width: 280px;
                bottom: 30px;
            }
            
            .aura-logo {
                letter-spacing: 0.1em;
            }
            
            .umn-text {
                letter-spacing: 0.25em;
                font-family: 'Rafaella';
            }

            .skip-button {
                top: 20px;
                right: 20px;
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="splash-container" id="splashContainer">
        <!-- Skip Button -->
        <button class="skip-button" id="skipButton">Skip Intro</button>
        
        <!-- Video Background -->
        <video class="video-background" id="bgVideo" autoplay muted>
            <source src="{{ asset('asset/home/welcome(2).mp4') }}" audio = 'enable' type="video/mp4">
        </video>
        
        <div class="video-overlay" id="videoOverlay"></div>
        
        <!-- Particles Effect -->
        <div class="particles" id="particles"></div>
        
        <!-- Logo Container -->
        <div class="logo-container">
            <div class="aura-logo">
                <img src="{{ asset('asset/logoaura.png') }}" alt="AURA Logo">
            </div>
            <div class="umn-text">AURA 2025</div>
        </div>
        
        <!-- Loading Bar -->
        <div class="loading-bar">
            <div class="loading-progress"></div>
        </div>
    </div>

    <!-- Audio -->
    <audio id="bgMusic" preload="auto">
        <source src="{{ asset('asset/home/serene.mp3') }}" type="audio/mpeg">
    </audio>

    <script>
        class AuraSplashScreen {
            constructor() {
                this.currentPhase = 'video'; // video -> logo -> transition
                this.init();
            }

            init() {
                const video = document.getElementById('bgVideo');
                const music = document.getElementById('bgMusic');
                const overlay = document.getElementById('videoOverlay');
                const skipButton = document.getElementById('skipButton');

                // Setup video event listeners
                video.addEventListener('loadedmetadata', () => {
                    console.log('Video loaded, duration:', video.duration);
                });

                video.addEventListener('timeupdate', () => {
                    this.handleVideoProgress(video);
                });

                video.addEventListener('ended', () => {
                    this.startLogoPhase();
                });

                video.addEventListener('error', (e) => {
                    console.log('Video error, starting logo phase immediately');
                    this.startLogoPhase();
                });

                // Setup audio
                this.setupAudio(music);

                // Setup skip button
                skipButton.addEventListener('click', () => this.skipToHome());

                // Start video overlay after 1 second
                setTimeout(() => {
                    overlay.classList.add('show');
                }, 1000);

                // Create particles
                this.createPurpleParticles();

                // Auto redirect after full sequence (12 seconds total)
                setTimeout(() => {
                    if (this.currentPhase !== 'completed') {
                        this.redirectToHome();
                    }
                }, 12000);
            }

            handleVideoProgress(video) {
                // Ketika video mencapai 70% atau minimal 3 detik, mulai logo phase
                const progress = video.currentTime / video.duration;
                if (progress >= 0.7 || video.currentTime >= 3) {
                    if (this.currentPhase === 'video') {
                        this.startLogoPhase();
                    }
                }
            }

            startLogoPhase() {
                if (this.currentPhase !== 'video') return;
                
                this.currentPhase = 'logo';
                console.log('Starting logo phase');

                // Fade video to background
                const video = document.getElementById('bgVideo');
                video.style.transition = 'opacity 1s ease-out';
                video.style.opacity = '0.3';

                // Start exit sequence after logo animations complete (8 seconds from now)
                setTimeout(() => {
                    this.redirectToHome();
                }, 8000);
            }

            setupAudio(music) {
                music.volume = 0.4;
                
                const playAudio = () => {
                    music.play().catch(e => {
                        console.log('Audio autoplay prevented:', e);
                    });
                };

                // Try autoplay
                setTimeout(playAudio, 500);

                // Fallback for browsers blocking autoplay
                const enableAudio = () => {
                    music.play().catch(e => console.log('Audio play failed:', e));
                    document.removeEventListener('click', enableAudio);
                    document.removeEventListener('touchstart', enableAudio);
                };

                document.addEventListener('click', enableAudio, { once: true });
                document.addEventListener('touchstart', enableAudio, { once: true });
            }

            createPurpleParticles() {
                const container = document.getElementById('particles');
                const colors = [
                    'rgba(196, 117, 255, 0.8)',
                    'rgba(168, 85, 247, 0.6)',
                    'rgba(147, 51, 234, 0.7)',
                    'rgba(124, 58, 237, 0.5)'
                ];

                for (let i = 0; i < 30; i++) {
                    setTimeout(() => {
                        const particle = document.createElement('div');
                        particle.className = 'particle';
                        
                        const size = Math.random() * 6 + 3;
                        particle.style.width = `${size}px`;
                        particle.style.height = `${size}px`;
                        particle.style.left = `${Math.random() * 100}%`;
                        particle.style.top = `${Math.random() * 100}%`;
                        particle.style.background = `radial-gradient(circle, ${colors[Math.floor(Math.random() * colors.length)]} 0%, transparent 70%)`;
                        
                        const duration = Math.random() * 4 + 3;
                        const delay = Math.random() * 2;
                        
                        particle.style.animation = `
                            purpleFloat ${duration}s ease-in-out infinite ${delay}s,
                            purpleFade ${duration * 1.5}s ease-in-out infinite ${delay}s
                        `;
                        
                        container.appendChild(particle);
                    }, i * 150);
                }

                // Add particle animation styles
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes purpleFloat {
                        0%, 100% { 
                            transform: translateY(0px) translateX(0px) rotate(0deg); 
                        }
                        25% { 
                            transform: translateY(-30px) translateX(15px) rotate(90deg); 
                        }
                        50% { 
                            transform: translateY(-60px) translateX(-10px) rotate(180deg); 
                        }
                        75% { 
                            transform: translateY(-30px) translateX(-20px) rotate(270deg); 
                        }
                    }
                    @keyframes purpleFade {
                        0%, 100% { opacity: 0.3; transform: scale(0.8); }
                        50% { opacity: 1; transform: scale(1.2); }
                    }
                `;
                document.head.appendChild(style);
            }

            skipToHome() {
                this.redirectToHome();
            }

            redirectToHome() {
                if (this.currentPhase === 'completed') return;
                
                this.currentPhase = 'completed';
                const splash = document.getElementById('splashContainer');
                const music = document.getElementById('bgMusic');
                
                // Fade out splash
                splash.classList.add('fade-out');
                
                // Fade out music
                const fadeOutMusic = setInterval(() => {
                    if (music.volume > 0.05) {
                        music.volume -= 0.05;
                    } else {
                        music.pause();
                        clearInterval(fadeOutMusic);
                    }
                }, 50);
                
                // Redirect to home
                setTimeout(() => {
                    window.location.href = "{{ route('home.view') }}";
                }, 1500);
            }
        }

        // Initialize splash screen
        document.addEventListener('DOMContentLoaded', () => {
            new AuraSplashScreen();
        });

        // Prevent right-click and F12 during splash (optional)
        document.addEventListener('contextmenu', e => e.preventDefault());
        document.addEventListener('keydown', e => {
            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>