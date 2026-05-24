<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaAdminController extends Controller
{
    private function shared(): array {
        return [
            'notifikasi'  => \App\Models\Notifikasi::orderByDesc('created_at')->limit(10)->get(),
            'unreadCount' => \App\Models\Notifikasi::where('dibaca', false)->count(),
        ];
    }
    // Tampilkan daftar semua admin
    public function index()
    {
        $admins = Admin::orderBy('role')->orderBy('name')->get();
        return view('admin.kelola-admin.index', array_merge(compact('admins'), $this->shared()));
    }

    // Simpan admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed', // butuh field password_confirmation
            'role'     => 'required|in:superadmin,admin',
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.kelola-admin.index')
                         ->with('success', 'Admin baru berhasil ditambahkan.');
    }

    // Hapus admin
    public function destroy($id)
    {
        $adminLogin = session('admin');

        // Cegah superadmin hapus dirinya sendiri
        if ($adminLogin['id'] == $id) {
            return redirect()->route('admin.kelola-admin.index')
                             ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.kelola-admin.index')
                         ->with('success', 'Admin berhasil dihapus.');
    }
}