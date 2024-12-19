<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kecamatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kecamatan',
        'kota_id'
    ];

    public function alamat(): HasOne
    {
        return $this->hasOne(Alamat::class);
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Kota::class);
    }
}


