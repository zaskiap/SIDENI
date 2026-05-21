<div class="pcard">
    <div class="pcard-left">
        <h3 class="pcard-title">Sesi Peramban</h3>
        <p class="pcard-desc">Kelola dan keluar dari sesi aktif Anda di browser dan perangkat lain.</p>
    </div>
    <div class="pcard-right">
        <div class="psession-box">
            <p class="psession-desc">
                Jika perlu, Anda dapat keluar dari semua sesi browser Anda di semua
                perangkat Anda. Beberapa sesi terbaru Anda tercantum di bawah;
                namun, daftar ini mungkin tidak lengkap. Jika Anda merasa akun Anda
                telah disusupi, Anda juga harus memperbarui kata sandi Anda.
            </p>

            @if (count($this->sessions) > 0)
                <div class="psession-list">
                    @foreach ($this->sessions as $session)
                        <div class="psession-item">
                            <div class="psession-icon">
                                @if ($session->agent->isDesktop())
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                         stroke="#666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                        <line x1="8" y1="21" x2="16" y2="21"/>
                                        <line x1="12" y1="17" x2="12" y2="21"/>
                                    </svg>
                                @else
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                         stroke="#666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                        <line x1="12" y1="18" x2="12.01" y2="18"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="psession-info">
                                <div class="psession-device">
                                    {{ $session->agent->platform() ?: 'Unknown' }}
                                    - {{ $session->agent->browser() ?: 'Unknown' }}
                                </div>
                                <div class="psession-meta">
                                    {{ $session->ip_address }},
                                    @if ($session->is_current_device)
                                        <span class="psession-current">Perangkat Ini</span>
                                    @else
                                        Terakhir aktif {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <button class="pcard-btn-dark" wire:click="confirmLogout" wire:loading.attr="disabled">
                KELUAR DARI SESI PERAMBAN LAIN
            </button>
        </div>

        {{-- MODAL KONFIRMASI --}}
        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">Keluar Sesi Lain</x-slot>
            <x-slot name="content">
                Masukkan kata sandi untuk mengonfirmasi keluar dari semua sesi browser lain.
                <div class="pform-group" style="margin-top:14px;">
                    <input type="password" class="pform-input"
                           placeholder="Kata sandi"
                           autocomplete="current-password"
                           wire:model="password"
                           wire:keydown.enter="logoutOtherBrowserSessions" />
                    @error('password') <span class="pform-error">{{ $message }}</span> @enderror
                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="pcard-btn-outline" wire:click="$toggle('confirmingLogout')">Batal</button>
                <button class="pcard-btn-save" wire:click="logoutOtherBrowserSessions"
                        wire:loading.attr="disabled" style="margin-left:8px;">
                    Keluar
                </button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
