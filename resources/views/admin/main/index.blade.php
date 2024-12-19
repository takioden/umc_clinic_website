@extends('layouts.partial')
@section('title', 'Dashboard')
@include('layouts.partialadmin')
 
{{-- konten --}}
 
 <div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
       {{-- statistik --}}
       <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50">
                <p class="text-lg font-bold text-secondary dark:text-gray-200 ">Tanggal Saat Ini</p>
                <p id="date" class=" text-xl text-background font-bold"></p>
            </div>
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50">
                <p class="text-lg text-secondary font-bold dark:text-gray-200">Waktu Saat Ini</p>
                <p id="clock" class="text-3xl font-bold text-primary"></p>
            </div>
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50">
                <button id="tambah-reservasi" class="flex items-center text-secondary font-bold hover:text-primary text-xl">
                    <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Reservasi
                </button>
            </div>
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50">
                <p class="text-lg text-secondary font-bold">Pasien Saat Ini</p>
                <p id="total-pasien" class="text-3xl font-bold text-primary">{{$totalPasien}}</p>
            </div>
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50">
                <p class="text-lg font-bold text-secondary">Dokter Saat Ini</p>
                <p id="total-dokter" class=" text-3xl text-background font-bold">{{$totalDokter}}</p>
            </div>
           <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50">
               <p class="text-lg text-secondary font-bold">Pengguna Saat Ini</p>
               <p id="total-user" class="text-3xl font-bold text-secondary">{{$totalUser}}</p>
           </div>
           
       </div>
       
            <!-- Daftar Reservasi -->
            {{-- daftar poli umum --}}
        <div class="flex flex-col items-start justify-center h-auto rounded bg-gray-50 p-4 overflow-x-auto mb-8">
            <p class="text-xl text-secondary mb-4 min-w-full text-center font-bold">Daftar Reservasi Poli Umum</p>
            <table class="min-w-full text-center text-secondary">
                <thead>
                    <tr>
                        <th class="border-b  py-2 px-4 text-center">Nama Pasien</th>
                        <th class="border-b  py-2 px-4 text-center">Dokter</th>
                        <th class="border-b  py-2 px-4 text-center">Waktu</th>
                        <th class="border-b  py-2 px-4 text-center">Status</th>
                        <th class="border-b  py-2 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="daftar-reservasi-umum">
                    {{-- data dengan ajax --}}
                </tbody>
            </table>
        </div>

        {{-- daftar poli gigi --}}
        <div class="flex flex-col items-start justify-center h-auto rounded bg-gray-50 p-4 overflow-x-auto">
            <p class="text-xl text-secondary mb-4 min-w-full text-center font-bold">Daftar Reservasi Poli Gigi</p>
            <table class="min-w-full text-center text-secondary">
                <thead>
                    <tr>
                        <th class="border-b  py-2 px-4 text-center">Nama Pasien</th>
                        <th class="border-b  py-2 px-4 text-center">Dokter</th>
                        <th class="border-b  py-2 px-4 text-center">Waktu</th>
                        <th class="border-b  py-2 px-4 text-center">Status</th>
                        <th class="border-b  py-2 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="daftar-reservasi-gigi">
                    {{-- data dengan ajax --}}
                </tbody>
            </table>
        </div>

   </div>
</div>

