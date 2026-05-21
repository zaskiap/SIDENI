<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body auth-body">
<main class="auth-main">
    <div class="auth-card" data-animate="fadeInUp">
        <div class="auth-header">
            <h1 class="auth-title">LOGIN SIDENI</h1>
            <p class="auth-subtitle">SISTEM DETEKSI DINI PENYAKIT HIV/AIDS</p>
        </div>

        {{-- Session Status --}}
        @if(session('status'))
            <div class="auth-success">{{ session('status') }}</div>
        @endif

        {{-- Errors --}}
        @if($errors->any())
            <div class="auth-error">
                @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
        @endif

        {{-- Form POST ke Fortify /login --}}
        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email terdaftar"
                       class="form-input {{ $errors->has('email') ? 'input-error' : '' }}"
                       required autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-pw-wrap">
                    <input id="password" type="password" name="password"
                           placeholder="Password"
                           class="form-input {{ $errors->has('password') ? 'input-error' : '' }}"
                           required autocomplete="current-password">
                    <button type="button" class="toggle-pw" onclick="togglePw('password',this)">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
            </div>

            <div class="form-forgot">
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-red">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="btn-auth">Login</button>

            <p class="auth-link-text">
                Belum punya akun? <a href="{{ route('register') }}" class="link-red font-bold">Registrasi</a>
            </p>
        </form>
    </div>
</main>
@include('partials.footer')
<script>
function togglePw(id, btn) {
    const inp = document.getElementById(id);
    const h = inp.type === 'password';
    inp.type = h ? 'text' : 'password';
    btn.innerHTML = h
        ? `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`
        : `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;
}
</script>
@livewireScripts
</body>
</html>
