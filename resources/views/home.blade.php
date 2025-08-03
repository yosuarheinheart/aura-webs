<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AURA UMN 2025</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AURA (Artistic Unity & Reflection in Action) is an annual program initiated by the Visual Communication Design Students Association (HMDKV) at UMN. AURA 2025 is a platform that presents student expression, creativity, and identities through various art and design-based activities.">
    <meta name="keywords" content="AURA, UMN, AURA UMN, AURA 2025, HMDKV UMN">

    {{-- SEO --}}
    @section('title', 'AURA UMN 2025')
    @section('description', 'AURA (Artistic Unity & Reflection in Action) is an annual program initiated by the Visual Communication Design Students Association (HMDKV) at UMN. AURA 2025 is a platform that presents student expression, creativity, and identities through various art and design-based activities.')
    @section('keywords', 'AURA, UMN, AURA UMN, AURA 2025, HMDKV UMN')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Custom CSS -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('js/carousel.js') }}"></script>

@include ('layouts.navbar')
</head>

<body>
    <!-- Title Section -->
    <section class="hero-section d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center hero-content">
            <img src="{{ asset('asset/logoaura.png') }}" class="logo-aura fade-in-element" data-animation="fadeInDown" style="animation-delay: 0.5s;">
            <div class="hero-text">
                <img src="{{ asset('asset/home/AuraText.png') }}" alt="AURA 2025" class="logo-text fade-in-element" data-animation="fadeInRight" style="animation-delay: 0.8s;">
                <p class="hero-description fade-in-element" style="text-align: justify; animation-delay: 1s;" data-animation="fadeInRight">
                    AURA (Artistic Unity & Reflection in Action) is an annual program initiated by the Visual Communication Design Students Association (HMDKV) at UMN. AURA 2025 is a platform that presents student expression, creativity, and identities through various art and design-based activities.
                </p>
            </div>
        </div>
        <!-- Tagline Section -->
        </div>
        <img src="{{ asset('asset/home/tagline.png') }}" alt="Tagline Image" class="tagline-title-img fade-in-element" data-animation="fadeInDown" style="animation-delay: 1s;">
        <div class="tagline-content-wrapper fade-in-element" data-animation="fadeInUp" style="animation-delay: 1s;">
            <p class="tagline-text-description" style="text-align: justify;">
                The tagline "Beyond the Clock, Creativity Unlock" captures a journey of exploration where each step beyond the limits of time opens up endless creative possibilities. 
                <br> <br>
                "Beyond the Clock" symbolizes the courage to transcend the boundaries of time whether past, present, or future reflecting a limitless, cross-dimensional exploration where creativity is no longer confined to a linear timeline. 
                <br> <br>
                Meanwhile, "Creativity Unlock" represents the act of unleashing and tapping into one’s full creative potential. AURA is designed to serve as the key that unlocks boundless innovation, empowering participants to access and bring to life ideas that may have once been hidden or overlooked.
            </p>
            <img src="{{ asset('asset/home/maskot.png') }}" alt="Mascot" class="mascot-tagline fade-in-element" data-animation="fadeInUp" style="animation-delay: 2s;">
        </div> 
 
    </section>
 <!-- Highlight Section -->
             

    <section class="highlight-section">
        <div class="highlight-background">
            
        <img src="{{ asset('asset/home/star.png') }}" alt="Stars" class="stars-decorative top-left-star fade-in-element" data-animation="fadeInLeft" style="animation-delay: 0.5s;">
        <img src="{{ asset('asset/home/star.png') }}" alt="Stars" class="stars-decorative top-right-star fade-in-element" data-animation="fadeInRight" style="animation-delay: 0.5s;">

        
        <img src="{{ asset('asset/home/highlightofaura.png') }}" alt="Highlight Title" class="highlight-title-img fade-in-element" data-animation="fadeInDown" style="animation-delay: 0s;">
        <div class="highlight-carousel ">
            <button class="carousel-arrow left-carousel-arrow fade-in-element" id="prevEvent" data-animation="fadeInLeft" style="animation-delay: 1s;">&lt;</button>

            <div class="events-container-wrapper fade-in-element" id="eventsContainerWrapper" data-animation="fadeInUp" style="animation-delay: 1s;">
                <div class="events-container" id="eventsContainer">
                    <div class="event-card active"> 
                        <div class="event-image-wrapper fade-in-element" data-animation="fadeInUp" style="animation-delay: 1s;">
                                <img src="{{ asset('asset/home/logoancient.png') }}" alt="Event 1" class="event-image">
                                <span class="event-text-overlay">Ancient Academy</span>
                            </div>
                            <a href="{{ route('ancient.view') }}">
                            <button class="btn-detail mt-3">Detail</button>
                            </a>
                    </div>
                    <div class="event-card">
                        <div class="event-image-wrapper fade-in-element" data-animation="fadeInUp" style="animation-delay: 1.3s;">
                                <img src="{{ asset('asset/home/logoartopia.png') }}" alt="Event 2" class="event-image">
                                <span class="event-text-overlay">Artopia</span>
                            </div>
                            <a href="{{ route('artopia.view') }}">
                            <button class="btn-detail mt-3" href = "">Detail</button>
                            </a>
                    </div>
                    <div class="event-card">
                        <div class="event-image-wrapper fade-in-element" data-animation="fadeInUp" style="animation-delay: 1.6s;">
                                <img src="{{ asset('asset/home/logogarden.png') }}" alt="Event 3" class="event-image">
                                <span class="event-text-overlay">Garden of Honors</span>
                            </div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalGarden" >
                            <button class="btn-detail mt-3">Detail</button>
                            </a>
                    </div>
                </div>
            </div>

            <button class="carousel-arrow right-carousel-arrow fade-in-element" id="nextEvent" data-animation="fadeInRight" style="animation-delay: 1s;">&gt;</button>
        </div>
    </div>
    </section>


    
    <!-- Timeline Section -->

    <div class="main-content-wrapper">
        <img src="{{ asset('asset/home/tiangL.png') }}" alt="Vines" class="vines left-vines fade-in-element" data-animation="fadeInLeft" style="animation-delay: 1s;">
        <img src="{{ asset('asset/home/tiangR.png') }}" alt="Vines" class="vines right-vines fade-in-element" data-animation="fadeInRight" style="animation-delay: 1s;">
        <img src="{{ asset('asset/home/timeline.png') }}" alt="Timeline Title" class="timeline-title-img fade-in-element" data-animation="fadeInDown" style="animation-delay: 0.5s;">


        <section class="timeline-section">
            <div class="timeline-background fade-in-element" data-animation="fadeIn" style="animation-delay: 2s;"></div> 

            <div id="timeline" >
                <img src="{{ asset('asset/home/timelinemaskot.png') }}" alt="Timeline Mascot" class="timeline-mascot fade-in-element" data-animation="fadeInLeft" style="animation-delay: 3.5s;">

                <ul id="dates" >
                    <li class="fade-in-element" data-animation="fadeIn" style="animation-delay: 2.3s;"><span data-hash="1900">1-16 Agustus 2025</span></li>
                    <li class="fade-in-element" data-animation="fadeIn" style="animation-delay: 2.6s;"><span data-hash="1930">1-16 Agustus 2025</span></li>
                    <li class="fade-in-element" data-animation="fadeIn" style="animation-delay: 2.9s;"><span data-hash="1944">6-10 Oktober 2025</span></li>
                    
                </ul>
                <ul id="issues" class="fade-in-element" data-animation="fadeIn" style="animation-delay: 3.5s;">
                    <li id="1900">
                        <div class="issue-content">
                            <img src="{{ asset('asset/home/logoancient.png') }}" alt="Event 1900">
                            <div class="text-content">
                                <h1>Ancient Academy</h1>
                            </div>
                        </div>
                    </li>
                    <li id="1930">
                        <div class="issue-content">
                            <img src="{{ asset('asset/home/logoartopia.png') }}" alt="Event 1900">
                            <div class="text-content">
                                <h1>Artopia</h1>
                            </div>
                        </div>
                    </li>
                    <li id="1944">
                        <div class="issue-content">
                            <img src="{{ asset('asset/home/logogarden.png') }}" alt="Event 1900">
                            <div class="text-content">
                                <h1>Garden of Honors</h1>
                            </div>
                        </div>
                    </li>
                    
                    
                </ul>
                
            </div>
        </section>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            function selectTimelineItem(targetHash) {
                $('#dates li').removeClass('selected');
                $('#dates li span').removeClass('selected');
                $('#issues li').removeClass('selected');

                $('span[data-hash="' + targetHash + '"]').addClass('selected').parent().addClass('selected');
                $('#' + targetHash).addClass('selected');
                
                var targetElement = $('#' + targetHash);
                if (targetElement.length) {
                    var issueContainer = $('#issues');
                    var newPosition = targetElement.index() * targetElement.outerHeight(true);
                    issueContainer.stop(true, true).animate({
                        scrollTop: newPosition
                    }, 800);
                }
            }

            $('#dates li span').click(function () {
                var hash = $(this).attr('data-hash');
                selectTimelineItem(hash);

                var target = $('#' + hash);
                if (target.length > 0) {
                    var index = target.index();
                    var issueHeight = target.outerHeight(true);
                    var newPosition = index * issueHeight;
                    console.log("Anda mengklik: ", hash);
                    console.log("Indeks: ", index);
                    console.log("Tinggi: ", issueHeight);
                    console.log("Gulir ke: ", newPosition);
                } else {
                    console.warn("Elemen dengan ID #" + hash + " tidak ditemukan!");
                }
            });

            $('#next').on('click', function(e) {
                e.preventDefault();
                var current = $('#dates li.selected'); 
                var next = current.next().find('span');
                if (next.length) {
                    selectTimelineItem(next.data('hash'));
                }
            });

            $('#prev').on('click', function(e) {
                e.preventDefault();
                var current = $('#dates li.selected'); 
                var prev = current.prev().find('span');
                if (prev.length) {
                    selectTimelineItem(prev.data('hash'));
                }
            });

            $('#issues').on('scroll', function () {
                var scrollTop = $(this).scrollTop();
                var issueHeight = $('#issues li').outerHeight(true);

                var index = Math.round(scrollTop / issueHeight);

                var $items = $('#issues li');
                var $dates = $('#dates li'); 

                if (index >= 0 && index < $items.length) {
                    $items.removeClass('selected');
                    $dates.removeClass('selected');
                    $dates.find('span').removeClass('selected'); 
                    $($items.get(index)).addClass('selected');
                    $($dates.get(index)).addClass('selected');
                    $($dates.get(index)).find('span').addClass('selected'); 
                }
            });
            
            $('#dates li:first-child').addClass('selected');
            $('#dates li:first-child span').addClass('selected');
            $('#issues li:first-child').addClass('selected');
        });
        </script>

        <section class="gallery-section">
            <img src="{{ asset('asset/home/GalleryText.png') }}" alt="Gallery Title" class="gallery-title-img fade-in-element" data-animation="fadeInUp" style="animation-delay: 0.5s;">
            <div class="gallery-buttons">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalEvent" class="gallery-link-card fade-in-element" data-animation="fadeInLeft" style="animation-delay: 1.5s;">
                    <div class="gallery-image-wrapper"> <img src="{{ asset('asset/logoaura.png') }}" alt="Ancient Event Thumbnail" class="gallery-card-image">
                        <div class="gallery-overlay">
                            <img src="{{ asset('asset/home/EventText.png') }}" alt="Event Text" class="overlay-text overlay-divisi">
                        </div>
                    </div>
                </a>

                <a href="#" data-bs-toggle="modal" data-bs-target="#modalDivisi" class="gallery-link-card fade-in-element" data-animation="fadeInRight" style="animation-delay: 1.5s;">
                    <div class="gallery-image-wrapper"> <img src="{{ asset('asset/logoaura.png') }}" alt="Division Event Thumbnail" class="gallery-card-image">
                        <div class="gallery-overlay">
                            <img src="{{ asset('asset/home/DivisiText.png') }}" alt="Divisi Text" class="overlay-text overlay-divisi">
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <section id = "faq" class="faq-section">
            <div class="container">
                <div class="faq-title-wrapper fade-in-element" data-animation="fadeInUp" style="animation-delay: 0.5s;">
                    <img src="{{ asset('asset/home/FAQText.png') }}" alt="FAQ Title" class="faq-title-img">
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="accordion custom-accordion" id="faqAccordion">
                            <!-- Item 1 -->
                            <div class="accordion-item fade-in-element" data-animation="fadeIn" style="animation-delay: 1s;">
                                <h2 class="accordion-header" id="faqHeadingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="false" aria-controls="faqCollapseOne">
                                        <i class="fas fa-star accordion-icon"></i>
                                        What is AURA 2025?
                                    </button>
                                </h2>
                                <div id="faqCollapseOne" class="accordion-collapse collapse" aria-labelledby="faqHeadingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        AURA (Artistic Unity &amp; Reflection in Action) is an annual program initiated by the Visual Communication Design Students Association (HMDKV) at UMN. It's a platform that presents student expression, creativity, and identities through various art and design-based activities.
                                    </div>
                                </div>
                            </div>
                            <!-- Item 2 -->
                            <div class="accordion-item fade-in-element" data-animation="fadeIn" style="animation-delay: 1.3s;">
                                <h2 class="accordion-header" id="faqHeadingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                        <i class="fas fa-users accordion-icon"></i>
                                        Who can participate in AURA events?
                                    </button>
                                </h2>
                                <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        AURA events are open to all students, particularly those interested in visual communication design, art, and creative expression. Whether you're a beginner or experienced, there's a place for everyone to showcase their creativity and learn from others.
                                    </div>
                                </div>
                            </div>
                            <!-- Item 3 -->
                            <div class="accordion-item fade-in-element" data-animation="fadeIn" style="animation-delay: 1.6s;">
                                <h2 class="accordion-header" id="faqHeadingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                                        <i class="fas fa-calendar-alt accordion-icon"></i>
                                        When will the events take place?
                                    </button>
                                </h2>
                                <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        The AURA 2025 events are scheduled throughout the academic year. Please check our timeline section above for specific dates and event schedules. Stay tuned to our official announcements for any updates or changes.
                                    </div>
                                </div>
                            </div>
                            <!-- Item 4 -->
                            <div class="accordion-item fade-in-element" data-animation="fadeIn" style="animation-delay: 1.9s;">
                                <h2 class="accordion-header" id="faqHeadingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                                        <i class="fas fa-question-circle accordion-icon"></i>
                                        How can I get involved or register?
                                    </button>
                                </h2>
                                <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        You can register for the event through our official website by accessing each event's page. Follow us on social media and check your email after registration for acceptance announcements and deadlines. Don't miss this opportunity to be part of this creative journey!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    function checkVisibility() {
        var windowHeight = $(window).height();
        var scrollPosition = $(window).scrollTop();
        var windowBottom = scrollPosition + windowHeight;

        $('.fade-in-element').each(function() {
            var elementTop = $(this).offset().top;
            var elementHeight = $(this).outerHeight();
            var elementBottom = elementTop + elementHeight;

            var offset = 100; 

            if (elementTop + offset < windowBottom) {
                $(this).addClass('is-visible');
            }
        });
    }

    checkVisibility();
    $(window).on('scroll', checkVisibility);
});
</script>

 

</body>




@include('layouts.footer')
</html>