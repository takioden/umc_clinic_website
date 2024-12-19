@extends('layouts.partial')
@section('title', 'Edit Data Dokter')
@include('layouts.partialdokter')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="mb-6 text-3xl font-bold text-center text-secondary">Edit Data Dokter</h2>
            <form action="{{ route('updateProfil', $dokter->id) }}" method="POST">
                @csrf
                @method('PUT')
    
                <!-- Grid Container -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring focus:ring-primary" value="{{ old('username', $dokter->user->username) }}">
                        @error('username')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring focus:ring-primary">
                        @error('password')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="nama" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring focus:ring-primary" value="{{ old('nama', $dokter->nama) }}">
                        @error('nama')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- No. STR -->
                    <div>
                        <label for="nostr" class="block text-sm font-medium text-gray-700">No. STR</label>
                        <input type="text" name="nostr" id="nostr" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring focus:ring-primary" value="{{ old('nostr', $dokter->nostr) }}">
                        @error('nostr')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- Poli -->
                    <div>
                        <label for="poli" class="block text-sm font-medium text-gray-700">Poli</label>
                        <select name="poli" id="poli" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring focus:ring-primary">
                            <option value="umum" {{ old('poli', $dokter->poli) == 'umum' ? 'selected' : '' }}>Umum</option>
                            <option value="gigi" {{ old('poli', $dokter->poli) == 'gigi' ? 'selected' : '' }}>Gigi</option>
                        </select>
                        @error('poli')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- No. HP -->
                    <div>
                        <label for="nohp" class="block text-sm font-medium text-gray-700">No. HP</label>
                        <input type="text" name="nohp" id="nohp" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring focus:ring-primary" value="{{ old('nohp', $dokter->nohp) }}">
                        @error('nohp')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring focus:ring-primary">
                            <option value="ada" {{ old('status', $dokter->status) == 'ada' ? 'selected' : '' }}>Ada</option>
                            <option value="tidak ada" {{ old('status', $dokter->status) == 'tidak ada' ? 'selected' : '' }}>Tidak Ada</option>
                        </select>
                        @error('status')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
    
                <!-- Button Section -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('dokterDashboard') }}" 
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
