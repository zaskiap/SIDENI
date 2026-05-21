<header class="sideni-header">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="header-logo">
            <svg width="32" height="32" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0">
                <g style="animation:spin-slow 18s linear infinite;transform-origin:90px 90px">
                    <circle cx="90" cy="20" r="4" fill="#8b0000" opacity="0.3"/>
                    <circle cx="148" cy="48" r="3" fill="#8b0000" opacity="0.2"/>
                    <circle cx="160" cy="110" r="4" fill="#8b0000" opacity="0.3"/>
                    <circle cx="65" cy="168" r="4" fill="#8b0000" opacity="0.3"/>
                    <circle cx="22" cy="138" r="3" fill="#8b0000" opacity="0.2"/>
                    <circle cx="18" cy="75" r="4" fill="#8b0000" opacity="0.3"/>
                </g>
                <circle cx="90" cy="90" r="72" fill="none" stroke="#8b0000" stroke-width="1" stroke-dasharray="5 8" opacity="0.18"/>
                <g><line x1="90" y1="90" x2="90" y2="30" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7"/><circle cx="90" cy="27" r="6" fill="#8b0000" opacity="0.85"/></g>
                <g><line x1="90" y1="90" x2="148" y2="52" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7"/><circle cx="151" cy="50" r="6" fill="#8b0000" opacity="0.85"/></g>
                <g><line x1="90" y1="90" x2="148" y2="128" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7"/><circle cx="151" cy="130" r="6" fill="#8b0000" opacity="0.85"/></g>
                <g><line x1="90" y1="90" x2="90" y2="150" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7"/><circle cx="90" cy="153" r="6" fill="#8b0000" opacity="0.85"/></g>
                <g><line x1="90" y1="90" x2="32" y2="128" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7"/><circle cx="29" cy="130" r="6" fill="#8b0000" opacity="0.85"/></g>
                <g><line x1="90" y1="90" x2="32" y2="52" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7"/><circle cx="29" cy="50" r="6" fill="#8b0000" opacity="0.85"/></g>
                <circle cx="90" cy="90" r="27" fill="#8b0000" opacity="0.9"/>
                <circle cx="82" cy="85" r="3" fill="#fff" opacity="0.35"/>
                <circle cx="90" cy="90" r="3" fill="#fff" opacity="0.25"/>
                <circle cx="98" cy="95" r="3" fill="#fff" opacity="0.35"/>
            </svg>
            <div>
                <span class="logo-title">S I D E N I</span>
                <span class="logo-sub">SISTEM DETEKSI DINI HIV/AIDS</span>
            </div>
        </a>

        @if(isset($auth) && $auth)
        <nav class="header-nav">
            <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'nav-link--active' : '' }}">BERANDA</a>
            <a href="{{ route('berita') }}" class="nav-link {{ request()->routeIs('berita*') ? 'nav-link--active' : '' }}">BERITA</a>
            <a href="{{ route('tentang') }}" class="nav-link {{ request()->routeIs('tentang') ? 'nav-link--active' : '' }}">TENTANG</a>

            <div class="user-dropdown" id="userDropdown">
                <button class="user-dropdown__trigger" onclick="toggleDropdown()">
                    {{ strtoupper(Auth::user()->name) }}
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6,9 12,15 18,9"/></svg>
                </button>
                <div class="user-dropdown__menu" id="dropdownMenu">
                    <div class="dropdown-label">Kelola Akun</div>
                    <a href="{{ route('profile.show') }}" class="dropdown-item">Profil</a>
                    <a href="{{ route('faktor-risiko') }}" class="dropdown-item">Faktor Risiko</a>
                    <a href="{{ route('riwayat') }}" class="dropdown-item">Riwayat Skrining</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="button" class="dropdown-item dropdown-item--logout" onclick="showLogoutModal()">Log Out</button>
                    </form>
                </div>
            </div>
        </nav>
        @else
        <nav class="header-nav">
            <a href="{{ route('login') }}" class="nav-btn nav-btn--outline">Login</a>
            <a href="{{ route('register') }}" class="nav-btn nav-btn--fill">Register</a>
        </nav>
        @endif
    </div>
</header>

@if(isset($auth) && $auth)
<script>
function toggleDropdown(){
    const m=document.getElementById('dropdownMenu');
    const d=document.getElementById('userDropdown');
    m.classList.toggle('show');d.classList.toggle('open');
}
document.addEventListener('click',function(e){
    const d=document.getElementById('userDropdown');
    if(d&&!d.contains(e.target)){
        document.getElementById('dropdownMenu').classList.remove('show');
        d.classList.remove('open');
    }
});
</script>
@endif