{{-- modal --}}
{{-- modal tambah --}}
<div id="modal-tambah-reservasi" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
   <div class="bg-white rounded-lg shadow-lg w-full sm:w-96 p-6">
       <h2 class="text-lg font-bold text-secondary text-center mb-4">Tambah Reservasi</h2>
       <form id="form-reservasi" action="{{route('create-reservasi')}}" method="POST">
           @csrf
           <div class="mb-4">
               <label for="tanggal" class="block text-gray-800">Tanggal:</label>
               <input type="datetime-local" name="tanggal" id="tanggal" class="w-full mt-1 p-2 border border-gray-300 rounded-md  focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-blue-300" required>
           </div>

           <div class="mb-4">
               <label for="poli" class="block text-gray-800">Poli:</label>
               <select name="poli" id="poli" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-blue-300" required>
                   <option value="" disabled selected>Pilih Poli</option>
                   <option value="umum">Umum</option>
                   <option value="gigi">Gigi</option>
               </select>
           </div>

           <div class="mb-4">
               <label for="dokter" class="block text-gray-800">Dokter:</label>
               <select name="dokter_id" id="dokter" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-blue-300" required>
                   <option value="" disabled selected>Pilih Dokter</option>
               </select>
           </div>

           <div class="mb-4">
               <label for="status" class="block text-gray-800">Status:</label>
               <select name="status" id="status" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-blue-300" required>
                   <option value="menunggu">Menunggu</option>
                   <option value="sedang ditangani">Sedang Ditangani</option>
                   <option value="selesai">Selesai</option>
               </select>
           </div>

           <div class="mb-4">
               <label for="pasien" class="block text-gray-800">Pasien:</label>
               <input type="text" id="pasien" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-blue-300" placeholder="Cari nama pasien..." autocomplete="off" required>
               <input type="hidden" name="pasien_id" id="pasien_id">
               <ul id="pasienSuggestions" class="border border-gray-300 bg-white rounded mt-1 hidden max-h-40 overflow-y-auto"></ul>
           </div>

           <div class="flex justify-between mt-4">
               <button type="button" id="tutup-modal" class="px-4 py-2 bg-secondary text-white rounded-md hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light">Batal</button>
               <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-light">Simpan</button>
           </div>
       </form>
   </div>
</div>

{{-- modal update status --}}
<div id="modal-update-status" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
   <div class="bg-white  rounded-lg shadow-lg w-96 p-6">
       <h2 class="text-lg font-bold text-secondary text-center  mb-4">Update Status</h2>
       <form action="{{ route('admin.update.status.reservasi') }}" method="POST">
           @csrf
           <input type="hidden" name="reservation_id" id="reservation-id">
           <div class="mb-4">
               <label for="status" class="block text-gray-800">Status:</label>
               <select name="status" id="status" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-blue-300" required>
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

