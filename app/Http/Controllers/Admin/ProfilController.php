<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class ProfilController extends Controller
{
    public function index()
    {
        $notifikasi = \App\Models\Notifikasi::latest()->take(10)->get();
        $unreadCount = $notifikasi->where('dibaca', false)->count();
        $admin = Admin::find(session('admin.id'));

        return view('admin.profil', compact('notifikasi', 'unreadCount', 'admin'));
    }

    public function update(Request $request)
    {
        $admin = Admin::find(session('admin.id'));

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email,'.$admin->id,
            'password' => 'nullable|confirmed|min:8',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $admin->name  = $request->name;
        $admin->email = $request->email;

        // Cek perubahan profil SEBELUM save
        $profilChanged = $admin->isDirty(['name', 'email']);

        // Cek apakah password diisi
        $passwordChanged = false;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
            $passwordChanged = true;
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'admin_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto-admin', $filename);
            $admin->foto = $filename;
        }

        $admin->save();

        // BARU
session(['admin.name'  => $admin->name]);
session(['admin.email' => $admin->email]);
session(['admin.foto'  => $admin->foto]); // ← tambahkan ini

        if ($passwordChanged && $profilChanged) {
            $message = 'Profil dan password berhasil diperbarui!';
        } elseif ($passwordChanged) {
            $message = 'Password berhasil diperbarui!';
        } else {
            $message = 'Profil berhasil diperbarui!';
        }

        return redirect()->route('admin.profil')->with('success', $message);
    }
}