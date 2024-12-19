@extends('layouts.partial')

@section('title', 'About')
@extends('layouts.navpasien')
@section('content')
<div class="flex flex-col items-center justify-center h-full gap-8 px-4 md:gap-16">
    <!-- Gambar -->
    <div 
      id="image-container"
      class="rounded-xl shadow w-64 h-64 md:w-96 md:h-96 bg-cover bg-center  hover:scale-110 transition duration-300 ease-in-out"
      style="background-image: url('https://th.bing.com/th/id/R.c3e680359b29a07361ce7f8d26b64558?rik=OHIo2fh9ScPL8Q&riu=http%3a%2f%2fchemeng.teknik.unej.ac.id%2fwp-content%2fuploads%2fsites%2f10%2f2024%2f02%2fUMC1.png&ehk=ddNHXIspdwFrdPl42R5He5ifKI71YwihtRSlHlevynY%3d&risl=&pid=ImgRaw&r=0');">
    </div>

    <!-- Konten Teks -->
    <div class="text-center max-w-xl">
      <h1 class="text-2xl font-bold mb-4 md:text-3xl">Tentang Kami</h1>
      <p class="text-gray-700 leading-relaxed text-base md:text-lg">
        Selamat datang di Universitas Jember Medical Center (UMC)! 
        Kami adalah pusat layanan kesehatan yang lengkap di Jember, 
        Jawa Timur. Di UMC, kami menyediakan berbagai layanan kesehatan 
        untuk memenuhi kebutuhan Anda, mulai dari klinik umum dan gigi, 
        layanan kesehatan ibu dan anak, hingga konsultasi gizi dan spa bayi.

        
      </p>
      
    </div>
  </div>

@endsection

@section('footer')
@include('layouts.footer')
@endsection