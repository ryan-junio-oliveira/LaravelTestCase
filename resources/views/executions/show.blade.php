@extends('layouts.app')

@section('title', 'Detalhamento da Execução - Sistema de Gerenciamento de Testes')
@section('page-title', 'Execução de Teste')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="card">
        <div class="p-6 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">{{ $execution->testCase->title }}</h3>
                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $execution->status_badge }}">
                    {{ $execution->status_text }}
                </span>
            </div>
            <p class="text-sm text-gray-600 mt-2">
                Sistema: {{ $execution->system->name }} | Executado por: {{ $execution->executed_by }} | Iniciado em: {{ $execution->started_at->format('d/m/Y H:i') }}
                @if($execution->completed_at)
                    | Concluído em: {{ $execution->completed_at->format('d/m/Y H:i') }}
                @endif
            </p>
        </div>

        <div class="p-6">
            <h4 class="text-md font-semibold text-gray-900 mb-4">Passos do Teste</h4>
            @if($execution->testCase->steps->isEmpty())
                <p class="text-gray-600">Nenhum passo disponível para este caso de teste.</p>
            @else
                <div class="space-y-4">
                    @foreach($execution->testCase->steps as $step)
                        @php
                            $result = $execution->results->where('test_step_id', $step->id)->first();
                        @endphp
                        <div class="border rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="text-sm font-medium text-gray-900">Passo {{ $step->step_number }}</h5>
                                @if($result)
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $result->status_badge }}">
                                        {{ $result->status_text }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600"><strong>Ação:</strong> {{ $step->action }}</p>
                            <p class="text-sm text-gray-600"><strong>Resultado Esperado:</strong> {{ $step->expected_result }}</p>
                            @if($result)
                                @if($result->actual_result)
                                    <p class="text-sm text-gray-600 mt-2"><strong>Resultado Real:</strong> {{ $result->actual_result }}</p>
                                @endif
                                @if($result->notes)
                                    <p class="text-sm text-gray-600 mt-2"><strong>Notas:</strong> {{ $result->notes }}</p>
                                @endif
                            @endif

                            @if($execution->status !== 'passed' && $execution->status !== 'failed')
                                <form action="{{ route('executions.updateStep', $execution) }}" method="POST" class="mt-4 space-y-4">
                                    @csrf
                                    <input type="hidden" name="step_id" value="{{ $step->id }}">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                        <select name="status" class="form-select @error('status') border-red-500 @enderror" required>
                                            <option value="passed" {{ old('status', $result->status) === 'passed' ? 'selected' : '' }}>Aprovado</option>
                                            <option value="failed" {{ old('status', $result->status) === 'failed' ? 'selected' : '' }}>Reprovado</option>
                                            <option value="blocked" {{ old('status', $result->status) === 'blocked' ? 'selected' : '' }}>Bloqueado</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Resultado Real</label>
                                        <textarea name="actual_result" 
                                                  rows="3"
                                                  class="form-textarea @error('actual_result') border-red-500 @enderror">{{ old('actual_result', $result->actual_result) }}</textarea>
                                        @error('actual_result')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Notas</label>
                                        <textarea name="notes" 
                                                  rows="3"
                                                  class="form-textarea @error('notes') border-red-500 @enderror">{{ old('notes', $result->notes) }}</textarea>
                                        @error('notes')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                        </svg>
                                        <span>Atualizar Passo</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if($execution->status !== 'passed' && $execution->status !== 'failed')
        <div class="card p-6">
            <h4 class="text-md font-semibold text-gray-900 mb-4">Finalizar Execução</h4>
            <form action="{{ route('executions.complete', $execution) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Final</label>
                    <select id="status" 
                            name="status" 
                            class="form-select @error('status') border-red-500 @enderror" 
                            required>
                        <option value="passed" {{ old('status') === 'passed' ? 'selected' : '' }}>Aprovado</option>
                        <option value="failed" {{ old('status') === 'failed' ? 'selected' : '' }}>Reprovado</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notas</label>
                    <textarea id="notes" 
                              name="notes" 
                              rows="3"
                              class="form-textarea @error('notes') border-red-500 @enderror">{{ old('notes', $execution->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="btn btn-primary flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Finalizar</span>
                    </button>
                    <form action="{{ route('executions.reset', $execution) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-secondary flex items-center space-x-2" onclick="return confirm('Tem certeza que deseja resetar esta execução?')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Resetar</span>
                        </button>
                    </form>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection