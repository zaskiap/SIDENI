<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Beranda Admin - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="admin-body">
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-content">
        @include('admin.partials.topbar')
        <main class="admin-main">
            <h1 class="admin-page-title">Beranda</h1>

            {{-- STAT CARDS --}}
            <div class="admin-stat-grid">
                <div class="admin-stat-card">
                    <div class="admin-stat-label">TOTAL SKRINING</div>
                    <div class="admin-stat-val">{{ $totalSkrining }}</div>
                    <div class="admin-stat-icon">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#d32f2f" stroke-width="1.5" opacity="0.4"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
                    </div>
                </div>
                <div class="admin-stat-card">
                    <div class="admin-stat-label">RISIKO TINGGI</div>
                    <div class="admin-stat-val">{{ $risikoTinggi }}</div>
                    <div class="admin-stat-icon">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#d32f2f" stroke-width="1.5" opacity="0.4"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                </div>
            </div>

            {{-- CHARTS --}}
            <div class="admin-chart-grid">
                <div class="admin-chart-card">
                    <div class="admin-chart-title">PRESENTASE FAKTOR RISIKO</div>
                    <canvas id="chartFaktor" height="160"></canvas>
                </div>
                <div class="admin-chart-card">
                    <div class="admin-chart-title">PRESENTASE JENIS KELAMIN</div>
                    <canvas id="chartKelamin" height="160"></canvas>
                </div>
            </div>

            {{-- TOP GEJALA --}}
            <div class="admin-gejala-card">
                <div class="admin-chart-title">👑 GEJALA HIV/AIDS YANG PALING BANYAK DIDERITA</div>
                <ol class="admin-gejala-list">
                    @foreach($topGejala as $label => $count)
                    <li><span class="admin-gejala-label">{{ $label }}</span><span class="admin-gejala-count">{{ $count }} kasus</span></li>
                    @endforeach
                </ol>
            </div>
        </main>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.partials.logout-modal')
<script>
// Chart Faktor Risiko
new Chart(document.getElementById('chartFaktor'),{
    type:'bar',
    data:{
        labels:{!! json_encode(array_keys($faktorData)) !!},
        datasets:[{
            data:{!! json_encode(array_values($faktorData)) !!},
            backgroundColor:['#3b82f6','#14b8a6','#f59e0b','#8b5cf6'],
            borderRadius:4,
        }]
    },
    options:{
        indexAxis:'y',
        plugins:{legend:{display:false}},
        scales:{x:{grid:{color:'#f0f0f0'},ticks:{font:{size:11}}},y:{ticks:{font:{size:11}}}},
    }
});
// Chart Jenis Kelamin
new Chart(document.getElementById('chartKelamin'),{
    type:'doughnut',
    data:{
        labels:['Laki-laki','Perempuan'],
        datasets:[{
            data:[{{ $lakiLaki }},{{ $perempuan }}],
            backgroundColor:['#3b82f6','#f472b6'],
            borderWidth:0,
        }]
    },
    options:{
        plugins:{legend:{position:'bottom',labels:{font:{size:11},boxWidth:12}}}
    }
});
</script>
</body>
</html>
