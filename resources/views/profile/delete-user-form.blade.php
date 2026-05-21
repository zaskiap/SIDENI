<div class="pcard">
    <div class="pcard-left">
        <h3 class="pcard-title">Hapus Akun</h3>
        <p class="pcard-desc">Hapus akun Anda secara permanen.</p>
    </div>
    <div class="pcard-right">
        <div class="pdelete-box">
            <p class="pdelete-desc">
                Setelah akun Anda dihapus, semua sumber daya dan data yang ada di
                dalamnya akan dihapus secara permanen. Sebelum menghapus akun
                Anda, harap unduh data atau informasi yang ingin Anda pertahankan.
            </p>

            <button class="pcard-btn-danger" wire:click="confirmUserDeletion"
                    wire:loading.attr="disabled">
                HAPUS AKUN
            </button>
        </div>

        {{-- MODAL KONFIRMASI HAPUS --}}
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">Hapus Akun</x-slot>
            <x-slot name="content">
                Apakah Anda yakin ingin menghapus akun? Semua data akan dihapus permanen.
                Masukkan kata sandi untuk mengonfirmasi.
                <div class="pform-group" style="margin-top:14px;">
                    <input type="password" class="pform-input"
                           placeholder="Kata sandi"
                           autocomplete="current-password"
                           wire:model="password"
                           wire:keydown.enter="deleteUser" />
                    @error('password') <span class="pform-error">{{ $message }}</span> @enderror
                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="pcard-btn-outline" wire:click="$toggle('confirmingUserDeletion')">Batal</button>
                <button class="pcard-btn-danger" wire:click="deleteUser"
                        wire:loading.attr="disabled" style="margin-left:8px;">
                    Hapus Akun
                </button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
