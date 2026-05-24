<div class="admin-logout-overlay" id="adminLogoutOverlay">
    <div class="admin-logout-modal">
        <div class="logout-icon-wrap">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#b91c1c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </div>
        <h3>Keluar dari Aplikasi</h3>
        <p>Apakah Anda yakin ingin keluar dari aplikasi SIDENI?</p>
 <div class="admin-logout-actions" style="display:flex; gap:10px;">
    <button class="btn-cancel-logout" onclick="hideAdminLogout()" style="flex:1; padding:10px 8px; border:1.5px solid #e5e5e5; border-radius:7px; background:#fff; font-size:13px; font-weight:600; cursor:pointer;">Tidak</button>
    <form method="POST" action="{{ route('admin.logout') }}" style="flex:1; display:flex;">
        @csrf
        <button type="submit" style="width:100%; padding:10px 8px; background:#3b82f6; color:#fff; border:none; border-radius:7px; font-size:13px; font-weight:700; cursor:pointer;">Ya</button>
    </form>
</div>
</div>
<script>
function showAdminLogout(){document.getElementById('adminLogoutOverlay').classList.add('show');}
function hideAdminLogout(){document.getElementById('adminLogoutOverlay').classList.remove('show');}
document.getElementById('adminLogoutOverlay').addEventListener('click',function(e){if(e.target===this)hideAdminLogout();});
</script>
