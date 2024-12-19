@extends('layouts.partial')
@section('title', 'Riwayat Pemeriksaan')
@include('layouts.partialpasien')

{{-- konten --}}
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="container mx-auto mt-5">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl text-secondary font-bold mb-4 text-center">Riwayat Pemeriksaan {{$pasien->nama}}</h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-secondary table-auto border-collapse border">
                        <thead class="bg-accent">
                            <tr>
                                <th class="border px-4 py-2 text-center">Tanggal</th>
                                <th class="border px-4 py-2 text-center">Dokter</th>
                                <th class="border px-4 py-2 text-center">Status</th>
                                <th class="border px-4 py-2 text-center">Kondisi</th>
                                <th class="border px-4 py-2 text-center">Resep Obat</th>
                                <th class="border px-4 py-2 text-center">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatPemeriksaan as $reservasi)
                                <tr class="odd:bg-white even:bg-gray-50">
                                    <td class="border border-accent px-4 py-2 text-center">{{ $reservasi->tanggal }}</td>
                                    <td class="border border-accent px-4 py-2 text-center">{{ $reservasi->dokter->nama }}</td>
                                    <td class="border border-accent px-4 py-2 text-center">{{ $reservasi->status }}</td>
                                    @if ($reservasi->hasilperiksa)
                                        <td class="border border-accent px-4 py-2 text-center">{{ $reservasi->hasilperiksa->kondisi }}</td>
                                        <td class="border border-accent px-4 py-2 text-center">{{ $reservasi->hasilperiksa->resep_obat }}</td>
                                        <td class="border border-accent px-4 py-2 text-center">{{ $reservasi->hasilperiksa->catatan }}</td>
                                    @else
                                        <td class="border border-accent px-4 py-2 text-center text-gray-600" colspan="3">
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
</div>
