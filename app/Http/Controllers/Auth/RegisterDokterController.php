<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Services\DokterService;
use App\Models\Dokter;

class RegisterDokterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest'); // Tidak membutuhkan login
    }

    public function showRegistrationForm()
    { 
        if (Auth::check() && Auth::user()->role === 'dokter') {
        return redirect()->route('dokterDashboard');  // Redirect ke dashboard admin
        }

    return view('auth/register/dokter');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        // Memvalidasi data
        $this->validator($data)->validate();

        // Memanggil DokterService untuk membuat user dan dokter
        $user = DokterService::createDokter((object) $data);

        // Login pengguna yang baru dibuat
        Auth::login($user);

        return redirect()->route('dokterDashboard');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
            'nama' => 'required|string|max:255',
            'nostr' => 'required|string',
            'poli' => 'required|in:umum,gigi',
            'nohp' => 'required|string|min:10|max:15',
            'status' => 'required|in:ada,tidak ada'
        ]);
    }

    
}