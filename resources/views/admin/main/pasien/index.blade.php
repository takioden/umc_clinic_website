@extends('layouts.partial')
@section('title', 'Halaman Pasien')
@include('layouts.partialadmin')
{{-- konten --}}
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="container mx-auto p-4">
            <div class="bg-white shadow-md rounded-lg p-6">
                
                <h1 class="text-2xl font-bold text-secondary mb-4 text-center">Halaman Pasien</h1>
                <div class="mb-4 flex justify-end gap-2">
                    <button id="openModal" 
                        class="bg-primary text-white py-2 px-4 rounded hover:bg-secondary">
                        Tambah
                    </button>
                </div>

                <form method="GET" action="{{ route('search.pasien.admin') }}" class="mb-6 flex justify-center">
                    <div class="flex gap-2 w-full max-w-xl">
                        <input type="text" name="nama" placeholder="Cari Pasien" 
                            class="border p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-primary">
                        <button type="submit" 
                            class="bg-primary text-white p-2 rounded hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-secondary flex items-center justify-center">
                            <!-- Ikon Cari -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1111.293 3.293l4.707 4.707a1 1 0 01-1.414 1.414l-4.707-4.707A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 text-sm">
                        <thead class="bg-accent text-secondary">
                            <tr>
                                <th class="py-2 px-4 border-b text-center">Nama</th>
                                <th class="py-2 px-4 border-b text-center">Username</th>
                                <th class="py-2 px-4 border-b text-center">Alamat</th>
                                <th class="py-2 px-4 border-b text-center">Kota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasiens as $p)
                            <!-- Seluruh baris menjadi tombol -->
                            <tr class="hover:bg-gray-100 cursor-pointer" data-modal-target="#modalPasien{{ $p->id }}">
                                <td class="py-2 px-4 border-b text-center">{{ $p->nama }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $p->user ? $p->user->username : 'Tidak memiliki akun' }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $p->alamat->jalan ?? '-' }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $p->alamat->kecamatan->kota->kota ?? '-' }}</td>
                            </tr>

                            <!-- Modal Detail Pasien -->
                            <div id="modalPasien{{ $p->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full sm:w-96 p-6 relative">
                                    <!-- Tombol silang di pojok kanan atas -->
                                    <button class="absolute top-6 right-6 text-gray-500 hover:text-gray-700" onclick="closeModal('#modalPasien{{ $p->id }}')">
                                        &times;
                                    </button>

                                    <div class="p-6">
                                        <h2 class="text-xl font-bold text-secondary dark:text-gray-200 text-center mb-4">Detail Pasien</h2>
                                        <p><strong>Username:</strong> {{ $p->user ? $p->user->username : 'Tidak memiliki akun' }}</p>
                                        <p><strong>Nama:</strong> {{ $p->nama }}</p>
                                        <p><strong>NIK:</strong> {{ $p->nik ?? '-' }}</p>
                                        <p><strong>Umur:</strong> {{ $p->umur }}</p>
                                        <p><strong>Jenis Kelamin:</strong> {{ ucfirst($p->jenis_kelamin) }}</p>
                                        <p><strong>Nomor HP:</strong> {{ $p->nohp ?? '-' }}</p>
                                        <p><strong>Alamat:</strong> {{ $p->alamat->jalan ?? '-' }}</p>
                                        <p><strong>Kecamatan:</strong> {{ $p->alamat->kecamatan->kecamatan ?? '-' }}</p>
                                        <p><strong>Kota:</strong> {{ $p->alamat->kecamatan->kota->kota ?? '-' }}</p>
                                    </div>

                                   
                                    <div class="flex justify-between mt-6 space-x-4">
                                  
                                        <button type="button" 
                                                onclick="openDeleteModal('{{ $p->id }}')"
                                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                   
                                        <a href="{{ route('updatePasienShow', $p->id) }}" 
                                           class="px-4 py-2 bg-primary text-white rounded-md hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- tambah pasien --}}
