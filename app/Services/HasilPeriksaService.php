<?php
namespace App\Services;

use App\Models\HasilPeriksa;
use Illuminate\Support\Facades\Auth;

class HasilPeriksaService
{
    public function createHasilPemeriksaan(array $data): HasilPeriksa
    {
        
        $data['dokter_id'] = Auth::id(); 
        
        return HasilPeriksa::create($data);
    }

    

}
