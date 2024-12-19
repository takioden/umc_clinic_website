@extends('layouts.partial')
@section('title', 'Edit Pasien')
@include('layouts.partialadmin')
{{-- konten --}}
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-secondary text-center">Edit Data Pasien</h2>


            <form action="{{ route('updatePasien', $pasien->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Input untuk Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username (Opsional)</label>
                        <input type="text" id="username" name="username" 
                            value="{{ old('username', optional($pasien->user)->username) }}" 
                            placeholder="Kosongkan jika pasien tidak memiliki akun"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring">
                        @error('username')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password (Opsional)</label>
                        <input type="password" id="password" name="password" 
                            placeholder="Kosongkan jika pasien tidak memiliki akun"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring">
                        @error('password')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="nama" name="nama" 
                            value="{{ old('nama', $pasien->nama) }}"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring"
                            required>
                        @error('nama')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" id="nik" name="nik" 
                            value="{{ old('nik', $pasien->nik) }}"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring"
                            required>
                        @error('nik')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk No HP -->
                    <div>
                        <label for="nohp" class="block text-sm font-medium text-gray-700">No HP</label>
                        <input type="text" id="nohp" name="nohp" 
                            value="{{ old('nohp', $pasien->nohp) }}"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring"
                            required>
                        @error('nohp')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk Umur -->
                    <div>
                        <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                        <input type="number" id="umur" name="umur" 
                            value="{{ old('umur', $pasien->umur) }}"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring"
                            required>
                        @error('umur')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" 
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring"
                            required>
                            <option value="laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk Kota -->
                    <div>
                        <label for="kota" class="block text-sm font-medium text-gray-700">Kota</label>
                        <input type="text" id="kota" name="kota" 
                            value="{{ old('kota', $pasien->alamat->kecamatan->kota->kota ?? '') }}"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring"
                            required>
                        @error('kota')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk Kecamatan -->
                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" 
                            value="{{ old('kecamatan', $pasien->alamat->kecamatan->kecamatan ?? '') }}"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring"
                            required>
                        @error('kecamatan')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Input untuk Jalan -->
                    <div>
                        <label for="jalan" class="block text-sm font-medium text-gray-700">Jalan</label>
                        <input type="text" id="jalan" name="jalan" 
                            value="{{ old('jalan', $pasien->alamat->jalan ?? '') }}"
                            class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:ring"
                            required>
                        @error('jalan')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            
                <div class="flex justify-between mt-6">
                    <a href="{{ route('adminPasienShow') }}" 
                       class="bg-secondary text-white py-2 px-4 rounded hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="bg-primary text-white py-2 px-4 rounded hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-light">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
