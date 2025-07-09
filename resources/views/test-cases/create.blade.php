<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">
                    {{ __('Novo Caso de Teste') }}
                </h2>
                <p class="text-sm text-slate-600 mt-1">Preencha os dados do caso de teste</p>
            </div>
        </div>
    </x-slot>

    <div class="p-4 max-w-3xl m-auto">
        <div class="bg-white rounded-2xl shadow-xl border overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-6 border-b border-green-100">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Criar Novo Caso de Teste</h3>
                        <p class="text-sm text-slate-600">Inclua os detalhes e passos do teste</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('test-cases.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Sistema -->
                <div>
                    <label for="system_id" class="text-sm font-semibold text-slate-700 mb-2 block">Sistema <span class="text-red-500">*</span></label>
                    <select id="system_id" name="system_id"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('system_id') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                        <option value="">Selecione um sistema</option>
                        @foreach ($systems as $system)
                            <option value="{{ $system->id }}" {{ old('system_id') == $system->id ? 'selected' : '' }}>
                                {{ $system->name }} (v{{ $system->version }})
                            </option>
                        @endforeach
                    </select>
                    @error('system_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Título -->
                <div>
                    <label for="title" class="text-sm font-semibold text-slate-700 mb-2 block">Título <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('title') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descrição -->
                <div>
                    <label for="description" class="text-sm font-semibold text-slate-700 mb-2 block">Descrição <span class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 resize-none focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('description') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Resultado Esperado -->
                <div>
                    <label for="expected_result" class="text-sm font-semibold text-slate-700 mb-2 block">Resultado Esperado <span class="text-red-500">*</span></label>
                    <textarea id="expected_result" name="expected_result" rows="3"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 resize-none focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('expected_result') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>{{ old('expected_result') }}</textarea>
                    @error('expected_result')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prioridade -->
                <div>
                    <label for="priority" class="text-sm font-semibold text-slate-700 mb-2 block">Prioridade <span class="text-red-500">*</span></label>
                    <select id="priority" name="priority"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('priority') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Baixa</option>
                        <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Média</option>
                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Alta</option>
                        <option value="critical" {{ old('priority') === 'critical' ? 'selected' : '' }}>Crítica</option>
                    </select>
                    @error('priority')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="text-sm font-semibold text-slate-700 mb-2 block">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('status') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Rascunho</option>
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Ativo</option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Arquivado</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Passos -->
                <div class="border-t pt-6">
                    <h4 class="text-md font-semibold text-slate-900 mb-4">Passos do Teste</h4>
                    <div id="steps-container" class="space-y-4">
                        <div class="step-item border p-4 rounded-xl space-y-3 bg-slate-50">
                            <div>
                                <label class="text-sm font-medium text-slate-700 mb-1 block">Ação</label>
                                <textarea name="steps[0][action]" rows="2" class="form-textarea w-full" required>{{ old('steps.0.action') }}</textarea>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-700 mb-1 block">Resultado Esperado</label>
                                <textarea name="steps[0][expected_result]" rows="2" class="form-textarea w-full" required>{{ old('steps.0.expected_result') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-step"
                        class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 bg-green-100 rounded-xl hover:bg-green-200 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Adicionar Passo
                    </button>
                </div>

                <!-- Ações -->
                <div class="flex justify-end space-x-4 border-t pt-6">
                    <a href="{{ route('test-cases.index') }}"
                        class="px-6 py-3 text-sm font-medium text-slate-600 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-8 py-3 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-green-700 rounded-xl hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        Salvar Caso
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let stepCount = 1;
            document.getElementById('add-step').addEventListener('click', () => {
                const container = document.getElementById('steps-container');
                const newStep = document.createElement('div');
                newStep.classList.add('step-item', 'border', 'p-4', 'rounded-xl', 'space-y-3', 'bg-slate-50');
                newStep.innerHTML = `
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Ação</label>
                        <textarea name="steps[${stepCount}][action]" rows="2" class="form-textarea w-full" required></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Resultado Esperado</label>
                        <textarea name="steps[${stepCount}][expected_result]" rows="2" class="form-textarea w-full" required></textarea>
                    </div>
                    <button type="button" class="remove-step text-red-600 hover:text-red-800 mt-2 text-sm">Remover Passo</button>
                `;
                container.appendChild(newStep);
                stepCount++;

                newStep.querySelector('.remove-step').addEventListener('click', () => {
                    newStep.remove();
                });
            });
        </script>
    @endpush
</x-app-layout>
