<?php
namespace App\Services;

use App\Models\User;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;

class DokterService
{
//create
    public static function createDokter($data)
    {
        
        $user = User::create([
            'username' => $data->username,
            'password' => bcrypt($data->password),
            'role' => 'dokter',
        ]);

        Dokter::create([
            'nama' => $data->nama,
            'nohp' => $data->nohp,
            'nostr' => $data->nostr,
            'poli' => $data->poli,
            'status' => $data->status,
            'user_id' => $user->id
        ]);
        
        return $user;
    }
//read
    public static function getAllDokter()
    {
        return Dokter::with(['user'])->get(); 
    }

    public static function getDokterById($id)
    {
        return Dokter::with(['user'])->find($id);
    }
//update
public static function updateDokter($data, Dokter $dokter)
{
    DB::transaction(function () use ($data, $dokter) {
        $user = $dokter->user;

       
        if (!empty($data['username'])) {
            $user->username = $data['username'];
        }
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();

       
        $dokter->nama = $data['nama'] ?? $dokter->nama;
        $dokter->nohp = $data['nohp'] ?? $dokter->nohp;
        $dokter->nostr = $data['nostr'] ?? $dokter->nostr;
        $dokter->poli = $data['poli'] ?? $dokter->poli;
        $dokter->status = $data['status'] ?? $dokter->status;
        $dokter->save();
    });
}



//delete
    public static function deleteDokter($id)
    {
        DB::transaction(function () use ($id) {
            $dokter = Dokter::findOrFail($id);

            
            $dokter->user()->delete(); 

            
            $dokter->delete();
        });
    }
}