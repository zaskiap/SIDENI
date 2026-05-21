<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skrinning extends Model
{
    protected $table = 'skrinning';
    protected $primaryKey = 'id_skrinning';
    protected $fillable = [
        'user_id','tanggal','hasil','skor_total','skor_gejala','skor_risiko',
        'g_sariawan','g_sakit_kepala','g_badan_lelah','g_radang_tenggorokan',
        'g_hilang_nafsu_makan','g_nyeri_otot','g_ruam_tubuh',
        'g_bengkak_kelenjar_leher','g_bengkak_kelenjar_ketiak',
        'g_kurang_sel_darah_putih','g_turun_bb_kurang_10',
        'g_jamur_mulut','g_jamur_tenggorokan','g_turun_bb_lebih_10',
        'g_diare_1_bulan','g_tbc_paru','g_infeksi_bakteri_berat',
    ];
    protected $casts = [
        'tanggal' => 'date',
        'g_sariawan' => 'boolean', 'g_sakit_kepala' => 'boolean',
        'g_badan_lelah' => 'boolean', 'g_radang_tenggorokan' => 'boolean',
        'g_hilang_nafsu_makan' => 'boolean', 'g_nyeri_otot' => 'boolean',
        'g_ruam_tubuh' => 'boolean', 'g_bengkak_kelenjar_leher' => 'boolean',
        'g_bengkak_kelenjar_ketiak' => 'boolean',
        'g_kurang_sel_darah_putih' => 'boolean', 'g_turun_bb_kurang_10' => 'boolean',
        'g_jamur_mulut' => 'boolean', 'g_jamur_tenggorokan' => 'boolean',
        'g_turun_bb_lebih_10' => 'boolean', 'g_diare_1_bulan' => 'boolean',
        'g_tbc_paru' => 'boolean', 'g_infeksi_bakteri_berat' => 'boolean',
    ];

    // Semua kolom gejala dengan label
    public static function gejalaMap(): array {
        return [
            'g_sariawan'               => ['label' => 'Sariawan', 'fase' => 1, 'skor' => 10],
            'g_sakit_kepala'           => ['label' => 'Sakit Kepala', 'fase' => 1, 'skor' => 10],
            'g_badan_lelah'            => ['label' => 'Badan Mudah Lelah', 'fase' => 1, 'skor' => 10],
            'g_radang_tenggorokan'     => ['label' => 'Mengalami Radang Tenggorokan', 'fase' => 1, 'skor' => 10],
            'g_hilang_nafsu_makan'     => ['label' => 'Hilangnya Nafsu Makan', 'fase' => 1, 'skor' => 10],
            'g_nyeri_otot'             => ['label' => 'Nyeri Otot', 'fase' => 1, 'skor' => 10],
            'g_ruam_tubuh'             => ['label' => 'Ruam-ruam Pada Tubuh', 'fase' => 1, 'skor' => 10],
            'g_bengkak_kelenjar_leher' => ['label' => 'Pembengkakan Kelenjar Getah Bening di Leher', 'fase' => 1, 'skor' => 10],
            'g_bengkak_kelenjar_ketiak'=> ['label' => 'Pembengkakan Kelenjar Getah Bening di Ketiak', 'fase' => 1, 'skor' => 10],
            'g_kurang_sel_darah_putih' => ['label' => 'Berkurangnya Sel Darah Putih Secara Drastis', 'fase' => 2, 'skor' => 15],
            'g_turun_bb_kurang_10'     => ['label' => 'Penurunan Berat Badan < 10% Tanpa Sebab Jelas', 'fase' => 2, 'skor' => 15],
            'g_jamur_mulut'            => ['label' => 'Infeksi Jamur Pada Mulut', 'fase' => 3, 'skor' => 20],
            'g_jamur_tenggorokan'      => ['label' => 'Infeksi Jamur Pada Tenggorokan', 'fase' => 3, 'skor' => 20],
            'g_turun_bb_lebih_10'      => ['label' => 'Penurunan Berat Badan > 10% Tanpa Sebab Jelas', 'fase' => 3, 'skor' => 20],
            'g_diare_1_bulan'          => ['label' => 'Diare Lebih dari 1 Bulan Tanpa Sebab', 'fase' => 3, 'skor' => 20],
            'g_tbc_paru'               => ['label' => 'Tuberkulosis Paru', 'fase' => 3, 'skor' => 20],
            'g_infeksi_bakteri_berat'  => ['label' => 'Infeksi Bakteri Berat (Pneumonia, Kanker, dll)', 'fase' => 3, 'skor' => 20],
        ];
    }

    public function getGejalaDipilihAttribute(): array {
        $result = [];
        foreach (self::gejalaMap() as $col => $info) {
            if ($this->$col) $result[] = $info['label'];
        }
        return $result;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
