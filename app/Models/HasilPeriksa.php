<?php

namespace App\Models;

use Doctrine\Common\Lexer\Token;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilPeriksa extends Model
{   
    protected $table = 'hasilperiksas';
    use HasFactory;
    protected $fillable = [
        'kondisi',
        'resep_obat',
        'catatan',
        'reservasi_id' 
    ];

    public function reservasi(): BelongsTo
    {
        return $this->belongsTo(Reservasi::class);
    }
}
