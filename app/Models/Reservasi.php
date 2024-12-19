<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'poli',
        'status',
        'pasien_id',
        'dokter_id'
    ];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }

    public function hasilperiksa(): HasOne
    {
        return $this->hasOne(HasilPeriksa::class);
    }
}
