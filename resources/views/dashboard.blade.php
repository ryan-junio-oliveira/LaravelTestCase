<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-8 p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Sistemas Card -->
            <div
                class="relative overflow-hidden border-0 shadow-lg bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-xl transition-all duration-300 rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-blue-700">Sistemas</p>
                            <p class="text-3xl font-bold text-blue-900">{{ $stats['totalSystems'] }}</p>
                            <p class="text-sm text-blue-600">{{ $stats['activeSystems'] }} ativos</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-200 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Casos de Teste Card -->
            <div
                class="relative overflow-hidden border-0 shadow-lg bg-gradient-to-br from-green-50 to-green-100 hover:shadow-xl transition-all duration-300 rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-green-700">Casos de Teste</p>
                            <p class="text-3xl font-bold text-green-900">{{ $stats['totalTestCases'] }}</p>
                            <p class="text-sm text-green-600">{{ $stats['activeTestCases'] }} ativos</p>
                        </div>
                        <div class="w-14 h-14 bg-green-200 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Execuções Card -->
            <div
                class="relative overflow-hidden border-0 shadow-lg bg-gradient-to-br from-purple-50 to-purple-100 hover:shadow-xl transition-all duration-300 rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-purple-700">Execuções</p>
                            <p class="text-3xl font-bold text-purple-900">{{ $stats['totalExecutions'] }}</p>
                            <p class="text-sm text-purple-600">{{ $stats['runningExecutions'] }} em execução</p>
                        </div>
                        <div class="w-14 h-14 bg-purple-200 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-purple-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taxa de Sucesso Card -->
            <div
                class="relative overflow-hidden border-0 shadow-lg bg-gradient-to-br from-orange-50 to-orange-100 hover:shadow-xl transition-all duration-300 rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-orange-700">Taxa de Sucesso</p>
                            <p class="text-3xl font-bold text-orange-900">{{ $passRate }}%</p>
                            <p class="text-sm text-orange-600">
                                {{ $stats['passedExecutions'] }}/{{ $stats['totalExecutions'] }} aprovados
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-orange-200 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-orange-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Test Results -->
            <div class="border-0 shadow-lg hover:shadow-xl transition-all duration-300 bg-white rounded-lg">
                <div class="p-6 pb-4 border-b border-slate-100">
                    <h3 class="text-xl font-semibold text-slate-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Resultado dos Testes
                    </h3>
                </div>
                <div class="p-6 space-y-6">
                    <div class="space-y-4">
                        <!-- Aprovados -->
                        <div
                            class="flex items-center justify-between p-4 bg-green-50 rounded-xl border border-green-100">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium text-green-900">Aprovados</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-xl font-bold text-green-900">{{ $stats['passedExecutions'] }}</span>
                                <div class="w-24 h-3 bg-green-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-green-500 rounded-full transition-all duration-500 animate-pulse"
                                        style="width: {{ $stats['totalExecutions'] > 0 ? ($stats['passedExecutions'] / $stats['totalExecutions']) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reprovados -->
                        <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl border border-red-100">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span class="font-medium text-red-900">Reprovados</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-xl font-bold text-red-900">{{ $stats['failedExecutions'] }}</span>
                                <div class="w-24 h-3 bg-red-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-red-500 rounded-full transition-all duration-500"
                                        style="width: {{ $stats['totalExecutions'] > 0 ? ($stats['failedExecutions'] / $stats['totalExecutions']) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Em execução -->
                        <div
                            class="flex items-center justify-between p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="font-medium text-blue-900">Em execução</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-xl font-bold text-blue-900">{{ $stats['runningExecutions'] }}</span>
                                <div class="w-24 h-3 bg-blue-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-500 rounded-full transition-all duration-500 animate-pulse"
                                        style="width: {{ $stats['totalExecutions'] > 0 ? ($stats['runningExecutions'] / $stats['totalExecutions']) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Executions -->
            <div class="border-0 shadow-lg hover:shadow-xl transition-all duration-300 bg-white rounded-lg">
                <div class="p-6 pb-4 border-b border-slate-100">
                    <h3 class="text-xl font-semibold text-slate-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Execuções Recentes
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @forelse($recentExecutions as $execution)
                            <div
                                class="flex items-center justify-between p-4 bg-white rounded-xl border border-slate-200 hover:border-slate-300 hover:shadow-md transition-all duration-200">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-10 h-10 rounded-lg flex items-center justify-center
                                        @if ($execution->status === 'passed') bg-green-50
                                        @elseif($execution->status === 'failed') bg-red-50
                                        @elseif($execution->status === 'running') bg-blue-50
                                        @else bg-gray-50 @endif">
                                        @if ($execution->status === 'passed')
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @elseif($execution->status === 'failed')
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        @elseif($execution->status === 'running')
                                            <svg class="w-5 h-5 text-blue-600 animate-spin" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 text-sm">
                                            {{ $execution->testCase->title }}</p>
                                        <p class="text-xs text-slate-500">{{ $execution->system->name }}</p>
                                    </div>
                                </div>
                                <div class="text-right space-y-1">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border-0
                                        @if ($execution->status === 'passed') bg-green-100 text-green-800
                                        @elseif($execution->status === 'failed') bg-red-100 text-red-800
                                        @elseif($execution->status === 'running') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        @if ($execution->status === 'passed')
                                            Aprovado
                                        @elseif($execution->status === 'failed')
                                            Reprovado
                                        @elseif($execution->status === 'running')
                                            Em execução
                                        @else
                                            Pendente
                                        @endif
                                    </span>
                                    <p class="text-xs text-slate-500">
                                        {{ $execution->started_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="w-12 h-12 text-slate-400 mx-auto mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                                <p class="text-slate-600 font-medium">Nenhuma execução encontrada</p>
                                <p class="text-slate-500 text-sm mt-1">As execuções aparecerão aqui quando
                                    iniciadas</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>
