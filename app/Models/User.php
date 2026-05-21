<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name','email','password','nama','jenis_kelamin',
        'faktor_alkohol','faktor_berganti_pasangan',
        'faktor_jarum_suntik','faktor_seks_tanpa_kondom',
    ];

    protected $hidden = ['password','remember_token','two_factor_recovery_codes','two_factor_secret'];
    protected $appends = ['profile_photo_url'];

    protected function casts(): array {
        return [
            'email_verified_at'        => 'datetime',
            'password'                 => 'hashed',
            'faktor_alkohol'           => 'boolean',
            'faktor_berganti_pasangan' => 'boolean',
            'faktor_jarum_suntik'      => 'boolean',
            'faktor_seks_tanpa_kondom' => 'boolean',
        ];
    }

    public static function faktorMap(): array {
        return [
            'faktor_alkohol'           => 'Sering mengonsumsi alkohol',
            'faktor_berganti_pasangan' => 'Sering berganti pasangan dalam melakukan hubungan seksual',
            'faktor_jarum_suntik'      => 'Penggunaan jarum suntik secara bergantian',
            'faktor_seks_tanpa_kondom' => 'Hubungan seks anal atau vaginal tanpa pengaman (kondom)',
        ];
    }

    public function getFaktorAktifAttribute(): array {
        $result = [];
        foreach (self::faktorMap() as $col => $label) {
            if ($this->$col) $result[$col] = $label;
        }
        return $result;
    }

    public function getSkorFaktorAttribute(): int {
        $skor = 0;
        foreach (array_keys(self::faktorMap()) as $col) {
            if ($this->$col) $skor += 15;
        }
        return $skor;
    }

    public function skrinning() {
        return $this->hasMany(Skrinning::class);
    }
}
