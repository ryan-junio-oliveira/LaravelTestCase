<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h4m6 0h2M7 15h10"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">
                        {{ __('Sistemas') }}
                    </h2>
                    <p class="text-sm text-slate-600 mt-1">Gerencie todos os sistemas do projeto</p>
                </div>
            </div>
            
            <!-- Stats Summary -->
            <div class="hidden md:flex items-center space-x-6 bg-white rounded-xl px-6 py-3 shadow-sm border border-slate-200">
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ $systems->count() }}</p>
                    <p class="text-xs text-slate-600">Total</p>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-600">{{ $systems->where('status', 'active')->count() }}</p>
                    <p class="text-xs text-slate-600">Ativos</p>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-orange-600">{{ $systems->where('status', 'maintenance')->count() }}</p>
                    <p class="text-xs text-slate-600">Manutenção</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Actions -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Sistemas</h1>
                    <p class="text-slate-600 mt-1">Gerencie e monitore todos os sistemas cadastrados</p>
                </div>
                
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="text" 
                               placeholder="Buscar sistemas..." 
                               class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Filter Dropdown -->
                    <div class="relative">
                        <select class="appearance-none bg-white border-2 border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-slate-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                            <option value="">Todos os status</option>
                            <option value="active">🟢 Ativos</option>
                            <option value="inactive">🔴 Inativos</option>
                            <option value="maintenance">🟡 Manutenção</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- New System Button -->
                    <a href="{{ route('systems.create') }}" 
                       class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Novo Sistema
                    </a>
                </div>
            </div>

            @if ($systems->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-xl border-0 overflow-hidden">
                    <div class="text-center py-16 px-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h4m6 0h2M7 15h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Nenhum sistema cadastrado</h3>
                        <p class="text-slate-600 mb-8 max-w-md mx-auto">
                            Comece criando seu primeiro sistema para gerenciar casos de teste e organizar seus projetos de forma eficiente.
                        </p>
                        <a href="{{ route('systems.create') }}" 
                           class="inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Criar Primeiro Sistema
                        </a>
                    </div>
                </div>
            @else
                <!-- Systems Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($systems as $system)
                        <div class="group bg-white rounded-2xl shadow-lg border-0 overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            <!-- Card Header -->
                            <div class="relative p-6 pb-4">
                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($system->status === 'active') bg-green-100 text-green-800 border border-green-200
                                        @elseif($system->status === 'inactive') bg-red-100 text-red-800 border border-red-200
                                        @elseif($system->status === 'maintenance') bg-orange-100 text-orange-800 border border-orange-200
                                        @else bg-gray-100 text-gray-800 border border-gray-200
                                        @endif">
                                        @if($system->status === 'active') 🟢 Ativo
                                        @elseif($system->status === 'inactive') 🔴 Inativo
                                        @elseif($system->status === 'maintenance') 🟡 Manutenção
                                        @else ⚪ Desconhecido
                                        @endif
                                    </span>
                                </div>

                                <!-- System Icon & Info -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300">
                                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h4m6 0h2M7 15h10"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-slate-900 truncate group-hover:text-blue-600 transition-colors duration-200">
                                            {{ $system->name }}
                                        </h3>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-700">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                                </svg>
                                                v{{ $system->version }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="px-6 pb-4">
                                <p class="text-slate-600 text-sm leading-relaxed line-clamp-3">
                                    {{ $system->description }}
                                </p>
                            </div>

                            <!-- Card Stats -->
                            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                                <div class="flex items-center justify-between text-xs text-slate-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $system->created_at->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span>{{ $system->test_cases_count ?? 0 }} testes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Actions -->
                            <div class="px-6 py-4 bg-white border-t border-slate-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <!-- View Button -->
                                        <a href="{{ route('systems.show', $system) }}" 
                                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Ver
                                        </a>
                                    </div>

                                    <div class="flex items-center space-x-1">
                                        <!-- Edit Button -->
                                        <a href="{{ route('systems.edit', $system) }}" 
                                           class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                           title="Editar sistema">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('systems.destroy', $system) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200"
                                                    title="Excluir sistema"
                                                    onclick="return confirm('⚠️ Tem certeza que deseja excluir este sistema?\n\nEsta ação não pode ser desfeita e todos os dados relacionados serão perdidos.')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination (if needed) -->
                @if(method_exists($systems, 'links'))
                    <div class="mt-8">
                        {{ $systems->links() }}
                    </div>
                @endif
            @endif

            <!-- Quick Actions Panel -->
            <div class="mt-12 bg-white rounded-2xl shadow-lg border-0 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Ações Rápidas
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('systems.create') }}" 
                           class="flex items-center p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors duration-200 group">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium text-slate-900">Novo Sistema</p>
                                <p class="text-sm text-slate-600">Adicionar sistema ao projeto</p>
                            </div>
                        </a>

                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center p-4 bg-green-50 rounded-xl hover:bg-green-100 transition-colors duration-200 group">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium text-slate-900">Dashboard</p>
                                <p class="text-sm text-slate-600">Ver estatísticas gerais</p>
                            </div>
                        </a>

                        <a href="#" 
                           class="flex items-center p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition-colors duration-200 group">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors duration-200">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium text-slate-900">Exportar Dados</p>
                                <p class="text-sm text-slate-600">Baixar relatório completo</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
