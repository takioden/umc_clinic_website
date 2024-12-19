@extends('layouts.partial')
@section('title', 'Riwayat Hasil')
@include('layouts.partialdokter')
  {{-- konten --}}
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="container mx-auto p-4">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl text-secondary text-center min-w-full font-bold mb-4">Riwayat Pasien yang Telah Ditangani</h2>
                <div class="mb-4">
                    <a href="{{ route('dokter.daftar.pasien') }}" 
                       class="bg-secondary text-white py-2 px-4 rounded hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light">
                        Kembali
                    </a>
                </div>
                <table class="w-full text-sm text-left border-collapse border border-gray-300">
                    <thead class="bg-accent text-secondary">
                        <tr>
                            <th class=" px-4 py-2 text-center ">Tanggal</th>
                            <th class=" px-4 py-2 text-center ">Pasien</th>
                            <th class=" px-4 py-2 text-center ">Poli</th>
                            <th class=" px-4 py-2 text-center ">Kondisi</th>
                            <th class=" px-4 py-2 text-center ">Resep Obat</th>
                            <th class=" px-4 py-2 text-center ">Catatan</th>
                            <th class=" px-4 py-2 text-center ">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 ">
                        @foreach ($riwayatReservasi as $reservasi)
                            <tr class="odd:bg-white even:bg-gray-50 ">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->tanggal }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->pasien->nama }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservasi->poli }}</td>
                                @if ($reservasi->hasilperiksa)
                                    <td class="border border-gray-300 px-4 py-2 text-center kondisi-cell">{{ $reservasi->hasilperiksa->kondisi }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center resep-cell">{{ $reservasi->hasilperiksa->resep_obat }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center catatan-cell">{{ $reservasi->hasilperiksa->catatan }}</td>
                                @else
                                    <td class="border border-gray-300 px-4 py-2 text-center kondisi-cell" colspan="3" class="text-gray-500">
                                        Hasil pemeriksaan belum ada
                                    </td>
                                @endif
                                <td class="border border-gray-300 px-4 py-2 text-center dark:border-gray-600">
                                    <button class="flex items-center  justify-center update-hasil" data-id="{{ $reservasi->id }}">
                                        <!-- SVG Icon -->
                                        <svg class="w-6 h-6 text-secondary hover:text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z" clip-rule="evenodd"/>
                                        </svg>                                      
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Mengubah Hasil Pemeriksaan -->
<div id="modal-ubah-hasil" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-bold text-center text-secondary">Ubah Hasil Pemeriksaan</h2>
        <form action="{{ route('dokter.update.hasil') }}" method="POST">
            @csrf
            <input type="hidden" name="reservasi_id" id="reservation-id">
            <div class="mb-4">
                <label for="kondisi" class="block text-gray-800">Kondisi:</label>
                <textarea name="kondisi" id="kondisi" rows="4" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="mb-4">
                <label for="resep_obat" class="block text-gray-800">Resep Obat:</label>
                <textarea name="resep_obat" id="resep_obat" rows="4" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="mb-4">
                <label for="catatan" class="block text-gray-800">Catatan:</label>
                <textarea name="catatan" id="catatan" rows="4" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="flex justify-between mt-4">
                <button type="button" class="px-4 py-2 bg-secondary text-white rounded-md hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light" onclick="closeModal()">Batal</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-light">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Sertakan JQuery di bagian atas sebelum script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Ketika tombol update-hasil ditekan
    $(document).on('click', '.update-hasil', function () {
        let reservasiId = $(this).data('id');
        
        // Ambil data dari baris terkait
        let kondisi = $(this).closest('tr').find('.kondisi-cell').text().trim();
        let resepObat = $(this).closest('tr').find('.resep-cell').text().trim();
        let catatan = $(this).closest('tr').find('.catatan-cell').text().trim();

        // Isi data ke dalam modal
        $('#reservation-id').val(reservasiId);
        $('#kondisi').val(kondisi !== "Hasil pemeriksaan belum ada" ? kondisi : "");
        $('#resep_obat').val(resepObat !== "Hasil pemeriksaan belum ada" ? resepObat : "");
        $('#catatan').val(catatan !== "Hasil pemeriksaan belum ada" ? catatan : "");

        // Tampilkan modal
        $('#modal-ubah-hasil').removeClass('hidden');
    });

    // Fungsi untuk menutup modal
    function closeModal() {
        $('#modal-ubah-hasil').addClass('hidden');
    }
</script>

