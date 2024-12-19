@section('navbar')
<nav class="fixed top-0 z-40 w-full bg-background border-b border-accent dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-accent rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
              <span class="sr-only">Open sidebar</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                 <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
              </svg>
           </button>
          <a href="https://unej.ac.id" class="flex ms-2 md:me-24">
            <img src="https://4.bp.blogspot.com/-xbSSASGKQkk/XuWnLm2KTkI/AAAAAAAAaLQ/uQTBzp3AsicCyBC3Wd9mlINaoL8ppQUNwCLcBGAsYHQ/s1600/logo-Universitas-Jember-UNEJ_237desain.png" class="h-8 me-3 " alt="Logo" />
            <span class="self-center text-xl text-accent font-bold sm:text-2xl whitespace-nowrap dark:text-white">Selamat Datang {{ $user->username }}...</span>
          </a>
        </div>
        <div class="flex items-center">
            <div class="flex items-center ms-3">
              <div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full bg-accent" src="https://provencevision.fr/wp-content/themes/vision/img/user_doc.png" alt="user photo">
                </button>
              </div>
              <div class="z-50 hidden my-4 text-base list-none bg-accent text-secondary divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                <div class="px-4 py-3" role="none">
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{$user->username}}
                  </p>
            
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a href="{{route('dokterDashboard')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('dokter.logout') }}" >
                       @csrf
                       <button type="submit" class="block px-4 py-2 text-sm text-secondary hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Logout</button>
                   </form>
                 </li>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
</nav>
@endsection
@section('content')
  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-background border-r border-accent sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
     <div class="h-full px-3 pb-4 overflow-y-auto bg-background dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
           <li>
              <a href="{{route('dokterDashboard')}}" class="flex items-center p-2 text-accent hover:text-secondary rounded-lg dark:text-white hover:bg-accent dark:hover:bg-gray-700 group">
                 <svg class="w-5 h-5 text-accent transition duration-75 dark:text-gray-400 group-hover:text-secondary dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                 </svg>
                 <span class="ms-3">Dashboard</span>
              </a>
           </li>
           <li>
              <a href="{{route('dokter.daftar.pasien')}}" class="flex items-center p-2 text-accent rounded-lg dark:text-white hover:text-secondary hover:bg-accent dark:hover:bg-gray-700 group">
                 <svg class="flex-shrink-0 w-5 h-5 text-accent transition duration-75 dark:text-gray-400 group-hover:text-secondary dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                 </svg>
                 <span class="flex-1 ms-3 whitespace-nowrap">Riwayat Hasil Periksa</span>
              </a>
           </li>
           <li>
              <a href="{{route('getHistoryInDokter')}}" class="flex items-center p-2 text-accent rounded-lg dark:text-white hover:bg-accent hover:text-secondary dark:hover:bg-gray-700 group">
                 <svg class="flex-shrink-0 w-5 h-5 text-accent transition duration-75 dark:text-gray-400 group-hover:text-secondary dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                 </svg>
                 <span class="flex-1 ms-3 whitespace-nowrap">Riwayat Pasien</span>
              </a>
           </li>
           <li>
            <form method="POST" action="{{ route('dokter.logout') }}" class="flex items-center p-2 text-accent hover:text-secondary rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                @csrf
                <button type="submit" class="flex items-center bg-transparent border-none p-0 text-accent hover:text-secondary hover:bg-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-accent transition duration-75 dark:text-gray-400 group-hover:text-secondary dark:group-hover:text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3a1 1 0 0 1 1 1v16a1 1 0 0 1-2 0V4a1 1 0 0 1 1-1zm5.293 7.293-4-4a1 1 0 0 1 1.414-1.414L20.414 11l-5.707 5.707a1 1 0 1 1-1.414-1.414l4-4z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
                </button>
            </form>
        </li>
        </ul>
     </div>
</aside>