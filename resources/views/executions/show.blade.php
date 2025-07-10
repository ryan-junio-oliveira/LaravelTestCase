<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="space-y-8">
                <!-- Execution Header -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-blue-100 rounded-lg">
                                    <i class="fas fa-clipboard-check text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $execution->testCase->title }}</h3>
                                    <div class="flex flex-wrap items-center gap-4 mt-2 text-sm text-gray-600">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-server text-gray-400"></i>
                                            <span>{{ $execution->system->name }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-user text-gray-400"></i>
                                            <span>{{ $execution->executed_by }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-play text-gray-400"></i>
                                            <span>{{ $execution->started_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                        @if ($execution->completed_at)
                                            <div class="flex items-center gap-1">
                                                <i class="fas fa-check text-gray-400"></i>
                                                <span>{{ $execution->completed_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $execution->status_badge }}">
                                <i class="fas fa-circle mr-2 text-xs"></i>
                                {{ $execution->status_text }}
                            </span>
                        </div>
                    </div>

                    <!-- Test Steps Section -->
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <i class="fas fa-list-ol text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Passos do Teste</h4>
                                <p class="text-sm text-gray-600">Execute e monitore cada passo do teste</p>
                            </div>
                        </div>

                        @if ($execution->testCase->steps->isEmpty())
                            <div class="text-center py-12">
                                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gray-100 mb-4">
                                    <i class="fas fa-list text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-600">Nenhum passo disponível para este caso de teste.</p>
                            </div>
                        @else
                            <div class="space-y-6">
                                @foreach ($execution->testCase->steps as $step)
                                    @php
                                        $result = $execution->results->where('test_step_id', $step->id)->first();
                                    @endphp
                                    <div class="bg-gray-50 border border-gray-200 rounded-xl overflow-hidden">
                                        <!-- Step Header -->
                                        <div class="bg-white px-6 py-4 border-b border-gray-200">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full">
                                                        <span class="text-sm font-semibold text-blue-600">{{ $step->step_number }}</span>
                                                    </div>
                                                    <h5 class="text-lg font-semibold text-gray-900">Passo {{ $step->step_number }}</h5>
                                                </div>
                                                @if ($result)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $result->status_badge }}">
                                                        <i class="fas fa-circle mr-1 text-xs"></i>
                                                        {{ $result->status_text }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Step Content -->
                                        <div class="p-6 space-y-4">
                                            <div class="grid md:grid-cols-2 gap-4">
                                                <div class="space-y-2">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-play text-blue-500"></i>
                                                        <span class="text-sm font-semibold text-gray-700">Ação</span>
                                                    </div>
                                                    <p class="text-sm text-gray-900 bg-white p-3 rounded-lg border">{{ $step->action }}</p>
                                                </div>
                                                <div class="space-y-2">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-bullseye text-green-500"></i>
                                                        <span class="text-sm font-semibold text-gray-700">Resultado Esperado</span>
                                                    </div>
                                                    <p class="text-sm text-gray-900 bg-white p-3 rounded-lg border">{{ $step->expected_result }}</p>
                                                </div>
                                            </div>

                                            @if ($result)
                                                @if ($result->actual_result)
                                                    <div class="space-y-2">
                                                        <div class="flex items-center gap-2">
                                                            <i class="fas fa-clipboard-check text-orange-500"></i>
                                                            <span class="text-sm font-semibold text-gray-700">Resultado Real</span>
                                                        </div>
                                                        <p class="text-sm text-gray-900 bg-white p-3 rounded-lg border">{{ $result->actual_result }}</p>
                                                    </div>
                                                @endif
                                                @if ($result->notes)
                                                    <div class="space-y-2">
                                                        <div class="flex items-center gap-2">
                                                            <i class="fas fa-sticky-note text-yellow-500"></i>
                                                            <span class="text-sm font-semibold text-gray-700">Notas</span>
                                                        </div>
                                                        <p class="text-sm text-gray-900 bg-white p-3 rounded-lg border">{{ $result->notes }}</p>
                                                    </div>
                                                @endif
                                            @endif

                                            @if ($execution->status !== 'passed' && $execution->status !== 'failed')
                                                <!-- Step Update Form -->
                                                <div class="bg-white rounded-lg border border-gray-200 p-4">
                                                    <form action="{{ route('executions.updateStep', $execution) }}" method="POST" class="space-y-4">
                                                        @csrf
                                                        <input type="hidden" name="step_id" value="{{ $step->id }}">
                                                        
                                                        <div class="grid md:grid-cols-3 gap-4">
                                                            <div class="space-y-2">
                                                                <label class="block text-sm font-semibold text-gray-700">
                                                                    <i class="fas fa-flag mr-1 text-gray-400"></i>
                                                                    Status
                                                                </label>
                                                                <select name="status"
                                                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm @error('status') border-red-500 ring-red-500 @enderror" 
                                                                        required>
                                                                    <option value="passed" {{ old('status', $result->status) === 'passed' ? 'selected' : '' }}>Aprovado</option>
                                                                    <option value="failed" {{ old('status', $result->status) === 'failed' ? 'selected' : '' }}>Reprovado</option>
                                                                    <option value="blocked" {{ old('status', $result->status) === 'blocked' ? 'selected' : '' }}>Bloqueado</option>
                                                                </select>
                                                                @error('status')
                                                                    <p class="mt-1 text-xs text-red-600 flex items-center">
                                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                                        {{ $message }}
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="md:col-span-2 space-y-2">
                                                                <label class="block text-sm font-semibold text-gray-700">
                                                                    <i class="fas fa-clipboard-check mr-1 text-gray-400"></i>
                                                                    Resultado Real
                                                                </label>
                                                                <textarea name="actual_result" 
                                                                          rows="2" 
                                                                          placeholder="Descreva o resultado obtido..."
                                                                          class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm @error('actual_result') border-red-500 ring-red-500 @enderror">{{ old('actual_result', $result->actual_result) }}</textarea>
                                                                @error('actual_result')
                                                                    <p class="mt-1 text-xs text-red-600 flex items-center">
                                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                                        {{ $message }}
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="space-y-2">
                                                            <label class="block text-sm font-semibold text-gray-700">
                                                                <i class="fas fa-sticky-note mr-1 text-gray-400"></i>
                                                                Notas
                                                            </label>
                                                            <textarea name="notes" 
                                                                      rows="2" 
                                                                      placeholder="Adicione observações adicionais..."
                                                                      class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm @error('notes') border-red-500 ring-red-500 @enderror">{{ old('notes', $result->notes) }}</textarea>
                                                            @error('notes')
                                                                <p class="mt-1 text-xs text-red-600 flex items-center">
                                                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        
                                                        <button type="submit" 
                                                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 text-sm shadow-sm">
                                                            <i class="fas fa-save"></i>
                                                            <span>Atualizar Passo</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                @if ($execution->status !== 'passed' && $execution->status !== 'failed')
                    <!-- Finalize Execution Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <i class="fas fa-flag-checkered text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">Finalizar Execução</h4>
                                    <p class="text-sm text-gray-600">Defina o status final e adicione observações</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <form action="{{ route('executions.complete', $execution) }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">
                                            <i class="fas fa-flag mr-2 text-gray-400"></i>
                                            Status Final
                                        </label>
                                        <select id="status" 
                                                name="status"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('status') border-red-500 ring-red-500 @enderror" 
                                                required>
                                            <option value="passed" {{ old('status') === 'passed' ? 'selected' : '' }}>
                                                <i class="fas fa-check-circle mr-2"></i>Aprovado
                                            </option>
                                            <option value="failed" {{ old('status') === 'failed' ? 'selected' : '' }}>
                                                <i class="fas fa-times-circle mr-2"></i>Reprovado
                                            </option>
                                        </select>
                                        @error('status')
                                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">
                                            <i class="fas fa-sticky-note mr-2 text-gray-400"></i>
                                            Notas Finais
                                        </label>
                                        <textarea id="notes" 
                                                  name="notes" 
                                                  rows="4" 
                                                  placeholder="Adicione observações sobre a execução..."
                                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('notes') border-red-500 ring-red-500 @enderror">{{ old('notes', $execution->notes) }}</textarea>
                                        @error('notes')
                                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Finalizar Execução</span>
                                    </button>
                                    
                                    <form action="{{ route('executions.reset', $execution) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200"
                                                onclick="return confirm('Tem certeza que deseja resetar esta execução?')">
                                            <i class="fas fa-redo"></i>
                                            <span>Resetar Execução</span>
                                        </button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
