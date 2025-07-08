@extends('layouts.app')

@section('title', 'Novo Caso de Teste - Sistema de Gerenciamento de Testes')
@section('page-title', 'Novo Caso de Teste')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="card">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Criar Novo Caso de Teste</h3>
        </div>

        <form action="{{ route('test-cases.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label for="system_id" class="block text-sm font-medium text-gray-700 mb-2">Sistema</label>
                <select id="system_id" 
                        name="system_id" 
                        class="form-select @error('system_id') border-red-500 @enderror" 
                        required>
                    <option value="">Selecione um sistema</option>
                    @foreach($systems as $system)
                        <option value="{{ $system->id }}" {{ old('system_id') == $system->id ? 'selected' : '' }}>
                            {{ $system->name }} (v{{ $system->version }})
                        </option>
                    @endforeach
                </select>
                @error('system_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       class="form-input @error('title') border-red-500 @enderror" 
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          class="form-textarea @error('description') border-red-500 @enderror" 
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="expected_result" class="block text-sm font-medium text-gray-700 mb-2">Resultado Esperado</label>
                <textarea id="expected_result" 
                          name="expected_result" 
                          rows="3"
                          class="form-textarea @error('expected_result') border-red-500 @enderror" 
                          required>{{ old('expected_result') }}</textarea>
                @error('expected_result')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Prioridade</label>
                <select id="priority" 
                        name="priority" 
                        class="form-select @error('priority') border-red-500 @enderror" 
                        required>
                    <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Baixa</option>
                    <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Média</option>
                    <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Alta</option>
                    <option value="critical" {{ old('priority') === 'critical' ? 'selected' : '' }}>Crítica</option>
                </select>
                @error('priority')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="status" 
                        name="status" 
                        class="form-select @error('status') border-red-500 @enderror" 
                        required>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Rascunho</option>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Ativo</option>
                    <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Arquivado</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t pt-4">
                <h4 class="text-md font-semibold text-gray-900 mb-4">Passos do Teste</h4>
                <div id="steps-container" class="space-y-4">
                    <div class="step-item flex flex-col space-y-2 border p-4 rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ação</label>
                            <textarea name="steps[0][action]" 
                                      rows="2"
                                      class="form-textarea @error('steps.0.action') border-red-500 @enderror" 
                                      required>{{ old('steps.0.action') }}</textarea>
                            @error('steps.0.action')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Resultado Esperado</label>
                            <textarea name="steps[0][expected_result]" 
                                      rows="2"
                                      class="form-textarea @error('steps.0.expected_result') border-red-500 @enderror" 
                                      required>{{ old('steps.0.expected_result') }}</textarea>
                            @error('steps.0.expected_result')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="button" id="add-step" class="mt-4 btn btn-secondary flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Adicionar Passo</span>
                </button>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('test-cases.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    <span>Salvar</span>
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
        newStep.classList.add('step-item', 'flex', 'flex-col', 'space-y-2', 'border', 'p-4', 'rounded-lg');
        newStep.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ação</label>
                <textarea name="steps[${stepCount}][action]" rows="2" class="form-textarea" required></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Resultado Esperado</label>
                <textarea name="steps[${stepCount}][expected_result]" rows="2" class="form-textarea" required></textarea>
            </div>
            <button type="button" class="remove-step btn btn-danger flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Remover</span>
            </button>
        `;
        container.appendChild(newStep);
        stepCount++;

        newStep.querySelector('.remove-step').addEventListener('click', () => {
            newStep.remove();
        });
    });
</script>
@endpush
@endsection