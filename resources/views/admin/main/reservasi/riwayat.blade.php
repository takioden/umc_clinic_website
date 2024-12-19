@extends('layouts.partial')
@section('title', 'Riwayat')
@include('layouts.partialadmin')
{{-- konten --}}
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="container mx-auto mt-5">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold text-secondary mb-4 text-center">Riwayat Pemeriksaan Pasien</h1>

                <!-- Button Kembali -->
                <div class="mb-4">
                    <a href="{{ route('getHistory') }}" 
                       class="bg-secondary text-white py-2 px-4 rounded hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light">
                        Kembali
                    </a>
                </div>

                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-accent">
                        <tr>
                            <th class=" px-4 py-2 text-center">Tanggal</th>
                            <th class=" px-4 py-2 text-center">Dokter</th>
                            <th class=" px-4 py-2 text-center">Status</th>
                            <th class=" px-4 py-2 text-center">Kondisi</th>
                            <th class=" px-4 py-2 text-center">Resep Obat</th>
                            <th class=" px-4 py-2 text-center">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatPemeriksaan as $reservasi)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->tanggal }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->dokter->nama }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->status }}</td>
                                @if ($reservasi->hasilperiksa)
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->hasilperiksa->kondisi }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->hasilperiksa->resep_obat }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->hasilperiksa->catatan }}</td>
                                @else
                                    <td class="border border-gray-300 px-4 py-2 text-center" colspan="3" class="text-gray-500">
                                        Hasil pemeriksaan belum ada
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
