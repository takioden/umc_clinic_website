@extends('layouts.partial')
@section('title', 'Contact')
@section('navbar')
@include('layouts.navpasien')
@endsection
@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6 text-center">Contact Us</h1>
    <div class="mt-6 text-center">
        <p class="text-gray-700">Phone: 0331333527</p>
        <p class="text-gray-700">Address: Jl. Kalimantan, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121</p>
    </div>
    <div class="mt-6 text-center">
        <iframe class="w-full h-98" allowfullscreen="" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2138.9902695858354!2d113.71208038117042!3d-8.161377348651882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6943569c31b4b%3A0x620aaa91f9d511f6!2sKlinik%20Kimia%20Farma%20UNEJ%20Medical%20Center%20(UMC%20KLINIK)!5e0!3m2!1sid!2sid!4v1734420555656!5m2!1sid!2sid" width="600" height="450" style="border:0;"  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection
@section('footer')
@include('layouts.footer')
@endsection
