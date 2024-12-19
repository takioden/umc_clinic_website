@extends('layouts.partial')
@section('title', 'Daftar Pasien Ditangani')
@include('layouts.partialdokter')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="container mx-auto p-4">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl text-secondary font-bold text-center mb-6">Pasien yang Ditangani {{$dokter->nama}}</h1>
                <table class="table-auto w-full border">
                    <thead>
                        <tr class="bg-accent">
                            <th class="border px-4 py-2 text-center text-secondary">Nama Pasien</th>
                            <th class="border px-4 py-2 text-center text-secondary">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $pasien_id => $reservasi)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $reservasi[0]->pasien->nama }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="{{ route('riwayatHasil', ['pasienId' => $pasien_id]) }}" 
                                    class="text-primary hover:text-secondary">
                                        Lihat Riwayat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center p-4">Tidak ada pasien yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
