<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Pelaporan - SIDENI Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="admin-body">
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-content">
        @include('admin.partials.topbar')
        <main class="admin-main">
            <h1 class="admin-page-title">Pelaporan</h1><br>
            <p style="font-size:13px;color:#666;margin-bottom:20px">
                Data dalam tabel dibawah ini merupakan data hasil skrining yang telah dilakukan oleh pengguna
            </p>

            <div class="admin-table-card">
                <div class="admin-table-title" style="padding:14px 16px;font-size:13px;font-weight:700;color:#8b0000;border-bottom:1px solid #f0f0f0">
                    Data Hasil Skrinning
                </div>

                {{-- CONTROLS --}}
                <div style="padding:12px 16px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
                    {{-- Show entries --}}
                    <form method="GET" action="{{ route('admin.pelaporan') }}" id="showForm"
                          style="display:flex;align-items:center;gap:8px">
                        <span style="font-size:12px;color:#555">Show</span>
                        <select name="per_page" class="admin-select-sm"
                                onchange="document.getElementById('showForm').submit()">
                            @foreach([10,25,50,100] as $n)
                                <option value="{{ $n }}" {{ $perPage==$n?'selected':'' }}>{{ $n }}</option>
                            @endforeach
                        </select>
                        <span style="font-size:12px;color:#555">entries</span>
                        @if($bulan !== '')<input type="hidden" name="bulan" value="{{ $bulan }}">@endif
                    </form>

                    {{-- Filter Bulan --}}
                    <form method="GET" action="{{ route('admin.pelaporan') }}" id="bulanForm"
                          style="display:flex;align-items:center;gap:8px">
                        <select name="bulan" class="admin-select-bulan"
                                onchange="document.getElementById('bulanForm').submit()">
                            <option value="">Pilih Bulan</option>
                            @foreach(range(1,12) as $m)
                                @php $nm = \Carbon\Carbon::create()->month($m)->locale('id')->monthName; @endphp
                                <option value="{{ $m }}" {{ $bulan==$m ? 'selected' : '' }}>
                                    {{ ucfirst($nm) }}
                                </option>
                            @endforeach
                        </select>
                        @if($perPage != 10)<input type="hidden" name="per_page" value="{{ $perPage }}">@endif
                        @if($bulan !== '')
                            <a href="{{ route('admin.pelaporan', ['per_page'=>$perPage]) }}"
                               style="font-size:12px;color:#8b0000;font-weight:600">Reset</a>
                        @endif
                    </form>
                </div>

                {{-- TABLE --}}
                <div class="admin-table-wrap">
                    <table class="admin-table">
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
                            @forelse($data as $s)
                            <tr>
                                <td style="text-align:center">{{ $s->user?->id ?? '-' }}</td>
                                <td>{{ $s->user?->nama ?: ($s->user?->name ?? '-') }}</td>
                                <td style="text-align:center">{{ $s->user?->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $s->user?->email ?? '-' }}</td>
                                <td style="text-align:center">{{ $s->id_skrinning }}</td>
                                <td style="text-align:center">{{ $s->tanggal->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $rc = match($s->hasil) {
                                            'Risiko Tinggi' => '#d32f2f',
                                            'Risiko Sedang' => '#f59e0b',
                                            default => '#16a34a'
                                        };
                                    @endphp
                                    <span style="color:{{ $rc }};font-weight:600">{{ $s->hasil }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" style="text-align:center;color:#aaa;padding:24px">
                                Tidak ada data{{ $bulan !== '' ? ' untuk bulan yang dipilih' : '' }}.
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER --}}
                <div class="admin-table-footer">
                    <span style="font-size:12px;color:#666">
                        @if($data->total() > 0)
                            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
                        @else
                            Tidak ada data
                        @endif
                    </span>
                    <div class="admin-pagination">
                        {{ $data->links('vendor.pagination.admin') }}
                    </div>
                </div>
            </div>

            {{-- CETAK --}}
            <div style="text-align:right;margin-top:16px">
                <a href="{{ route('admin.pelaporan.cetak', array_filter(['bulan'=>$bulan,'per_page'=>$perPage])) }}"
                   target="_blank" class="btn-admin-cetak">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6,9 6,2 18,2 18,9"/>
                        <path d="M6,18H4a2,2,0,0,1-2-2V11a2,2,0,0,1,2-2H20a2,2,0,0,1,2,2v5a2,2,0,0,1-2,2H18"/>
                        <rect x="6" y="14" width="12" height="8"/>
                    </svg>
                    Cetak Laporan
                </a>
            </div>
        </main>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.partials.logout-modal')
</body>
</html>
