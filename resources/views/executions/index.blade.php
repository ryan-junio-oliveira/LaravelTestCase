@extends('layouts.app')

@section('title', 'Execuções de Teste - Sistema de Gerenciamento de Testes')
@section('page-title', 'Execuções de Teste')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900">Execuções de Teste</h2>
        <button type="button" class="btn btn-primary flex items-center space-x-2" data-toggle="modal" data-target="#startExecutionModal">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <span>Iniciar Nova Execução</span>
        </button>
    </div>

    @if($executions->isEmpty())
        <div class="text-center py-12">
            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhuma execução cadastrada</h3>
            <p class="text-gray-600 mb-6">Comece iniciando uma nova execução de teste</p>
            <button type="button" class="btn btn-primary flex items-center space-x-2 mx-auto" data-toggle="modal" data-target="#startExecutionModal">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span>Iniciar Execução</span>
            </button>
        </div>
    @else
        <div class="card">
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Caso de Teste</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sistema</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Executado por</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($executions as $execution)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $execution->testCase->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $execution->system->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $execution->executed_by }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $execution->status_badge }}">
                                        {{ $execution->status_text }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $execution->started_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <a href="{{ route('executions.show', $execution) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 3 3 0 016 0zM19 12a7 7 0 11-14 7 7 0 0114 0z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Modal para Iniciar Nova Execução -->
    <div id="startExecutionModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-lg font-semibold text-gray-900">Iniciar Nova Execução</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('executions.start') }}" method="POST" class="modal-body p-6 space-y-4">
                    @csrf
                    <div>
                        <label for="test_case_id" class="block text-sm font-medium text-gray-700 mb-2">Caso de Teste</label>
                        <select id="test_case_id" 
                                name="test_case_id" 
                                class="form-select @error('test_case_id') border-red-500 @enderror" 
                                required>
                            <option value="">Selecione um caso de teste</option>
                            @foreach($testCases as $testCase)
                                <option value="{{ $testCase->id }}">{{ $testCase->title }} ({{ $testCase->system->name }})</option>
                            @endforeach
                        </select>
                        @error('test_case_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="executed_by" class="block text-sm font-medium text-gray-700 mb-2">Executado por</label>
                        <input type="text" 
                               id="executed_by" 
                               name="executed_by" 
                               value="{{ old('executed_by') }}"
                               class="form-input @error('executed_by') border-red-500 @enderror" 
                               required>
                        @error('executed_by')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span>Iniciar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Inicializar modais (assumindo uso de Bootstrap ou similar)
    if (typeof bootstrap !== 'undefined') {
        var modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            new bootstrap.Modal(modal);
        });
    }
</script>
@endpush
@endsection