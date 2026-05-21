<div class="admin-logout-overlay" id="adminLogoutOverlay">
    <div class="admin-logout-modal">
        <div class="logout-icon-wrap">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#b91c1c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </div>
        <h3>Keluar dari Aplikasi</h3>
        <p>Apakah Anda yakin ingin keluar dari aplikasi SIDENI?</p>
        <div class="admin-logout-actions">
            <button onclick="hideAdminLogout()" class="btn-cancel-logout">Tidak</button>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn-confirm-logout">Ya</button>
            </form>
        </div>
    </div>
</div>
<script>
function showAdminLogout(){document.getElementById('adminLogoutOverlay').classList.add('show');}
function hideAdminLogout(){document.getElementById('adminLogoutOverlay').classList.remove('show');}
document.getElementById('adminLogoutOverlay').addEventListener('click',function(e){if(e.target===this)hideAdminLogout();});
</script>
