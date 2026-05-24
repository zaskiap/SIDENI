<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Skrining - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body">
@include('partials.header',['auth'=>true])
<main class="skrinning-main">
    <div class="skrinning-wrap">
        <a href="{{ route('beranda') }}" class="page-back">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,8 8,12 12,16"/><line x1="16" y1="12" x2="8" y2="12"/></svg>
            Skrining
        </a>
        <form method="POST" action="{{ route('skrinning.simpan') }}" id="skrinningForm">
            @csrf
            <div class="fase-card">
                <div class="fase-header"><span class="fase-badge">1</span><div><h2 class="fase-title">Pilih Gejala Fase Pertama yang Dirasakan</h2><p class="fase-sub">Gejala Fase Pertama</p></div></div>
                <div class="gejala-grid">
                    @foreach(['g_sariawan'=>'Sariawan','g_sakit_kepala'=>'Sakit kepala','g_nyeri_otot'=>'Nyeri otot','g_radang_tenggorokan'=>'Mengalami radang tenggorokan','g_hilang_nafsu_makan'=>'Hilangnya nafsu makan','g_bengkak_kelenjar_leher'=>'Pembengkakan kelenjar getah bening di leher','g_ruam_tubuh'=>'Ruam-ruam pada tubuh','g_badan_lelah'=>'Badan mulai lelah','g_bengkak_kelenjar_ketiak'=>'Pembengkakan kelenjar getah bening di ketiak'] as $col=>$label)
                    <label class="gejala-item"><input type="checkbox" name="{{ $col }}" value="1"><span>{{ $label }}</span></label>
                    @endforeach
                </div>
            </div>
            <div class="fase-card">
                <div class="fase-header"><span class="fase-badge">2</span><div><h2 class="fase-title">Pilih Gejala Fase Kedua yang Dirasakan</h2><p class="fase-sub">Gejala Fase Kedua</p></div></div>
                <div class="gejala-grid">
                    @foreach(['g_kurang_sel_darah_putih'=>'Berkurangnya sel darah putih secara drastis','g_turun_bb_kurang_10'=>'Penurunan berat badan kurang dari 10% tanpa penyebab yang jelas'] as $col=>$label)
                    <label class="gejala-item"><input type="checkbox" name="{{ $col }}" value="1"><span>{{ $label }}</span></label>
                    @endforeach
                </div>
            </div>
            <div class="fase-card">
                <div class="fase-header"><span class="fase-badge">3</span><div><h2 class="fase-title">Pilih Gejala Fase Ketiga yang Dirasakan</h2><p class="fase-sub">Gejala Fase Ketiga</p></div></div>
                <div class="gejala-grid">
                    @foreach(['g_jamur_mulut'=>'Infeksi jamur pada mulut','g_infeksi_bakteri_berat'=>'Infeksi bakteri berat seperti pneumonia, toksosplasmosis, meningitis, kanker','g_tbc_paru'=>'Tuberkulosis paru','g_jamur_tenggorokan'=>'Infeksi jamur pada tenggorokan','g_turun_bb_lebih_10'=>'Penurunan berat badan drastis lebih dari 10% tanpa penyebab yang jelas','g_diare_1_bulan'=>'Diare lebih dari 1 bulan tanpa sebab yang jelas'] as $col=>$label)
                    <label class="gejala-item"><input type="checkbox" name="{{ $col }}" value="1"><span>{{ $label }}</span></label>
                    @endforeach
                </div>
            </div>
            <div style="text-align:center;padding:24px 0 40px;">
                <button type="submit" class="btn-mulai-analisis">Mulai Analisis!</button>
            </div>
        </form>
    </div>
</main>
@include('partials.footer')
@include('partials.logout-modal')
@livewireScripts
</body>
</html>