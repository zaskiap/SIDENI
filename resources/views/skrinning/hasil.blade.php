<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Hasil Skrining - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body">
@include('partials.header',['auth'=>true])
@php
    $skor = $skrinning->skor_total;
    $hasil = $skrinning->hasil;
    if($skor >= 90){ $color='#d32f2f'; $gradient='linear-gradient(135deg,#d32f2f,#b71c1c)'; $icon='🔴'; }
    elseif($skor >= 40){ $color='#f59e0b'; $gradient='linear-gradient(135deg,#f59e0b,#d97706)'; $icon='🟡'; }
    else { $color='#16a34a'; $gradient='linear-gradient(135deg,#16a34a,#15803d)'; $icon='🟢'; }

    $rekMap = [
        'Risiko Tinggi' => [
            ['icon'=>'🏥','text'=>'Segera kunjungi fasilitas kesehatan terdekat (Puskesmas, Klinik VCT, atau RS) untuk melakukan tes HIV resmi.'],
            ['icon'=>'🧪','text'=>'Lakukan tes VCT atau PITC untuk mendapatkan kepastian status HIV.'],
            ['icon'=>'🤝','text'=>'Diskusikan kondisi Anda secara jujur dengan tenaga kesehatan. Semua informasi dijaga kerahasiaannya.'],
            ['icon'=>'🛡️','text'=>'Hindari perilaku berisiko seperti berganti pasangan tanpa kondom dan penggunaan jarum suntik bersama.'],
            ['icon'=>'💊','text'=>'Jika terkonfirmasi positif, terapi ARV tersedia gratis di layanan kesehatan pemerintah.'],
        ],
        'Risiko Sedang' => [
            ['icon'=>'🏥','text'=>'Konsultasikan hasil skrining ini dengan dokter atau tenaga kesehatan untuk evaluasi lebih lanjut.'],
            ['icon'=>'🧪','text'=>'Pertimbangkan melakukan tes HIV (VCT/PITC) untuk mendapatkan kepastian.'],
            ['icon'=>'🛡️','text'=>'Kurangi perilaku berisiko dan tingkatkan perilaku hidup sehat.'],
            ['icon'=>'📅','text'=>'Lakukan pemeriksaan kesehatan rutin setidaknya setiap 6 bulan sekali.'],
        ],
        'Risiko Rendah' => [
            ['icon'=>'✅','text'=>'Pertahankan gaya hidup sehat dan perilaku seksual yang aman.'],
            ['icon'=>'📅','text'=>'Tetap lakukan pemeriksaan kesehatan rutin secara berkala.'],
            ['icon'=>'💡','text'=>'Tingkatkan pengetahuan tentang HIV/AIDS untuk perlindungan diri yang lebih baik.'],
            ['icon'=>'🤝','text'=>'Ingat: skrining ini BUKAN pengganti tes HIV. Hanya tes laboratorium yang bisa memastikan status HIV.'],
        ],
    ];
    $rekomendasi = $rekMap[$hasil] ?? $rekMap['Risiko Rendah'];
    $MAX_SKOR = 17*10 + 4*15; // estimasi maks
    $persen = min(round(($skor/$MAX_SKOR)*100),100);
