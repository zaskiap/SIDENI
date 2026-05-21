<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Edit Berita - SIDENI Admin</title>
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
                    <span>Edit Berita</span>
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
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Berita
                </div>
                <form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data" class="admin-form-body">
                    @csrf
                    @method('PUT')

                    <div class="admin-form-group">
                        <label class="admin-form-label">JUDUL BERITA <span class="required">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" class="admin-form-input {{ $errors->has('judul')?'input-error':'' }}" required>
                    </div>

                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label class="admin-form-label">KATEGORI <span class="required">*</span></label>
                            <select name="kategori" class="admin-form-input" required>
                                @foreach(['Trending','Highlight','Terbaru'] as $k)
                                <option value="{{ $k }}" {{ old('kategori',$berita->kategori)===$k?'selected':'' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="admin-form-group">
                            <label class="admin-form-label">TANGGAL <span class="required">*</span></label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal->format('Y-m-d')) }}" class="admin-form-input" required>
                        </div>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">ISI BERITA <span class="required">*</span></label>
                        <textarea name="isi" rows="12" class="admin-form-input admin-form-textarea" required>{{ old('isi', $berita->isi) }}</textarea>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">FOTO / THUMBNAIL</label>
                        @if($berita->thumbnail)
                        <div style="margin-bottom:10px">
                            <p style="font-size:12px;color:#888;margin-bottom:6px">Thumbnail saat ini:</p>
                            <img src="{{ $berita->thumbnail_url }}" style="max-height:120px;border-radius:8px;border:1px solid #e5e5e5">
                        </div>
                        @endif
                        <div class="admin-upload-zone" onclick="document.getElementById('thumb_edit').click()">
                            <div id="uploadPlaceholderEdit">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/></svg>
                                <p>Klik untuk ganti foto (opsional)</p>
                                <span>JPG, PNG — Maksimal 2MB</span>
                            </div>
                            <img id="previewEdit" style="display:none;max-width:100%;max-height:160px;border-radius:8px;margin-top:8px">
                            <input type="file" id="thumb_edit" name="thumbnail" accept="image/jpeg,image/png" style="display:none" onchange="previewEditImage(this)">
                        </div>
                    </div>

                    <div class="admin-form-actions">
                        <a href="{{ route('admin.berita.index') }}" class="btn-admin-batal">Batal</a>
                        <button type="submit" class="btn-admin-perbarui">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                            Perbarui Berita
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
function previewEditImage(input) {
    const prev = document.getElementById('previewEdit');
    const ph   = document.getElementById('uploadPlaceholderEdit');
    if (input.files && input.files[0]) {
        const r = new FileReader();
        r.onload = e => { prev.src=e.target.result; prev.style.display='block'; ph.style.display='none'; };
        r.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