{{-- modal konfirm hapus --}}
<div id="modal-confirm-delete" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
   <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full sm:w-96 p-6">
       <h2 class="text-lg font-bold text-center text-secondary mb-4">Konfirmasi Hapus</h2>
       <p class="text-gray-800 mb-4 text-center">Apakah Anda yakin ingin menghapus reservasi ini?</p>
       <form action="{{ route('admin.delete.reservasi') }}" method="POST" id="form-delete-reservasi">
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // tambah reservasi
    $(document).ready(function () {
        // buka modal
        $('#tambah-reservasi').on('click', function () {
            $('#modal-tambah-reservasi').removeClass('hidden');
        });

        // tutup modal
        $('#tutup-modal').on('click', function () {
            $('#modal-tambah-reservasi').addClass('hidden');
        });

        // filter dokter by poli
        $('#poli').on('change', function () {
            let poli = $(this).val();
            if (poli) {
                $.ajax({
                    url: "{{ route('admin.get.dokter') }}",
                    type: "GET",
                    data: { poli: poli },
                    success: function (data) {
                        $('#dokter').empty().append('<option value="" disabled selected>Pilih Dokter</option>');
                        data.forEach(function (dokter) {
                            $('#dokter').append(`<option value="${dokter.id}">${dokter.nama}</option>`);
                        });
                    },
                    error: function () {
                        alert('Gagal mengambil data dokter.');
                    }
                });
            } else {
                $('#dokter').empty().append('<option value="" disabled selected>Pilih Dokter</option>');
            }
        });

        // auto complete pasien
        $('#pasien').on('input', function () {
            let query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: "{{ route('admin.search.pasien') }}",
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                        let suggestions = '';
                        data.forEach(item => {
                            suggestions += `<li data-id="${item.id}" class="p-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600">${item.nama}</li>`;
                        });
                        $('#pasienSuggestions').html(suggestions).removeClass('hidden');
                    },
                    error: function () {
                        alert('Gagal mengambil data pasien.');
                    }
                });
            } else {
                $('#pasienSuggestions').addClass('hidden');
            }
        });

        // pilih pasien dari auto complete
        $(document).on('click', '#pasienSuggestions li', function () {
            $('#pasien').val($(this).text());
            $('#pasien_id').val($(this).data('id'));
            $('#pasienSuggestions').addClass('hidden');
        });

        // sembunyikan auto complete
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#pasienSuggestions, #pasien').length) {
                $('#pasienSuggestions').addClass('hidden');
            }
        });
    });

    // daftar reservasi
    $(document).ready(function () {
        $.ajax({
            url: "{{ route('admin.get.reservasi.hari_ini') }}",
            type: "GET",
            success: function (data) {
                // Data poli umum
                let daftarReservasiUmum = '';
                data.poli_umum.forEach(function (reservasi) {
                    daftarReservasiUmum += `
                        <tr>
                            <td class="border-b py-2 px-4 text-center">${reservasi.pasien.nama}</td>
                            <td class="border-b py-2 px-4 text-center">${reservasi.dokter.nama}</td>
                            <td class="border-b py-2 px-4 text-center">${reservasi.tanggal}</td>
                            <td class="border-b py-2 px-4 text-center">${reservasi.status}</td>
                            <td class="border-b py-2 px-4 text-center">
                                <button class="text-secondary hover:text-primary update-status" data-id="${reservasi.id}" data-status="${reservasi.status}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700 delete-reservasi" data-id="${reservasi.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#daftar-reservasi-umum').html(daftarReservasiUmum);

                // Data poli gigi
                let daftarReservasiGigi = '';
                data.poli_gigi.forEach(function (reservasi) {
                    daftarReservasiGigi += `
                        <tr>
                            <td class="border-b  py-2 px-4 text-center">${reservasi.pasien.nama}</td>
                            <td class="border-b  py-2 px-4 text-center">${reservasi.dokter.nama}</td>
                            <td class="border-b  py-2 px-4 text-center">${reservasi.tanggal}</td>
                            <td class="border-b  py-2 px-4 text-center">${reservasi.status}</td>
                            <td class="border-b  py-2 px-4 text-center">
                                <button class="text-secondary hover:text-primary update-status" data-id="${reservasi.id}" data-status="${reservasi.status}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700 delete-reservasi" data-id="${reservasi.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#daftar-reservasi-gigi').html(daftarReservasiGigi);
            },
            error: function () {
                alert('Gagal mengambil data reservasi.');
            }
        });
    });

    // hapus
   $(document).ready(function () {
    // Menangani klik pada ikon update
    $(document).on('click', '.update-status', function () {
        let reservasiId = $(this).data('id');
        let status = $(this).data('status');
        openUpdateModal(reservasiId, status);
    });

    // Menangani klik pada ikon delete
    $(document).on('click', '.delete-reservasi', function () {
        let reservasiId = $(this).data('id');
        confirmDelete(reservasiId);
    });
    });

      // Fungsi untuk membuka modal update status
    function openUpdateModal(reservationId, status) {
         $('#reservation-id').val(reservationId);
         $('#status').val(status);  // Set status di dropdown sesuai status saat ini
         $('#modal-update-status').removeClass('hidden');
      }

      // Fungsi untuk menutup modal update status
      function closeUpdateModal() {
         $('#modal-update-status').addClass('hidden');
      }

      // Fungsi untuk membuka modal konfirmasi delete
      function confirmDelete(reservationId) {
         $('#delete-reservation-id').val(reservationId);
         $('#modal-confirm-delete').removeClass('hidden');
      }

      // Fungsi untuk menutup modal konfirmasi delete
      function closeDeleteModal() {
         $('#modal-confirm-delete').addClass('hidden');
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

