@extends('layouts.partial')
@section('title', 'Register')
@extends('layouts.navpasien')
@section('content')
<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Left Section with Background -->
    <div class="hover:scale-110 transition duration-300 ease-in-out rounded-xl shadow m-1 w-full lg:w-1/2 h-64 lg:h-screen bg-cover bg-center" style="background-image: url('https://th.bing.com/th/id/R.c3e680359b29a07361ce7f8d26b64558?rik=OHIo2fh9ScPL8Q&riu=http%3a%2f%2fchemeng.teknik.unej.ac.id%2fwp-content%2fuploads%2fsites%2f10%2f2024%2f02%2fUMC1.png&ehk=ddNHXIspdwFrdPl42R5He5ifKI71YwihtRSlHlevynY%3d&risl=&pid=ImgRaw&r=0');">
    </div>

    <!-- Right Section with Content -->
    <div class="w-full lg:w-1/2 lg:p-12 flex items-center justify-center lg-mt-0">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white">{{ __('Register Pasien') }}</h2>
                <form method="POST" action="{{ route('register.pasien') }}" class="mt-6 space-y-4">
                    @csrf
                    @if($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-2 rounded">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="role" value="pasien">
    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    
                        <!-- Username Field -->
                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Username</label>
                            <input id="username" type="text" name="username" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Password</label>
                            <input id="password" type="password" name="password" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                        <!-- Nama Lengkap Field -->
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Nama Lengkap</label>
                            <input id="nama" type="text" name="nama" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                        <!-- NIK Field -->
                        <div class="mb-4">
                            <label for="nik" class="block text-sm font-medium text-gray-600 dark:text-gray-300">NIK</label>
                            <input id="nik" type="text" name="nik" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                        <!-- Umur Field -->
                        <div class="mb-4">
                            <label for="umur" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Umur</label>
                            <input id="umur" type="number" name="umur" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                        <!-- Jenis Kelamin Field -->
                        <div class="mb-4">
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                                <option value="" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Pilih Jenis Kelamin</option>
                                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
    
                        <!-- Alamat Field -->
                        <div class="mb-4">
                            <label for="jalan" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Alamat</label>
                            <input id="jalan" type="text" name="jalan" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                        <!-- Kecamatan Field -->
                        <div class="mb-4">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Kecamatan</label>
                            <input id="kecamatan" type="text" name="kecamatan" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                        <!-- Kota Field -->
                        <div class="mb-4">
                            <label for="kota" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Kota</label>
                            <input id="kota" type="text" name="kota" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                        <!-- No HP Field -->
                        <div class="mb-4">
                            <label for="nohp" class="block text-sm font-medium text-gray-600 dark:text-gray-300">No HP</label>
                            <input id="nohp" type="text" name="nohp" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                        </div>
    
                    </div>
                    <div class="hover:scale-110 transition duration-300 ease-in-out flex items-center justify-between">
                        <button type="submit" class="w-full px-4 py-2 text-white bg-primary hover:bg-secondary rounded-lg focus:ring focus:ring-primary focus:outline-none transition">{{ __('Register') }}</button>
                    </div>
                </form>
                <div class="px-6 py-4 bg-gray-100 dark:bg-gray-700 text-sm text-center">
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __("Already have an account?") }} 
                        <a 
                            href="{{route('login.pasien')}}" 
                            class="text-primary hover:underline dark:text-secondary">
                            {{ __('Login here') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
@section('footer')
@include('layouts.footer')
@endsection
