@extends('layouts.partial')
@section('title', 'Landing Page')
@section('navbar')
@include('layouts.navdokter')
@endsection

@section('content')

<div class="flex flex-col md:flex-row h-screen">
    <!-- Left Section with Background -->
    <div 
        class="rounded-xl shadow m-1 md:w-1/2 hover:scale-110 transition duration-300 ease-in-out h-1/3 md:h-full bg-cover bg-center"
        style="background-image: url('https://th.bing.com/th/id/R.c3e680359b29a07361ce7f8d26b64558?rik=OHIo2fh9ScPL8Q&riu=http%3a%2f%2fchemeng.teknik.unej.ac.id%2fwp-content%2fuploads%2fsites%2f10%2f2024%2f02%2fUMC1.png&ehk=ddNHXIspdwFrdPl42R5He5ifKI71YwihtRSlHlevynY%3d&risl=&pid=ImgRaw&r=0');"
    >
    </div>
  
    <!-- Right Section with Content -->
    <div class="md:w-1/2 h-2/3 md:h-full p-8 flex items-center justify-center bg-gray-100 ">
        <div class="text-center space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 ">
                Selamat Datang di UMC Dokter
            </h2>
            <p class="text-gray-600 dark:text-gray-300">
                Platform manajemen administrasi yang dirancang untuk kemudahan Anda. Silakan login untuk memulai, atau buat akun jika Anda belum memiliki akun.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a 
                    href="{{ route('login.dokter') }}" 
                    class="w-full hover:scale-110 transition duration-300 ease-in-out md:w-auto px-4 py-2 text-white bg-primary hover:bg-secondary rounded-lg text-sm font-medium text-center"
                >
                    Login
                </a>
                <a 
                    href="{{ route('register.dokter') }}" 
                    class="w-full hover:scale-110 transition duration-300 ease-in-out md:w-auto px-4 py-2 text-primary hover:border-secondary border border-primary hover:bg-secondary hover:text-white rounded-lg text-sm font-medium text-center"
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
