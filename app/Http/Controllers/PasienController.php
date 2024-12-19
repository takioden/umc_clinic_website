<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PasienService;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pasien.index');
    }

    public function showAbout()
    {
        return view('pasien.about');
    }

    public function showContact()
    {
        return view('pasien.contact');
    }

    public function showDashboard()
    {
        $user = Auth::user();
        $pasien = $user->pasien;
        return view('pasien.main.index', compact('user', 'pasien'));
    }
    

     public function updatePasienShow($id)
    {   
        $user = Auth::user();
        $pasien = Pasien::with('user', 'alamat.kecamatan.kota')->where('user_id', $user->id)->findOrFail($id);

        return view('pasien.main.edit', compact('pasien', 'user'));
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

        return redirect()->back()->with('success', 'Data pasien berhasil diperbarui!');
    }

    
}
