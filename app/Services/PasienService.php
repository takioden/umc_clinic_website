<?php
namespace App\Services;

use App\Models\User;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Alamat;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class PasienService
{
//create
    public static function createPasien($data)
    {
        DB::transaction(function () use ($data) {
            // Jika ada data untuk akun user, buatkan akun user
            $user = null;
            if (isset($data->username) && isset($data->password)) {
                $user = User::create([
                    'username' => $data->username,
                    'password' => bcrypt($data->password),
                    'role' => 'pasien', 
                ]);
            }

            // Buat kota jika belum ada
            $kota = Kota::firstOrCreate([
                'kota' => $data->kota
            ]);

            // Buat kecamatan jika belum ada
            $kecamatan = Kecamatan::firstOrCreate([
                'kecamatan' => $data->kecamatan,
                'kota_id' => $kota->id
            ]);

            // Buat alamat jika belum ada
            $alamat = Alamat::firstOrCreate([
                'jalan' => $data->jalan,
                'kecamatan_id' => $kecamatan->id
            ]);

            // Buat data pasien
            $pasienData = [
                'nama' => $data->nama,
                'nohp' => $data->nohp,
                'umur' => $data->umur,
                'jenis_kelamin' => $data->jenis_kelamin,
                'nik' => $data->nik,
                'alamat_id' => $alamat->id
            ];

            // Jika ada user yang dibuat, tambahkan user_id pada data pasien
            if ($user) {
                $pasienData['user_id'] = $user->id;
            }

            // Buat pasien
            Pasien::create($pasienData);
            
            return $user;
        });


    }
//read
    public static function getAllPasien()
    {
        return Pasien::with(['user', 'alamat.kecamatan.kota'])->get(); 
    }

    public static function getPasienById($id)
    {
        return Pasien::with(['user', 'alamat.kecamatan.kota'])->find($id);
    }
//update
    public static function updatePasien($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            // Menemukan pasien berdasarkan ID
            $pasien = Pasien::findOrFail($id);
            $user = $pasien->user;

            // Jika pasien memiliki akun user, update data user
            if ($request->filled('username') || $request->filled('password')) {
                if (!$pasien->user) {
                    // Buat user baru jika pasien belum memiliki user
                    $validated = $request->validate([
                        'username' => 'required|string|unique:users,username',
                        'password' => 'required|string|min:8',
                    ]);
            
                    $user = new User();
                    $user->username = $validated['username'];
                    $user->password = bcrypt($validated['password']);
                    $user->role = 'pasien';
                    $user->save();
            
                    $pasien->user_id = $user->id;
                    $pasien->save();
                } else {
                    // Update user jika sudah ada
                    $user = $pasien->user;
                    if ($request->filled('username')) {
                        $user->username = $request->username;
                    }
                    if ($request->filled('password')) {
                        $user->password = bcrypt($request->password);
                    }
                    $user->save();
                }
            }
        
           
            $kota = $request->filled('kota') 
                ? Kota::firstOrCreate(['kota' => $request->kota]) 
                : Kota::find($pasien->alamat->kecamatan->kota_id);

            $kecamatan = $request->filled('kecamatan') 
                ? Kecamatan::firstOrCreate(['kecamatan' => $request->kecamatan, 'kota_id' => $kota->id]) 
                : $pasien->alamat->kecamatan;

            
            $alamat = $pasien->alamat;
            $alamat->jalan = $request->filled('jalan') ? $request->jalan : $alamat->jalan;
            $alamat->kecamatan_id = $kecamatan->id;
            $alamat->save();

            
            $pasien->nama = $request->filled('nama') ? $request->nama : $pasien->nama;
            $pasien->nohp = $request->filled('nohp') ? $request->nohp : $pasien->nohp;
            $pasien->umur = $request->filled('umur') ? $request->umur : $pasien->umur;
            $pasien->jenis_kelamin = $request->filled('jenis_kelamin') ? $request->jenis_kelamin : $pasien->jenis_kelamin;
            $pasien->nik = $request->filled('nik') ? $request->nik : $pasien->nik;
            $pasien->save();
        });
    }
//delete
    public static function deletePasien($id)
    {
        DB::transaction(function () use ($id) {
            $pasien = Pasien::findOrFail($id);

            
            $pasien->user()->delete(); 
            $pasien->alamat()->delete(); 

            
            $pasien->delete();
        });
    }
}