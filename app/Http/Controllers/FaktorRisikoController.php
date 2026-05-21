<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaktorRisikoController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('faktor-risiko.index', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();
        $map  = \App\Models\User::faktorMap();

        // Hanya boleh menambah, tidak boleh menghapus
        foreach ($map as $col => $label) {
            // Jika sudah true di DB, tetap true (tidak bisa dihapus)
            if ($user->$col) continue;
            // Jika belum, set sesuai request
            if ($request->boolean($col)) {
                $user->$col = true;
            }
        }
        $user->save();

        return back()->with('success', 'Faktor risiko berhasil disimpan!');
    }
}
