<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AURA 2025 - Ancient Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/ancient.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include ('layouts.navbar')
</head>
<body>
    <section class="section section-1">
        <img class="bg-img" src="{{ asset ('/asset/ancient/Sec1.png') }}" alt="Section 1 Background">
        <div class="title-container">
            <img class="title" src="{{ asset('asset/ancient/TITLE.png') }}" alt="Title">
        </div>
    </section>

    <section class="section section-2">
        <img class="decor-left" src="{{ asset('asset/ancient/left-decor.png') }}" alt="Left Decor">
        <img class="decor-right" src="{{ asset('asset/ancient/right-decor.png') }}" alt="Right Decor">

<div class="button-row">
                <div class="countdown-c button-row-1 countdown-container">
                    <div id="countdown" class="countdown-display">
                        <div class="countdown-item">
                            <span class="countdown-label">Hours</span>
                            <span id="hours" class="countdown-value">00</span>
                        </div>
                        <span class="colon">:</span>
                        <div class="countdown-item">
                            <span class="countdown-label">Minutes</span>
                            <span id="minutes" class="countdown-value">00</span>
                        </div>
                        <span class="colon">:</span>
                        <div class="countdown-item">
                            <span class="countdown-label">Seconds</span>
                            <span id="seconds" class="countdown-value">00</span>
                        </div>
                    </div>

                    <div class="deadline-info">
                        <div>
                            <i class="fas fa-calendar-alt"></i> <span class="deadline-date">16 August 2025</span>
                        </div>
                        <div>
                            <i class="fas fa-clock"></i> <span class="deadline-time">23.59</span>
                        </div>
                    </div>
                </div>
            </div>

        <div class="content-container">
            <div class="section-container">
                <div class="buttons-mid">
                    <button class="btn-mid btn-register" data-bs-toggle="modal" data-bs-target="#modalAncient">
                        <i class="fas fa-user-edit"></i> Register Now
                    </button>

                    <button class="btn-mid btn-guide" data-bs-toggle="modal" data-bs-target="#modalGuidebookAncient">
                        <i class="fas fa-book-open"></i> Download Guidebook
                    </button>
                </div>

                <div class="content-box">
                    <h2>About Ancient Academy</h2>
                    <p>Ancient Academy is an off-campus workshop initiative designed to bring Visual Communication Design (VCD) 
                        students into external locations such as schools and orphanages. Here, students share their knowledge 
                        of the creative world while also introducing the values of the Sustainable Development Goals (SDGs).</p>
                    <p>This program is not only a chance to introduce VCD to younger students through fun and interactive 
                        activities, but also serves as a platform for fostering empathy among university students, as they 
                        engage in meaningful teaching experiences.</p>
                    <p>Workshops include basic visual design introductions, hands-on creative activities, and how design 
                        connects with global goals like sustainability, inclusivity, and innovation.</p>
                </div>
            </div>
        </div>

        <div class="timeline-container">
            <img class="timeline-title" src="{{ asset('asset/ancient/timeline.png') }}" alt="Timeline">
        </div>

        <div class="timeline">
            <ul>
                <li style="--accent-color:#D3634A">
                    <div class="date">1-16 August 2025</div>
                    <div class="content-box2">
                        <div class="title-in text-center">Ancient Registration</div>
                    </div>
                </li>
                <li style="--accent-color:#C54E34">
                    <div class="date">18-23 August 2025</div>
                    <div class="content-box2">
                        <div class="title-in text-center">Participant Screening</div>
                    </div>
                </li>
                <li style="--accent-color:#A9381E">
                    <div class="date">26 August 2025</div>
                    <div class="content-box2">
                        <div class="title-in text-center">Announcement</div>
                    </div>
                </li>
                <li style="--accent-color:#872009">
                    <div class="date">25 September 2025</div>
                    <div class="content-box2">
                        <div class="title-in text-center">Ancient Briefing</div>
                    </div>
                </li>
                <li style="--accent-color:#872009">
                    <div class="date">29 September 2025</div>
                    <div class="content-box2">
                        <div class="title-in text-center">Ancient Opening</div>
                    </div>
                </li>
                <li style="--accent-color:#45150A">
                    <div class="date">29 September - 02 October 2025</div>
                    <div class="content-box2">
                        <div class="title-in text-center">Ancient Event</div>
                    </div>
                </li>
                <li style="--accent-color:#2D0B03">
                    <div class="date">02 October 2025</div>
                    <div class="content-box2">
                        <div class="title-in text-center">Ancient Closing</div>
                    </div>
                </li>
            </ul>
        </div>

            <div class="bottom-decor-wrapper">
                <img class="bottom-decor bush" src="{{ asset('asset/ancient/bush.png') }}" alt="Bush">
                <img class="bottom-decor upper-bush" src="{{ asset('asset/ancient/upper-bush.png') }}" alt="Upper Bush">
                <img class="bottom-decor building-under" src="{{ asset('asset/ancient/building-under.png') }}" alt="Building Under">
            </div>
    </section>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for all elements to be ready
            setTimeout(() => {
                const timelineUl = document.querySelector('.timeline ul');
                const timelineItems = document.querySelectorAll('.timeline ul li');
                const debugEl = document.getElementById('debug');
                
                let maxScrollProgress = 0;
                let revealedCount = 0;
                let isInitialized = false;
                let animationPaused = false;

                console.log('Timeline initialization:', {
                    ul: !!timelineUl,
                    items: timelineItems.length,
                    debug: !!debugEl
                });

                // Hanya cek elemen wajib
                if (!timelineUl || !timelineItems.length) {
                    console.error('Critical timeline elements not found!');
                    return;
                }

                // Force initial state untuk semua items
                const initializeTimeline = () => {
                    timelineItems.forEach((item, index) => {
                        // Reset semua class dan style
                        item.classList.remove('revealed', 'timeline-item-reveal', 'timeline-item-revealed');
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(40px)';
                        item.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                    });
                    
                    // Reset progress
                    maxScrollProgress = 0;
                    timelineUl.style.setProperty('--progress-height', '0%');
                    isInitialized = true;
                    
                    console.log('Timeline initialized - all items reset');
                };

                const updateTimeline = () => {
                    // Skip jika animasi di-pause atau belum diinisialisasi
                    if (animationPaused || !isInitialized) return;
                    
                    try {
                        const timelineRect = timelineUl.getBoundingClientRect();
                        const viewportHeight = window.innerHeight;
                        const scrollY = window.pageYOffset || document.documentElement.scrollTop;
                        
                        // Hitung progress dengan metode yang lebih robust
                        let progress = 0;
                        
                        // Method 1: Viewport-based calculation
                        const startTrigger = viewportHeight * 0.7; // Lebih sensitif
                        const endTrigger = viewportHeight * 0.3;
                        
                        if (timelineRect.top <= startTrigger && timelineRect.bottom >= endTrigger) {
                            const visibleTop = Math.max(0, startTrigger - timelineRect.top);
                            const totalScrollable = timelineRect.height + (startTrigger - endTrigger);
                            progress = Math.min(1, visibleTop / totalScrollable);
                        }
                        
                        // Method 2: Backup calculation
                        if (progress === 0 && timelineRect.top < viewportHeight) {
                            const simpleProgress = Math.max(0, Math.min(1, 
                                (viewportHeight - timelineRect.top) / (viewportHeight + timelineRect.height)
                            ));
                            progress = Math.max(progress, simpleProgress);
                        }
                        
                        // Hanya tingkatkan progress, jangan pernah kurangi
                        if (progress > maxScrollProgress) {
                            maxScrollProgress = progress;
                            timelineUl.style.setProperty('--progress-height', `${maxScrollProgress * 100}%`);
                        }
                        
                        // Reveal items berdasarkan individual position
                        revealedCount = 0;
                        timelineItems.forEach((item, index) => {
                            if (item.classList.contains('revealed')) {
                                revealedCount++;
                                return; // Skip jika sudah revealed
                            }
                            
                            const itemRect = item.getBoundingClientRect();
                            const triggerPoint = viewportHeight * 0.8; // Trigger point untuk individual items
                            
                            if (itemRect.top <= triggerPoint) {
                                // Delay berdasarkan index untuk staggered effect
                                setTimeout(() => {
                                    if (!item.classList.contains('revealed')) {
                                        item.classList.add('revealed');
                                        item.style.opacity = '1';
                                        item.style.transform = 'translateY(0)';
                                        item.style.transitionDelay = `${index * 0.1}s`;
                                        console.log(`Item ${index + 1} revealed`);
                                    }
                                }, index * 50); // Stagger delay
                            }
                        });
                        
                        // Update revealed count
                        revealedCount = document.querySelectorAll('.timeline ul li.revealed').length;
                        
                        // Update debug jika ada
                        if (debugEl) {
                            debugEl.innerHTML = `
                                <strong>Timeline Status</strong><br>
                                Progress: ${Math.round(maxScrollProgress * 100)}%<br>
                                Revealed: ${revealedCount}/7<br>
                                Timeline Top: ${Math.round(timelineRect.top)}px<br>
                                Viewport: ${viewportHeight}px<br>
                                Initialized: ${isInitialized ? 'Yes' : 'No'}<br>
                                Animation: ${animationPaused ? 'Paused' : 'Active'}
                            `;
                        }
                        
                    } catch (error) {
                        console.error('Error in updateTimeline:', error);
                        if (debugEl) {
                            debugEl.innerHTML = `<strong>ERROR:</strong><br>${error.message}`;
                        }
                    }
                };

                // Throttle function untuk optimasi performa
                let ticking = false;
                const throttledUpdate = () => {
                    if (!ticking) {
                        requestAnimationFrame(() => {
                            updateTimeline();
                            ticking = false;
                        });
                        ticking = true;
                    }
                };

                // Reset function jika diperlukan
                const resetTimeline = () => {
                    console.log('Resetting timeline...');
                    initializeTimeline();
                    setTimeout(updateTimeline, 100);
                };

                // Initialize timeline
                initializeTimeline();
                
                // Initial call
                setTimeout(() => {
                    updateTimeline();
                }, 100);

                // Event listeners dengan throttling
                window.addEventListener('scroll', throttledUpdate, { passive: true });
                window.addEventListener('resize', () => {
                    setTimeout(resetTimeline, 100);
                });

                // Intersection Observer sebagai backup
                if ('IntersectionObserver' in window) {
                    const observerOptions = {
                        root: null,
                        rootMargin: '0px 0px -20% 0px', // Trigger sebelum masuk viewport
                        threshold: [0, 0.1, 0.3, 0.5, 0.7, 1]
                    };

                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                // Timeline masuk viewport, pastikan animasi aktif
                                if (animationPaused) {
                                    animationPaused = false;
                                    console.log('Animation resumed via Intersection Observer');
                                }
                                updateTimeline();
                            }
                        });
                    }, observerOptions);

                    observer.observe(timelineUl);
                }

                // Visibility change handler
                document.addEventListener('visibilitychange', () => {
                    if (!document.hidden) {
                        // Tab menjadi aktif kembali
                        setTimeout(() => {
                            animationPaused = false;
                            updateTimeline();
                        }, 100);
                    }
                });

                // Periodic check (tidak akan berhenti)
                const periodicCheck = () => {
                    if (!animationPaused && isInitialized) {
                        updateTimeline();
                    }
                };

                // Jalankan periodic check setiap 500ms
                setInterval(periodicCheck, 500);

                // Cleanup untuk mencegah memory leaks
                window.addEventListener('beforeunload', () => {
                    animationPaused = true;
                });

                console.log('Timeline system fully initialized');
                
            }, 300); // Kurangi delay initialization
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownDate = new Date("2025-08-16T23:59:59+07:00"); // Target August 16, 2025, 23:59:59 WIB (UTC+7)

            const x = setInterval(function() {
                const now = new Date().getTime();
                const distance = countdownDate.getTime() - now;

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "EVENT STARTED!";
                    return;
                }

                const hours = Math.floor((distance % (1000 * 60 * 60 * 24 * 365 * 100)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
                document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
                document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');
            }, 1000);
        });
    </script>
@include('layouts.footer')






</body>
</html>