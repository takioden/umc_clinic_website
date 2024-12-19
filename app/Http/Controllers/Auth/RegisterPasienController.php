<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PasienService;
use Illuminate\Support\Facades\DB;

class RegisterPasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest'); // Tidak membutuhkan login
    }

    public function showRegistrationForm()
    { 
        if (Auth::check() && Auth::user()->role === 'pasien') {
        return redirect()->route('pasienDashboard');  // Redirect ke dashboard admin
        }

    return view('auth/register/pasien');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $this->validator($data)->validate();

        $user = PasienService::createPasien((object)$data);
        
        // Auth::login($user);

        return redirect()->route('login.pasien');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
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

    }

}