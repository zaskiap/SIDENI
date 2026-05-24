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
            <div class="admin-page-header" style="align-items:center;">
                <h1 class="admin-page-title" style="margin:0; line-height:1;">Profil Admin</h1>
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

                <div style="display:flex; flex-direction:column; gap:0;">

                    {{-- COVER + AVATAR --}}
                    <div style="background:#e5e7eb; border-radius:10px 10px 0 0; height:100px; position:relative;">
                        <div style="position:absolute; bottom:-40px; left:50%; transform:translateX(-50%); cursor:pointer;" onclick="document.getElementById('fotoInput').click()">
                            @if($admin && $admin->foto)
                                <img src="{{ asset('storage/foto-admin/'.$admin->foto) }}"
                                    style="width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                            @else
                                <div style="width:80px; height:80px; background:#9ca3af; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:28px; font-weight:700; border:3px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                                    {{ strtoupper(substr(session('admin.name', 'A'), 0, 1)) }}
                                </div>
                            @endif
                            <div style="position:absolute; bottom:2px; right:2px; background:#fff; border-radius:50%; width:22px; height:22px; display:flex; align-items:center; justify-content:center; box-shadow:0 1px 4px rgba(0,0,0,0.2); font-size:12px;">✏️</div>
                        </div>
                    </div>

                    {{-- INFO --}}
                    <div style="background:#fff; padding:52px 24px 20px; border-left:1px solid #e5e5e5; border-right:1px solid #e5e5e5; display:flex; align-items:center; gap:18px;">
                        <div>
                            <div style="font-size:16px; font-weight:700; color:#1a1a1a;">{{ session('admin.name', '-') }}</div>
                            <div style="font-size:13px; color:#666; margin-top:2px;">{{ session('admin.email', '-') }}</div>
                            <span style="display:inline-block; background:#fef3c7; color:#92400e; font-size:11px; font-weight:700; padding:3px 14px; border-radius:99px; margin-top:8px; border:1px solid #fcd34d;">Super Admin</span>
                        </div>
                    </div>

                    {{-- FORM --}}
                    <div style="background:#fff; border:1px solid #e5e5e5; border-radius:0 0 10px 10px; padding:24px;">
                        <div class="admin-chart-title">EDIT PROFIL</div>

                        <div style="display:flex; flex-direction:column; gap:6px; margin-bottom:16px;">
                            <label style="font-size:12px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:0.4px;">Nama</label>
                            <input type="text" name="name" value="{{ old('name', session('admin.name')) }}"
                                style="padding:9px 12px; border:1px solid #e5e5e5; border-radius:7px; font-size:13px; color:#1a1a1a; outline:none; font-family:Inter,sans-serif; width:100%;"
                                placeholder="Nama lengkap">
                            @error('name')<span style="font-size:11px; color:#d32f2f;">{{ $message }}</span>@enderror
                        </div>

                        <div style="display:flex; flex-direction:column; gap:6px; margin-bottom:16px;">
                            <label style="font-size:12px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:0.4px;">Email</label>
                            <input type="email" name="email" value="{{ old('email', session('admin.email')) }}"
                                style="padding:9px 12px; border:1px solid #e5e5e5; border-radius:7px; font-size:13px; color:#1a1a1a; outline:none; font-family:Inter,sans-serif; width:100%;"
                                placeholder="Alamat email">
                            @error('email')<span style="font-size:11px; color:#d32f2f;">{{ $message }}</span>@enderror
                        </div>

                        <div class="admin-chart-title" style="margin-top:24px;">GANTI PASSWORD</div>
                        <p style="font-size:12px; color:#888; margin-bottom:14px;">Kosongkan jika tidak ingin mengganti password.</p>

                        <div style="display:flex; flex-direction:column; gap:6px; margin-bottom:16px;">
                            <label style="font-size:12px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:0.4px;">Password Baru</label>
                            <input type="password" name="password"
                                style="padding:9px 12px; border:1px solid #e5e5e5; border-radius:7px; font-size:13px; color:#1a1a1a; outline:none; font-family:Inter,sans-serif; width:100%;"
                                placeholder="Password baru">
                            @error('password')<span style="font-size:11px; color:#d32f2f;">{{ $message }}</span>@enderror
                        </div>

                        <div style="display:flex; flex-direction:column; gap:6px; margin-bottom:16px;">
                            <label style="font-size:12px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:0.4px;">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                style="padding:9px 12px; border:1px solid #e5e5e5; border-radius:7px; font-size:13px; color:#1a1a1a; outline:none; font-family:Inter,sans-serif; width:100%;"
                                placeholder="Ulangi password baru">
                        </div>

                        <div style="margin-top:24px;">
                            <button type="submit" class="btn-admin-add" style="width:100%; justify-content:center; padding:12px;">Simpan Perubahan</button>
                        </div>
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