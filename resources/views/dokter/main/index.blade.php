@extends('layouts.partial')
@section('title', 'Dashboard')
@include('layouts.partialdokter') 
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg  mt-14">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-lg font-bold text-secondary dark:text-gray-200 ">Tanggal Saat Ini</p>
                <p id="date" class=" text-xl text-background font-bold"></p>
            </div>
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-lg text-secondary font-bold dark:text-gray-200">Waktu Saat Ini</p>
                <p id="clock" class="text-3xl font-bold text-primary"></p>
            </div>
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <button class="flex items-center justify-center " onclick="window.location.href='{{route('editProfilShow', $dokter->id)}}'">
                    <svg class="w-16 h-16 text-secondary hover:text-primary dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z" clip-rule="evenodd"/>
                      </svg>                      
                </button>
            </div>
        </div>

        <!-- Daftar Reservasi -->
        <div class="flex flex-col items-start justify-center h-auto rounded bg-gray-50  p-4 overflow-x-auto">
            <p class="text-2xl font-bold text-secondary  mb-4 min-w-full text-center">Daftar Reservasi</p>
            <table class="min-w-full text-center text-secondary ">
                <thead>
                    <tr>
                        <th class="border-b  py-2 px-4 text-center">Tanggal</th>
                        <th class="border-b  py-2 px-4 text-center">Pasien</th>
                        <th class="border-b  py-2 px-4 text-center">Poli</th>
                        <th class="border-b  py-2 px-4 text-center">Status</th>
                        <th class="border-b  py-2 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($reservasiList as $reservasi)
                    <tr>
                        <td class="py-2 px-4 text-center">{{ $reservasi->tanggal }}</td>
                        <td class="py-2 px-4 text-center">{{ $reservasi->pasien->nama }}</td>
                        <td class="py-2 px-4 text-center">{{ $reservasi->poli }}</td>
                        <td class="py-2 px-4 text-center">
                            <span>
                                {{ $reservasi->status }}
                            </span>
                        </td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <!-- Tombol Tambah Hasil Periksa -->
                                <button class="flex items-center justify-center tambah-hasil" data-id="{{$reservasi->id}}">
                                    <svg class="w-6 h-6 text-secondary hover:text-primary " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z" clip-rule="evenodd"/>
                                      </svg>                                      
                                </button>
                                <!-- Tombol Update Status Reservasi -->
                                <button class="flex items-center justify-center update-status" data-id="{{$reservasi->id}}" data-status="{{$reservasi->status}}">
                                    <svg class="w-6 h-6 text-primary hover:text-secondary " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                                      </svg>                                      
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- modal --}}
{{-- Modal Update Status --}}
<div id="modal-update-status" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-semibold text-secondary text-center  mb-4">Update Status</h2>
        <form action="{{ route('dokter.update.status.reservasi') }}" method="POST">
            @csrf
            <input type="hidden" name="reservation_id" id="reservation-id">
            <div class="mb-4">
                <label for="status" class="block text-gray-800 ">Status:</label>
                <select name="status" id="status" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <option value="menunggu">Menunggu</option>
                    <option value="sedang ditangani">Sedang Ditangani</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="flex justify-between mt-4">
                <button type="button" class="px-4 py-2 bg-secondary text-white rounded-md hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light" onclick="closeUpdateModal()">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-light">Update</button>
            </div>
        </form>
    </div>
 </div>

{{-- Modal Tambah Hasil --}}
 <div id="modal-tambah-hasil" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-bold text-secondary text-center mb-4">Tambah Hasil Pemeriksaan</h2>
        <form action="{{route('tambah.hasil')}}" method="POST">
            @csrf
            <input type="hidden" name="reservasi_id" id="reservasi-id-hasil">
            <div class="mb-4">
                <label for="kondisi" class="block text-gray-800 dark:text-gray-200">Kondisi:</label>
                <textarea name="kondisi" id="kondisi" class="w-full mt-1 p-2 border border-gray-300 rounded-md  focus:outline-none focus:ring-2 focus:ring-primary " required></textarea>
            </div>
            <div class="mb-4">
                <label for="resep_obat" class="block text-gray-800 dark:text-gray-200">Resep Obat:</label>
                <textarea name="resep_obat" id="resep_obat" class="w-full mt-1 p-2 border border-gray-300 rounded-md  focus:outline-none focus:ring-2 focus:ring-primary " required></textarea>
            </div>
            <div class="mb-4">
                <label for="catatan" class="block text-gray-800 dark:text-gray-200">Catatan:</label>
                <textarea name="catatan" id="catatan" class="w-full mt-1 p-2 border border-gray-300 rounded-md  focus:outline-none focus:ring-2 focus:ring-primary "></textarea>
            </div>
            <div class="flex justify-between mt-4">
                <button type="button" class="px-4 py-2 bg-secondary text-white rounded-md hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light" onclick="closeHasilModal()">Batal</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-light">Simpan</button>
            </div>
        </form>
    </div>
</div>


<script>
    document.querySelectorAll('.update-status').forEach(button => {
            button.addEventListener('click', function () {
                const reservasiId = this.getAttribute('data-id');
                const status = this.getAttribute('data-status');
                openUpdateModal(reservasiId, status);
            });
        });

    function openUpdateModal(reservationId, status) {
        document.getElementById('reservation-id').value = reservationId;
        document.getElementById('status').value = status;
        document.getElementById('modal-update-status').classList.remove('hidden');
    }

    function closeUpdateModal() {
        document.getElementById('modal-update-status').classList.add('hidden');
    }

    document.querySelectorAll('.tambah-hasil').forEach(button => {
    button.addEventListener('click', function () {
        const reservasiId = this.getAttribute('data-id');
        document.getElementById('reservasi-id-hasil').value = reservasiId;
        document.getElementById('modal-tambah-hasil').classList.remove('hidden');
        });
    });

    function closeHasilModal() {
        document.getElementById('modal-tambah-hasil').classList.add('hidden');
    }

    function updateClock() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const formattedTime = `${hours}:${minutes}:${seconds}`;

        document.getElementById('clock').textContent = formattedTime;
    }

    // Perbarui waktu setiap detik
        setInterval(updateClock, 1000);

    // Set waktu awal saat halaman pertama kali dimuat
        updateClock();

    function updateDate() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = now.toLocaleDateString('id-ID', options); // Format tanggal dalam bahasa Indonesia

        document.getElementById('date').textContent = formattedDate;
    }

    // Set tanggal saat halaman pertama kali dimuat
        updateDate();

</script>