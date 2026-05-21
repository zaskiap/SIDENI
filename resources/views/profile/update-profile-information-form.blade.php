<div class="pcard">
    <div class="pcard-left">
        <h3 class="pcard-title">Informasi Profil</h3>
        <p class="pcard-desc">Perbarui informasi profil dan alamat email akun Anda.</p>
    </div>
    <div class="pcard-right">
        <form wire:submit="updateProfileInformation">
            <div class="pform-group">
                <label class="pform-label">Nama</label>
                <input type="text" class="pform-input" wire:model="state.name"
                       required autocomplete="name" />
                @error('name') <span class="pform-error">{{ $message }}</span> @enderror
            </div>

            <div class="pform-group">
                <label class="pform-label">Email</label>
                <input type="email" class="pform-input" wire:model="state.email"
                       required autocomplete="username" />
                @error('email') <span class="pform-error">{{ $message }}</span> @enderror
            </div>

            <div class="pcard-actions">
                <div wire:dirty wire:target="updateProfileInformation" class="pcard-saved">Menyimpan...</div>
                <div x-data="{ saved: false }"
                     x-on:profile-information-updated.window="saved = true; setTimeout(() => saved = false, 2000)">
                    <span x-show="saved" class="pcard-saved">Tersimpan!</span>
                </div>
                <button type="submit" class="pcard-btn-save">SIMPAN</button>
            </div>
        </form>
    </div>
</div>
