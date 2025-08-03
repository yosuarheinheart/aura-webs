<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AURA 2025 - Artopia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/artopia.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer">
@include('layouts.navbar')
</head>
<body>
    <div class="artopia-head">
        <img src="{{ asset('asset/artopia/artopia_head.png') }}" alt="Artopia Head" class="artopia-image">
    </div>

    <div class="buttons">
        <img src="{{ asset('asset/artopia/artopia_left.png') }}" alt="Left Icon" class="left-attached-image">
        <img src="{{ asset('asset/artopia/artopia_right.png') }}" alt="Right Icon" class="right-attached-image">

        <div class="button-layout">
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

            <div class="button-row secondary-color-row">
                <div class="two-button-wrapper">
                    <button class="main-button left" id="registerNowBtn"><i class="fas fa-user-plus"></i> <span>Register Now</span></button>
                    <button class="main-button right" id="downloadGuidebookBtn"><i class="fas fa-download"></i> <span>Download Guidebook</span></button>
                </div>
            </div>

            <div class="button-row full-width-row">
                <div class="main-button button-row-3 about-us-info">
                    <h2 class="about-us-title">About Artopia</h2>
                    <p class="about-us-text">
                        Artopia is an art market that gives VCD students a platform to exhibit and sell their creative works, ranging from merchandise, illustrations, and accessories to unique visual expressions.
                    </p>
                    <p></p>
                    <p class="about-us-text">
                        Built on the theme of art through time, Artopia invites visitors to experience a multi-era journey where each booth or area represents a distinct artistic timeline from traditional to futuristic styles.
                    </p>
                    <p></p>
                    <p class="about-us-text">
                        To add an interactive layer, Artopia will feature a voting-based competition, where visitors can vote for their favorite artworks. This not only celebrates student talents but also encourages audience engagement and appreciation for creativity.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="background-waves">
        <div class="ocean">
            <div class="ocean-wave wave-1"></div>
            <div class="ocean-wave wave-2"></div>
            <div class="ocean-wave wave-3"></div>
        </div>

        <div class="sky">
            <svg viewbox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <style type="text/css">
                        .svg-wave-main {
                            left: 0;
                            animation: svgWaveAnimation 8s linear infinite;
                        }

                        .svg-wave-one {
                            left: 100%;
                            animation: svgWaveAnimationOne 10s linear infinite;
                        }

                        .svg-wave-two {
                            left: 200%;
                            animation: svgWaveAnimationTwo 12s linear infinite;
                        }

                        @keyframes svgWaveAnimation {
                            0% { transform: translateX(0%); }
                            100% { transform: translateX(100%); }
                        }

                        @keyframes svgWaveAnimationOne {
                            0% { transform: scaleY(1.2) translateX(0%); }
                            100% { transform: scaleY(1.2) translateX(100%); }
                        }

                        @keyframes svgWaveAnimationTwo {
                            0% { transform: scaleY(.8) translateX(0%); }
                            100% { transform: scaleY(.8) translateX(100%); }
                        }
                    </style>
                    <path id='sineWave' fill="#DCE53C" fill-opacity="0.7" d="M0,160 C320,200,420,200,740,160 C1060,120,1120,120,1440,160 V0 H0" />
                </defs>
                <use class="svg-wave-main" href="#sineWave" />
                <use class="svg-wave-main" x="-100%" href="#sineWave" />
                <use class="svg-wave-one" href="#sineWave" />
                <use class="svg-wave-one" x="-100%" href="#sineWave" />
                <use class="svg-wave-two" href="#sineWave" />
                <use class="svg-wave-two" x="-100%" href="#sineWave" />
            </svg>
        </div>
    </div>

    <div class="timli">
        <img src="{{ asset('asset/artopia/artopia_timeline.png') }}" alt="Artopia Timeline" class="timli-image">
    </div>

    <div class="timeline">
        <ul>
            <li style="--accent-color:#7900B0">
                <div class="date">1-16 August 2025</div>
                <div class="content-box">
                    <div class="title text-center">Artopia Registration</div>
                </div>
            </li>
            <li style="--accent-color:#DD8D7A">
                <div class="date">18-23 August 2025</div>
                <div class="content-box">
                    <div class="title text-center">Participant Screening</div>
                </div>
            </li>
            <li style="--accent-color:#4A94DC">
                <div class="date">26 August 2025</div>
                <div class="content-box">
                    <div class="title text-center">Announcement</div>
                </div>
            </li>
            <li style="--accent-color:#4CBBE9">
                <div class="date">25 September 2025</div>
                <div class="content-box">
                    <div class="title text-center">Artopia Briefing</div>
                </div>
            </li>
            <li style="--accent-color:#F55836">
                <div class="date">29 September 2025</div>
                <div class="content-box">
                    <div class="title text-center">Artopia Opening</div>
                </div>
            </li>
            <li style="--accent-color:#7900B0">
                <div class="date">29 September - 02 October 2025</div>
                <div class="content-box">
                    <div class="title text-center">Artopia Event</div>
                </div>
            </li>
            <li style="--accent-color:#DD8D7A">
                <div class="date">02 October 2025</div>
                <div class="content-box">
                    <div class="title text-center">Artopia Closing</div>
                </div>
            </li>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

            const timelineUl = document.querySelector('.timeline ul');
            const timelineItems = document.querySelectorAll('.timeline ul li');

            timelineItems.forEach(item => {
                item.classList.add('timeline-item-hidden');
            });

            let maxScrollProgress = 0;

            const updateTimelineProgress = () => {
                const timelineRect = timelineUl.getBoundingClientRect();
                const viewportHeight = window.innerHeight || document.documentElement.clientHeight;

                let currentScrollProgress = 0;

                const startTriggerPoint = viewportHeight * 0.75;
                const effectiveScroll = startTriggerPoint - timelineRect.top;

                let fillFactor = 1.1;

                if (window.matchMedia('(max-width: 480px)').matches) {
                    fillFactor = 1;
                } else if (window.matchMedia('(max-width: 768px)').matches) {
                    fillFactor = 1;
                } else if (window.matchMedia('(max-width: 1024px)').matches) {
                    fillFactor = 1;
                }

                const totalFillDistance = timelineRect.height * fillFactor;
                const totalTravelDistance = totalFillDistance;

                if (totalTravelDistance > 0) {
                    currentScrollProgress = effectiveScroll / totalTravelDistance;
                    currentScrollProgress = Math.max(0, Math.min(1, currentScrollProgress));
                }

                if (currentScrollProgress > maxScrollProgress) {
                    maxScrollProgress = currentScrollProgress;
                }

                timelineUl.style.setProperty('--progress-height', `${maxScrollProgress * 100}%`);

                timelineItems.forEach(item => {
                    if (!item.classList.contains('timeline-item-revealed')) {
                        const itemRect = item.getBoundingClientRect();

                        // Reveal item based on its position relative to the viewport
                        // This logic can stay the same, as it reveals based on current scroll
                        if (itemRect.top < viewportHeight * 0.75 && itemRect.bottom > 0) {
                            item.classList.remove('timeline-item-hidden');
                            item.classList.add('timeline-item-reveal');

                            item.addEventListener('transitionend', function handler() {
                                item.classList.add('timeline-item-revealed');
                                item.removeEventListener('transitionend', handler);
                            });
                        }
                    }
                });
            };

            updateTimelineProgress();
            window.addEventListener('scroll', updateTimelineProgress);
            window.addEventListener('resize', updateTimelineProgress);

            const registerButton = document.getElementById('registerNowBtn');
            const registrationLink = '{{ route('artopiaregistration.view') }}';

            registerButton.addEventListener('click', function() {
                window.location.href = registrationLink;
            });

            const downloadButton = document.getElementById('downloadGuidebookBtn');
            const googleDriveLink = 'https://drive.google.com/file/d/1wTItnwwUoNnhONi_8ZCZat-lr7ieUfWY/view?usp=drive_link';

            downloadButton.addEventListener('click', function() {
                window.open(googleDriveLink, '_blank');
            });
        });
    </script>
</body>

@include('layouts.footer')
</html>