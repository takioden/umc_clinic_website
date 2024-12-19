@extends('layouts.partial')
@section('title', 'Register')
@section('navbar')
@include('layouts.navdokter')
@endsection

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Left Section with Background -->
    <div class="rounded-xl shadow m-1 hover:scale-110 transition duration-300 ease-in-out w-full lg:w-1/2 h-64 lg:h-screen bg-cover bg-center" style="background-image: url('https://th.bing.com/th/id/R.c3e680359b29a07361ce7f8d26b64558?rik=OHIo2fh9ScPL8Q&riu=http%3a%2f%2fchemeng.teknik.unej.ac.id%2fwp-content%2fuploads%2fsites%2f10%2f2024%2f02%2fUMC1.png&ehk=ddNHXIspdwFrdPl42R5He5ifKI71YwihtRSlHlevynY%3d&risl=&pid=ImgRaw&r=0');">
    </div>

    <!-- Right Section with Content -->
    <div class="w-full lg:w-1/2 p-6 lg:p-12 flex items-center justify-center lg-mt-0">
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white">{{ __('Register Dokter') }}</h2>
                <form method="POST" action="{{ route('register.dokter') }}" class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-4">
                    @csrf
                    <input type="hidden" name="role" value="dokter">
    
                    <!-- Nama Field -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Nama') }}</label>
                        <input id="nama" type="text" name="nama" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                    </div>
    
                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Username') }}</label>
                        <input id="username" type="text" name="username" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                    </div>
    
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                    </div>
    
                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                    </div>
    
                    <!-- No HP Field -->
                    <div>
                        <label for="nohp" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('No HP') }}</label>
                        <input id="nohp" type="text" name="nohp" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                    </div>
    
                    <!-- Nostr Field -->
                    <div>
                        <label for="nostr" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Nostr') }}</label>
                        <input id="nostr" type="text" name="nostr" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                    </div>
    
                    <!-- Poli Field -->
                    <div>
                        <label for="poli" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Poli') }}</label>
                        <select id="poli" name="poli" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                            <option value="umum">{{ __('Umum') }}</option>
                            <option value="gigi">{{ __('Gigi') }}</option>
                        </select>
                    </div>
    
                    <!-- Status Field -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Status') }}</label>
                        <select id="status" name="status" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                            <option value="ada">{{ __('Ada') }}</option>
                            <option value="tidak ada">{{ __('Tidak Ada') }}</option>
                        </select>
                    </div>
    
                    <!-- Submit Button (Full Width) -->
                    <div class="col-span-1 lg:col-span-2 hover:scale-110 transition duration-300 ease-in-out flex items-center justify-between">
                        <button type="submit" class="w-full px-4 py-2 text-white bg-primary hover:bg-secondary rounded-lg focus:ring focus:ring-primary focus:outline-none transition">{{ __('Register') }}</button>
                    </div>
                </form>
    
                <div class="px-6 py-4 bg-gray-100 dark:bg-gray-700 text-sm text-center mt-3">
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __("Already have an account?") }} 
                        <a href="{{ route('login.dokter') }}" class="text-primary hover:underline dark:text-secondary">
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
