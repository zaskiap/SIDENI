<div class="admin-topbar">
    <div class="admin-topbar-right">
        {{-- NOTIFIKASI --}}
        <div class="notif-wrap" id="notifWrap">
            <button class="notif-btn" onclick="toggleNotif()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                @if($unreadCount > 0)
                    <span class="notif-badge">{{ $unreadCount }}</span>
                @endif
            </button>
            <div class="notif-dropdown" id="notifDropdown">
                <div class="notif-header">
                    <span>Notifikasi</span>
                    @if($notifikasi->count() > 0)
                        <form method="POST" action="{{ route('admin.notifikasi.hapus-semua') }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="notif-clear">Hapus Semua</button>
                        </form>
                    @endif
                </div>
                @forelse($notifikasi as $n)
                    <div class="notif-item {{ $n->dibaca ? '' : 'unread' }}">
                        <div class="notif-item-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="#3b82f6"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/></svg>
                        </div>
                        <div class="notif-item-body">
                            <div class="notif-item-time">{{ $n->created_at->format('d F Y') }}</div>
                            <div class="notif-item-text">{{ $n->pesan }}</div>
                        </div>
                        <form method="POST" action="{{ route('admin.notifikasi.hapus', $n) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="notif-item-del">×</button>
                        </form>
                    </div>
                @empty
                    <div style="padding:16px;text-align:center;font-size:12px;color:#aaa;">Tidak ada notifikasi</div>
                @endforelse
            </div>
        </div>

        {{-- ADMIN INFO --}}
        <div class="admin-info">
            <span class="admin-name">{{ strtoupper(session('admin.name','ADMIN')) }}</span>
            <div class="admin-avatar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#888"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </div>
        </div>
    </div>
</div>
<script>
function toggleNotif(){
    document.getElementById('notifDropdown').classList.toggle('show');
}
document.addEventListener('click',function(e){
    const w=document.getElementById('notifWrap');
    if(w&&!w.contains(e.target)) document.getElementById('notifDropdown').classList.remove('show');
});
</script>
