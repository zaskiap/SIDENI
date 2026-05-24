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
                <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none;" onchange="this.form.submit()">

                {{-- HEADER --}}
                <div class="admin-profil-header">
                    <div class="admin-profil-header-avatar-wrap" onclick="document.getElementById('fotoInput').click()">
                        @if($admin && $admin->foto)
                            <img src="{{ asset('storage/foto-admin/'.$admin->foto) }}" class="admin-profil-header-avatar">
                        @else
                            <div class="admin-profil-header-initials">
                                {{ strtoupper(substr(session('admin.name', 'A'), 0, 1)) }}
                            </div>
                        @endif
                        <div class="admin-profil-header-edit-icon">✏️</div>
                    </div>
                    <div>
                        <div class="admin-profil-name">{{ session('admin.name', '-') }}</div>
                        <div class="admin-profil-email">{{ session('admin.email', '-') }}</div>
                        <span class="admin-profil-badge">Super Admin</span>
                    </div>
                </div>

                {{-- FORM BODY --}}
                <div class="admin-profil-form-body">
                    <div class="admin-profil-section-title">Edit Profil</div>

                    <div class="admin-profil-field">
                        <label class="admin-profil-label">Nama</label>
                        <input type="text" name="name" value="{{ old('name', session('admin.name')) }}" class="admin-profil-input" placeholder="Nama lengkap">
                        @error('name')<span class="admin-profil-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="admin-profil-field">
                        <label class="admin-profil-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', session('admin.email')) }}" class="admin-profil-input" placeholder="Alamat email">
                        @error('email')<span class="admin-profil-error">{{ $message }}</span>@enderror
                    </div>

                    <hr class="admin-profil-divider">

                    <div class="admin-profil-section-title">Ganti Password</div>

                    <div class="admin-profil-field">
                        <label class="admin-profil-label">Password Baru</label>
                        <input type="password" name="password" class="admin-profil-input" placeholder="Password baru">
                        @error('password')<span class="admin-profil-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="admin-profil-field">
                        <label class="admin-profil-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="admin-profil-input" placeholder="Ulangi password baru">
                    </div>

                    <div class="admin-profil-field">
                        <button type="submit" class="btn-admin-add btn-admin-add--full">Simpan Perubahan</button>
                    </div>
                </div>

            </form>
        </main>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.partials.logout-modal')
</body>
</html>