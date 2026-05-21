<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Daftar Pengguna - SIDENI Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="admin-body">
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-content">
        @include('admin.partials.topbar')
        <main class="admin-main">
            <h1 class="admin-page-title">Daftar Pengguna</h1><br>
            <p style="font-size:13px;color:#666;margin-bottom:20px">
                Data dalam tabel dibawah ini merupakan data pengguna yang melakukan skrinning
            </p>

            <div class="admin-table-card">
                <div style="padding:14px 16px;font-size:13px;font-weight:700;color:#8b0000;border-bottom:1px solid #f0f0f0">
                    Data Daftar Pengguna
                </div>

                {{-- CONTROLS --}}
                <div style="padding:12px 16px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px">
                    {{-- Show entries --}}
                    <form method="GET" action="{{ route('admin.pengguna') }}" id="showForm"
                          style="display:flex;align-items:center;gap:8px">
                        <span style="font-size:12px;color:#555">Show</span>
                        <select name="per_page" class="admin-select-sm"
                                onchange="document.getElementById('showForm').submit()">
                            @foreach([10,25,50,100] as $n)
                                <option value="{{ $n }}" {{ $perPage==$n?'selected':'' }}>{{ $n }}</option>
                            @endforeach
                        </select>
                        <span style="font-size:12px;color:#555">entries</span>
                        @foreach(request()->except('per_page','page') as $k=>$v)
                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                        @endforeach
                    </form>

                    {{-- FILTER BUTTON --}}
                    <div style="position:relative">
                        <button class="btn-admin-filter" onclick="toggleFilter(event)">
                            Filter
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46"/></svg>
                        </button>

                        <div class="admin-filter-panel" id="filterPanel" style="display:none">
                            <form method="GET" action="{{ route('admin.pengguna') }}" id="filterForm">
                                <input type="hidden" name="per_page" value="{{ $perPage }}">

                                {{-- Jenis Kelamin --}}
                                <div class="admin-filter-section">
                                    <div style="font-size:11px;font-weight:700;color:#555;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">Jenis Kelamin</div>
                                    <label class="admin-filter-label">
                                        <input type="radio" name="jenis_kelamin" value=""
                                            {{ !request('jenis_kelamin') ? 'checked' : '' }}>
                                        Semua
                                    </label>
                                    <label class="admin-filter-label">
                                        <input type="radio" name="jenis_kelamin" value="Laki-Laki"
                                            {{ request('jenis_kelamin')==='Laki-Laki' ? 'checked' : '' }}>
                                        Laki-laki
                                    </label>
                                    <label class="admin-filter-label">
                                        <input type="radio" name="jenis_kelamin" value="Perempuan"
                                            {{ request('jenis_kelamin')==='Perempuan' ? 'checked' : '' }}>
                                        Perempuan
                                    </label>
                                </div>

                                {{-- Faktor Risiko --}}
                                @php
                                    $faktorLabels = [
                                        'faktor_alkohol'           => 'Faktor Risiko 1 (Alkohol)',
                                        'faktor_berganti_pasangan' => 'Faktor Risiko 2 (Berganti Pasangan)',
                                        'faktor_jarum_suntik'      => 'Faktor Risiko 3 (Jarum Suntik)',
                                        'faktor_seks_tanpa_kondom' => 'Faktor Risiko 4 (Seks Tanpa Kondom)',
                                    ];
                                @endphp
                                @foreach($faktorLabels as $col => $label)
                                <div class="admin-filter-section">
                                    <div style="font-size:11px;font-weight:700;color:#555;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">{{ $label }}</div>
                                    <label class="admin-filter-label">
                                        <input type="radio" name="filter_{{ $col }}" value=""
                                            {{ request('filter_'.$col)===null||request('filter_'.$col)==='' ? 'checked' : '' }}>
                                        Semua
                                    </label>
                                    <label class="admin-filter-label">
                                        <input type="radio" name="filter_{{ $col }}" value="1"
                                            {{ request('filter_'.$col)==='1' ? 'checked' : '' }}>
                                        Aktif (1)
                                    </label>
                                    <label class="admin-filter-label">
                                        <input type="radio" name="filter_{{ $col }}" value="0"
                                            {{ request('filter_'.$col)==='0' ? 'checked' : '' }}>
                                        Tidak Aktif (null)
                                    </label>
                                </div>
                                @endforeach

                                <div style="display:flex;gap:8px;margin-top:4px">
                                    <button type="submit" class="btn-admin-terapkan">Terapkan</button>
                                    <a href="{{ route('admin.pengguna') }}" class="btn-admin-ulangi">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- TABLE --}}
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th style="color:#8b0000">Jenis Kelamin</th>
                                <th style="color:#8b0000">Faktor 1</th>
                                <th style="color:#8b0000">Faktor 2</th>
                                <th style="color:#8b0000">Faktor 3</th>
                                <th style="color:#8b0000">Faktor 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengguna as $p)
                            <tr>
                                <td style="text-align:center">{{ $p->id }}</td>
                                <td>{{ $p->nama ?: $p->name }}</td>
                                <td>{{ $p->email }}</td>
                                <td style="font-family:monospace;font-size:11px">{{ Str::limit($p->password, 16) }}..</td>
                                <td style="text-align:center">{{ $p->jenis_kelamin ?: '-' }}</td>
                                <td style="text-align:center">
                                    <span style="color:{{ $p->faktor_alkohol ? '#16a34a' : '#aaa' }};font-weight:600">
                                        {{ $p->faktor_alkohol ? '1' : 'null' }}
                                    </span>
                                </td>
                                <td style="text-align:center">
                                    <span style="color:{{ $p->faktor_berganti_pasangan ? '#16a34a' : '#aaa' }};font-weight:600">
                                        {{ $p->faktor_berganti_pasangan ? '1' : 'null' }}
                                    </span>
                                </td>
                                <td style="text-align:center">
                                    <span style="color:{{ $p->faktor_jarum_suntik ? '#16a34a' : '#aaa' }};font-weight:600">
                                        {{ $p->faktor_jarum_suntik ? '1' : 'null' }}
                                    </span>
                                </td>
                                <td style="text-align:center">
                                    <span style="color:{{ $p->faktor_seks_tanpa_kondom ? '#16a34a' : '#aaa' }};font-weight:600">
                                        {{ $p->faktor_seks_tanpa_kondom ? '1' : 'null' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" style="text-align:center;color:#aaa;padding:24px;font-size:13px">
                                    Tidak ada data pengguna.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER --}}
                <div class="admin-table-footer">
                    <span style="font-size:12px;color:#666">
                        @if($pengguna->total() > 0)
                            Showing {{ $pengguna->firstItem() }} to {{ $pengguna->lastItem() }} of {{ $pengguna->total() }} entries
                        @else
                            Tidak ada data
                        @endif
                    </span>
                    <div class="admin-pagination">{{ $pengguna->links('vendor.pagination.admin') }}</div>
                </div>
            </div>
        </main>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.partials.logout-modal')
<script>
function toggleFilter(e) {
    e.stopPropagation();
    const p = document.getElementById('filterPanel');
    p.style.display = p.style.display === 'none' ? 'block' : 'none';
}
document.addEventListener('click', function(e) {
    const panel = document.getElementById('filterPanel');
    const btn   = document.querySelector('.btn-admin-filter');
    if (panel && !panel.contains(e.target) && btn && !btn.contains(e.target)) {
        panel.style.display = 'none';
    }
});
</script>
</body>
</html>
