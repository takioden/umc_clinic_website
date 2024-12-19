@extends('layouts.partial')
@section('title', 'Riwayat Pasien')
@include('layouts.partialdokter')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="container mx-auto p-4">
            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- Judul Daftar Pasien -->
                <h1 class="text-3xl text-secondary font-bold mb-4 text-center">Daftar Pasien</h1>

                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('search.pasien.dokter') }}" class="mb-6 flex justify-center">
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

                <!-- Tabel Daftar Pasien -->
                <table class="table-auto w-full border">
                    <thead class="bg-accent text-secondary">
                        <tr>
                            <th class="border p-2 text-center">Nama Pasien</th>
                            <th class="border p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pasien->isEmpty())
                            <tr>
                                <td colspan="2" class="text-center p-4">Tidak ada pasien yang ditemukan.</td>
                            </tr>
                        @else
                            @foreach ($pasien as $p)
                                <tr>
                                    <td class="border p-2 text-center">{{ $p->nama }}</td>
                                    <td class="border p-2 text-center">
                                        <a href="{{ route('riwayat.periksa.dokter', $p->id) }}" 
                                           class="text-primary hover:text-secondary">
                                           Lihat Riwayat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</div>
