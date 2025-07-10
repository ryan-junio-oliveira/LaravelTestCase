<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="space-y-8">
                <!-- Header Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <i class="fas fa-bolt text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Execuções de Teste</h2>
                                <p class="text-sm text-gray-600 mt-1">Gerencie e monitore suas execuções de teste</p>
                            </div>
                        </div>
                        <button type="button" 
                                class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md" 
                                data-toggle="modal" data-target="#startExecutionModal">
                            <i class="fas fa-play text-sm"></i>
                            <span>Iniciar Nova Execução</span>
                        </button>
                    </div>
                </div>

                @if ($executions->isEmpty())
                    <!-- Empty State -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="text-center py-16 px-6">
                            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gray-100 mb-6">
                                <i class="fas fa-bolt text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhuma execução cadastrada</h3>
                            <p class="text-gray-600 mb-8 max-w-sm mx-auto">Comece iniciando uma nova execução de teste para monitorar seus resultados</p>
                            <button type="button" 
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md" 
                                    data-toggle="modal" data-target="#startExecutionModal">
                                <i class="fas fa-play text-sm"></i>
                                <span>Iniciar Primeira Execução</span>
                            </button>
                        </div>
                    </div>
                @else
                    <!-- Executions Table -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Lista de Execuções</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $executions->count() }} execução(ões) encontrada(s)</p>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <i class="fas fa-clipboard-list mr-2 text-gray-400"></i>
                                            Caso de Teste
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <i class="fas fa-desktop mr-2 text-gray-400"></i>
                                            Sistema
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <i class="fas fa-user mr-2 text-gray-400"></i>
                                            Executado por
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <i class="fas fa-flag mr-2 text-gray-400"></i>
                                            Status
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <i class="fas fa-calendar mr-2 text-gray-400"></i>
                                            Data
                                        </th>
                                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <i class="fas fa-cog mr-2 text-gray-400"></i>
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($executions as $execution)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                                        <i class="fas fa-file-alt text-blue-600 text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $execution->testCase->title }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <i class="fas fa-server text-gray-400 mr-2"></i>
                                                    <span class="text-sm text-gray-900">{{ $execution->system->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <i class="fas fa-user-circle text-gray-400 mr-2"></i>
                                                    <span class="text-sm text-gray-900">{{ $execution->executed_by }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $execution->status_badge }}">
                                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                                    {{ $execution->status_text }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center text-sm text-gray-500">
                                                    <i class="fas fa-clock mr-2 text-gray-400"></i>
                                                    {{ $execution->started_at->format('d/m/Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <a href="{{ route('executions.show', $execution) }}"
                                                   class="inline-flex items-center justify-center w-10 h-10 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                                                    <i class="fas fa-eye text-sm group-hover:scale-110 transition-transform"></i>
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
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-xl border-0 shadow-xl">
                            <!-- Modal Header -->
                            <div class="modal-header border-b border-gray-200 p-6">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-green-100 rounded-lg">
                                        <i class="fas fa-play text-green-600"></i>
                                    </div>
                                    <div>
                                        <h5 class="modal-title text-xl font-semibold text-gray-900">Iniciar Nova Execução</h5>
                                        <p class="text-sm text-gray-600 mt-1">Configure os parâmetros para a execução</p>
                                    </div>
                                </div>
                                <button type="button" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors" data-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-times text-lg"></i>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <form action="{{ route('executions.start') }}" method="POST" class="modal-body p-6 space-y-6">
                                @csrf
                                
                                <!-- Test Case Selection -->
                                <div class="space-y-2">
                                    <label for="test_case_id" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-clipboard-list mr-2 text-gray-400"></i>
                                        Caso de Teste
                                    </label>
                                    <select id="test_case_id" name="test_case_id"
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('test_case_id') border-red-500 ring-red-500 @enderror" 
                                            required>
                                        <option value="">Selecione um caso de teste</option>
                                        @foreach ($testCases as $testCase)
                                            <option value="{{ $testCase->id }}">{{ $testCase->title }} ({{ $testCase->system->name }})</option>
                                        @endforeach
                                    </select>
                                    @error('test_case_id')
                                        <p class="mt-1 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Executed By -->
                                <div class="space-y-2">
                                    <label for="executed_by" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-user mr-2 text-gray-400"></i>
                                        Executado por
                                    </label>
                                    <input type="text" 
                                           id="executed_by" 
                                           name="executed_by" 
                                           value="{{ old('executed_by') }}"
                                           placeholder="Digite o nome do executor"
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('executed_by') border-red-500 ring-red-500 @enderror" 
                                           required>
                                    @error('executed_by')
                                        <p class="mt-1 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Modal Footer -->
                                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                                    <button type="button" 
                                            class="flex-1 sm:flex-none px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200" 
                                            data-dismiss="modal">
                                        <i class="fas fa-times mr-2"></i>
                                        Cancelar
                                    </button>
                                    <button type="submit" 
                                            class="flex-1 sm:flex-none px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                        <i class="fas fa-play mr-2"></i>
                                        Iniciar Execução
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Inicializar modais (assumindo uso de Bootstrap ou similar)
    if (typeof bootstrap !== 'undefined') {
        var modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            new bootstrap.Modal(modal);
        });
    }
</script>
