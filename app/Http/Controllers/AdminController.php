<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Reservasi;
use App\Models\User;
use App\Services\DokterService;
use App\Services\PasienService;
use App\Services\ReservasiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
   
    public function index()
    {
        return view('admin.index');
    }


    public function showDashboard()
    {
        $user = Auth::user();
        $totalDokter = Dokter::count();
        $totalPasien = Pasien::count();
        $totalUser = User::count();
        return view('admin.main.index', compact('user'), [
            'totalDokter' => $totalDokter,
            'totalPasien' => $totalPasien,
            'totalUser' => $totalUser
        ]);
    }
    
//pasien
    public function createPasienShow()
    {
        
        return view('admin.main.pasien.create');
    }

    public function createPasien(Request $request)
    {
        
        $request->validate([
                'username' => 'nullable|string|unique:users,username',
                'password' => 'nullable|string|min:8',
                'kota' => 'required|string',
                'kecamatan' => 'required|string',
                'jalan' => 'required|string',
                'nama' => 'required|string|max:255',
                'nohp' => 'required|string|min:10|max:15',
                'umur' => 'required|integer|min:1|max:120',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'nik' => 'required|string|size:16|unique:pasiens,nik',
            ]);
    
        DB::transaction(function () use ($request) {
            PasienService::createPasien((object) $request->all());
            });
            
        return redirect()->back();
    }

    public function updatePasienShow($id)
    {   
        $user=Auth::user();
        $pasien = Pasien::with('user', 'alamat.kecamatan.kota')->findOrFail($id);

        return view('admin.main.pasien.update', compact('pasien', 'user'));
    }

    public function updatePasien(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'username' => [
                'nullable',
                'string',
                Rule::unique('users', 'username')->ignore($pasien->user_id, 'id'),
            ],
            'password' => 'nullable|string|min:8',
            'kota' => 'sometimes|string',
            'kecamatan' => 'sometimes|string',
            'jalan' => 'sometimes|string',
            'nama' => 'sometimes|string|max:255',
            'nohp' => 'sometimes|string|min:10|max:15',
            'umur' => 'sometimes|integer|min:1|max:120',
            'jenis_kelamin' => 'sometimes|in:laki-laki,perempuan',
            'nik' => 'sometimes|string|size:16|unique:pasiens,nik,' . $id . ',id',
        ]);

        PasienService::updatePasien($request, $id);

        return redirect()->back();
    }


    public function readPasien(REquest $request)
    {   
        $search = $request->input('search');

        $pasiens = Pasien::with(['user', 'alamat.kecamatan.kota'])
            ->when($search, function ($query, $search) {
                $query->where('nama', 'LIKE', '%' . $search . '%')
                      ->orWhereHas('user', function ($query) use ($search) {
                          $query->where('username', 'LIKE', '%' . $search . '%');
                      })
                      ->orWhereHas('alamat.kecamatan.kota', function ($query) use ($search) {
                          $query->where('kota', 'LIKE', '%' . $search . '%');
                      });
            });
        $user=Auth::user();
        $pasiens = PasienService::getAllPasien();
        return view('admin.main.pasien.index', compact('pasiens', 'user'));
    }
    
    public function readPasienById($id)
    {
        $pasiens = PasienService::getPasienById($id);

        if (!$pasiens) {
            return redirect()->route('')->with('error', 'Pasien tidak ditemukan');
        }

        return view('', compact('pasiens'));

    }

    public function destroyPasien($id)
    {
        try{
            PasienService::deletePasien($id);

            return redirect()->route('adminPasienShow')->with('success', 'Pasien berhasil dihapus');
        } catch(\Exception $e){
            return redirect()->route('adminPasienShow')->with('error', 'Gagal menghapus pasien: ' . $e->getMessage());
        }
    }
//dokter    
    public function createDokter(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
            'nama' => 'required|string|max:255',
            'nostr' => 'required|string',
            'poli' => 'required|in:umum,gigi',
            'nohp' => 'required|string|min:10|max:15',
            'status' => 'required|in:ada,tidak ada'
        ]);

        DB::transaction(function () use ($request) {
            DokterService::createDokter((object) $request->all());
            });
            
        return redirect()->back();
    
    }
    
    public function updateDokterShow($id)
    {
        $user=Auth::user();
        $dokter = Dokter::with('user')->findOrFail($id);

        return view('admin.main.dokter.update', compact('dokter', 'user'));
    }


    public function readDokter()
    {
        $user=Auth::user();
        $dokters = DokterService::getAllDokter();
        return view('admin.main.dokter.index', compact('dokters', 'user'));
    }

    public function readDokterById($id)
    {
        $dokter = DokterService::getDokterById($id);

        if (!$dokter) {
            return redirect()->route('')->with('error', 'Dokter tidak ditemukan');
        }

        return view('', compact('pasien'));

    }

    public function destroyDokter($id)
    {
        try{
            dokterService::deleteDokter($id);

            return redirect()->route('adminDokterShow')->with('success', 'Dokter berhasil dihapus');
        } catch(\Exception $e){
            return redirect()->route('adminDokterShow')->with('error', 'Gagal menghapus dokter: ' . $e->getMessage());
        }
    }
//reservasi    

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

        return redirect()->back();
    }
    
    public function getDokterByPoli(Request $request)
    {
        $poli = $request->get('poli');

        $dokters = Dokter::where('poli', $poli)
            ->where('status', 'ada')
            ->get(['id', 'nama']);

        return response()->json($dokters);
    }
    
    public function searchPasien(Request $request)
    {
        $query = $request->get('query');

        $pasiens = Pasien::where('nama', 'like', '%' . $query . '%')
            ->take(10) 
            ->get(['id', 'nama']);

        return response()->json($pasiens);
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

            return redirect()->back();
    }

    
    
}
