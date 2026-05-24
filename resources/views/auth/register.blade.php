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
                    <span id="error-email" style="display:none; font-size:12px; color:#dc2626; margin-top:4px;"></span>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-pw-wrap">
                        <input type="password" id="reg_pw" name="password" placeholder="Min. 8 karakter, huruf besar, angka & simbol" class="form-input" required autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePw('reg_pw',this)">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                    <span id="error-pw" style="display:none; font-size:12px; color:#dc2626; margin-top:4px;"></span>
                    <div id="pw-strength" style="margin-top:6px; font-size:11px; color:#888;"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-pw-wrap">
                        <input type="password" id="reg_cfm" name="password_confirmation" placeholder="Ulangi password" class="form-input" required autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePw('reg_cfm',this)">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                    <span id="error-cfm" style="display:none; font-size:12px; color:#dc2626; margin-top:4px;"></span>
                </div>
                <button type="button" class="btn-auth" onclick="goStep2()">Berikutnya &nbsp;→</button>
            </div>

            {{-- STEP 2 --}}
            <div class="reg-step hidden" id="step-2">
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" id="reg_nama" value="{{ old('nama') }}" placeholder="Nama atau alias" class="form-input" maxlength="100" oninput="syncName(this.value)">
                    <span id="error-nama" style="display:none; font-size:12px; color:#dc2626; margin-top:4px;">Nama wajib diisi.</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <input type="hidden" name="jenis_kelamin" id="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                    <div class="gender-group">
                        <button type="button" class="gender-btn {{ old('jenis_kelamin')==='Laki-Laki'?'gender-laki active':'' }}" onclick="pilihGender(this,'Laki-Laki')">Laki-Laki</button>
                        <button type="button" class="gender-btn {{ old('jenis_kelamin')==='Perempuan'?'gender-pr active':'' }}" onclick="pilihGender(this,'Perempuan')">Perempuan</button>
                    </div>
                    <span id="error-gender" style="display:none; font-size:12px; color:#dc2626; margin-top:4px;">Jenis kelamin wajib dipilih.</span>
                </div>
                <div class="btn-pair">
                    <button type="button" class="btn-back-reg" onclick="goStep(1)">← &nbsp;Kembali</button>
                    <button type="button" class="btn-auth" onclick="goStep(3)">Berikutnya &nbsp;→</button>
                </div>
            </div>

            {{-- STEP 3 --}}
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
function syncName(v){ document.getElementById('hidden-name').value = v || 'Pengguna'; }

function goStep(n){
    if(n === 3){
        const nama = document.getElementById('reg_nama').value.trim();
        const errorNama = document.getElementById('error-nama');
        if(nama === ''){
            document.getElementById('reg_nama').classList.add('input-error');
            errorNama.style.display = 'block';
            return;
        } else {
            document.getElementById('reg_nama').classList.remove('input-error');
            errorNama.style.display = 'none';
        }
        const gender = document.getElementById('jenis_kelamin').value;
        const errorGender = document.getElementById('error-gender');
        if(!gender){
            errorGender.style.display = 'block';
            return;
        } else {
            errorGender.style.display = 'none';
        }
    }
    document.querySelectorAll('.reg-step').forEach(s => s.classList.add('hidden'));
    document.getElementById('step-' + n).classList.remove('hidden');
    document.querySelector('.auth-card').scrollIntoView({behavior:'smooth', block:'start'});
}

function goStep2(){
    const emailInput = document.getElementById('regForm').querySelector('[name=email]');
    const email = emailInput.value.trim();
    const pw = document.getElementById('reg_pw').value;
    const cfm = document.getElementById('reg_cfm').value;
    const errorEmail = document.getElementById('error-email');
    const errorPw = document.getElementById('error-pw');
    const errorCfm = document.getElementById('error-cfm');
    const pwInput = document.getElementById('reg_pw');

    // Validasi email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!email || !emailRegex.test(email)){
        emailInput.classList.add('input-error');
        errorEmail.style.display = 'block';
        errorEmail.textContent = !email ? 'Email wajib diisi.' : 'Format email tidak valid.';
        return;
    } else {
        emailInput.classList.remove('input-error');
        errorEmail.style.display = 'none';
    }

    // Validasi password — semua error sekaligus
    const pwErrors = [];
    if(pw.length < 8) pwErrors.push('• Minimal 8 karakter');
    if(!/[A-Z]/.test(pw)) pwErrors.push('• Minimal 1 huruf besar');
    if(!/[0-9]/.test(pw)) pwErrors.push('• Minimal 1 angka');
    if(!/[^A-Za-z0-9]/.test(pw)) pwErrors.push('• Minimal 1 simbol (contoh: @, #, !)');

    if(pwErrors.length > 0){
        pwInput.classList.add('input-error');
        errorPw.style.display = 'block';
        errorPw.innerHTML = 'Password tidak memenuhi syarat:<br>' + pwErrors.join('<br>');
        return;
    }

    // Cek password umum
    const passwordLemah = ['12345678','password','password123','qwerty123','abc12345','11111111'];
    if(passwordLemah.includes(pw.toLowerCase())){
        pwInput.classList.add('input-error');
        errorPw.style.display = 'block';
        errorPw.textContent = 'Password terlalu umum, gunakan kombinasi yang lebih unik.';
        return;
    }

    pwInput.classList.remove('input-error');
    errorPw.style.display = 'none';

    // Validasi konfirmasi password
    if(pw !== cfm){
        document.getElementById('reg_cfm').classList.add('input-error');
        errorCfm.style.display = 'block';
        errorCfm.textContent = 'Konfirmasi password tidak cocok.';
        return;
    } else {
        document.getElementById('reg_cfm').classList.remove('input-error');
        errorCfm.style.display = 'none';
    }

    goStep(2);
}

document.getElementById('reg_pw').addEventListener('input', function(){
    const pw = this.value;
    const el = document.getElementById('pw-strength');
    if(!pw){ el.innerHTML = ''; return; }

    let strength = 0;
    if(pw.length >= 8) strength++;
    if(/[A-Z]/.test(pw)) strength++;
    if(/[0-9]/.test(pw)) strength++;
    if(/[^A-Za-z0-9]/.test(pw)) strength++;

    const label = ['Sangat Lemah', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
    const color = ['#dc2626', '#dc2626', '#f59e0b', '#3b82f6', '#16a34a'];

    el.innerHTML = `Kekuatan password: <strong style="color:${color[strength]}">${label[strength]}</strong>`;
});

function pilihGender(btn, val){
    document.querySelectorAll('.gender-btn').forEach(b => { b.classList.remove('active','gender-laki','gender-pr'); });
    btn.classList.add('active');
    if(val === 'Laki-Laki') btn.classList.add('gender-laki');
    else btn.classList.add('gender-pr');
    document.getElementById('jenis_kelamin').value = val;
}

function togglePw(id, btn){
    const i = document.getElementById(id);
    const h = i.type === 'password';
    i.type = h ? 'text' : 'password';
    btn.innerHTML = h ?
        `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>` :
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