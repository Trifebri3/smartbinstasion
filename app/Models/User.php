<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

#[Fillable(['name', 'email', 'password', 'role', 'google_id', 'avatar', 'points', 'qr_code_token'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'points' => 'integer',
        ];
    }

    /**
     * Cek apakah user memiliki peran Admin (Full Control).
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Pastikan user memiliki QR Code token unik untuk autentikasi stasiun fisik.
     */
    public function ensureQrToken(): string
    {
        if (empty($this->qr_code_token)) {
            $this->qr_code_token = 'SB-USR-' . strtoupper(Str::random(12));
            $this->save();
        }
        return $this->qr_code_token;
    }

    /**
     * Relasi ke transaksi setoran sampah.
     */
    public function deposits()
    {
        return $this->hasMany(WasteDeposit::class);
    }
}
