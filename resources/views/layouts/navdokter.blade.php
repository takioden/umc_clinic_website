
<nav class="bg-background rounded-xl shadow m-1 items-center dark:bg-gray-900 w-full z-20 top-0 start-0 border-b border-secondary dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://unej.ac.id/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://4.bp.blogspot.com/-xbSSASGKQkk/XuWnLm2KTkI/AAAAAAAAaLQ/uQTBzp3AsicCyBC3Wd9mlINaoL8ppQUNwCLcBGAsYHQ/s1600/logo-Universitas-Jember-UNEJ_237desain.png" class="h-8" alt="Logo">
        <span class="text-accent self-center text-4xl font-bold whitespace-nowrap dark:text-white">UMC</span>
      </a>
      <div class="flex md:order-2 space-x-4 rtl:space-x-reverse hover:scale-110 transition duration-300 ease-in-out">
        <button onclick="window.location.href='{{ route('register.dokter') }}'" type="button" class="text-accent font-bold bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-primary dark:hover:bg-secondary dark:focus:ring-secondary dark:text-background">
          Get Started
        </button>
        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-accent rounded-lg md:hidden hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-secondary dark:text-accent dark:hover:bg-secondary dark:focus:ring-secondary" aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
        <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-secondary rounded-lg bg-accent md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-background dark:bg-gray-800 dark:border-gray-700">
          <li>
            <a href="{{ route('homedokter') }}" class="block py-2 px-3 text-secondary bg-accent rounded md:bg-transparent md:text-accent md:p-0 hover:text-primary dark:hover:bg-secondary dark:text-accent dark:hover:text-background transition-all">
              Home
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
