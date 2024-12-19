<?php

namespace App\Services;

use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ReservasiService
{
    /**
     * 
     *
     * @param array $data
     * @return Reservasi
     */
    public static function createReservasi(array $data): Reservasi
    {
        return DB::transaction(function () use ($data) {
          
            return Reservasi::create([
                'tanggal' => $data['tanggal'],
                'poli' => $data['poli'],
                'status' => $data['status'],
                'pasien_id' => $data['pasien_id'],
                'dokter_id' => $data['dokter_id'],
            ]);
        });
    }

    public function getRiwayatPemeriksaanByPasien(int $pasienId): Collection
    {
        return Reservasi::where('pasien_id', $pasienId)
            ->with(['hasilperiksa']) 
            ->get();
    }


    public function searchPasien(string $nama): Collection
    {
        return \App\Models\Pasien::where('nama', 'like', "%$nama%")->get();
    }

    public function getReservasiHariIniByDokter(int $dokterId): Collection
    {
        return Reservasi::where('dokter_id', $dokterId)
            ->whereDate('tanggal', now()) 
            ->with(['pasien', 'hasilperiksa'])
            ->get();
    }

    public function getRiwayatReservasiByDokter(int $dokterId)
    {
        return Reservasi::with(['pasien', 'hasilperiksa'])
            ->where('dokter_id', $dokterId)
            ->orderBy('tanggal', 'desc')
            ->get();
    }

    public function getRiwayatReservasiByDokterPasien(int $dokterId, int $pasienId)
    {
        return Reservasi::with(['pasien', 'hasilperiksa'])
            ->where('dokter_id', $dokterId)
            ->where('pasien_id', $pasienId)
            ->orderBy('tanggal', 'desc')
            ->get();
    }

    public function getReservasiByUmumToday()
    {
        
    }

}
