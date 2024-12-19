<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pasien extends Model
{
    use HasFactory;
     // Kolom yang bisa diisi
     protected $fillable = [
        'nama',
        'nohp',
        'umur',
        'jenis_kelamin',
        'nik',
        'user_id',
        'alamat_id'   
    ];

    /**
     * Relasi dengan model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function alamat(): BelongsTo
    {
        return $this->belongsTo(Alamat::class);
    }

    public function reservasi(): HasMany
    {
        return $this->hasMany(Reservasi::class);
    }
}
