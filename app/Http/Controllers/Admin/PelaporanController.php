<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skrinning;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    private function shared(): array {
        return [
            'notifikasi'  => Notifikasi::orderByDesc('created_at')->limit(10)->get(),
            'unreadCount' => Notifikasi::where('dibaca', false)->count(),
        ];
    }

    public function index(Request $request) {
        $bulan   = $request->input('bulan', '');
        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) $perPage = 10;

        $query = Skrinning::with('user')->orderBy('tanggal')->orderBy('id_skrinning');
        if ($bulan !== '') {
            $query->whereMonth('tanggal', (int)$bulan);
        }

        $data = $query->paginate($perPage)->withQueryString();

        return view('admin.pelaporan.index', array_merge(
            compact('data', 'bulan', 'perPage'),
            $this->shared()
        ));
    }

    public function cetak(Request $request) {
        $bulan = $request->input('bulan', '');
        $query = Skrinning::with('user')->orderBy('tanggal');
        if ($bulan !== '') {
            $query->whereMonth('tanggal', (int)$bulan);
        }
        $data      = $query->get();
        $namaBulan = $bulan !== ''
            ? \Carbon\Carbon::create()->month((int)$bulan)->locale('id')->monthName
            : 'Semua Bulan';
        $admin = session('admin');

        // Simpan notifikasi cetak
        Notifikasi::create([
            'judul' => 'Laporan Berhasil Dicetak',
            'pesan' => 'Laporan Bulan ' . ucfirst($namaBulan) . ' Telah Berhasil Dicetak!',
        ]);

        return view('admin.pelaporan.cetak', compact('data', 'namaBulan', 'admin'));
    }
}
