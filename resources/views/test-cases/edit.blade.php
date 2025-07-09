<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">
                    {{ __('Editar Caso de Teste') }}
                </h2>
                <p class="text-sm text-slate-600 mt-1">Atualize as informações do caso de teste "{{ $testCase->title }}"</p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-slate-600 mb-6">
                <a href="{{ route('test-cases.index') }}" class="hover:text-slate-900 transition-colors">Casos de Teste</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-900 font-medium">{{ $testCase->title }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-900 font-medium">Editar</span>
            </nav>

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-xl border-0 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-blue-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">Editar Caso de Teste</h3>
                                <p class="text-sm text-slate-600">Atualize as informações do caso de teste</p>
                            </div>
                        </div>
                        <!-- Test Case Info Badge -->
                        <div class="hidden sm:flex items-center space-x-3 bg-white rounded-lg px-4 py-2 shadow-sm">
                            <div class="text-right">
                                <p class="text-xs text-slate-500">Criado em</p>
                                <p class="text-sm font-medium text-slate-900">{{ $testCase->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="w-px h-8 bg-slate-200"></div>
                            <div class="text-right">
                                <p class="text-xs text-slate-500">Prioridade</p>
                                <p class="text-sm font-medium text-slate-900">{{ ucfirst($testCase->priority) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('test-cases.update', $testCase) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        <!-- Sistema -->
                        <div class="group">
                            <label for="system_id" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                </svg>
                                <span>Sistema</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="system_id" 
                                        name="system_id" 
                                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 appearance-none @error('system_id') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror" 
                                        required>
                                    <option value="">Selecione um sistema</option>
                                    @foreach($systems as $system)
                                        <option value="{{ $system->id }}" {{ old('system_id', $testCase->system_id) == $system->id ? 'selected' : '' }}>
                                            {{ $system->name }} (v{{ $system->version }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-Importerror"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('system_id')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Título -->
                        <div class="group">
                            <label for="title" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span>Título</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $testCase->title) }}"
                                       class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('title') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                                       placeholder="Ex: Teste de Login de Usuário"
                                       required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    @error('title')
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @enderror
                                </div>
                            </div>
                            @error('title')
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
                                          class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 resize-none @error('description') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                                          placeholder="Descreva o propósito e contexto do caso de teste..."
                                          required>{{ old('description', $testCase->description) }}</textarea>
                                <div class="absolute top-3 right-3">
                                    @error('description')
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                        <!-- Resultado Esperado -->
                        <div class="group">
                            <label for="expected_result" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Resultado Esperado</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea id="expected_result" 
                                          name="expected_result" 
                                          rows="4"
                                          class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 resize-none @error('expected_result') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                                          placeholder="Descreva o resultado esperado do teste..."
                                          required>{{ old('expected_result', $testCase->expected_result) }}</textarea>
                                <div class="absolute top-3 right-3">
                                    @error('expected_result')
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @enderror
                                </div>
                            </div>
                            @error('expected_result')
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <!-- Prioridade -->
                        <div class="group">
                            <label for="priority" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21a2 2 0 012 2v11m-2 0l-1 1m-4 0H8m8 0a2 2 0 002-2V7m-6 14H5a2 2 0 01-2-2V7m9 14V3"></path>
                                </svg>
                                <span>Prioridade</span>
                                <span class="text-red-500">*</span>
                                <span class="text-xs text-slate-500 ml-2">(Prioridade atual: {{ ucfirst($testCase->priority) }})</span>
                            </label>
                            <div class="relative">
                                <select id="priority" 
                                        name="priority" 
                                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 appearance-none @error('priority') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror" 
                                        required>
                                    <option value="low" {{ old('priority', $testCase->priority) === 'low' ? 'selected' : '' }}>Baixa</option>
                                    <option value="medium" {{ old('priority', $testCase->priority) === 'medium' ? 'selected' : '' }}>Média</option>
                                    <option value="high" {{ old('priority', $testCase->priority) === 'high' ? 'selected' : '' }}>Alta</option>
                                    <option value="critical" {{ old('priority', $testCase->priority) === 'critical' ? 'selected' : '' }}>Crítica</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('priority')
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
                                <span class="text-red-500">*</span>
                                <span class="text-xs text-slate-500 ml-2">(Status atual: 
                                    @if($testCase->status === 'draft') 📝 Rascunho
                                    @elseif($testCase->status === 'active') 🟢 Ativo
                                    @elseif($testCase->status === 'archived') 🗄️ Arquivado
                                    @endif)
                                </span>
                            </label>
                            <div class="relative">
                                <select id="status" 
                                        name="status" 
                                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 appearance-none @error('status') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror" 
                                        required>
                                    <option value="draft" {{ old('status', $testCase->status) === 'draft' ? 'selected' : '' }}>📝 Rascunho</option>
                                    <option value="active" {{ old('status', $testCase->status) === 'active' ? 'selected' : '' }}>🟢 Ativo</option>
                                    <option value="archived" {{ old('status', $testCase->status) === 'archived' ? 'selected' : '' }}>🗄️ Arquivado</option>
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

                        <!-- Passos do Teste -->
                        <div class="border-t pt-6">
                            <h4 class="text-md font-semibold text-slate-900 flex items-center mb-4">
                                <svg class="w-5 h-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Passos do Teste
                            </h4>
                            <div id="steps-container" class="space-y-6">
                                @foreach($testCase->steps as $index => $step)
                                    <div class="step-item bg-slate-50 rounded-xl p-6 border border-slate-200">
                                        <div class="group mb-4">
                                            <label class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"></path>
                                                </svg>
                                                <span>Ação</span>
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <textarea name="steps[{{ $index }}][action]" 
                                                          rows="3"
                                                          class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 resize-none @error('steps.'.$index.'.action') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                                                          placeholder="Descreva a ação a ser realizada..."
                                                          required>{{ old('steps.'.$index.'.action', $step->action) }}</textarea>
                                                <div class="absolute top-3 right-3">
                                                    @error('steps.'.$index.'.action')
                                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    @enderror
                                                </div>
                                            </div>
                                            @error('steps.'.$index.'.action')
                                                <div class="flex items-center space-x-2 mt-2">
                                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="group">
                                            <label class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>Resultado Esperado</span>
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <textarea name="steps[{{ $index }}][expected_result]" 
                                                          rows="3"
                                                          class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 resize-none @error('steps.'.$index.'.expected_result') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                                                          placeholder="Descreva o resultado esperado desta ação..."
                                                          required>{{ old('steps.'.$index.'.expected_result', $step->expected_result) }}</textarea>
                                                <div class="absolute top-3 right-3">
                                                    @error('steps.'.$index.'.expected_result')
                                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    @enderror
                                                </div>
                                            </div>
                                            @error('steps.'.$index.'.expected_result')
                                                <div class="flex items-center space-x-2 mt-2">
                                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                                                </div>
                                            @enderror
                                        </div>
                                        @if($index > 0)
                                            <button type="button" class="remove-step inline-flex items-center justify-center px-4 py-2 mt-4 text-sm font-medium text-red-600 bg-red-50 border-2 border-red-200 rounded-xl hover:bg-red-100 hover:border-red-300 focus:outline-none focus:ring-4 focus:ring-red-100 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Remover Passo
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-step" class="mt-6 inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-slate-600 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-4 focus:ring-slate-100 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Adicionar Passo
                            </button>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 pt-8 mt-8 border-t border-slate-200">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center space-x-2 text-sm text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Última atualização: {{ $testCase->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                                <a href="{{ route('test-cases.index') }}"
                                   class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-slate-600 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-4 focus:ring-slate-100 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Cancelar
                                </a>
                                <button type="submit" 
                                        class="inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Atualizar Caso de Teste
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-xl p-6 shadow-lg border border-blue-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Cuidado com Alterações</h4>
                            <p class="text-sm text-slate-600">Mudanças podem afetar execuções existentes</p>
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
                            <h4 class="font-semibold text-slate-900">Prioridade do Teste</h4>
                            <p class="text-sm text-slate-600">Defina a prioridade com base na criticidade</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg border border-orange-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Passos Claros</h4>
                            <p class="text-sm text-slate-600">Descreva passos detalhados para reprodutibilidade</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    let stepCount = {{ $testCase->steps->count() }};
    document.getElementById('add-step').addEventListener('click', () => {
        const container = document.getElementById('steps-container');
        const newStep = document.createElement('div');
        newStep.classList.add('step-item', 'bg-slate-50', 'rounded-xl', 'p-6', 'border', 'border-slate-200');
        newStep.innerHTML = `
            <div class="group mb-4">
                <label class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"></path>
                    </svg>
                    <span>Ação</span>
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <textarea name="steps[${stepCount}][action]" rows="3" class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 resize-none" placeholder="Descreva a ação a ser realizada..." required></textarea>
                    <div class="absolute top-3 right-3">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="group">
                <label class="flex items-center space-x-2 text-sm font-semibold text-slate-700 mb-3">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Resultado Esperado</span>
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <textarea name="steps[${stepCount}][expected_result]" rows="3" class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 resize-none" placeholder="Descreva o resultado esperado desta ação..." required></textarea>
                    <div class="absolute top-3 right-3">
                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <button type="button" class="remove-step inline-flex items-center justify-center px-4 py-2 mt-4 text-sm font-medium text-red-600 bg-red-50 border-2 border-red-200 rounded-xl hover:bg-red-100 hover:border-red-300 focus:outline-none focus:ring-4 focus:ring-red-100 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Remover Passo
            </button>
        `;
        container.appendChild(newStep);
        stepCount++;

        newStep.querySelector('.remove-step').addEventListener('click', () => {
            newStep.remove();
        });
    });

    document.querySelectorAll('.remove-step').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('.step-item').remove();
        });
    });
</script>
@endpush