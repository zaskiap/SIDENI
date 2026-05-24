<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table    = 'admins';
    protected $fillable = ['name','email','password', 'role', 'foto'];
    protected $hidden   = ['password'];

    // Helper: cek apakah admin ini adalah superadmin
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }
    
    public function berita() {
        return $this->hasMany(Berita::class, 'id_admin');
    }
}
