@extends('layouts.dashboard')

@section('title', 'Permisos del Rol')
@section('content')
    <div class="max-w-4xl mx-auto mt-6">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-surface-400 hover:text-white transition duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-surface-600 mx-2"></i>
                            <a href="{{ route('gestion-roles.index') }}"
                                class="text-sm font-medium text-surface-400 hover:text-white transition duration-200">
                                Gestión de Roles
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-surface-600 mx-2"></i>
                            <span class="text-sm font-medium text-white">
                                Permisos del Rol
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <h1 class="text-2xl font-bold text-white mb-4">Permisos del Rol: {{ ucfirst($rol->nombre) }}</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-500/20 border border-green-500/30 rounded-2xl text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('gestion-roles.update-permisos', $rol->id_roles) }}">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($permisos as $permiso)
                    <label
                        class="flex items-center space-x-2 bg-surface-700 p-3 rounded-xl cursor-pointer hover:bg-surface-600">
                        <input type="checkbox" name="permisos[]" value="{{ $permiso->id_permisos }}"
                            {{ $rol->permisos->contains('id_permisos', $permiso->id_permisos) ? 'checked' : '' }}
                            class="form-checkbox h-5 w-5 text-blue-500">
                        <span class="text-white">{{ $permiso->nombre }}</span>
                    </label>
                @endforeach
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium rounded-xl hover:from-primary-600 hover:to-primary-700 transition duration-200">
                    Guardar Permisos
                </button>
            </div>
        </form>
    </div>
@endsection
