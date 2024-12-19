@section('navbar')
<nav class="fixed top-0 z-40 w-full bg-background border-b border-accent dark:bg-secondary dark:border-accent">
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
            <img src="https://4.bp.blogspot.com/-xbSSASGKQkk/XuWnLm2KTkI/AAAAAAAAaLQ/uQTBzp3AsicCyBC3Wd9mlINaoL8ppQUNwCLcBGAsYHQ/s1600/logo-Universitas-Jember-UNEJ_237desain.png" class="h-8 me-3" alt="FlowBite Logo" />
            <span class="text-accent self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-primary">Admin Dashboard</span>
          </a>
        </div>
        <div class="flex items-center">
            <div class="flex items-center ms-3">
              <div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full bg-accent" src="https://de.cdn-website.com/cd1b328aa49a49ac91d4cff13357adc6/dms3rep/multi/call.png" alt="user photo">
                </button>
              </div>
              <div class="z-50 hidden my-4 text-base list-none bg-accent divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                <div class="px-4 py-3" role="none">
                  <p class="text-sm text-secondary dark:text-accent" role="none">
                     {{ $user->username }}
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a href="{{route('adminDashboard')}}" class="block px-4 py-2 text-sm text-secondary hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                  </li>
                  <li>
                     <form method="POST" action="{{ route('admin.logout') }}" >
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
    

@section('content')
<aside id="logo-sidebar" class="fixed top-0 left-0 z-30 w-64 h-screen pt-20 transition-transform -translate-x-full bg-background border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-background dark:bg-secondary">
       <ul class="space-y-2 font-medium">
          <li>
             <a href="{{route('adminDashboard')}}" class="flex items-center p-2 text-accent hover:text-secondary rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 transition duration-75 dark:text-secondary group-hover:text-secondary dark:group-hover:text-accent" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                   <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                   <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
             </a>
          </li>
          <li>
             <a href="{{route('adminPasienShow')}}" class="flex items-center p-2 text-accent hover:text-secondary rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-accent transition duration-75 dark:text-gray-400 group-hover:text-secondary dark:group-hover:text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5zm0 2c-2.673 0-8 1.334-8 4v2h16v-2c0-2.666-5.327-4-8-4z"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Pasien</span>
             </a>
          </li>
          <li>
             <a href="{{route('adminDokterShow')}}" class="flex items-center p-2 text-accent hover:text-secondary rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-accent transition duration-75 dark:text-gray-400 group-hover:text-secondary dark:group-hover:text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M11 10.586V5a1 1 0 1 1 2 0v5.586a4 4 0 1 1-2 0zm-3.5 0V4a1 1 0 1 1 2 0v6.586a6 6 0 1 0 5 0V4a1 1 0 1 1 2 0v6.586a8 8 0 1 1-9 0zM17 16a2 2 0 1 0 4 0 2 2 0 0 0-4 0z"/>
                </svg>
                 <span class="flex-1 ms-3 whitespace-nowrap">Dokter</span>
             </a>
            </li>
          <li>
             <a href="{{route('getHistory')}}" class="flex items-center p-2 text-accent hover:text-secondary rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-accent transition duration-75 dark:text-gray-400 group-hover:text-secondary dark:group-hover:text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 8c-.553 0-1 .448-1 1v4c0 .553.447 1 1 1h3c.553 0 1-.447 1-1s-.447-1-1-1h-2V9c0-.552-.447-1-1-1zm7.071-4.929c-3.905-3.905-10.237-3.905-14.142 0-1.171 1.171-1.905 2.568-2.25 4.041-.125.553.227 1.105.788 1.227.561.122 1.107-.227 1.228-.788.27-1.187.845-2.307 1.748-3.211 3.124-3.124 8.193-3.124 11.317 0s3.124 8.193 0 11.317-8.193 3.124-11.317 0c-.482-.482-.917-1.016-1.318-1.591L5 15.5c-.447-.447-1.171-.262-1.5.164l-1.5 2c-.33.424-.11 1.07.379 1.201.671.173 1.344.259 2.021.259 2.649 0 5.299-1.01 7.313-3.025 3.905-3.905 3.905-10.237 0-14.142z"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Histori Pemeriksaan</span>
             </a>
          </li>
          <li>
            <form method="POST" action="{{ route('admin.logout') }}" class="flex items-center p-2 text-accent hover:text-secondary rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                @csrf
                <button type="submit" class="flex items-center bg-transparent border-none p-0 text-accent hover:text-secondary group">
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
