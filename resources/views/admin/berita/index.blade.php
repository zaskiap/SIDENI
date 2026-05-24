<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Berita Admin - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="admin-body">
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-content">
        @include('admin.partials.topbar')
        <main class="admin-main">
           <div class="admin-page-header" style="align-items: center;">
    <h1 class="admin-page-title" style="margin:0; line-height:1;">Berita</h1>
                <a href="{{ route('admin.berita.create') }}" class="btn-admin-add">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Berita
                </a>
            </div>

            @if(session('success'))
            <div class="admin-alert admin-alert-success">
                {{ session('success') }}
                <button onclick="this.parentElement.remove()" class="admin-alert-close">×</button>
            </div>
            @endif

            @if(session('error'))
            <div class="admin-alert admin-alert-error">
                {{ session('error') }}
                <button onclick="this.parentElement.remove()" class="admin-alert-close">×</button>
            </div>
            @endif

            {{-- SEARCH --}}
            <form method="GET" action="{{ route('admin.berita.index') }}" class="admin-search-form">
                <span style="font-size:13px;color:#555">Cari:</span>
                <input type="text" name="cari" value="{{ $q }}" class="admin-search-input" placeholder="Cari judul berita...">
                <button type="submit" class="btn-admin-cari">Cari</button>
                @if($q)
                    <a href="{{ route('admin.berita.index') }}" class="btn-admin-reset-cari">Reset</a>
                @endif
            </form>

            {{-- LIST BERITA --}}
            <div class="admin-berita-list">
                @forelse($berita as $b)
                <div class="admin-berita-item">
                    <div class="admin-berita-item-head">
                        <h3 class="admin-berita-judul">{{ $b->judul }}</h3>
                        <span class="berita-badge-kategori {{ strtolower($b->kategori) }}">{{ $b->kategori }}</span>
                    </div>
                    <p class="admin-berita-desc">{{ $b->isi_singkat }}</p>
                    <div class="admin-berita-item-foot">
                        <span class="admin-berita-tgl">{{ $b->tanggal->translatedFormat('d F Y') }}</span>
                        <div class="admin-berita-actions">
                            <a href="{{ route('admin.berita.show', $b->id) }}" class="btn-admin-lihat">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Lihat
                            </a>
                            <a href="{{ route('admin.berita.edit', $b->id) }}" class="btn-admin-edit">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.berita.destroy', $b->id) }}" style="display:inline" onsubmit="return confirm('Apaka anda yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-admin-hapus">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19,6l-1,14a2,2,0,0,1-2,2H8a2,2,0,0,1-2-2L5,6"/><path d="M10,11v6"/><path d="M14,11v6"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="admin-empty-state">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                    <p>{{ $q ? 'Tidak ada berita dengan kata kunci "'.$q.'"' : 'Belum ada berita.' }}</p>
                </div>
                @endforelse
            </div>
        </main>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.partials.logout-modal')
</body>
</html>
