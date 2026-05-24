<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Beranda - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>

<body class="sideni-body">
    @include('partials.header',['auth'=>true])
    <main class="beranda-main">
        <div class="beranda-card" data-animate="fadeInUp">
            <span class="beranda-badge">ALAT SKRINING NON DIAGNOSTIK</span>
            <div class="beranda-headline">
                <h2 class="beranda-sub">DETEKSI DINI</h2>
                <h1 class="beranda-title">HIV/AIDS</h1>
            </div>
            <p class="beranda-desc">
                SIDENI dapat membantu mengidentifikasi risiko infeksi HIV berdasarkan gejala dan faktor risiko.<br>
                Hasil skrining yang ditampilkan <strong class="text-red">BUKAN DIAGNOSIS MEDIS</strong>
                dan tidak menggantikan pemeriksaan laboratorium.
            </p>
            <div class="beranda-warn">
                <span class="warn-icon">⚠</span>
                <span>PERINGATAN: Hanya tes HIV (VCT/PITC) yang dapat memastikan status HIV secara akurat!
                    Konsultasikan dengan dokter untuk diagnosis resmi.</span>
            </div>
            <a href="{{ route('skrinning') }}" class="beranda-btn">Skrinning Sekarang!</a>
        </div>
    </main>
    @include('partials.footer')
    @include('partials.logout-modal')
    @livewireScripts
</body>

</html>