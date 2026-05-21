<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\SkrinningController;
use App\Http\Controllers\FaktorRisikoController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\TentangController;

// ===== HOMEPAGE =====
Route::get('/', fn() => view('homepage'))->name('home');

// ===== AUTH ROUTES (Fortify handle POST otomatis) =====
Route::middleware('guest')->group(function () {
    Route::get('/login',    fn() => view('auth.login'))->name('login');
    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
    Route::get('/reset-password/{token}', fn(string $token) => view('auth.reset-password', ['token' => $token]))->name('password.reset');
});

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ===== USER HALAMAN =====
Route::middleware(['auth'])->group(function () {
    Route::get('/beranda',        [BerandaController::class,     'index'])->name('beranda');
    Route::get('/skrinning',      [SkrinningController::class,   'index'])->name('skrinning');
    Route::post('/skrinning',     [SkrinningController::class,   'simpan'])->name('skrinning.simpan');
    Route::get('/hasil',          [SkrinningController::class,   'hasil'])->name('hasil');
    Route::get('/riwayat',        [SkrinningController::class,   'riwayat'])->name('riwayat');
    Route::get('/faktor-risiko',  [FaktorRisikoController::class,'index'])->name('faktor-risiko');
    Route::post('/faktor-risiko', [FaktorRisikoController::class,'update'])->name('faktor-risiko.update');
    Route::get('/berita',         [BeritaController::class,      'index'])->name('berita');
    Route::get('/berita/{berita}',[BeritaController::class,      'show'])->name('berita.show');
    Route::get('/tentang',        [TentangController::class,     'index'])->name('tentang');
});

// ===== ADMIN =====
Route::prefix('admin')->name('admin.')->group(function () {
    // Publik admin
    Route::get('/login',   [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',  [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/',        [\App\Http\Controllers\Admin\BerandaController::class, 'index'])->name('beranda');
        Route::get('/beranda', [\App\Http\Controllers\Admin\BerandaController::class, 'index']);

        // BERITA CRUD — halaman penuh terpisah
        Route::get   ('/berita',           [\App\Http\Controllers\Admin\BeritaController::class,'index'])->name('berita.index');
        Route::get   ('/berita/tambah',    [\App\Http\Controllers\Admin\BeritaController::class,'create'])->name('berita.create');
        Route::post  ('/berita',           [\App\Http\Controllers\Admin\BeritaController::class,'store'])->name('berita.store');
        Route::get   ('/berita/{id}',      [\App\Http\Controllers\Admin\BeritaController::class,'show'])->name('berita.show');
        Route::get   ('/berita/{id}/edit', [\App\Http\Controllers\Admin\BeritaController::class,'edit'])->name('berita.edit');
        Route::put   ('/berita/{id}',      [\App\Http\Controllers\Admin\BeritaController::class,'update'])->name('berita.update');
        Route::delete('/berita/{id}',      [\App\Http\Controllers\Admin\BeritaController::class,'destroy'])->name('berita.destroy');

        // PENGGUNA
        Route::get('/pengguna',        [\App\Http\Controllers\Admin\PenggunaController::class,  'index'])->name('pengguna');

        // PELAPORAN
        Route::get('/pelaporan',       [\App\Http\Controllers\Admin\PelaporanController::class, 'index'])->name('pelaporan');
        Route::get('/pelaporan/cetak', [\App\Http\Controllers\Admin\PelaporanController::class, 'cetak'])->name('pelaporan.cetak');

        // NOTIFIKASI
        Route::delete('/notifikasi/{notifikasi}', [\App\Http\Controllers\Admin\NotifikasiController::class,'hapus'])->name('notifikasi.hapus');
        Route::delete('/notifikasi',              [\App\Http\Controllers\Admin\NotifikasiController::class,'hapusSemua'])->name('notifikasi.hapus-semua');
    });
});
