<div class="pcard">
    <div class="pcard-left">
        <h3 class="pcard-title">Perbarui Kata Sandi</h3>
        <p class="pcard-desc">Pastikan akun Anda menggunakan kata sandi panjang dan acak untuk tetap aman.</p>
    </div>
    <div class="pcard-right">
        <form wire:submit="updatePassword">
            <div class="pform-group">
                <label class="pform-label">Kata Sandi Saat Ini</label>
                <input type="password" class="pform-input" wire:model="state.current_password"
                       autocomplete="current-password" />
                @error('current_password') <span class="pform-error">{{ $message }}</span> @enderror
            </div>

            <div class="pform-group">
                <label class="pform-label">Kata Sandi Baru</label>
                <input type="password" class="pform-input" wire:model="state.password"
                       autocomplete="new-password" />
                @error('password') <span class="pform-error">{{ $message }}</span> @enderror
            </div>

            <div class="pform-group">
                <label class="pform-label">Konfirmasi Kata Sandi</label>
                <input type="password" class="pform-input" wire:model="state.password_confirmation"
                       autocomplete="new-password" />
                @error('password_confirmation') <span class="pform-error">{{ $message }}</span> @enderror
            </div>

            <div class="pcard-actions">
                <div x-data="{ saved: false }"
                     x-on:password-updated.window="saved = true; setTimeout(() => saved = false, 2000)">
                    <span x-show="saved" class="pcard-saved">Tersimpan!</span>
                </div>
                <button type="submit" class="pcard-btn-save">SIMPAN</button>
            </div>
        </form>
    </div>
</div>
