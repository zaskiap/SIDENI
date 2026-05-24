<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIDENI - Sistem Deteksi Dini HIV/AIDS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body">

    @include('partials.header')

    <main class="homepage-main">
        <div class="homepage-content">
            <!-- TEKS KIRI -->
            <div class="homepage-text" data-animate="fadeInLeft">
                <h1 class="homepage-headline">
                    Cegah dan Kenali HIV/<br>AIDS Sejak Dini dengan<br>
                    <span class="text-red">SIDENI!</span>
                </h1>
                <p class="homepage-tagline">Stay Informed, Stay Safe!</p>
            </div>

            <!-- ILUSTRASI KANAN -->
            <div class="homepage-illustration" data-animate="fadeInRight">
                <img src="{{ asset('images/gambar-homepage-removebg-preview.png') }}"
                     alt="Dokter SIDENI"
                     class="homepage-img" />
            </div>
        </div>
    </main>

    @include('partials.footer')

    @livewireScripts
</body>
</html>
