<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Detail Berita - SIDENI Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="admin-body">
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-content">
        @include('admin.partials.topbar')
        <main class="admin-main">
            <div class="admin-page-header">
                <div class="admin-breadcrumb">
                    <a href="{{ route('admin.berita.index') }}" class="admin-bc-link">Berita</a>
                    <span class="admin-bc-sep">›</span>
                    <span>Detail Berita</span>
                </div>
                <div style="display:flex;gap:8px">
                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn-admin-edit">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Berita
                    </a>
                    <form method="POST" action="{{ route('admin.berita.destroy', $berita->id) }}" onsubmit="return confirm('Hapus berita ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin-hapus">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19,6l-1,14a2,2,0,0,1-2,2H8a2,2,0,0,1-2-2L5,6"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

            <div class="admin-show-card">
                {{-- THUMBNAIL --}}
                @if($berita->thumbnail)
                <div class="admin-show-thumb">
                    <img src="{{ $berita->thumbnail_url }}" alt="{{ $berita->judul }}">
                </div>
                @endif

                {{-- META --}}
                <div class="admin-show-meta">
                    <span class="berita-badge-kategori {{ strtolower($berita->kategori) }}">{{ $berita->kategori }}</span>
                    <span class="admin-show-meta-status">Dipublikasi</span>
                    <span class="admin-show-meta-tgl">{{ $berita->tanggal->translatedFormat('d F Y') }}</span>
                    @if($berita->admin)
                        <span class="admin-show-meta-author">Oleh: {{ $berita->admin->name }}</span>
                    @endif
                </div>

                {{-- JUDUL --}}
                <h2 class="admin-show-judul">{{ $berita->judul }}</h2>

                {{-- ISI --}}
                <div class="admin-show-label">ISI BERITA</div>
                <div class="admin-show-isi">{!! $berita->isi !!}</div>
            </div>
        </main>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.partials.logout-modal')
</body>
</html>
