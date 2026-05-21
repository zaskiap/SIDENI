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
        <a href="{{ route('beranda') }}" class="page-back">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,8 8,12 12,16"/><line x1="16" y1="12" x2="8" y2="12"/></svg>
            Riwayat Skrining
        </a>

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
                <div class="riwayat-item">
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
