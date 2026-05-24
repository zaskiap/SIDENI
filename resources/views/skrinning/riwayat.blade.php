<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Riwayat Skrining - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body">
@include('partials.header',['auth'=>true])
<main class="riwayat-main">
    <div class="riwayat-wrap">
        <div class="breadcrumb-bar">
            <a href="{{ route('beranda') }}" class="bc-link">Beranda</a>
            <span class="bc-sep">›</span><span>Riwayat Skrining</span>
        </div>

        {{-- PROFIL PENGGUNA --}}
        <div class="riwayat-card">
            <div class="riwayat-section-label">PROFIL PENGGUNA</div>
            <div class="riwayat-profil">
                <div class="riwayat-avatar">{{ strtoupper(substr($user->nama ?: $user->name,0,1)) }}</div>
                <div>
                    <div class="riwayat-nama">{{ $user->nama ?: $user->name }}</div>
                    <div class="riwayat-kelamin">{{ $user->jenis_kelamin ?: '-' }}</div>
                </div>
            </div>
        </div>

        {{-- FAKTOR RISIKO --}}
        <div class="riwayat-card">
            <div class="riwayat-section-label">FAKTOR RISIKO</div>
            @if(count($user->faktor_aktif))
                <ul class="riwayat-risiko-list">
                    @foreach($user->faktor_aktif as $label)
                        <li>{{ $label }}</li>
                    @endforeach
                </ul>
            @else
                <p style="font-size:13px;color:#aaa;padding:8px 0">Belum ada faktor risiko yang tercatat.</p>
            @endif
        </div>

        {{-- RIWAYAT SKRINING --}}
        <div class="riwayat-card">
            <div class="riwayat-section-label">RIWAYAT SKRINING</div>
            @forelse($riwayat as $r)
                @php
                    if($r->hasil==='Risiko Tinggi') $rc='#d32f2f';
                    elseif($r->hasil==='Risiko Sedang') $rc='#f59e0b';
                    else $rc='#16a34a';
                @endphp
                <a href="{{ route('hasil.detail', $r->id_skrinning) }}" style="text-decoration:none;color:inherit;display:block">
                <div class="riwayat-item" style="cursor:pointer">
                    <div class="riwayat-item-tanggal">{{ $r->tanggal->translatedFormat('d F Y') }}</div>
                    <div class="riwayat-item-hasil" style="color:{{ $rc }};font-weight:700">{{ $r->hasil }}</div>
                    <div class="riwayat-item-skor">Skor: {{ $r->skor_total }}</div>
                </div>
            @empty
                <p style="font-size:13px;color:#aaa;padding:8px 0">Belum ada riwayat skrining.</p>
            @endforelse
        </div>
    </div>
</main>
@include('partials.footer')
@include('partials.logout-modal')
@livewireScripts
</body>
</html>
