<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{ $berita->judul }} - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>

<body class="sideni-body">
    @include('partials.header',['auth'=>true])
    <main class="berita-detail-main">
        <div class="berita-detail-wrap">
            <div class="berita-detail-content">
                <div class="breadcrumb-bar">
                    <a href="{{ route('beranda') }}" class="bc-link">Beranda</a>
                    <span class="bc-sep">›</span>
                    <a href="{{ route('berita') }}" class="bc-link">Berita</a>
                    <span class="bc-sep">›</span>
                    <span>{{ Str::limit($berita->judul,40) }}</span>
                </div>

                <div class="berita-detail-thumb">
                    <img src="{{ $berita->thumbnail_url }}" alt="{{ $berita->judul }}" onerror="this.src='{{ asset('images/banner-berita.png') }}'">
                </div>

                <div class="berita-detail-meta">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    {{ $berita->tanggal->translatedFormat('d M Y') }}
                    <span style="margin-left:12px;color:#888;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        </svg>
                        {{ $berita->kategori }}
                    </span>
                </div>

                <h1 class="berita-detail-title">{{ $berita->judul }}</h1>
                <div class="berita-detail-isi">{!! $berita->isi !!}</div>
            </div>

            </aside>
        </div>
    </main>
    @include('partials.footer')
    @include('partials.logout-modal')
    @livewireScripts
</body>

</html>