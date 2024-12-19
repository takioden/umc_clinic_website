@extends('layouts.partial')

@section('title', 'Landing Page')
@section('navbar')
@include('layouts.navpasien')  
@endsection
@section('content')
    <div class="flex flex-col md:flex-row h-screen">

    <div 
        class=" rounded-xl shadow m-1 md:w-1/2 h-1/3 md:h-full bg-cover bg-center  hover:scale-110 transition duration-300 ease-in-out"
        style="background-image: url('https://th.bing.com/th/id/R.c3e680359b29a07361ce7f8d26b64558?rik=OHIo2fh9ScPL8Q&riu=http%3a%2f%2fchemeng.teknik.unej.ac.id%2fwp-content%2fuploads%2fsites%2f10%2f2024%2f02%2fUMC1.png&ehk=ddNHXIspdwFrdPl42R5He5ifKI71YwihtRSlHlevynY%3d&risl=&pid=ImgRaw&r=0');"
    >
    </div>

    <div class="md:w-1/2 h-2/3 md:h-full p-8 flex items-center justify-center bg-gray-100 ">
        <div class="text-center space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Selamat Datang di UMC Pasien
            </h2>
            <p class="text-gray-600 ">
                Selamat datang di platform manajemen administrasi Klinik UMC. Silakan login untuk memulai, atau buat akun baru jika Anda belum memiliki akun. Kami berkomitmen untuk memberikan pengalaman terbaik bagi pasien dan pengguna kami.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a 
                    href="{{ route('login.pasien') }}" 
                    class="w-full md:w-auto px-4 py-2 text-white bg-primary hover:bg-secondary rounded-lg text-sm font-medium text-center hover:scale-110 transition duration-300 ease-in-out"
                >
                    Login
                </a>
                <a 
                    href="{{ route('register.pasien') }}" 
                    class="w-full md:w-auto px-4 py-2 text-primary border border-primary hover:bg-secondary hover:text-white hover:border-secondary rounded-lg text-sm font-medium text-center hover:scale-110 transition duration-300 ease-in-out"
                >
                    Register
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('footer')
@include('layouts.footer')
@endsection