@endphp
<main class="hasil-main">
    <div class="hasil-wrap">
        {{-- DATA DIRI --}}
        <div class="hasil-card">
            <div class="hasil-card-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                DATA DIRI
            </div>
            <div class="hasil-profil-grid">
                <div class="hasil-profil-item"><div class="hasil-profil-label">NAMA</div><div class="hasil-profil-val">{{ $user->nama ?: $user->name }}</div></div>
                <div class="hasil-profil-item"><div class="hasil-profil-label">JENIS KELAMIN</div><div class="hasil-profil-val">{{ $user->jenis_kelamin ?: '-' }}</div></div>
                <div class="hasil-profil-item"><div class="hasil-profil-label">TANGGAL SKRINNING</div><div class="hasil-profil-val">{{ $skrinning->tanggal->translatedFormat('d F Y') }}</div></div>
            </div>
        </div>

        {{-- HASIL ANALISIS --}}
        <div class="hasil-card">
            <div class="hasil-card-title">HASIL ANALISIS</div>
            <div class="hasil-skor-wrap">
                <div class="hasil-skor-circle" style="background:{{ $gradient }}">
                    <div class="hasil-skor-num">{{ $skor }}</div>
                    <div class="hasil-skor-label">SKOR</div>
                </div>
                <div class="hasil-skor-info">
                    <div class="hasil-skor-status" style="color:{{ $color }}">{{ $hasil }}</div>
                    <div class="hasil-skor-breakdown">
                        <span class="skor-chip"><span class="skor-dot" style="background:#d32f2f"></span>Skor Gejala: <strong>{{ $skrinning->skor_gejala }}</strong></span>
                        <span class="skor-chip"><span class="skor-dot" style="background:#f59e0b"></span>Faktor Risiko: <strong>{{ $skrinning->skor_risiko }}</strong></span>
                        <span class="skor-chip"><span class="skor-dot" style="background:{{ $color }}"></span>Total: <strong>{{ $skor }}/{{ $MAX_SKOR }}</strong></span>
                    </div>
                    <div class="hasil-progress-wrap">
                        <div class="hasil-progress-label"><span>0</span><span>RENDAH (&lt;40) · SEDANG (40–89) · TINGGI (≥90)</span><span>{{ $MAX_SKOR }}</span></div>
                        <div class="hasil-progress-bg"><div class="hasil-progress-fill" id="progressFill" style="width:0%;background:{{ $gradient }}"></div></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- GEJALA & RISIKO --}}
        <div class="hasil-card">
            <div class="hasil-card-title">GEJALA YANG DILAPORKAN</div>
            <div class="hasil-tag-list">
                @forelse($skrinning->gejala_dipilih as $g)
                    <span class="hasil-tag hasil-tag-gejala">{{ $g }}</span>
                @empty
                    <span style="font-size:13px;color:#bbb">Tidak ada gejala yang dipilih</span>
                @endforelse
            </div>
            <div class="hasil-card-title" style="margin-top:18px">FAKTOR RISIKO PROFIL</div>
            <div class="hasil-tag-list">
                @forelse($user->faktor_aktif as $col => $label)
                    <span class="hasil-tag hasil-tag-risiko">{{ $label }}</span>
                @empty
                    <span style="font-size:13px;color:#bbb">Tidak ada faktor risiko yang tercatat</span>
                @endforelse
            </div>
        </div>

        {{-- REKOMENDASI --}}
        <div class="hasil-card">
            <div class="hasil-card-title">REKOMENDASI TINDAKAN</div>
            <div class="hasil-rek-list">
                @foreach($rekomendasi as $r)
                <div class="hasil-rek-item"><span class="hasil-rek-icon">{{ $r['icon'] }}</span><span>{{ $r['text'] }}</span></div>
                @endforeach
            </div>
            <div class="hasil-disclaimer">Hasil skrining ini <strong>BUKAN DIAGNOSIS MEDIS</strong> dan tidak menggantikan pemeriksaan laboratorium. Hanya tes HIV (VCT/PITC) yang dapat memastikan status HIV secara akurat.</div>
        </div>

        <div class="hasil-actions">
            <a href="{{ route('skrinning') }}" class="hasil-btn hasil-btn-primer">Skrining Ulang!</a>
            <a href="{{ route('beranda') }}" class="hasil-btn hasil-btn-sekunder">Ke Beranda</a>
        </div>
    </div>
</main>
@include('partials.footer')
@include('partials.logout-modal')
<script>
setTimeout(()=>{const f=document.getElementById('progressFill');if(f)f.style.width='{{ $persen }}%';},400);
</script>
@livewireScripts
</body>
</html>
