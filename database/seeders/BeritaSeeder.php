<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        Berita::create([
            'judul'    => 'Kenali Apa Itu HIV, Penyebab, dan Tanda-tandanya',
            'kategori' => 'Trending',
            'tanggal'  => '2026-01-10',
            'isi'      => '<p>HIV adalah salah satu penyakit infeksi menular seksual yang belum ada obatnya. Penyakit ini berpotensi mengancam jiwa dengan merusak sistem kekebalan tubuh penderitanya.</p><p>HIV mengganggu kemampuan tubuh Anda untuk melawan infeksi dan penyakit. Simak penjelasan lebih lanjut tentang apa itu HIV, penyebab, dan tanda-tandanya.</p><h3>Apa itu HIV?</h3><p>Mengutip Organisasi Kesehatan Dunia (WHO), HIV adalah singkatan dari human immunodeficiency virus. Penyakit infeksi ini menyerang sel darah putih, sehingga melemahkan sistem kekebalan tubuh.</p><h3>Apa penyebab HIV?</h3><p>Dikutip dari Mayo Clinic, HIV disebabkan oleh human immunodeficiency virus. Virus tersebut menghancurkan sel T CD4, sel darah putih yang berperan besar dalam membantu tubuh Anda melawan penyakit.</p><h3>Apa saja tanda-tanda HIV?</h3><p>Beberapa tanda HIV meliputi: Demam, Sakit kepala, Ruam, Sakit tenggorokan, Pembengkakan kelenjar getah bening, Penurunan berat badan, Diare, Batuk.</p>',
        ]);
        Berita::create([
            'judul'    => 'Tren Kasus HIV di Padang Terkendali, Dinkes Gencarkan Pencegahan',
            'kategori' => 'Trending',
            'tanggal'  => '2026-02-28',
            'isi'      => '<p>Padang, Padangkita.com - Upaya pengendalian penyebaran Human Immunodeficiency Virus (HIV) di Kota Padang menunjukkan hasil positif. Dinas Kesehatan setempat terus menggencarkan program pencegahan dan edukasi kepada masyarakat.</p>',
        ]);
        Berita::create([
            'judul'    => 'Untuk Anak dengan HIV di Indonesia',
            'kategori' => 'Highlight',
            'tanggal'  => '2026-02-02',
            'isi'      => '<p>Anak dengan HIV di Indonesia merupakan populasi rentan dengan karakteristik khusus. Pemenuhan hak anak dengan remaja dengan HIV menjadi kerja yang sulit. Di sisi lain, pihak yang terlibat dalam pendampingan dan perawatan untuk anak dengan HIV sangat membutuhkan informasi dan dukungan.</p>',
        ]);
    }
}
