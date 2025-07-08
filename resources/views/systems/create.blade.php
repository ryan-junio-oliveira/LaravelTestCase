@extends('layouts.app')

@section('title', 'Novo Sistema - Sistema de Gerenciamento de Testes')
@section('page-title', 'Novo Sistema')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Criar Novo Sistema</h3>
        </div>

        <form action="{{ route('systems.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome do Sistema</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="form-input @error('name') border-red-500 @enderror" 
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="version" class="block text-sm font-medium text-gray-700 mb-2">Versão</label>
                <input type="text" 
                       id="version" 
                       name="version" 
                       value="{{ old('version') }}"
                       class="form-input @error('version') border-red-500 @enderror" 
                       required>
                @error('version')
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
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="status" 
                        name="status" 
                        class="form-select @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Ativo</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inativo</option>
                    <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Manutenção</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('systems.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
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
@endsection