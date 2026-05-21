<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table    = 'berita';
    protected $fillable = ['judul','kategori','tanggal','isi','thumbnail','id_admin'];
    protected $casts    = ['tanggal' => 'date'];

    public function getThumbnailUrlAttribute(): string {
        return $this->thumbnail
            ? asset('storage/'.$this->thumbnail)
            : asset('images/banner-berita.png');
    }

    public function getIsiSingkatAttribute(): string {
        return mb_substr(strip_tags($this->isi), 0, 120).'...';
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
