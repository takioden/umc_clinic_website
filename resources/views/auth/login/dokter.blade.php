@extends('layouts.partial')
@section('title', 'Login')
@section('navbar')
@include('layouts.navdokter')
@endsection
@section('content')
<div class="flex flex-col lg:flex-row h-screen">
    <!-- Left Section with Background -->
    <div 
    class="rounded-xl shadow m-1 md:w-1/2 hover:scale-110 transition duration-300 ease-in-out h-1/3 md:h-full bg-cover bg-center"
    style="background-image: url('https://th.bing.com/th/id/R.c3e680359b29a07361ce7f8d26b64558?rik=OHIo2fh9ScPL8Q&riu=http%3a%2f%2fchemeng.teknik.unej.ac.id%2fwp-content%2fuploads%2fsites%2f10%2f2024%2f02%2fUMC1.png&ehk=ddNHXIspdwFrdPl42R5He5ifKI71YwihtRSlHlevynY%3d&risl=&pid=ImgRaw&r=0');"
>
</div>
  
    <!-- Right Section with Content -->
    <div class="lg:w-1/2 w-full p-4 lg:p-8 flex items-center justify-center">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-white text-center">
                    {{ __('Dokter Login') }}
                </h2>

                <form method="POST" action="{{ route('login.dokter') }}" class="mt-6">
                    @csrf

                    <!-- Username Field -->
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-600 dark:text-gray-300">
                            {{ __('Username') }}
                        </label>
                        <input 
                            id="username" 
                            type="text" 
                            name="username" 
                            value="{{ old('username') }}" 
                            required 
                            autocomplete="username" 
                            autofocus 
                            class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none"
                        >
                        @error('username')
                            <span class="text-sm text-red-600 dark:text-red-400 mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-600 dark:text-gray-300">
                            {{ __('Password') }}
                        </label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password" 
                            class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none"
                        >
                        @error('password')
                            <span class="text-sm text-red-600 dark:text-red-400 mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between hover:scale-110 transition duration-300 ease-in-out">
                        <button 
                            type="submit" 
                            class="w-full px-4 py-2 text-white bg-primary hover:bg-secondary rounded-lg focus:ring focus:ring-primary focus:outline-none transition"
                        >
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="px-6 py-4 bg-gray-100 dark:bg-gray-700 text-sm text-center m-4">
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __("Don't have an account?") }} 
                    <a 
                        href="{{ route('register.dokter') }}" 
                        class="text-primary hover:underline dark:text-secondary">
                        {{ __('Register here') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@include('layouts.footer')
@endsection
