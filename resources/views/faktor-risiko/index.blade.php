<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Faktor Risiko - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body">
@include('partials.header',['auth'=>true])
<main class="fr-main">
    <div class="fr-wrap">
        <a href="{{ route('beranda') }}" class="page-back">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,8 8,12 12,16"/><line x1="16" y1="12" x2="8" y2="12"/></svg>
            Faktor risiko
        </a>
        <div class="breadcrumb-bar">
            <a href="{{ route('beranda') }}" class="bc-link">Beranda</a>
            <span class="bc-sep">›</span><span>Faktor Risiko</span>
        </div>

        {{-- HEADER CARD --}}
        <div class="fr-header-card">
            <span class="fr-header-icon">⚠️</span>
            <div>
                <h1 class="fr-header-title">Kelola Faktor Risiko</h1>
                <p class="fr-header-desc">Pilih faktor risiko yang sesuai dengan kondisi Anda. Data ini akan digunakan dalam perhitungan skor skrining HIV/AIDS.</p>
            </div>
        </div>

        {{-- STATUS CARD --}}
        <div class="fr-status-card">
            <span class="fr-status-label">Faktor risiko aktif saat ini</span>
            @php $aktif = count($user->faktor_aktif); @endphp
            <span class="fr-status-count {{ $aktif > 0 ? 'has-risiko' : '' }}">
                {{ $aktif > 0 ? $aktif.' faktor risiko aktif' : 'Tidak ada faktor risiko aktif' }}
            </span>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- PILIH FAKTOR RISIKO --}}
        <div class="fr-card">
            <div class="fr-card-head">
                <div class="fr-card-title-wrap">
                    <span class="fr-card-icon">📋</span>
                    <span class="fr-card-title">Pilih Faktor Risiko</span>
                    <span class="fr-badge" id="frBadge">{{ count($user->faktor_aktif) }} dipilih</span>
                </div>
            </div>
            <p class="fr-card-desc">Centang faktor risiko yang berlaku. Faktor yang sudah tersimpan <strong>tidak dapat dihapus</strong>.</p>

            <form method="POST" action="{{ route('faktor-risiko.update') }}">
                @csrf
                <div class="fr-list">
                    @foreach(\App\Models\User::faktorMap() as $col => $label)
                    @php $saved = $user->$col; @endphp
                    <label class="fr-item {{ $saved ? 'fr-item-saved' : '' }}">
                        <input type="checkbox" name="{{ $col }}" value="1"
                            {{ $saved ? 'checked disabled' : '' }}
                            onchange="updateFrBadge()">
                        <span class="fr-item-text">{{ $label }}</span>
                        @if($saved)<span class="fr-item-locked">🔒 Tersimpan</span>@endif
                    </label>
                    @endforeach
                </div>
                <div class="fr-actions">
                    <button type="submit" class="btn-fr-save">💾 Simpan Perubahan</button>
                    <button type="button" class="btn-fr-reset" onclick="resetUnsaved()">↺ Reset</button>
                </div>
            </form>
        </div>

        {{-- FAKTOR RISIKO TERSIMPAN --}}
        <div class="fr-card">
            <div class="fr-card-head">
                <span class="fr-card-icon">🕓</span>
                <span class="fr-card-title">Faktor Risiko Tersimpan</span>
            </div>
            <p class="fr-card-desc">Daftar faktor risiko yang saat ini tercatat di profil Anda.</p>
            @if(count($user->faktor_aktif))
                <div class="fr-saved-list">
                    @foreach($user->faktor_aktif as $label)
                    <div class="fr-saved-item">
                        <span class="fr-saved-dot"></span>
                        <span>{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
            @else
                <p style="font-size:13px;color:#aaa;padding:8px 0">Belum ada faktor risiko yang tersimpan.</p>
            @endif
        </div>

        <div class="fr-back-row">
            <a href="{{ route('beranda') }}" class="btn-fr-back">← Kembali ke Beranda</a>
        </div>
    </div>
</main>
@include('partials.footer')
@include('partials.logout-modal')
<script>
function updateFrBadge(){
    const all = document.querySelectorAll('.fr-list input[type=checkbox]');
    const checked = [...all].filter(c=>c.checked).length;
    const badge = document.getElementById('frBadge');
    if(badge) badge.textContent = checked+' dipilih';
}
function resetUnsaved(){
    document.querySelectorAll('.fr-list input[type=checkbox]:not([disabled])').forEach(c=>c.checked=false);
    updateFrBadge();
}
</script>
@livewireScripts
</body>
</html>
