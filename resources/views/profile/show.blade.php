<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SIDENI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="sideni-body">

    @include('partials.header', ['auth' => true])

    <main class="profile-main">
        <div class="profile-wrap">

            <!-- BACK LINK -->
            <a href="{{ route('beranda') }}" class="profile-back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12,8 8,12 12,16"/>
                    <line x1="16" y1="12" x2="8" y2="12"/>
                </svg>
                Profil
            </a>

            {{-- 1. INFORMASI PROFIL --}}
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <div class="profile-divider"></div>
            @endif

            {{-- 2. PERBARUI KATA SANDI --}}
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                @livewire('profile.update-password-form')
                <div class="profile-divider"></div>
            @endif

            {{-- 3. OTENTIKASI DUA FAKTOR --}}
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                @livewire('profile.two-factor-authentication-form')
                <div class="profile-divider"></div>
            @endif

            {{-- 4. SESI PERAMBAN --}}
            @livewire('profile.logout-other-browser-sessions-form')

            {{-- 5. HAPUS AKUN --}}
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="profile-divider"></div>
                @livewire('profile.delete-user-form')
            @endif

        </div>
    </main>

    @include('partials.footer')

    {{-- MODAL LOGOUT --}}
    <div class="logout-overlay" id="logoutOverlay">
        <div class="logout-modal">
            <div class="logout-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                     stroke="#b91c1c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16,17 21,12 16,7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </div>
            <h3 class="logout-title">Keluar dari Aplikasi</h3>
            <p class="logout-desc">Apakah Anda yakin ingin keluar dari aplikasi SIDENI?</p>
            <div class="logout-actions">
                <button class="logout-btn-cancel" onclick="hideLogoutModal()">Tidak</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn-confirm">Ya</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function showLogoutModal() {
        document.getElementById('logoutOverlay').classList.add('show');
    }
    function hideLogoutModal() {
        document.getElementById('logoutOverlay').classList.remove('show');
    }
    document.getElementById('logoutOverlay').addEventListener('click', function(e) {
        if (e.target === this) hideLogoutModal();
    });
    </script>

    @livewireScripts
</body>
</html>