<div id="modalTambahPasien" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full sm:w-11/12 md:w-3/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 p-6 relative max-h-screen overflow-auto">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-xl font-bold text-secondary text-center min-w-full dark:text-gray-200">Tambah Pasien</h2>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                
            </button>
        </div>

        <form action="{{ route('create-pasien') }}" method="POST">
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
            <!-- Notifikasi Error -->
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-2 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Data Pasien -->
            <div class="mb-4">
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Pasien" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
            </div>
            <div class="mb-4">
                <input type="text" name="nohp" value="{{ old('nohp') }}" placeholder="No HP Pasien (10-15 karakter)" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
            </div>
            <div class="mb-4">
                <input type="number" name="umur" value="{{ old('umur') }}" placeholder="Umur (1-120)" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required min="1" max="120">
            </div>
            <div class="mb-4">
                <select name="jenis_kelamin" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-4">
                <input type="text" name="nik" value="{{ old('nik') }}" placeholder="NIK (16 digit)" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required minlength="16" maxlength="16">
            </div>
            <div class="mb-4">
                <input type="text" name="kota" value="{{ old('kota') }}" placeholder="Kota" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
            </div>
            <div class="mb-4">
                <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" placeholder="Kecamatan" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
            </div>
            <div class="mb-4">
                <input type="text" name="jalan" value="{{ old('jalan') }}" placeholder="Alamat Jalan" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
            </div>

            <!-- Akun User (Opsional) -->
            <div class="mb-4">
                <label class="block mb-2 text-gray-700 dark:text-gray-300">
                    <input type="checkbox" id="createAccount" class="mr-2"> Buat Akun User
                </label>
                <div id="accountFields" class="hidden">
                    <div class="mb-4">
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Username (Opsional)" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring">
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" placeholder="Password (Min. 8 karakter, Opsional)" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" minlength="8">
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan dan Tutup -->
            <div class="flex justify-between items-center mt-6 space-x-4">
                <button type="button" id="closeModalButton" class="bg-secondary text-white py-2 px-4 rounded hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary">
                    Tutup
                </button>
                <button type="submit" class="bg-primary text-white py-2 px-4 rounded hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary">
                    Simpan Pasien
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modal-confirm-delete" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full sm:w-80 p-6">
        <h2 class="text-lg font-bold text-secondary  text-center mb-4">Konfirmasi Hapus</h2>
        <p class="text-gray-800  mb-4 text-center">Apakah Anda yakin ingin menghapus pasien ini?</p>
        <form action="{{ route('delete-pasien', $p->id) }}" method="POST" id="form-delete-reservasi">
            @csrf
            @method('DELETE')
            <input type="hidden" name="reservation_id" id="delete-reservation-id">
            <div class="flex justify-between mt-4">
                <button type="button" class="px-4 py-2 bg-secondary text-white rounded-md hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light" onclick="closeDeleteModal()">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">Hapus</button>
            </div>
        </form>
    </div>
 </div>

<script>
      // Referensi elemen modal
    const modal = document.getElementById('modalTambahPasien');
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');
    const closeModalButtonAlt = document.getElementById('closeModalButton');

    // Event buka modal
    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Event tutup modal
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
    closeModalButtonAlt.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Tampilkan/Sembunyikan input akun
    document.getElementById('createAccount').addEventListener('change', function () {
        const accountFields = document.getElementById('accountFields');
        if (this.checked) {
            accountFields.classList.remove('hidden');
        } else {
            accountFields.classList.add('hidden');
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
    // Open Modal
    document.querySelectorAll('[data-modal-target]').forEach(function (row) {
        row.addEventListener('click', function () {
            const modalId = this.getAttribute('data-modal-target');
            document.querySelector(modalId).classList.remove('hidden');
        });
    });

    // Close Modal
    window.closeModal = function (modalId) {
        document.querySelector(modalId).classList.add('hidden');
    };  
    });

     // Open delete modal
     function openDeleteModal(id) {
        document.getElementById('delete-reservation-id').value = id;
        document.getElementById('modal-confirm-delete').classList.remove('hidden');
    }

    // Close delete modal
    function closeDeleteModal() {
        document.getElementById('modal-confirm-delete').classList.add('hidden');
    }

    // Open modal function for pasien detail
    function closeModal(modalId) {
        document.querySelector(modalId).classList.add('hidden');
    }

</script>
    
@endsection
