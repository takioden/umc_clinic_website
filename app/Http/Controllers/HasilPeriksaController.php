<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HasilPeriksaService;
use App\Models\HasilPeriksa;

class HasilPeriksaController extends Controller
{
    protected $hasilPeriksaService;


    public function __construct(HasilPeriksaService $hasilPeriksaService)
    {
        $this->hasilPeriksaService = $hasilPeriksaService;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'reservasi_id' => 'required|exists:reservasis,id',
            'kondisi' => 'required|string|max:65000',
            'resep_obat' => 'required|string|max:65000',
            'catatan' => 'nullable|string|max:65000',
        ]);

        $hasilPemeriksaan = $this->hasilPeriksaService->createHasilPemeriksaan($validatedData);

        return redirect()->back()->with('success', 'Hasil pemeriksaan berhasil ditambahkan!');
    }

    public function showRiwayatHasil($reservasiId)
    {
        $hasil = HasilPeriksa::where('reservasi_id', $reservasiId)->first();

        if ($hasil) {
            return response()->json([
                'kondisi' => $hasil->kondisi,
                'resep_obat' => $hasil->resep_obat,
                'catatan' => $hasil->catatan,
            ]);
        }

        return response()->json(['error' => 'Data not found'], 404);
    }

}
