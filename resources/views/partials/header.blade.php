<header class="sideni-header">
    <div class="header-inner">
        <div>
            <span class="logo-title">S I D E N I</span><br>
            <span class="logo-sub">SISTEM DETEKSI DINI HIV/AIDS</span>
        </div>

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
