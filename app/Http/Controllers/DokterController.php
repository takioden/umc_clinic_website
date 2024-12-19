<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ReservasiService;
use App\Services\HasilPeriksaService;
use App\Services\DokterService;

class DokterController extends Controller
{
    

    protected $reservasiService;
    protected $hasilPeriksaService;

    public function __construct(ReservasiService $reservasiService, HasilPeriksaService $hasilPeriksaService)
    {
        $this->reservasiService = $reservasiService;
        $this->hasilPeriksaService= $hasilPeriksaService;
    }

    public function index()
    {
        return view('dokter.index');
    }

    public function showDashboard()
    {
        $user = Auth::user();
        $dokter = Auth::user()->dokter;
        $reservasiList = $this->reservasiService->getReservasiHariIniByDokter($dokter->id);
        return view('dokter.main.index', compact('user', 'dokter', 'reservasiList'));
    }

    public function showRiwayatHasil(int $pasienId)
    {
        $user = Auth::user();
        $dokter = auth()->user()->dokter; 
        $riwayatReservasi = $this->reservasiService->getRiwayatReservasiByDokterPasien($dokter->id, $pasienId);
        return view('dokter.main.riwayathasil', compact('user', 'riwayatReservasi'));
    }


    public function updateHasilPeriksa(Request $request)
    {
            $request->validate([
                'reservasi_id' => 'required|exists:reservasis,id',
                'kondisi' => 'required|string',
                'resep_obat' => 'required|string',
                'catatan' => 'nullable|string',
            ]);

            $reservasi = Reservasi::findOrFail($request->reservasi_id);

            if ($reservasi->hasilperiksa) {
                
                $reservasi->hasilperiksa->update([
                    'kondisi' => $request->kondisi,
                    'resep_obat' => $request->resep_obat,
                    'catatan' => $request->catatan,
                ]);
            } else {
                
                $reservasi->hasilperiksa()->create([
                    'kondisi' => $request->kondisi,
                    'resep_obat' => $request->resep_obat,
                    'catatan' => $request->catatan,
                ]);
            }

            return redirect()->route('riwayatHasil')->with('success', 'Hasil pemeriksaan berhasil diperbarui.');
    }

    public function daftarPasien()
    {   
        $user = Auth::user();
        $dokter = auth()->user()->dokter;
        
        $data = Reservasi::with(['pasien', 'hasilperiksa'])
            ->where('dokter_id', $dokter -> id)
            ->whereHas('pasien')
            ->get()
            ->groupBy('pasien_id');

        return view('dokter.main.daftarhasil', compact('data', 'user', 'dokter'));
        
    }

    public function updateDokterShow($id)
    {
        $user=Auth::user();
        $dokter = Dokter::with('user')->findOrFail($id);

        return view('dokter.main.editprofil', compact('dokter', 'user'));
    }

    public function updateDokter(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        $user = $dokter->user;

        $request->validate([
            'username' => 'sometimes|string|unique:users,username,' . $user->id,  
            'password' => 'nullable|string|min:6',  
            'nama' => 'sometimes|string|max:255',
            'nohp' => 'sometimes|string',
            'nostr' => 'sometimes|string|unique:dokters,nostr,' . $dokter->id,  
            'poli' => 'sometimes|string|in:umum,gigi',
            'status' => 'sometimes|in:ada,tidak ada',
        ]);

        // Mengirim data ke service
        DokterService::updateDokter($request->all(), $dokter);

        return redirect()->back()->with('success', 'Data dokter berhasil diperbarui!');
    }


    public function updateStatusReservasi(Request $request)
    {
            $request->validate([
            'reservation_id' => 'required|exists:reservasis,id',
            'status' => 'required|in:menunggu,sedang ditangani,selesai',
        ]);

        $reservasi = Reservasi::findOrFail($request->reservation_id);
        $reservasi->status = $request->status;
        $reservasi->save();

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    public function showRiwayatPasien()
    {
        $dokter = auth()->user()->dokter;  
        $riwayatReservasi = $this->reservasiService->getRiwayatReservasiByDokter($dokter->id); 
        
        return view('dokter.riwayat', compact('riwayatReservasi'));
    }

    public function showRiwayatSeluruh()
    {
        $user=Auth::user();
        return view('dokter.main.riwayatpasien', compact('user'));
    }

    
}
