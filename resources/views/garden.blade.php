<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AURA 2025 - Garden of Honor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/garden.css') }}" rel="stylesheet">
</head>

@include('layouts.navbar')

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
    </div>
   
    <div class="garden-head">
        <img src="{{ asset('asset/garden/garden.png') }}" alt="Garden Head" class="garden-image">
    </div>
    <div class="content">
        <div class="content-box">
            <h2 class="section-title">About</h2>
            <h2 class="section-title with-underline">Garden of Honors</h2>
            <p class="section-description about">
                Garden of Honors is the closing event of AURA 2025, dedicated to showcasing the outcomes of the Ancient Academy workshops. features curated works created by school students who participated in the workshops held in Tangerang and Sukabumi.                
            </p>
            <p></p>
            <p class="section-description">
                The exhibition not only displays the final artworks but also highlights the process and stories behind them capturing moments of learning, collaboration, and creativity between the university students and their younger peers.
            </p>
            <p></p>
            <p class="section-description">
                Designed with a sense of warmth and gratitude, Garden of Honors serves as a reflective space to appreciate how knowledge-sharing and empathy can shape meaningful artistic growth.
            </p>
            </p>
        </div>
        <div class="location-title-container">
            <img src="{{ asset('asset/garden/location&date.png') }}" alt="Location Title" class="location-image">
        </div>
        <div class="content-box">
            <p class="section-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel sapien vel nulla tempor consectetur. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi morbi tempus iacullis urna id volutpat lacus laoreet non curabitur gravida. Donec sollicitudin molestie malesuada. Proin eget tortor risus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
            </p>
        </div>
    </div>
</body>

@include('layouts.footer')

</html>