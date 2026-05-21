<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Berita - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body">
@include('partials.header',['auth'=>true])
<main>
    <div class="berita-hero">
        <img src="{{ asset('images/banner-berita.png') }}" alt="Berita" class="berita-hero-img">
    </div>
    <div class="berita-main">
        <div class="berita-wrap">
            <a href="{{ route('beranda') }}" class="page-back">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,8 8,12 12,16"/><line x1="16" y1="12" x2="8" y2="12"/></svg>
            </a>
            <div class="breadcrumb-bar">
                <a href="{{ route('beranda') }}" class="bc-link">Beranda</a>
                <span class="bc-sep">›</span><span>Berita</span>
            </div>

            <div class="berita-page-header">
                <h1>Berita <span class="text-red">HIV & AIDS</span> Terkini Untuk Anda</h1>
                <p>Berita Terbaru Seputar Kesehatan & Teknologi</p>
                <p>Medis Dari V-Kes Untuk Hidup Lebih Sehat</p>
            </div>

            <div class="berita-grid">
                @foreach($berita as $b)
                <a href="{{ route('berita.show',$b) }}" class="berita-grid-card">
                    <span class="berita-badge-kategori {{ strtolower($b->kategori) }}">{{ $b->kategori }}</span>
                    <h3 class="berita-grid-title">{{ Str::limit($b->judul,45) }}</h3>
                    <p class="berita-grid-tanggal">{{ $b->tanggal->translatedFormat('d F Y') }}</p>
                    <div class="berita-grid-thumb">
                        <img src="{{ $b->thumbnail_url }}" alt="{{ $b->judul }}" onerror="this.src='{{ asset('images/banner-berita.png') }}'">
                        <span class="berita-grid-arrow">↗</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</main>
@include('partials.footer')
@include('partials.logout-modal')
@livewireScripts
</body>
</html>
