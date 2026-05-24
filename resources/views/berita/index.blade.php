<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
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
                <div class="breadcrumb-bar">
                    <a href="{{ route('beranda') }}" class="bc-link">Beranda</a>
                    <span class="bc-sep">›</span><span>Berita</span>
                </div>

                <div class="berita-page-header">
                    <h1>Berita <span class="text-red">HIV & AIDS</span> Terkini Untuk Anda</h1>
                    <p>Berita Terbaru Seputar Kesehatan & Teknologi</p>
                    <p>Medis Terkait Penyakit HIV/ AIDS</p>
                </div>

                <div class="berita-grid">
                    @foreach($berita as $b)
                    <a href="{{ route('berita.show',$b) }}" class="berita-grid-card">
                        <span class="berita-badge-kategori {{ strtolower($b->kategori) }}">{{ $b->kategori }}</span>
                        <h3 class="berita-grid-title">{{ Str::limit($b->judul,45) }}</h3>
                        <p class="berita-grid-tanggal">{{ $b->tanggal->translatedFormat('d F Y') }}</p>
                        <div class="berita-grid-thumb">
                            <img src="{{ $b->thumbnail_url }}" alt="{{ $b->judul }}" onerror="this.src='{{ asset('images/banner-berita.png') }}'">

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