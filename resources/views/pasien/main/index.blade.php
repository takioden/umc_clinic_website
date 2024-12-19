@extends('layouts.partial')
@section('title', 'Dashboard')

@include('layouts.partialpasien') 
  <div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg  mt-14">
        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50 ">
                <p class="text-lg font-bold text-secondary">Tanggal Saat Ini</p>
                <p id="date" class=" text-xl text-background font-bold"></p>
            </div>
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50">
                <p class="text-lg text-secondary font-bold dark:text-gray-200">Waktu Saat Ini</p>
                <p id="clock" class="text-3xl font-bold text-primary"></p>
            </div>
            <div class="flex flex-col items-center justify-center h-24 rounded bg-gray-50">
                <button id="tambah-reservasi" class="flex items-center font-bold text-xl text-secondary hover:text-primary">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Reservasi
                </button>
            </div>
        </div>
        
             <!-- Daftar Reservasi -->
             <!-- Daftar Reservasi Poli Umum -->
         <div class="flex flex-col items-start justify-center h-auto rounded bg-gray-50 p-4 overflow-x-auto mb-8">
             <p class="text-xl text-secondary font-bold  mb-4 min-w-full text-center">Daftar Reservasi Poli Umum</p>
             <table class="min-w-full text-secondary ">
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
                     
                 </tbody>
             </table>
         </div>
 
         <!-- Daftar Reservasi Poli Gigi -->
         <div class="flex flex-col items-start justify-center h-auto rounded bg-gray-50 p-4 overflow-x-auto">
             <p class="text-xl text-secondary text-center font-bold min-w-full mb-4">Daftar Reservasi Poli Gigi</p>
             <table class="min-w-full text-left text-secondary ">
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
                     
                 </tbody>
             </table>
         </div>
 
    </div>
 </div>
 

 <div id="modal-tambah-reservasi" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white  rounded-lg shadow-lg w-full sm:w-96 p-6">
        <h2 class="text-lg font-bold text-secondary text-center mb-4 ">Tambah Reservasi</h2>
        <form id="form-reservasi" action="{{route('create-reservasi-pasien')}}" method="POST">
            @csrf
            {{-- hidden input --}}
            <input type="hidden" name="status" id="status" value="menunggu">
            <input type="hidden" name="pasien_id" id="pasien_id" value="{{$pasien->id}}">
            
            <div class="mb-4">
                <label for="tanggal" class="block text-gray-800 dark:text-gray-200">Tanggal:</label>
                <input type="datetime-local" name="tanggal" id="tanggal" class="w-full mt-1 p-2 border border-gray-300 rounded-md  focus:outline-none focus:ring-2 focus:ring-primary " required>
            </div>
 
            <div class="mb-4">
                <label for="poli" class="block text-gray-800 dark:text-gray-200 ">Poli:</label>
                <select name="poli" id="poli" class="w-full mt-1 p-2 border border-gray-300 rounded-md  focus:outline-none focus:ring-2 focus:ring-primary " required>
                    <option value="" disabled selected>Pilih Poli</option>
                    <option value="umum">Umum</option>
                    <option value="gigi">Gigi</option>
                </select>
            </div>
 
            <div class="mb-4">
                <label for="dokter" class="block text-gray-800 dark:text-gray-200">Dokter:</label>
                <select name="dokter_id" id="dokter" class="w-full mt-1 p-2 border border-gray-300 rounded-md  focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <option value="" disabled selected>Pilih Dokter</option>
                </select>
            </div>
 
            <div class="flex justify-between mt-4">
                <button type="button" id="tutup-modal" class="px-4 py-2 bg-secondary text-white rounded-md hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-secondary-light">Batal</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-light">Simpan</button>
            </div>
        </form>
    </div>
 </div>
 

 <div id="modal-confirm-delete" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
   <div class="bg-white  rounded-lg shadow-lg w-full sm:w-96 p-6">
       <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
       <p class="text-gray-800 mb-4">Apakah Anda yakin ingin menghapus reservasi ini?</p>
       <form action="{{ route('pasien.delete.reservasi') }}" method="POST" id="form-delete-reservasi">
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
    $(document).ready(function () {
        // membuka modal 
        $('#tambah-reservasi').on('click', function () {
            $('#modal-tambah-reservasi').removeClass('hidden');
        });

        // menutup modal
        $('#tutup-modal').on('click', function () {
            $('#modal-tambah-reservasi').addClass('hidden');
        });

        // filter berdasar poli
        $('#poli').on('change', function () {
            let poli = $(this).val();
            if (poli) {
                $.ajax({
                    url: "{{ route('pasien.get.dokter') }}",
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
    });

    $(document).ready(function () {
    // memfetch data dan merender
    $.ajax({
        url: "{{ route('pasien.get.reservasi.hari_ini') }}",
        type: "GET",
        success: function (data) {
            const pasienIdLogin = data.pasien_id_login;

            // data poli umum
            let daftarReservasiUmum = '';
            data.poli_umum.forEach(function (reservasi) {
                daftarReservasiUmum += `
                    <tr>
                        <td class="border-b  py-2 px-4 text-center">${reservasi.pasien.nama}</td>
                        <td class="border-b  py-2 px-4 text-center">${reservasi.dokter.nama}</td>
                        <td class="border-b  py-2 px-4 text-center">${reservasi.tanggal}</td>
                        <td class="border-b  py-2 px-4 text-center">${reservasi.status}</td>
                        <td class="border-b  py-2 px-4 text-center">
                            ${
                                reservasi.pasien_id === pasienIdLogin
                                    ? `<button class="text-red-500 hover:text-red-700 delete-reservasi" 
                                        data-id="${reservasi.id}">
                                        <i class="fas fa-trash"></i>
                                       </button>`
                                    : ''
                            }
                        </td>
                    </tr>
                `;
            });
            $('#daftar-reservasi-umum').html(daftarReservasiUmum);

            // Ddata poli gigi
            let daftarReservasiGigi = '';
            data.poli_gigi.forEach(function (reservasi) {
                daftarReservasiGigi += `
                    <tr>
                        <td class="border-b  py-2 px-4 text-center">${reservasi.pasien.nama}</td>
                        <td class="border-b  py-2 px-4 text-center">${reservasi.dokter.nama}</td>
                        <td class="border-b  py-2 px-4 text-center">${reservasi.tanggal}</td>
                        <td class="border-b  py-2 px-4 text-center">${reservasi.status}</td>
                        <td class="border-b  py-2 px-4 text-center">
                            ${
                                reservasi.pasien_id === pasienIdLogin
                                    ? `<button class="text-red-500 hover:text-red-700 delete-reservasi" 
                                        data-id="${reservasi.id}">
                                        <i class="fas fa-trash"></i> 
                                       </button>`
                                    : ''
                            }
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

    // handle klik hapus
    $(document).on('click', '.delete-reservasi', function () {
        const reservationId = $(this).data('id');
        $('#delete-reservation-id').val(reservationId); // Set ID reservasi ke input hidden
        $('#modal-confirm-delete').removeClass('hidden'); // Tampilkan modal
    });
});

    // Function untuk menutup modal
    function closeDeleteModal() {
        $('#modal-confirm-delete').addClass('hidden');
    }



    $(document).ready(function () {

        // Menangani klik pada ikon delete
        $(document).on('click', '.delete-reservasi', function () {
            let reservasiId = $(this).data('id');
            confirmDelete(reservasiId);
        });
    });

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