<?php
namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index() {
        $berita = Berita::orderByDesc('tanggal')->get();
        return view('berita.index', compact('berita'));
    }

    public function show(Berita $berita) {
        $terkait = Berita::where('id', '!=', $berita->id)
                         ->where('kategori', $berita->kategori)
                         ->limit(3)->get();
        return view('berita.show', compact('berita', 'terkait'));
    }
}
