<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Models\Admin;

class RegisterAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest'); // Tidak membutuhkan login
    }

    public function showRegistrationForm()
    { 
        if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('adminDashboard');  // Redirect ke dashboard admin
        }

    return view('auth/register/admin');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $data['role'] = 'admin';

        $this->validator($data)->validate();

        $user = $this->create($data);

        Admin::create([
            'user_id' => $user->id,
            'nama' => $data['nama'],
        ]);

        auth()->login($user);

        return redirect()->route('adminDashboard');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nama'=> ['required', 'string']
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    
}