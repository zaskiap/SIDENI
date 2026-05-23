<?php
namespace App\Http\Controllers;

use App\Models\Skrinning;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkrinningController extends Controller
{
    public function index() {
        return view('skrinning.index');
    }

    public function simpan(Request $request) {
        $user = Auth::user();
        $gejalaMap = Skrinning::gejalaMap();

        $data = ['user_id' => $user->id, 'tanggal' => now()->toDateString()];
        $skorGejala = 0;

        foreach ($gejalaMap as $col => $info) {
            $val = $request->boolean($col);
            $data[$col] = $val;
            if ($val) $skorGejala += $info['skor'];
        }

        $skorRisiko = $user->skor_faktor;
        $skorTotal  = $skorGejala + $skorRisiko;

        if ($skorTotal >= 90) $hasil = 'Risiko Tinggi';
        elseif ($skorTotal >= 40) $hasil = 'Risiko Sedang';
        else $hasil = 'Risiko Rendah';

        $data['skor_gejala'] = $skorGejala;
        $data['skor_risiko'] = $skorRisiko;
        $data['skor_total']  = $skorTotal;
        $data['hasil']       = $hasil;

        $skrinning = Skrinning::create($data);

        // Simpan ke session untuk halaman hasil
        session(['hasil_skrinning_id' => $skrinning->id_skrinning]);

        return redirect()->route('hasil');
    }

    public function hasil() {
        $user = Auth::user();
        $id   = session('hasil_skrinning_id');

        if (!$id) return redirect()->route('skrinning');

        $skrinning = Skrinning::find($id);
        if (!$skrinning || $skrinning->user_id !== $user->id) {
            return redirect()->route('skrinning');
        }

        return view('skrinning.hasil', compact('skrinning', 'user'));
    }

    public function hasilDetail($id) {
        $user      = Auth::user();
        $skrinning = Skrinning::where('id_skrinning', $id)
                                ->where('user_id', $user->id)
                                ->firstOrFail();
        return view('skrinning.hasil', compact('skrinning', 'user'));
    }

    public function riwayat() {
        $user      = Auth::user();
        $riwayat   = Skrinning::where('user_id', $user->id)
                               ->orderByDesc('tanggal')
                               ->orderByDesc('id_skrinning')
                               ->get();
        return view('skrinning.riwayat', compact('riwayat', 'user'));
    }
}
