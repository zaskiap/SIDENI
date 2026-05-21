<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    private function shared(): array {
        return [
            'notifikasi'  => \App\Models\Notifikasi::orderByDesc('created_at')->limit(10)->get(),
            'unreadCount' => \App\Models\Notifikasi::where('dibaca', false)->count(),
        ];
    }

    public function index(Request $request) {
        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) $perPage = 10;

        $query = User::query();

        // Filter jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter faktor risiko
        $faktorCols = [
            'faktor_alkohol',
            'faktor_berganti_pasangan',
            'faktor_jarum_suntik',
            'faktor_seks_tanpa_kondom',
        ];
        foreach ($faktorCols as $col) {
            $val = $request->input('filter_' . $col);
            if ($val === '1') {
                $query->where($col, true);
            } elseif ($val === '0') {
                $query->where(function($q) use ($col) {
                    $q->where($col, false)->orWhereNull($col);
                });
            }
        }

        $pengguna = $query->orderBy('id')->paginate($perPage)->withQueryString();

        return view('admin.pengguna.index', array_merge(
            compact('pengguna', 'perPage'),
            $this->shared()
        ));
    }
}
