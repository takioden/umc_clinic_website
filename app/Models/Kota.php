<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kota extends Model
{
    use HasFactory;

    protected $fillable = [
        'kota',
    ];

    public function kecamatan():HasOne
    {
       return $this->hasOne(Kecamatan::class); 
    }
}
