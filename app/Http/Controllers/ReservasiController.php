<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Reservasi;
use App\Models\Dokter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\ReservasiService;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $reservasiService;

     public function __construct(ReservasiService $reservasiService)
     {
         $this->reservasiService = $reservasiService;
     }
 
    
     public function getHistory()
     {
         $user=Auth::user();
         $pasien = Pasien::all();
         return view('admin.main.reservasi.index', compact('pasien', 'user'));
     }
 
     public function riwayatPemeriksaan($pasienId)
     {   
         $user=Auth::user();
         $riwayatPemeriksaan = $this->reservasiService->getRiwayatPemeriksaanByPasien($pasienId);
         return view('admin.main.reservasi.riwayat', compact('riwayatPemeriksaan', 'user'));
     }
 
     public function getSearchPasien(Request $request)
     {
         $user=Auth::user();
         $nama = $request->input('nama');
         $pasien = Pasien::where('nama', 'LIKE', '%' . $nama . '%')->get();
 
         return view('admin.main.reservasi.index', compact('pasien', 'user'));
     }

     public function getSearchPasienInAdmin(Request $request)
     {
         $user=Auth::user();
         $nama = $request->input('nama');
 
         $pasiens = Pasien::where('nama', 'LIKE', '%' . $nama . '%')->get();
 
         return view('admin.main.pasien.index', compact('pasiens', 'user'));
     }

     public function getHistoryInDokter()
     {
         $user=Auth::user();
         $pasien = Pasien::all();
         return view('dokter.main.riwayatpasien', compact('pasien', 'user'));
     }

     public function riwayatPemeriksaanInDokter($pasienId)
     {   
         $user=Auth::user();
         $riwayatPemeriksaan = $this->reservasiService->getRiwayatPemeriksaanByPasien($pasienId);
         return view('dokter.main.detailriwayat', compact('riwayatPemeriksaan', 'user'));
     }

     public function getSearchPasienInDokter(Request $request)
     {
         $user=Auth::user();
         $nama = $request->input('nama');
         $pasien = Pasien::where('nama', 'LIKE', '%' . $nama . '%')->get();
         return view('dokter.main.riwayatpasien', compact('pasien', 'user'));
     }

     public function getReservasiToday()
    {
        $tanggalHariIni = Carbon::now()->toDateString();

        $reservasiPoliUmum = Reservasi::whereDate('tanggal', $tanggalHariIni)
                                    ->where('poli', 'umum')
                                    ->with(['pasien', 'dokter'])
                                    ->get();

        $reservasiPoliGigi = Reservasi::whereDate('tanggal', $tanggalHariIni)
                                    ->where('poli', 'gigi')
                                    ->with(['pasien', 'dokter'])
                                    ->get();

        return response()->json([
            'poli_umum' => $reservasiPoliUmum,
            'poli_gigi' => $reservasiPoliGigi,
        ]);
    }

    public function getReservasiTodayPasien()
    {
        $tanggalHariIni = Carbon::now()->toDateString();

        $reservasiPoliUmum = Reservasi::whereDate('tanggal', $tanggalHariIni)
                                    ->where('poli', 'umum')
                                    ->with(['pasien', 'dokter'])
                                    ->get();

        $reservasiPoliGigi = Reservasi::whereDate('tanggal', $tanggalHariIni)
                                    ->where('poli', 'gigi')
                                    ->with(['pasien', 'dokter'])
                                    ->get();

        $user = Auth::user();
        $pasienIdLogin = $user->pasien->id ?? null;

        return response()->json([
            'poli_umum' => $reservasiPoliUmum,
            'poli_gigi' => $reservasiPoliGigi,
            'pasien_id_login' => $pasienIdLogin,
        ]);
    }

    public function riwayatPemeriksaanInPasien($pasienId)
    {   
        $user=Auth::user();
        $pasien = $user->pasien;
         $riwayatPemeriksaan = $this->reservasiService->getRiwayatPemeriksaanByPasien($pasienId);
         return view('pasien.main.riwayat', compact('riwayatPemeriksaan', 'user', 'pasien'));
    }

    public function destroy(Request $request)
    {
        $reservasiId = $request->input('reservation_id');
        $reservasi = Reservasi::findOrFail($reservasiId);

        if (Auth::user()->pasien->id !== $reservasi->pasien_id) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan untuk menghapus reservasi ini.');
        }

        $reservasi->delete();

        return redirect()->back()->with('success', 'Reservasi berhasil dihapus.');
    }



    public function deleteReservasi(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservasis,id',
        ]);

        $reservasi = Reservasi::findOrFail($request->reservation_id);
        $reservasi->delete();

        return redirect()->back()->with('success', 'Reservasi berhasil dihapus.');
    }


    public function getDokterByPoli(Request $request)
    {
        $poli = $request->get('poli');

        $dokters = Dokter::where('poli', $poli)
            ->where('status', 'ada') 
            ->get(['id', 'nama']);

        return response()->json($dokters);
    }

    public function createReservasi(Request $request)
    {
      
        $request->validate([
            'tanggal' => 'required|date',
            'poli' => 'required|in:umum,gigi',
            'status' => 'required|in:menunggu,sedang ditangani,selesai',
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        
        ReservasiService::createReservasi($request->all());

        
        return redirect()->back()->with('success', 'Reservasi berhasil dibuat.');
    }

    
}
