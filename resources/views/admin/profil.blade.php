<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Profil Admin - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="admin-body">
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-content">
        @include('admin.partials.topbar')
        <main class="admin-main">
            <div class="admin-page-header">
                <h1 class="admin-page-title">Profil Admin</h1>
            </div>

            @if(session('success'))
            <div class="admin-alert admin-alert-success">
                {{ session('success') }}
                <button onclick="this.parentElement.remove()" class="admin-alert-close">×</button>
            </div>
            @endif

            @if(session('error'))
            <div class="admin-alert admin-alert-error">
                {{ session('error') }}
                <button onclick="this.parentElement.remove()" class="admin-alert-close">×</button>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none;" onchange="previewFoto(event)">

                {{-- INFO + FORM dalam satu card --}}
                <div class="admin-profil-card">

                    {{-- HEADER --}}
                    <div class="admin-profil-header">
                        <div class="admin-profil-header-avatar-wrap" onclick="document.getElementById('fotoInput').click()">
                            @if($admin && $admin->foto)
                                <img id="fotoPreview" src="{{ asset('storage/foto-admin/'.$admin->foto) }}" class="admin-profil-header-avatar">
                            @else
                                <img id="fotoPreview" src="" class="admin-profil-header-avatar" style="display:none;">
                                <div id="fotoInitials" class="admin-profil-header-initials">
                                    {{ strtoupper(substr(session('admin.name', 'A'), 0, 1)) }}
                                </div>
                            @endif
                            <div class="admin-profil-header-edit-icon">✏️</div>
                        </div>
                        <div>
                            <div class="admin-profil-name">{{ session('admin.name', '-') }}</div>
                            <div class="admin-profil-email">{{ session('admin.email', '-') }}</div>
                            <span class="admin-profil-badge">{{ $admin->role }}</span>
                        </div>
                    </div>{{-- END admin-profil-header --}}

                    {{-- FORM BODY --}}
                    <div class="admin-profil-form-body">
                        <div class="admin-chart-title">EDIT PROFIL</div>

                        <div class="admin-profil-field">
                            <label class="admin-profil-label">Nama</label>
                            <input type="text" name="name" value="{{ old('name', session('admin.name')) }}"
                                class="admin-profil-input" placeholder="Nama lengkap">
                            @error('name')<span class="admin-profil-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="admin-profil-field">
                            <label class="admin-profil-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', session('admin.email')) }}"
                                class="admin-profil-input" placeholder="Alamat email">
                            @error('email')<span class="admin-profil-error">{{ $message }}</span>@enderror
                        </div>

                        {{-- DIVIDER --}}
                        <div class="admin-profil-divider"></div>

                        <div class="admin-chart-title" style="margin-top:24px;">GANTI PASSWORD</div>

                        <div class="admin-profil-field">
                            <label class="admin-profil-label">Password Baru</label>
                            <input type="password" name="password"
                                class="admin-profil-input" placeholder="Password baru">
                            @error('password')<span class="admin-profil-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="admin-profil-field">
                            <label class="admin-profil-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="admin-profil-input" placeholder="Ulangi password baru">
                        </div>

                        <div class="admin-profil-actions">
                            <a href="{{ route('admin.profil') }}" class="btn-admin-batal">Buang Perubahan</a>
                            <button type="submit" class="btn-admin-simpan-profil">Simpan Perubahan</button>
                        </div>
                    </div>{{-- END admin-profil-form-body --}}

                </div>{{-- END admin-profil-card --}}

            </form>
        </main>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.partials.logout-modal')

<script>
function previewFoto(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('fotoPreview');
        const initials = document.getElementById('fotoInitials');

        preview.src = e.target.result;
        preview.style.display = 'block';

        if (initials) initials.style.display = 'none';
    };
    reader.readAsDataURL(file);
}
</script>

</body>
</html>