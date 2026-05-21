<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function hapus(Notifikasi $notifikasi) {
        $notifikasi->delete();
        return back();
    }

    public function hapusSemua() {
        Notifikasi::truncate();
        return back();
    }
}
