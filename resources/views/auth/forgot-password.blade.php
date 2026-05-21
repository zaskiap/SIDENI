<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SIDENI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body auth-body">

    <main class="auth-main">
        <div class="auth-card" data-animate="fadeInUp">

            <div class="auth-header">
                <h1 class="auth-title">LUPA PASSWORD</h1>
                <p class="auth-subtitle">SISTEM DETEKSI DINI PENYAKIT HIV/AIDS</p>
            </div>

            <p class="forgot-desc">
                Lupa kata sandi anda? Silakkan masukkan email yang Anda gunakan
                untuk SIDENI dan kami akan mengirimkan tautan untuk mengatur ulang password Anda.
            </p>

            @if (session('status'))
                <div class="auth-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="auth-error">
                    @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="Masukkan email terdaftar"
                           class="form-input {{ $errors->has('email') ? 'input-error' : '' }}"
                           required autofocus />
                </div>
                <button type="submit" class="btn-auth btn-auth--blue">
                    Kirim Tautan Pengaturan Password
                </button>
            </form>

        </div>
    </main>

    @include('partials.footer')
    @livewireScripts
</body>
</html>
