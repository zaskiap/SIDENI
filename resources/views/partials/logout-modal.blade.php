<div class="logout-overlay" id="logoutOverlay">
    <div class="logout-modal">
        <div class="logout-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#b91c1c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16,17 21,12 16,7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </div>
        <h3 class="logout-title">Keluar dari Aplikasi</h3>
        <p class="logout-desc">Apakah Anda yakin ingin keluar dari aplikasi SIDENI?</p>
        <div class="logout-actions">
            <button class="logout-btn-cancel" onclick="hideLogoutModal()">Tidak</button>
            <form method="POST" action="{{ route('logout') }}" style="flex:1; display:block;">
    @csrf
    <button type="submit" class="logout-btn-confirm">Ya</button>
</form>
        </div>
    </div>
</div>
<script>
function showLogoutModal(){document.getElementById('logoutOverlay').classList.add('show');}
function hideLogoutModal(){document.getElementById('logoutOverlay').classList.remove('show');}
document.addEventListener('DOMContentLoaded',function(){
    const o=document.getElementById('logoutOverlay');
    if(o) o.addEventListener('click',function(e){if(e.target===this)hideLogoutModal();});
});
</script>
