<nav class="bg-[#5E1675] text-[#D4C2FC] shadow-lg">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{asset('image/logoHollowTCG.png')}}" class="h-8" alt="logo HollowTCG">
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-[#D4C2FC] rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                <li>
                    <a href="/" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">Inicio</a>
                </li>
                <li>
                    <a href="cards" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">Cards</a>
                </li>

                @guest
                    <li>
                        <a href="shoppingCart" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">Carrito</a>
                    </li>
                    <li>
                        <a href="login" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">Login</a>
                    </li>
                @else
                    @if(auth()->user()->role === 'user')
                        <li>
                            <a href="shoppingCart" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">Carrito</a>
                        </li>
                        <li>
                            <a href="perfil" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">Perfil</a>
                        </li>
                    @elseif(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">Panel admin</a>
                        </li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">
                                Logout
                            </button>
                        </form>
                    </li>
                @endguest
                <li>
                    <button id="theme-toggle" class="block py-2 px-3 rounded-sm hover:bg-gray-100 hover:scale-105 md:hover:bg-transparent md:border-0 md:hover:text-[#A76BBE] md:p-0 text-lg">
                        🌙 Tema
                    </button>
                </li>

            </ul>
        </div>
    </div>
</nav>
