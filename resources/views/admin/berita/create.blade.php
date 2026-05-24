<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Tambah Berita - SIDENI Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ckeditor5@41.4.2/dist/browser/ckeditor5.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="admin-body">
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-content">
        @include('admin.partials.topbar')
        <main class="admin-main">
            <div class="admin-page-header">
                <div class="admin-breadcrumb">
                    <a href="{{ route('admin.berita.index') }}" class="admin-bc-link">Berita</a>
                    <span class="admin-bc-sep">›</span>
                    <span>Tambah Berita Baru</span>
                </div>
            </div>

            @if($errors->any())
            <div class="admin-alert admin-alert-error">
                @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
                <button onclick="this.parentElement.remove()" class="admin-alert-close">×</button>
            </div>
            @endif

            <div class="admin-form-card">
                <div class="admin-form-card-head">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Berita Baru
                </div>
                <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" class="admin-form-body">
                    @csrf
                    <div class="admin-form-group">
                        <label class="admin-form-label">JUDUL BERITA <span class="required">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}" class="admin-form-input {{ $errors->has('judul')?'input-error':'' }}" placeholder="Masukkan judul berita" required>
                    </div>

                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label class="admin-form-label">KATEGORI <span class="required">*</span></label>
                            <select name="kategori" class="admin-form-input" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(['Trending','Highlight','Terbaru'] as $k)
                                <option value="{{ $k }}" {{ old('kategori')===$k?'selected':'' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="admin-form-group">
                            <label class="admin-form-label">TANGGAL <span class="required">*</span></label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" class="admin-form-input {{ $errors->has('tanggal')?'input-error':'' }}" required>
                        </div>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">ISI BERITA <span class="required">*</span></label>
                        <textarea id="editor" name="isi" rows="12" class="admin-form-input admin-form-textarea" placeholder="Tulis isi berita di sini...">{{ old('isi') }}</textarea>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">FOTO / THUMBNAIL</label>
                        <div class="admin-upload-zone" id="uploadZone" onclick="document.getElementById('thumbnail_input').click()">
                            <div id="uploadPlaceholder">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/></svg>
                                <p>Klik untuk upload foto</p>
                                <span>JPG, PNG — Maksimal 2MB</span>
                            </div>
                            <img id="previewImg" style="display:none;max-width:100%;max-height:200px;border-radius:8px;margin-top:8px">
                            <input type="file" id="thumbnail_input" name="thumbnail" accept="image/jpeg,image/png" style="display:none" onchange="previewImage(this)">
                        </div>
                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('admin.berita.index') }}" class="btn-admin-batal">Batal</a>
                        <button type="submit" class="btn-admin-simpan">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                            Simpan Berita
                        </button>
                    </div>
                </form>
            </div>
        </main>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.partials.logout-modal')
<script>
function previewImage(input) {
    const preview = document.getElementById('previewImg');
    const placeholder = document.getElementById('uploadPlaceholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
