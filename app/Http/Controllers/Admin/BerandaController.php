<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skrinning;
use App\Models\User;

class BerandaController extends Controller
{
    public function index() {
        $totalSkrining  = Skrinning::count();
        $risikoTinggi   = Skrinning::where('hasil','Risiko Tinggi')->count();

        // Persentase faktor risiko
        $totalUser = User::count() ?: 1;
        $faktorData = [
            'Sering mengonsumsi alkohol'           => User::where('faktor_alkohol',true)->count(),
            'Sering berganti pasangan seksual'     => User::where('faktor_berganti_pasangan',true)->count(),
            'Penggunaan jarum suntik bergantian'   => User::where('faktor_jarum_suntik',true)->count(),
            'Hubungan seks tanpa kondom'            => User::where('faktor_seks_tanpa_kondom',true)->count(),
        ];

        // Persentase jenis kelamin
        $lakiLaki   = User::where('jenis_kelamin','Laki-Laki')->count();
        $perempuan  = User::where('jenis_kelamin','Perempuan')->count();

        // Top 3 gejala terbanyak
        $gejalaMap = Skrinning::gejalaMap();
        $gejalaCounts = [];
        foreach ($gejalaMap as $col => $info) {
            $gejalaCounts[$info['label']] = Skrinning::where($col, true)->count();
        }
        arsort($gejalaCounts);
        $topGejala = array_slice($gejalaCounts, 0, 3, true);

        $notifikasi = \App\Models\Notifikasi::orderByDesc('created_at')->limit(10)->get();
        $unreadCount = \App\Models\Notifikasi::where('dibaca',false)->count();

        return view('admin.beranda', compact(
            'totalSkrining','risikoTinggi','faktorData','lakiLaki','perempuan',
            'topGejala','notifikasi','unreadCount','totalUser'
        ));
    }
}
