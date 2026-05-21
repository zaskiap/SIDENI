<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Cetak Laporan - SIDENI</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#f5f5f5; }
        .cetak-wrap { background:#fff; max-width:900px; margin:0 auto; padding:48px 40px; min-height:100vh; }
        .cetak-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:6px; }
        .cetak-title { font-size:18px; font-weight:800; color:#1a1a1a; letter-spacing:0.5px; }
        .cetak-bulan { font-size:12px; color:#888; }
        .cetak-desc { font-size:12px; color:#666; margin-bottom:28px; }
        table { width:100%; border-collapse:collapse; font-size:12px; }
        th { padding:10px 12px; text-align:center; font-weight:700; border-bottom:2px solid #e0e0e0; color:#8b0000; white-space:nowrap; }
        td { padding:9px 12px; text-align:center; border-bottom:1px solid #f0f0f0; color:#333; }
        tr:nth-child(even) td { background:#fafafa; }
        .cetak-footer { margin-top:36px; text-align:right; font-size:12px; color:#888; }
        @media print {
            body { background:#fff; }
            .cetak-wrap { padding:20px; box-shadow:none; }
        }
    </style>
</head>
<body>
    <div class="cetak-wrap">
        <div class="cetak-header">
            <div class="cetak-title">PELAPORAN</div>
            <div class="cetak-bulan">Dicetak pada Bulan: {{ ucfirst($namaBulan) }}</div>
        </div>
        <p class="cetak-desc">
            Data dalam tabel dibawah ini merupakan data hasil skrining yang telah dilakukan oleh pengguna
        </p>

        <table>
            <thead>
                <tr>
                    <th>ID Pengguna</th>
                    <th>Nama</th>
                    <th style="color:#8b0000">Jenis Kelamin</th>
                    <th style="color:#8b0000">Email</th>
                    <th>ID Riwayat</th>
                    <th>Tanggal</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $s)
                <tr>
                    <td>{{ $s->user?->id ?? '-' }}</td>
                    <td>{{ $s->user?->nama ?: ($s->user?->name ?? '-') }}</td>
                    <td>{{ $s->user?->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $s->user?->email ?? '-' }}</td>
                    <td>{{ $s->id_skrinning }}</td>
                    <td>{{ $s->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $s->hasil }}</td>
                </tr>
                @empty
                <tr><td colspan="7" style="padding:20px;color:#aaa">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="cetak-footer">
            Dicetak Oleh: {{ $admin['name'] ?? 'Admin' }}
        </div>
    </div>
    <script>
        // Auto print saat halaman dibuka
        window.addEventListener('load', function() {
            setTimeout(function() { window.print(); }, 500);
        });
    </script>
</body>
</html>
