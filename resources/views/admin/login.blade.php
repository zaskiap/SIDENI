<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login Admin - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="sideni-body auth-body">
<main class="auth-main">
    <div class="auth-card" data-animate="fadeInUp">
        <div class="auth-header">
            <h1 class="auth-title">LOGIN ADMIN</h1>
            <p class="auth-subtitle">SISTEM DETEKSI DINI PENYAKIT HIV/AIDS</p>
        </div>
        @if($errors->any())
        <div class="auth-error">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>
        @endif
        <form method="POST" action="{{ route('admin.login.post') }}" class="auth-form">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email terdaftar" class="form-input {{ $errors->has('email')?'input-error':'' }}" required autofocus>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-pw-wrap">
                    <input type="password" id="pw" name="password" placeholder="Password" class="form-input" required>
                    <button type="button" class="toggle-pw" onclick="togglePwAdmin()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn-auth">Login</button>
        </form>
    </div>
</main>
@include('partials.footer')
<script>
function togglePwAdmin(){
    const i=document.getElementById('pw');
    i.type=i.type==='password'?'text':'password';
}
</script>
</body>
</html>
