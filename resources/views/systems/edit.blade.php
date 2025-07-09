<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">
                    {{ __('Editar Sistema') }}
                </h2>
                <p class="text-sm text-slate-600 mt-1">Atualize as informações do sistema "{{ $system->name }}"</p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-slate-600 mb-6">
                <a href="{{ route('systems.index') }}" class="hover:text-slate-900 transition-colors">Sistemas</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-900 font-medium">{{ $system->name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-900 font-medium">Editar</span>
            </nav>

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-xl border-0 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-orange-50 to-red-50 px-8 py-6 border-b border-orange-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">Editar Sistema</h3>
                                <p class="text-sm text-slate-600">Atualize as informações do sistema</p>
                            </div>
                        </div>
                        
                        <!-- System Info Badge -->
                        <div class="hidden sm:flex items-center space-x-3 bg-white rounded-lg px-4 py-2 shadow-sm">
                            <div class="text-right">
                                <p class="text-xs text-slate-500">Criado em</p>
                                <p class="text-sm font-medium text-slate-900">{{ $system->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="w-px h-8 bg-slate-200"></div>
                            <div class="text-right">
                                <p class="text-xs text-slate-500">Versão atual</p>
                                <p class="text-sm font-medium text-slate-900">v{{ $system->version }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('systems.update', $system) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-8">
                        <!-- Nome do Sistema -->
                        <div class="group">
                            <label for="name" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span>Nome do Sistema</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $system->name) }}"
                                       class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 @error('name') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                                       placeholder="Ex: Sistema de Gerenciamento de Usuários"
                                       required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    @error('name')
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @enderror
                                </div>
                            </div>
                            @error('name')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Versão -->
                        <div class="group">
                            <label for="version" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                <span>Versão</span>
                                <span class="text-red-500">*</span>
                                <span class="text-xs text-slate-500 ml-2">(Versão anterior: v{{ $system->version }})</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       id="version" 
                                       name="version" 
                                       value="{{ old('version', $system->version) }}"
                                       class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 @error('version') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                                       placeholder="Ex: 1.0.1"
                                       required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    @error('version')
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @enderror
                                </div>
                            </div>
                            @error('version')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Descrição -->
                        <div class="group">
                            <label for="description" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                <span>Descrição</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea id="description" 
                                          name="description" 
                                          rows="4"
                                          class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 resize-none @error('description') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                                          placeholder="Descreva o propósito e funcionalidades principais do sistema..."
                                          required>{{ old('description', $system->description) }}</textarea>
                                <div class="absolute top-3 right-3">
                                    @error('description')
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @enderror
                                </div>
                            </div>
                            @error('description')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="group">
                            <label for="status" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Status</span>
                                <span class="text-xs text-slate-500 ml-2">(Status atual: 
                                    @if($system->status === 'active') 🟢 Ativo
                                    @elseif($system->status === 'inactive') 🔴 Inativo
                                    @elseif($system->status === 'maintenance') 🟡 Manutenção
                                    @endif)
                                </span>
                            </label>
                            <div class="relative">
                                <select id="status" 
                                        name="status" 
                                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 appearance-none @error('status') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror">
                                    <option value="active" {{ old('status', $system->status) === 'active' ? 'selected' : '' }}>
                                        🟢 Ativo
                                    </option>
                                    <option value="inactive" {{ old('status', $system->status) === 'inactive' ? 'selected' : '' }}>
                                        🔴 Inativo
                                    </option>
                                    <option value="maintenance" {{ old('status', $system->status) === 'maintenance' ? 'selected' : '' }}>
                                        🟡 Manutenção
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('status')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 pt-8 mt-8 border-t border-slate-200">
                        <!-- Left side - Danger Zone -->
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center space-x-2 text-sm text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Última atualização: {{ $system->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>

                        <!-- Right side - Action Buttons -->
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('systems.index') }}"
                               class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-slate-600 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-4 focus:ring-slate-100 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancelar
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-orange-600 to-orange-700 rounded-xl hover:from-orange-700 hover:to-orange-800 focus:outline-none focus:ring-4 focus:ring-orange-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Atualizar Sistema
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-xl p-6 shadow-lg border border-orange-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Cuidado com Alterações</h4>
                            <p class="text-sm text-slate-600">Mudanças podem afetar testes existentes</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-lg border border-blue-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Versionamento</h4>
                            <p class="text-sm text-slate-600">Atualize a versão para mudanças importantes</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Status do Sistema</h4>
                            <p class="text-sm text-slate-600">Controle a disponibilidade para testes</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Stats (if available) -->
            @if(isset($system->test_cases_count) || isset($system->executions_count))
            <div class="bg-white rounded-2xl shadow-lg border-0 overflow-hidden mt-8">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Estatísticas do Sistema
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600">{{ $system->test_cases_count ?? 0 }}</p>
                            <p class="text-sm text-slate-600">Casos de Teste</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600">{{ $system->executions_count ?? 0 }}</p>
                            <p class="text-sm text-slate-600">Execuções</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-orange-600">{{ $system->success_rate ?? 0 }}%</p>
                            <p class="text-sm text-slate-600">Taxa de Sucesso</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-purple-600">{{ $system->days_since_creation ?? 0 }}</p>
                            <p class="text-sm text-slate-600">Dias Ativo</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
