<nav class="fixed top-0 z-50 w-full bg-sky-900 border-b border-sky-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">

                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <i class="fas fa-bars text-lg"></i>
                </button>

                <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">DokTestCase</span>
                </a>

            </div>

            <div class="flex items-center">
                <div class="flex items-center ms-3">

                    <div>
                        <button type="button"
                            class="flex items-center justify-center w-10 h-10 text-sky-900 bg-yellow-400 rounded-full focus:ring-4 focus:ring-gray-300"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <i class="fa-solid fa-user text-xl"></i>
                        </button>
                    </div>

                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900" role="none">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li><a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Meu Perfil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">

            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-blue-600 font-semibold' : 'text-gray-900 hover:bg-gray-100' }}">
                    <i
                        class="fas fa-chart-pie w-5 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('systems.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('systems.*') ? 'bg-gray-100 text-blue-600 font-semibold' : 'text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-cogs w-5 {{ request()->routeIs('systems.*') ? 'text-blue-600' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                    <span class="ms-3">Sistemas</span>
                </a>
            </li>

            <li>
                <a href="{{ route('test-cases.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('test-cases.*') ? 'bg-gray-100 text-blue-600 font-semibold' : 'text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-vial w-5 {{ request()->routeIs('test-cases.*') ? 'text-blue-600' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                    <span class="ms-3">Casos de Teste</span>
                </a>
            </li>

            <li>
                <a href="{{ route('executions.index') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('executions.*') ? 'bg-gray-100 text-blue-600 font-semibold' : 'text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-play-circle w-5 {{ request()->routeIs('executions.*') ? 'text-blue-600' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                    <span class="ms-3">Execuções</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<div class="p-4 sm:ml-64">
    <div class="mt-14">
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="flex-grow w-full max-w-7xl mb-6 m-auto mt-6">
            {{ $slot }}
        </main>
    </div>
</div>
