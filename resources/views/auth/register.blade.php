<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body auth-body">
<main class="auth-main">
    <div class="auth-card reg-card" data-animate="fadeInUp">
        <div class="auth-header">
            <h1 class="auth-title">REGISTRASI SIDENI</h1>
            <p class="auth-subtitle">SISTEM DETEKSI DINI PENYAKIT HIV/AIDS</p>
        </div>

        @if($errors->any())
        <div class="auth-error">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="auth-form" id="regForm">
            @csrf
            <input type="hidden" name="name" id="hidden-name" value="{{ old('name','Pengguna') }}">

            {{-- STEP 1 --}}
            <div class="reg-step" id="step-1">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email aktif" class="form-input {{ $errors->has('email')?'input-error':'' }}" required autocomplete="username">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-pw-wrap">
                        <input type="password" id="reg_pw" name="password" placeholder="Minimal 6 karakter" class="form-input" required autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePw('reg_pw',this)">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-pw-wrap">
                        <input type="password" id="reg_cfm" name="password_confirmation" placeholder="Ulangi password" class="form-input" required autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePw('reg_cfm',this)">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-auth" onclick="goStep2()">Berikutnya &nbsp;→</button>
            </div>

            {{-- STEP 2 --}}
            <div class="reg-step hidden" id="step-2">
                <div class="form-group">
                    <label class="form-label">Nama (Opsional)</label>
                    <input type="text" name="nama" id="reg_nama" value="{{ old('nama') }}" placeholder="Nama atau alias" class="form-input" maxlength="100" oninput="syncName(this.value)">
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <input type="hidden" name="jenis_kelamin" id="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                    <div class="gender-group">
                        <button type="button" class="gender-btn {{ old('jenis_kelamin')==='Laki-Laki'?'gender-laki active':'' }}" onclick="pilihGender(this,'Laki-Laki')">Laki-Laki</button>
                        <button type="button" class="gender-btn {{ old('jenis_kelamin')==='Perempuan'?'gender-pr active':'' }}" onclick="pilihGender(this,'Perempuan')">Perempuan</button>
                    </div>
                </div>
                <div class="btn-pair">
                    <button type="button" class="btn-back-reg" onclick="goStep(1)">← &nbsp;Kembali</button>
                    <button type="button" class="btn-auth" onclick="goStep(3)">Berikutnya &nbsp;→</button>
                </div>
            </div>

            {{-- STEP 3 — faktor risiko OPSIONAL --}}
            <div class="reg-step hidden" id="step-3">
                <div class="form-group">
                    <label class="form-label">Pilih Faktor Risiko <span style="color:#aaa;font-weight:400">(Opsional)</span></label>
                    <p style="font-size:11px;color:#888;margin-bottom:8px">Anda dapat memilih sekarang atau nanti setelah masuk.</p>
                    <div class="risiko-list">
                        @foreach(\App\Models\User::faktorMap() as $col => $label)
                        <label class="risiko-item">
                            <input type="checkbox" name="{{ $col }}" value="1" {{ old($col)?'checked':'' }}>
                            <span>{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                    <div class="risiko-warn">
                        <span class="warn-icon-sm">▲</span>
                        <span>Data Anda bersifat anonim. Tidak ada informasi yang dikirim ke pihak ketiga.</span>
                    </div>
                </div>
                <label class="privasi-check">
                    <input type="checkbox" name="terms" required>
                    <span>Saya menyetujui kebijakan privasi dan pengolahan data</span>
                </label>
                <div class="btn-pair">
                    <button type="button" class="btn-back-reg" onclick="goStep(2)">← &nbsp;Kembali</button>
                    <button type="submit" class="btn-auth">Selesai & Masuk &nbsp;→</button>
                </div>
            </div>
        </form>
    </div>
</main>
@include('partials.footer')
<script>
function syncName(v){document.getElementById('hidden-name').value=v||'Pengguna';}
function goStep(n){
    document.querySelectorAll('.reg-step').forEach(s=>s.classList.add('hidden'));
    document.getElementById('step-'+n).classList.remove('hidden');
    document.querySelector('.auth-card').scrollIntoView({behavior:'smooth',block:'start'});
}
function goStep2(){
    const email=document.getElementById('regForm').querySelector('[name=email]').value.trim();
    const pw=document.getElementById('reg_pw').value;
    const cfm=document.getElementById('reg_cfm').value;
    if(!email){alert('Email wajib diisi.');return;}
    if(pw.length<6){alert('Password minimal 6 karakter.');return;}
    if(pw!==cfm){alert('Konfirmasi password tidak cocok.');return;}
    goStep(2);
}
function pilihGender(btn,val){
    document.querySelectorAll('.gender-btn').forEach(b=>{b.classList.remove('active','gender-laki','gender-pr');});
    btn.classList.add('active');
    if(val==='Laki-Laki') btn.classList.add('gender-laki');
    else btn.classList.add('gender-pr');
    document.getElementById('jenis_kelamin').value=val;
}
function togglePw(id,btn){
    const i=document.getElementById(id);
    const h=i.type==='password';
    i.type=h?'text':'password';
    btn.innerHTML=h?
        `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`:
        `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;
}
@if($errors->has('email')||$errors->has('password')||$errors->has('password_confirmation'))goStep(1);
@elseif($errors->has('jenis_kelamin'))goStep(2);
@elseif($errors->has('terms'))goStep(3);
@endif
</script>
@livewireScripts
</body>
</html>
