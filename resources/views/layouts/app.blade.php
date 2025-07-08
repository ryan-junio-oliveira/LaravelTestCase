<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Sistema de Gerenciamento de Testes')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Mobile sidebar overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden">
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg">
            <div class="flex items-center justify-between p-4 border-b">
                <h1 class="text-xl font-bold text-gray-800">TestManager</h1>
                <button id="close-mobile-menu" class="p-2 rounded-md hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            @include('layouts.navigation')
        </div>
    </div>

    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full lg:block">
        <div class="flex items-center justify-between p-4 border-b">
            <h1 class="text-xl font-bold text-gray-800">TestManager</h1>
        </div>
        @include('layouts.navigation')
    </div>

    <!-- Main content -->
    <div class="lg:ml-64">
        <!-- Top bar -->
        <div class="bg-white shadow-sm border-b">
            <div class="px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <button id="mobile-menu-button" class="p-2 rounded-md hover:bg-gray-100 lg:hidden">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h2 class="text-lg font-semibold text-gray-900">
                        @yield('page-title', 'Dashboard')
                    </h2>
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-medium">U</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <main class="p-4 sm:p-6 lg:p-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>