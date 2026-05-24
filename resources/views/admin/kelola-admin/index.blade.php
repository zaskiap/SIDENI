<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Admin - SIDENI Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="admin-body">
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-content">
        @include('admin.partials.topbar')
        <main class="admin-main">
            <h1 class="admin-page-title">Kelola Admin</h1><br>
            <p class="admin-page-desc">
                Hanya Super Admin yang dapat menambah dan menghapus akun admin.
            </p>

            {{-- NOTIFIKASI SUKSES / ERROR --}}
            @if(session('success'))
                <div class="alert-admin alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert-admin alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row g-4">

                {{-- FORM TAMBAH ADMIN BARU --}}
                <div class="col-12">
                    <div class="admin-table-card">
                        <div class="admin-table-head">
                            <span class="admin-table-title">Tambah Admin Baru</span>
                        </div>
                        <div class="admin-card-body">
                        @if($errors->any())
                            <div class="alert-validation">
                                <ul class="alert-validation-list">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.kelola-admin.store') }}">
                            @csrf
                            <div class="form-group-field">
                                <label class="form-field-label">Nama</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-field-input" required>
                            </div>
                            <div class="form-group-field">
                                <label class="form-field-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-field-input" required>
                            </div>
                            <div class="form-group-field">
                                <label class="form-field-label">Password</label>
                                <input type="password" name="password" class="form-field-input" required>
                            </div>
                            <div class="form-group-field">
                                <label class="form-field-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-field-input" required>
                            </div>
                            <div class="form-group-field-lg">
                                <label class="form-field-label">Role</label>
                                <select name="role" class="form-field-input" required>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-submit-admin">
                                Tambah Admin
                            </button>
                        </form>
                    </div>
                </div>

                 {{-- 1. TABEL DAFTAR ADMIN (Lebar penuh di atas) --}}
                <div class="col-12">
                    <div class="admin-table-card">
                        <div class="admin-table-head">
                            <span class="admin-table-title">Daftar Admin</span>
                        </div>
                        <div class="admin-table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $adm)
                                <tr>
                                    <td>{{ $adm->name }}</td>
                                    <td>{{ $adm->email }}</td>
                                    <td>
                                        @if($adm->role === 'superadmin')
                                            <span class="badge-role badge-superadmin">Super Admin</span>
                                        @else
                                            <span class="badge-role badge-admin">Admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Tombol hapus tidak muncul jika ini akun sendiri --}}
                                        @if($adm->id !== session('admin')['id'])
                                            <form method="POST" action="{{ route('admin.kelola-admin.destroy', $adm->id) }}"
                                                  onsubmit="return confirm('Hapus admin {{ $adm->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete-admin">
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-current-user">Akun Anda</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>