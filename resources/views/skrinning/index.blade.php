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
        <div class="breadcrumb-bar">
            <a href="{{ route('beranda') }}" class="bc-link">Beranda</a>
            <span class="bc-sep">›</span><span>Skrining</span>
        </div>
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
                    @foreach(['g_luka_yang_lama_sembuh'=>'Luka yang lama sembuh','g_turun_bb_kurang_3kg'=>'Penurunan Berat Badan kurang dari 3 kg Tanpa Sebab Jelas'] as $col=>$label)
                    <label class="gejala-item"><input type="checkbox" name="{{ $col }}" value="1"><span>{{ $label }}</span></label>
                    @endforeach
                </div>
            </div>
            <div class="fase-card">
                <div class="fase-header"><span class="fase-badge">3</span><div><h2 class="fase-title">Pilih Gejala Fase Ketiga yang Dirasakan</h2><p class="fase-sub">Gejala Fase Ketiga</p></div></div>
                <div class="gejala-grid">
                    @foreach(['g_jamur_mulut'=>'Infeksi jamur pada mulut','g_infeksi_bakteri_berat'=>'Infeksi bakteri berat seperti pneumonia, toksosplasmosis, meningitis, kanker','g_gangguan_pernafasan'=>'Gangguan sistem pernafasan, sesak, dan batuk lebih dari 3 minggu','g_radang_tenggorokan_3'=>'Radang tenggorokan lebih dari 3 minggu','g_turun_bb_lebih_3kg'=>'Penurunan Berat Badan drastis lebih dari 3 kg Tanpa Sebab Jelas','g_diare_1_bulan'=>'Diare lebih dari 1 bulan tanpa sebab yang jelas'] as $col=>$label)
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