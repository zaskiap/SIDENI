<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    private function shared(): array {
        return [
            'notifikasi'  => \App\Models\Notifikasi::orderByDesc('created_at')->limit(10)->get(),
            'unreadCount' => \App\Models\Notifikasi::where('dibaca', false)->count(),
        ];
    }

    public function index(Request $request) {
        $q = $request->input('cari', '');
        $berita = Berita::with('admin')
            ->when($q, fn($q2) => $q2->where('judul', 'like', "%{$q}%"))
            ->orderByDesc('tanggal')->get();
        return view('admin.berita.index', array_merge(compact('berita','q'), $this->shared()));
    }

    public function create() {
        return view('admin.berita.create', $this->shared());
    }

    public function store(Request $request) {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'isi'      => 'required|string',
            'thumbnail'=> 'nullable|image|max:2048',
        ]);
        $data = $request->only(['judul','kategori','tanggal','isi']);
        $data['id_admin'] = session('admin.id');
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita','public');
        }
        Berita::create($data);
        return redirect()->route('admin.berita.index')
                         ->with('success','Berita berhasil ditambahkan!');
    }

    public function show($id) {
        $berita = Berita::with('admin')->findOrFail($id);
        return view('admin.berita.show', array_merge(compact('berita'), $this->shared()));
    }

    public function edit($id) {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', array_merge(compact('berita'), $this->shared()));
    }

    public function update(Request $request, $id) {
        $berita = Berita::findOrFail($id);
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'isi'      => 'required|string',
            'thumbnail'=> 'nullable|image|max:2048',
        ]);
        $data = $request->only(['judul','kategori','tanggal','isi']);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita','public');
        }
        $berita->update($data);
        return redirect()->route('admin.berita.index')
                         ->with('success','Berita berhasil diperbarui!');
    }

    public function destroy($id) {
        $berita = Berita::findOrFail($id);
        if ($berita->thumbnail) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($berita->thumbnail);
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')
                         ->with('success','Berita berhasil dihapus!');
    }
}
