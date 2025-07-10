<x-app-layout>

    <x-slot name="header">
        <x-application.breadcrumb :items="[
            ['title' => 'Início', 'url' => route('dashboard')],
            ['title' => 'Casos de Teste', 'url' => route('test-cases.index')],
            ['title' => isset($testCase) ? 'Editar Caso de Teste' : 'Novo Caso de Teste'],
        ]" />
    </x-slot>

    <x-application.container>
        <div class="bg-white rounded-2xl shadow-xl border overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-6 border-b border-green-100">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-save w-6 h-6 text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">
                            {{ isset($testCase) ? __('Editar Caso de Teste') : __('Criar Novo Caso de Teste') }}</h3>
                        <p class="text-sm text-slate-600">
                            {{ isset($testCase) ? __('Atualize os detalhes e passos do teste') : __('Inclua os detalhes e passos do teste') }}
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ isset($testCase) ? route('test-cases.update', $testCase->id) : route('test-cases.store') }}"
                method="POST" class="p-8 space-y-6">
                @csrf
                @if (isset($testCase))
                    @method('PUT')
                @endif

                <!-- Sistema -->
                <div>
                    <label for="system_id" class="text-sm font-semibold text-slate-700 mb-2 block">Sistema <span
                            class="text-red-500">*</span></label>
                    <select id="system_id" name="system_id"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('system_id') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                        <option value="">Selecione um sistema</option>
                        @foreach ($systems as $system)
                            <option value="{{ $system->id }}"
                                {{ old('system_id', isset($testCase) ? $testCase->system_id : '') == $system->id ? 'selected' : '' }}>
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
                    <label for="title" class="text-sm font-semibold text-slate-700 mb-2 block">Título <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title"
                        value="{{ old('title', isset($testCase) ? $testCase->title : '') }}"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('title') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descrição -->
                <div>
                    <label for="description" class="text-sm font-semibold text-slate-700 mb-2 block">Descrição <span
                            class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 resize-none focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('description') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>{{ old('description', isset($testCase) ? $testCase->description : '') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Resultado Esperado -->
                <div>
                    <label for="expected_result" class="text-sm font-semibold text-slate-700 mb-2 block">Resultado
                        Esperado <span class="text-red-500">*</span></label>
                    <textarea id="expected_result" name="expected_result" rows="3"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 resize-none focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('expected_result') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>{{ old('expected_result', isset($testCase) ? $testCase->expected_result : '') }}</textarea>
                    @error('expected_result')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prioridade -->
                <div>
                    <label for="priority" class="text-sm font-semibold text-slate-700 mb-2 block">Prioridade <span
                            class="text-red-500">*</span></label>
                    <select id="priority" name="priority"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('priority') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                        <option value="low"
                            {{ old('priority', isset($testCase) ? $testCase->priority : '') === 'low' ? 'selected' : '' }}>
                            Baixa</option>
                        <option value="medium"
                            {{ old('priority', isset($testCase) ? $testCase->priority : '') === 'medium' ? 'selected' : '' }}>
                            Média</option>
                        <option value="high"
                            {{ old('priority', isset($testCase) ? $testCase->priority : '') === 'high' ? 'selected' : '' }}>
                            Alta</option>
                        <option value="critical"
                            {{ old('priority', isset($testCase) ? $testCase->priority : '') === 'critical' ? 'selected' : '' }}>
                            Crítica
                        </option>
                    </select>
                    @error('priority')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="text-sm font-semibold text-slate-700 mb-2 block">Status <span
                            class="text-red-500">*</span></label>
                    <select id="status" name="status"
                        class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-900 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 @error('status') border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-100 @enderror"
                        required>
                        <option value="draft"
                            {{ old('status', isset($testCase) ? $testCase->status : '') === 'draft' ? 'selected' : '' }}>
                            Rascunho</option>
                        <option value="active"
                            {{ old('status', isset($testCase) ? $testCase->status : '') === 'active' ? 'selected' : '' }}>
                            Ativo</option>
                        <option value="archived"
                            {{ old('status', isset($testCase) ? $testCase->status : '') === 'archived' ? 'selected' : '' }}>
                            Arquivado
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Passos -->
                <div class="border-t pt-6">
                    <h4 class="text-md font-semibold text-slate-900 mb-4">Passos do Teste</h4>
                    <div id="steps-container" class="space-y-4">
                        @php
                            $steps = old(
                                'steps',
                                isset($testCase) && $testCase->steps ? $testCase->steps->toArray() : [[]],
                            );
                        @endphp
                        @foreach ($steps as $index => $step)
                            <div class="step-item border p-4 rounded-xl space-y-3 bg-slate-50"
                                id="div-step-{{ $index }}">
                                <div>
                                    <label class="text-sm font-medium text-slate-700 mb-1 block">Ação</label>
                                    <textarea name="steps[{{ $index }}][action]" rows="2" class="form-textarea w-full" required>{{ old("steps.$index.action", $step['action'] ?? '') }}</textarea>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-slate-700 mb-1 block">Resultado
                                        Esperado</label>
                                    <textarea name="steps[{{ $index }}][expected_result]" rows="2" class="form-textarea w-full" required>{{ old("steps.$index.expected_result", $step['expected_result'] ?? '') }}</textarea>
                                </div>
                                @if ($index > 0)
                                    <button type="button" onclick="removeStep('div-step-{{ $index }}')"
                                        class="remove-step text-red-600 hover:text-red-800 mt-2 text-sm">Remover
                                        Passo</button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-step"
                        class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 bg-green-100 rounded-xl hover:bg-green-200 transition">
                        <i class="fas fa-plus w-4 h-4 mr-2"></i>
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
                        <i class="fas fa-save w-4 h-4 mr-2 inline"></i>
                        {{ isset($testCase) ? __('Atualizar Caso') : __('Salvar Caso') }}
                    </button>
                </div>
            </form>
        </div>
    </x-application.container>
</x-app-layout>

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

    const removeStep = (id) => {
        const divRemove = document.getElementById(id);
        divRemove.remove();
    }
</script>
