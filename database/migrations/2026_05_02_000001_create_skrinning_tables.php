<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Tabel hasil skrining
        Schema::create('skrinning', function (Blueprint $table) {
            $table->id('id_skrinning');
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal');
            $table->string('hasil', 50); // Risiko Rendah/Sedang/Tinggi
            $table->integer('skor_total')->default(0);
            $table->integer('skor_gejala')->default(0);
            $table->integer('skor_risiko')->default(0);
            // Gejala fase 1 (8 gejala) - kolom terpisah
            $table->boolean('g_sariawan')->default(false);
            $table->boolean('g_sakit_kepala')->default(false);
            $table->boolean('g_badan_lelah')->default(false);
            $table->boolean('g_radang_tenggorokan')->default(false);
            $table->boolean('g_hilang_nafsu_makan')->default(false);
            $table->boolean('g_nyeri_otot')->default(false);
            $table->boolean('g_ruam_tubuh')->default(false);
            $table->boolean('g_bengkak_kelenjar_leher')->default(false);
            $table->boolean('g_bengkak_kelenjar_ketiak')->default(false);
            // Gejala fase 2 (2 gejala)
            $table->boolean('g_kurang_sel_darah_putih')->default(false);
            $table->boolean('g_turun_bb_kurang_10')->default(false);
            // Gejala fase 3 (6 gejala)
            $table->boolean('g_jamur_mulut')->default(false);
            $table->boolean('g_jamur_tenggorokan')->default(false);
            $table->boolean('g_turun_bb_lebih_10')->default(false);
            $table->boolean('g_diare_1_bulan')->default(false);
            $table->boolean('g_tbc_paru')->default(false);
            $table->boolean('g_infeksi_bakteri_berat')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel berita
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori', 50)->default('Trending');
            $table->date('tanggal');
            $table->longText('isi');
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });

        // Tabel admin
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Tabel notifikasi admin
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('pesan');
            $table->boolean('dibaca')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('notifikasi');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('skrinning');
    }
};
