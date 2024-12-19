@extends('layouts.partial')
@section('title', 'Halaman Dokter')
@include('layouts.partialadmin')
{{-- konten --}}
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="container mx-auto p-4">
            <div class="bg-white shadow-md rounded-lg p-6">
               
                <h1 class="text-2xl font-bold mb-4 text-center">Halaman Dokter</h1>
                
              
                <div class="mb-4 flex justify-end gap-2">
                    <!-- Tombol untuk membuka modal -->
                    <a href="#" data-modal-toggle="modalTambahDokter" 
                       class="bg-primary text-white py-2 px-4 rounded hover:bg-secondary">
                        Tambah
                    </a>
                </div>


                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-center">Nama</th>
                                <th class="py-2 px-4 border-b text-center">Username</th>
                                <th class="py-2 px-4 border-b text-center">Poli</th>
                                <th class="py-2 px-4 border-b text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokters as $d)
                            <tr class="hover:bg-gray-100 cursor-pointer" data-modal-target="#modalDokter{{ $d->id }}">
                                <td class="py-2 px-4 border-b text-center">{{ $d->nama }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $d->user->username }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $d->poli }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $d->status }}</td>
                            </tr>

                            <!-- Modal Detail Dokter -->
                            <div id="modalDokter{{ $d->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
                                <div class="bg-white rounded-lg shadow-lg w-full sm:w-96 p-6 relative">
                                
                                    <button class="absolute top-6 right-6 text-gray-500 hover:text-gray-700" onclick="closeModal('#modalDokter{{ $d->id }}')">
                                        &times;
                                    </button>

                                    <div class="p-6">
                                        <h2 class="text-xl font-bold text-secondary text-center mb-4">Detail Dokter</h2>
                                        <p><strong>Username:</strong> {{ $d->user->username }}</p>
                                        <p><strong>Nama:</strong> {{ $d->nama }}</p>
                                        <p><strong>Poli:</strong> {{ $d->poli }}</p>
                                        <p><strong>Nomor STR:</strong> {{ $d->nostr }}</p>
                                        <p><strong>Nomor HP:</strong> {{ $d->nohp }}</p>
                                        <p><strong>Status:</strong> {{ $d->status }}</p>
                                    </div>

                                   
                                    <div class="flex justify-between mt-6 space-x-4">
                                  
                                        <button type="button" 
                                                onclick="openDeleteModal('{{ $d->id }}')"
                                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    
                                        <a href="{{ route('updateDokterShow', $d->id) }}" 
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

<!-- Modal Tambah Dokter -->
<div id="modalTambahDokter" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full sm:w-11/12 md:w-3/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 p-6 relative max-h-screen overflow-auto">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-xl font-bold text-secondary min-w-full text-center">Tambah Dokter</h2>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="closeModal('#modalTambahDokter')">
            </button>
        </div>

        <form action="{{ route('create-dokter') }}" method="POST">
            @csrf

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

            <!-- Username -->
            <div class="mb-4">
                <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Username" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
                @error('username')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <input type="password" name="password" id="password" placeholder="Password (Min. 8 karakter)" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" minlength="8" required>
                @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Nama Dokter" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
                @error('nama')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- No. STR -->
            <div class="mb-4">
                <input type="text" name="nostr" id="nostr" value="{{ old('nostr') }}" placeholder="No. STR" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
                @error('nostr')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Poli -->
            <div class="mb-4">
                <select name="poli" id="poli" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
                    <option value="">Pilih Poli</option>
                    <option value="umum" {{ old('poli') == 'umum' ? 'selected' : '' }}>Umum</option>
                    <option value="gigi" {{ old('poli') == 'gigi' ? 'selected' : '' }}>Gigi</option>
                </select>
                @error('poli')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- No. HP -->
            <div class="mb-4">
                <input type="text" name="nohp" id="nohp" value="{{ old('nohp') }}" placeholder="No. HP Dokter" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
                @error('nohp')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded focus:ring-primary focus:ring" required>
                    <option value="ada" {{ old('status') == 'ada' ? 'selected' : '' }}>Ada</option>
                    <option value="tidak ada" {{ old('status') == 'tidak ada' ? 'selected' : '' }}>Tidak Ada</option>
                </select>
                @error('status')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan dan Tutup -->
            <div class="flex justify-between items-center mt-6 space-x-4">
                <button type="button" class="bg-secondary text-white py-2 px-4 rounded hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary" onclick="closeModal('#modalTambahDokter')">
                    Tutup
                </button>
                <button type="submit" class="bg-primary text-white py-2 px-4 rounded hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary">
                    Simpan Dokter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full sm:w-80 p-6 relative">
        <h2 class="text-lg font-bold text-secondary text-center ">Konfirmasi Penghapusan</h2>
        <p class="text-gray-800 text-center mb-4">Apakah Anda yakin ingin menghapus dokter ini?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-between mt-4">
                <button type="button" 
                        class="px-4 py-2 bg-secondary text-white rounded-md hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light" 
                        onclick="closeModal('#deleteModal')">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Pembukaan modal dengan data-modal-toggle (untuk modal tambah dokter)
    document.querySelectorAll('[data-modal-toggle]').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah aksi default dari anchor tag
            const modalId = button.getAttribute('data-modal-toggle');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden'); // Membuka modal
            }
        });
    });

    // Pembukaan modal dengan data-modal-target (untuk modal detail dokter)
    document.querySelectorAll('[data-modal-target]').forEach(function(row) {
        row.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal-target');
            const modal = document.querySelector(modalId);
            if (modal) {
                modal.classList.remove('hidden'); // Membuka modal
            }
        });
    });

    // Fungsi untuk menutup modal
    window.closeModal = function(modalId) {
        const modal = document.querySelector(modalId);
        if (modal) {
            modal.classList.add('hidden'); // Menutup modal
        }
    };
});

  // Fungsi untuk membuka modal konfirmasi hapus
  function openDeleteModal(dokterId) {
        const form = document.getElementById('deleteForm');
        form.action = '/delete-dokter/' + dokterId; // Set action untuk form delete
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        document.querySelector(modalId).classList.add('hidden');
    }

</script>
@endsection
