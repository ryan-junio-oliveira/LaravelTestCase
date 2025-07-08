@extends('layouts.app')

@section('title', 'Dashboard - Sistema de Gerenciamento de Testes')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Dashboard</h2>
        <p class="text-gray-600">Visão geral do sistema de testes</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Sistemas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['totalSystems'] }}</p>
                    <p class="text-sm text-gray-500">{{ $stats['activeSystems'] }} ativos</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Casos de Teste</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['totalTestCases'] }}</p>
                    <p class="text-sm text-gray-500">{{ $stats['activeTestCases'] }} ativos</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Execuções</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['totalExecutions'] }}</p>
                    <p class="text-sm text-gray-500">{{ $stats['runningExecutions'] }} em execução</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Taxa de Sucesso</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $passRate }}%</p>
                    <p class="text-sm text-gray-500">
                        {{ $stats['passedExecutions'] }}/{{ $stats['totalExecutions'] }} aprovados
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Resultado dos Testes</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Aprovados</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-semibold text-gray-900">{{ $stats['passedExecutions'] }}</span>
                        <div class="w-20 h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-green-500 rounded-full" 
                                 style="width: {{ $stats['totalExecutions'] > 0 ? ($stats['passedExecutions'] / $stats['totalExecutions']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Reprovados</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-semibold text-gray-900">{{ $stats['failedExecutions'] }}</span>
                        <div class="w-20 h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-red-500 rounded-full" 
                                 style="width: {{ $stats['totalExecutions'] > 0 ? ($stats['failedExecutions'] / $stats['totalExecutions']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="text-gray-700">Em execução</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-semibold text-gray-900">{{ $stats['runningExecutions'] }}</span>
                        <div class="w-20 h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-blue-500 rounded-full" 
                                 style="width: {{ $stats['totalExecutions'] > 0 ? ($stats['runningExecutions'] / $stats['totalExecutions']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Execuções Recentes</h3>
            <div class="space-y-3">
                @forelse($recentExecutions as $execution)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            @if($execution->status === 'passed')
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @elseif($execution->status === 'failed')
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @elseif($execution->status === 'running')
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                            <div>
                                <p class="font-medium text-gray-900 text-sm">{{ $execution->testCase->title }}</p>
                                <p class="text-xs text-gray-500">{{ $execution->system->name }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $execution->status_badge }}">
                                {{ $execution->status_text }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $execution->started_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <p class="text-gray-600">Nenhuma execução encontrada</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection