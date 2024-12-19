@extends('layouts.partial')
@section('title', 'Register')
@section('navbar')
@include('layouts.navadmin')
@endsection

@section('content')
<div class="flex flex-col lg:flex-row h-auto lg:h-screen">
    <!-- Left Section with Background -->
    <div class=" rounded-xl shadow m-1 w-full lg:w-1/2 h-64 lg:h-full bg-cover bg-center hover:scale-110 transition duration-300 ease-in-out" style="background-image: url('https://th.bing.com/th/id/R.c3e680359b29a07361ce7f8d26b64558?rik=OHIo2fh9ScPL8Q&riu=http%3a%2f%2fchemeng.teknik.unej.ac.id%2fwp-content%2fuploads%2fsites%2f10%2f2024%2f02%2fUMC1.png&ehk=ddNHXIspdwFrdPl42R5He5ifKI71YwihtRSlHlevynY%3d&risl=&pid=ImgRaw&r=0');">
    </div>

    <!-- Right Section with Content -->
    <div class="w-full lg:w-1/2 p-6 lg:p-12 flex items-center justify-center">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4">
            <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white">{{ __('Register as Admin') }}</h2>
            <form method="POST" action="{{ route('register.admin') }}" class="mt-6">
                @csrf
                <input type="hidden" name="role" value="admin">

                <!-- Nama Field -->
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Nama') }}</label>
                    <input id="nama" type="text" name="nama" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                </div>

                <!-- Username Field -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Username') }}</label>
                    <input id="username" type="text" name="username" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-2 block w-full px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-primary focus:outline-none">
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button type="submit" class="hover:scale-110 transition duration-300 ease-in-out w-full px-4 py-2 text-white bg-primary hover:bg-secondary rounded-lg focus:ring focus:ring-primary focus:outline-none transition">{{ __('Register') }}</button>
                </div>
            </form>

            <div class="px-6 py-4 bg-gray-100 dark:bg-gray-700 text-sm text-center mt-3">
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __("Already have an account?") }} 
                    <a 
                        href="{{ route('login.admin') }}" 
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
