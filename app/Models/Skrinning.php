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
        'g_luka_yang_lama_sembuh','g_turun_bb_kurang_3kg',
        'g_jamur_mulut','g_radang_tenggorokan_3','g_turun_bb_lebih_3kg',
        'g_diare_1_bulan','g_gangguan_pernafasan','g_infeksi_bakteri_berat',
    ];
    protected $casts = [
        'tanggal' => 'date',
        'g_sariawan' => 'boolean', 'g_sakit_kepala' => 'boolean',
        'g_badan_lelah' => 'boolean', 'g_radang_tenggorokan' => 'boolean',
        'g_hilang_nafsu_makan' => 'boolean', 'g_nyeri_otot' => 'boolean',
        'g_ruam_tubuh' => 'boolean', 'g_bengkak_kelenjar_leher' => 'boolean',
        'g_bengkak_kelenjar_ketiak' => 'boolean',
        'g_luka_yang_lama_sembuh' => 'boolean', 'g_turun_bb_kurang_3kg' => 'boolean',
        'g_jamur_mulut' => 'boolean', 'g_radang_tenggorokan_3' => 'boolean',
        'g_turun_bb_lebih_3kg' => 'boolean', 'g_diare_1_bulan' => 'boolean',
        'g_gangguan_pernafasan' => 'boolean', 'g_infeksi_bakteri_berat' => 'boolean',
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
            'g_luka_yang_lama_sembuh'  => ['label' => 'Luka yang lama sembuh', 'fase' => 2, 'skor' => 15],
            'g_turun_bb_kurang_3kg'    => ['label' => 'Penurunan Berat Badan kurang dari 3 kg Tanpa Sebab Jelas', 'fase' => 2, 'skor' => 15],
            'g_jamur_mulut'            => ['label' => 'Infeksi Jamur Pada Mulut', 'fase' => 3, 'skor' => 20],
            'g_radang_tenggorokan_3'   => ['label' => 'Radang tenggorokan lebih dari 3 minggu', 'fase' => 3, 'skor' => 20],
            'g_turun_bb_lebih_3kg'     => ['label' => 'Penurunan Berat Badan drastis lebih dari 3 kg Tanpa Sebab Jelas', 'fase' => 3, 'skor' => 20],
            'g_diare_1_bulan'          => ['label' => 'Diare Lebih dari 1 Bulan Tanpa Sebab', 'fase' => 3, 'skor' => 20],
            'g_gangguan_pernafasan'    => ['label' => 'Gangguan sistem pernafasan, sesak, dan batuk lebih dari 3 minggu', 'fase' => 3, 'skor' => 20],
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
