<div class="pcard" x-data="{}">
    <div class="pcard-left">
        <h3 class="pcard-title">Otentikasi Dua Faktor</h3>
        <p class="pcard-desc">Tambahkan keamanan tambahan ke akun Anda menggunakan autentikasi dua faktor.</p>
    </div>
    <div class="pcard-right">
        <div class="p2fa-box">
            <p class="p2fa-status">
                @if ($this->enabled)
                    @if ($showingConfirmation)
                        Selesaikan pengaktifan autentikasi dua faktor.
                    @else
                        <strong>Anda telah mengaktifkan autentikasi dua faktor.</strong>
                    @endif
                @else
                    <strong>Anda belum mengaktifkan autentikasi dua faktor.</strong>
                @endif
            </p>

            <p class="p2fa-desc">
                Ketika autentikasi dua faktor diaktifkan, Anda akan diminta untuk
                memasukkan token aman dan acak selama proses autentikasi. Anda
                dapat mengambil token ini dari aplikasi Google Authenticator di
                ponsel Anda.
            </p>

            @if ($this->enabled)
                @if ($showingQrCode)
                    <div class="p2fa-qr-wrap">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>
                    <p class="p2fa-key">
                        <strong>Setup Key:</strong> {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                    @if ($showingConfirmation)
                        <div class="pform-group" style="margin-top:12px;">
                            <label class="pform-label">Kode OTP</label>
                            <input type="text" inputmode="numeric" class="pform-input"
                                   wire:model="code"
                                   wire:keydown.enter="confirmTwoFactorAuthentication"
                                   autofocus autocomplete="one-time-code" />
                            @error('code') <span class="pform-error">{{ $message }}</span> @enderror
                        </div>
                    @endif
                @endif

                @if ($showingRecoveryCodes)
                    <div class="p2fa-recovery">
                        <p class="p2fa-recovery-title">Simpan kode pemulihan ini di tempat yang aman.</p>
                        <div class="p2fa-recovery-codes">
                            @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                                <div class="p2fa-code">{{ $code }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            <!-- TOMBOL AKSI -->
            <div class="p2fa-actions">
                @if (!$this->enabled)
                    <x-confirms-password wire:then="enableTwoFactorAuthentication">
                        <button type="button" class="pcard-btn-save" wire:loading.attr="disabled">
                            AKTIFKAN
                        </button>
                    </x-confirms-password>
                @else
                    @if ($showingRecoveryCodes)
                        <x-confirms-password wire:then="regenerateRecoveryCodes">
                            <button type="button" class="pcard-btn-outline">
                                REGENERASI KODE
                            </button>
                        </x-confirms-password>
                    @elseif ($showingConfirmation)
                        <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                            <button type="button" class="pcard-btn-save" wire:loading.attr="disabled">
                                KONFIRMASI
                            </button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="showRecoveryCodes">
                            <button type="button" class="pcard-btn-outline">
                                TUNJUKKAN KODE PEMULIHAN
                            </button>
                        </x-confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <button type="button" class="pcard-btn-danger" wire:loading.attr="disabled">
                                BATALKAN
                            </button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <button type="button" class="pcard-btn-danger" wire:loading.attr="disabled">
                                NONAKTIFKAN
                            </button>
                        </x-confirms-password>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
